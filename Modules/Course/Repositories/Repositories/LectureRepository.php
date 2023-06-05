<?php

namespace Modules\Course\Repositories\Repositories;

use Modules\Course\Entities\Note;
use Modules\Course\Entities\Course;
use Illuminate\Support\Facades\Auth;
use Modules\Course\Entities\Lecture;
use Pion\Laravel\ChunkUpload\Receiver\FileReceiver;
use Pion\Laravel\ChunkUpload\Handler\HandlerFactory;
use Modules\Course\Repositories\Interfaces\LectureInterface;
use Darryldecode\Cart\Cart;
use Modules\User\Entities\Payment;
use Modules\Course\Entities\Language;
use Illuminate\Support\Facades\Request;
use Modules\User\Repositories\Interfaces\PaymentRepositoryInterface;
use Modules\User\Repositories\Interfaces\CartInterface;
use Illuminate\Routing\Controller;

class LectureRepository implements LectureInterface{
    protected $path='images\lectures';
    protected $attchmenntpath="attachments\lectures";
    public function index($relations=[],$count=[],$params=['*'],$paginate=10){
        if($paginate>50)
        $paginate=50;
        $lectures=Lecture::with($relations)->select($params)->withCount($count)->search()->paginate($paginate);
        return $lectures;

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



        return Lecture::SelectRaw($search)->search()->first();
    }
    public function store($request){
        $create=[
            'title_ar'=>$request->title_ar,
            'title_en'=>$request->title_en,
            'path_video'=>$request->lecture_link,
            'duration_video'=>$request->duration,
            'visiable'=>$request->visiable,
            'order'=>$request->order,
            'course_id'=>$request->course,
            'description_ar'=>$request->description_ar,
            'description_en'=>$request->description_en,
            'type'=>$request->type,
            'duration'=>$request->duration,
            'added_id'=>auth()->guard('admin')->user()->id

        ];
        if($request->file("poster"))
        {
            $create['poster']='storage\\'.$this->path."\\".storeImage($this->path,$request->poster);

        }
        $lecture=Lecture::create($create);
        return $lecture;
    }
    public function update($id,$request){
        $lecture=$this->find($id,['*']);

        $update=[
            'title_ar'=>$request->title_ar,
            'title_en'=>$request->title_en,
            'path_video'=>$request->lecture_link,
            'duration_video'=>$request->duration,
            'visiable'=>$request->visiable,
            'order'=>$request->order,
            'course_id'=>$request->course,
            'description_ar'=>$request->description_ar,
            'description_en'=>$request->description_en,
            'type'=>$request->type,
            'duration'=>$request->duration

        ];
        if($request->file("poster"))
        {
            $update['poster']='storage\\'.$this->path."\\".storeImage($this->path,$request->poster);

        }
        //dd( $update);

        $lecture->update($update);
        return true;

    }
    public function find($id,$params=['*'],$relations=[],$count=[]){
        return findById(Lecture::class,$id,$relations,$params,$count);

    }
    public function delete($id){
        $lecture=$this->find($id,['id'],['attachments']);
        if($lecture->poster)
        deleteImage($lecture->poster);
        if($lecture->attachments)
        {
            foreach($lecture->attachments as $attachment)
            deleteImage($attachment->path);
            $lecture->attachments()->delete();
        }
        $lecture->delete();
        return true;


    }
    public function getCourseLecture($id,$relations=[],$params=['*'],$count=[],$paginate=10){
        if($paginate>20)
        $paginate=20;
        return Lecture::with($relations)->select($params)->withCount($count)->where('course_id',$id)->search()->paginate($paginate);
    }
    public function uploadFile($id,$request){
        $receiver = new FileReceiver('file', $request, HandlerFactory::classFromRequest($request));

        if (!$receiver->isUploaded()) {
            // file not uploaded
        }

        $fileReceived = $receiver->receive();
       // receive file

        if ($fileReceived->isFinished()) { // file uploading is complete / all chunks are uploaded
            $file = $fileReceived->getFile(); // get file

            $path="storage\\".$this->attchmenntpath."\\".storeImage($this->attchmenntpath,$file);




            // delete chunked file
            $size=$file->getSize();
            $type=substr($file->getMimeType(), 0, 5) == 'image'?"image":"file";


            unlink($file->getPathname());

             $lecture=$this->find($id);
             $lecture->attachments()->create([
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
    public function downloadAttachment($lecture,$id){
        $lecture=$this->find($lecture);
        $file=$lecture->attachments()->findOrFail($id);

        return $file;


    }
    public function deleteAttachment($lecture,$id){
        $lecture=$this->find($lecture);
        $file=$lecture->attachments()->findOrFail($id);
        deleteImage($file->path);
         $file->delete();

         return true;

    }



    public function showlectures($id){
        $Lectures = Lecture::with('course:id,image,price,title_ar,title_en')->where('visiable',1)->findOrFail($id);
          $user = auth()->user()?auth()->user()->load(['notes'=>function($q) use($Lectures){
            $q->where('lecture_id',$Lectures->id);
          },'courses:id']):null;
          $user_courses=[];
          if($user && $user->courses)
           $user_courses=$user->courses->pluck('id')->toArray();
        $notes=[];
        if($user && $user->notes)
        $notes=$user->notes;
        if($Lectures->type == '1' && !in_array($Lectures->course_id , $user_courses))
        {
      
          if ($user) {
            $courses=$user->courses;     
          
            if(! \Cart::session($user->id)->get($Lectures->course_id)){
              \Cart::session($user->id)->add(array(
                'id' => $Lectures->course->id, // inique row ID
                'name' =>app()->getLocale()=='en'? $Lectures->course->title_en:$Lectures->course->title_ar,
                'price' =>$Lectures->course->price,
                'quantity' => 1,
                'attributes' => array()
          
            ));
            }
            
          } else {
          
            if( ! \Cart::get($Lectures->course->id)){
              \Cart::add(array(
                'id' => $Lectures->course->id, // inique row ID
                'name' =>app()->getLocale()=='en'? $Lectures->course->title_en:$Lectures->course->title_ar,
                'price' =>$Lectures->course->price,
                'quantity' => 1,
                'attributes' => array()
          
            ));
            }
          
          
          }
      
          return redirect()->route('cart.details');          
      
        }
       
    
      $recentLectures = Lecture::where('visiable',1)->where('course_id' ,$Lectures->course_id )->where('id','<>' ,$id)->orderBy('order')->get();
      
           $Lectures->visit();
            return view('course::User.Lecture.lecture',[
                'Lectures'=>$Lectures,
                'notes'=>$notes,
      
                'user_courses'=>$user_courses,
                'recentLectures'=>$recentLectures,
      ]);
      
      
      
      
      }



}
