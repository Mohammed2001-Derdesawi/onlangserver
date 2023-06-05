<?php

namespace Modules\Course\Repositories\Repositories;

use Illuminate\Support\Carbon;
use Modules\Course\Entities\Note;
use Modules\Course\Entities\Course;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Storage;
use Modules\Course\Entities\Attachment;
use Pion\Laravel\ChunkUpload\Receiver\FileReceiver;
use Pion\Laravel\ChunkUpload\Handler\HandlerFactory;
use Modules\Course\Repositories\Interfaces\CourseInterface;


class CourseRepository implements CourseInterface{
    protected $path='images\courses';
    protected $attachmentpath="attachments\course";
    public function index($relations=[],$count=[],$params=['*'],$paginate=10)
     {
        if($paginate>50)
        $paginate=50;
        $courses=Course::with($relations)->select($params)->withCount($count)->search()->language()->paginate($paginate);
        return $courses;

     }
     public function getAll($relations = [], $params = ['*'], $count = [])
     {
         return Course::with($relations)->select($params)->withCount($count)->get();
     }
     public function getScopes($scopes)
     {

         $allscopes=["count"=>"COUNT(id)","max"=>"MAX(id)","min"=>"MIN(id)"];
         $keys=array_keys($allscopes);
         $search=[];
         foreach($scopes as $scope)
         {

             if(in_array($scope,$keys)){
                 $search[$scope]=$allscopes[$scope]." as ".$scope;
             }
         }
         if(count($search)==0)
         return collect();

         $search=implode(',',array_values($search));



         return Course::SelectRaw($search)->search()->language()->first();
     }
    public function store($request)
    {
        $start_at=new Carbon($request->start_at);
        $end_at=new Carbon($request->end_at);

        $create=[
            'title_ar'=>$request->title_ar,
            'title_en'=>$request->title_en ,
            'description_ar'=>$request->description_ar,
            'description_en'=>$request->description_en,
            'meta_description'=>$request->meta_description,
            'features'=>$request->features,
            'start_at'=>$start_at->toDateTimeString(),
            'end_at'=>$end_at->toDateTimeString(),
            'duration'=>$request->duration,
            'price'=>(float)$request->price,
            'visiable'=>$request->visiable,
            'type'=>$request->type,
            'preview_video'=>$request->preview,
            'added_id'=>auth()->guard('admin')->user()->id,
            'image'=>'storage\\'.$this->path."\\".storeImage($this->path,$request->picture),
            'language_id'=>null

        ];


        if($request->language)
        {
            $create["language_id"]=$request->language;
        }
        $course=Course::create($create);
        if($request->teachers && $request->teachers[0]!=null)
            $course->teachers()->attach($request->teachers);
        return true;

    }
    public function find($id, $params = ['*'], $relations = [], $count = [])
    {
       return findById(Course::class,$id,$relations,$params,$count);
    }
    public function delete($id)
    {
       $course=$this->find($id,['id'],['attachment']);
       if($course->attachment)
       {

           deleteImage($course->attachment->path);
           $course->attachment()->delete();
       }
       $course->delete();
       return true;
    }
    public function update($id, $request)
    {
        $start_at=new Carbon($request->start_at);
        $end_at=new Carbon($request->end_at);
         $course=$this->find($id,['*']);
         $update=[
            'title_ar'=>$request->title_ar,
            'title_en'=>$request->title_en ,
            'description_ar'=>$request->description_ar,
            'description_en'=>$request->description_en,
            'meta_description'=>$request->meta_description,
            'features'=>$request->features,
            'start_at'=>$start_at->toDateTimeString(),
            'end_at'=>$end_at->toDateTimeString(),
            'duration'=>$request->duration,
            'price'=>$request->price,
            'visiable'=>$request->visiable,
            'type'=>$request->type,
            'preview_video'=>$request->preview,
            'language_id'=>$request->language??null

        ];
         if($request->file("picture")){
            $update["image"]='storage\\'.$this->path."\\".editImage($this->path,$request->picture,$course->image);

         }
        $course->update($update);
        if(!is_array($request->teachers))
        $request->teachers=[];
            $course->teachers()->sync($request->teachers);

        return true;
    }

    public function uploadFile($id,$request){

        $receiver = new FileReceiver('file', $request, HandlerFactory::classFromRequest($request));

        if (!$receiver->isUploaded()) {
            // file not uploaded
        }

        $fileReceived = $receiver->receive();
       // receive file

        if ($fileReceived->isFinished()) { // file uploading is complete / all chunks are uploaded
            $course=$this->find($id,['id'],['attachment:id,attachmentable_id']);
            if($course->attachment)
            return [
                'error' =>'تم رفع الملف بالفعل للدورة',
            ];

            $file = $fileReceived->getFile(); // get file

            $path="storage\\".$this->attachmentpath."\\".storeImage($this->attachmentpath,$file);




            // delete chunked file
            $size=$file->getSize();
            $type=substr($file->getMimeType(), 0, 5) == 'image'?"image":"file";


            unlink($file->getPathname());

             $course->attachment()->create([
                'path'=>$path,
                'title'=>$file->getClientOriginalName(),
                'description_ar'=>$request->description_ar,
                'description_en'=>$request->description_en,
                 'size'=>$size,
                 "type"=>$type,

             ]);
            return [
                'message' =>'تم رفع الملف بنجاح',


            ];
        }

        // otherwise return percentage information
        $handler = $fileReceived->handler();
        return [
            'done' => $handler->getPercentageDone(),
            'status' => true
        ];
    }
    public function downloadAttachment($course,$id){
        $course=$this->find($course);
        $file=$course->attachments()->findOrFail($id);

        return $file;


    }
    public function deleteAttachment($course,$id){
        $course=$this->find($course);
        $file=$course->attachment()->findOrFail($id);
        deleteImage($file->path);
         $file->delete();

         return true;

    }


    public function showAllCourses($slug){
        $allCourses = Course::whereHas('language' , function ($q) use ($slug){
            return $q->where('slug', $slug);
        })->with(['teachers' ,"lectures"=>function ($q){
            return $q->where("visiable",1);
        }])->where('visiable' , 1)->paginate(12);
        if( auth()->user())
        {
            auth()->user()->load('courses');
        }
        return  $allCourses ;

    }
    public function showcourseDetailsPage($slug){

        $courseDetails = Course::with([  'language','attachment' ,'reviews',"teachers"=>function ($q){
            return $q->where('has_private_learning', 0);
        }  ,"lectures"=>function ($q){
            return $q->where("visiable",1)->orderBy('order');
        }])->where('visiable' , 1)->where('slug',$slug)->first();

        $oneRealated = Course::where('language_id' , $courseDetails->language_id)->where('visiable' , 1)->whereNotIn('slug' , [$slug])->take(1)->get();
        if( auth()->user())
        {
            auth()->user()->load('courses');
        }
        $user_courses = auth()->user()?auth()->user()->courses->pluck('id')->toArray():[];
        return  [$courseDetails,$user_courses , $oneRealated] ;

    }



    public function myCourses(){

        $user =  auth()->user()->load(['courses'=>function($q){
            $q->withCount(['lectures as lec_count' => function ($query) {
                $query->where('visiable', 1);
            }]);
        }]);

        return $user ;
    }

}
