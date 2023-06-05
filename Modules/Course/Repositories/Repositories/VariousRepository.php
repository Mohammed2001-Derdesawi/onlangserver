<?php

namespace Modules\Course\Repositories\Repositories;

use Modules\Course\Entities\Various;
use Pion\Laravel\ChunkUpload\Receiver\FileReceiver;
use Pion\Laravel\ChunkUpload\Handler\HandlerFactory;
use Modules\Course\Repositories\Interfaces\VariousInterface;

class VariousRepository implements VariousInterface{
    protected $path='images\variouses';
    protected $attachmentpath="attachments\\various";
    public function index($relations=[],$count=[],$params=['*'],$paginate=10)
     {
        if($paginate>50)
        $paginate=50;
        $variouses=Various::with($relations)->select($params)->withCount($count)->search()->paginate($paginate);
        return $variouses;

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



         return Various::SelectRaw($search)->search()->first();
     }
    public function store($request)
    {

        $create=[
            'title_ar'=>$request->title_ar,
            'title_en'=>$request->title_en,
            'description_ar'=>$request->description_ar,
            'description_en'=>$request->description_en,
            'description_en'=>$request->description_en,
            'group_id'=>$request->group??null,
            'poster'=>'storage\\'.$this->path."\\".storeImage($this->path,$request->image),
            "type"=>$request->type,
            "path"=>$request->path,
            'added_id'=>auth()->guard('admin')->user()->id,
        ];
        $various=Various::create($create);

        return $various;

    }
    public function find($id, $params = ['*'], $relations = [], $count = [])
    {
       return findById(Various::class,$id,$relations,$params,$count);
    }
    public function delete($id)
    {
       $various=$this->find($id,['id']);
       if($various->attachments)
       {
        foreach($various->attachments as $attachment)
           deleteImage($attachment->path);
           $various->attachments()->delete();
       }
       $various->delete();
       return true;
    }
    public function update($id, $request)
    {

         $various=$this->find($id,['*']);
         $update=[
            'title_ar'=>$request->title_ar,
            'title_en'=>$request->title_en,
            'description_ar'=>$request->description_ar,
            'description_en'=>$request->description_en,
            'description_en'=>$request->description_en,
            'group_id'=>$request->group??null,
            "type"=>$request->type,
            "path"=>$request->path,
            'added_id'=>auth()->guard('admin')->user()->id,
        ];
        if($request->image)
        {
            $update['poster']='storage\\'.$this->path."\\".editImage($this->path,$request->image,$various->poster);

        }
        $various->update($update);
        return $various;
    }

    public function uploadFile($id,$request){

        $receiver = new FileReceiver('file', $request, HandlerFactory::classFromRequest($request));

        if (!$receiver->isUploaded()) {
            // file not uploaded
        }

        $fileReceived = $receiver->receive();
       // receive file

        if ($fileReceived->isFinished()) { // file uploading is complete / all chunks are uploaded
            $various=$this->find($id,['id']);

            $file = $fileReceived->getFile(); // get file

            $path="storage\\".$this->attachmentpath."\\".storeImage($this->attachmentpath,$file);




            // delete chunked file
            $size=$file->getSize();
            $type=substr($file->getMimeType(), 0, 5) == 'image'?"image":"file";


            unlink($file->getPathname());

             $various->attachments()->create([
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
    public function downloadAttachment($various,$id){
        $various=$this->find($various);
        $file=$various->attachments()->findOrFail($id);

        return $file;


    }
    public function deleteAttachment($various,$id){
        $various=$this->find($various);
        $file=$various->attachments()->findOrFail($id);
        deleteImage($file->path);
         $file->delete();

         return true;

    }



    public function showAllPaidVideos($id){

        $allPaidVideos = Various::where('group_id' , $id)->where('type' , 'paid')->get();

        return  $allPaidVideos ;

    }
    public function showAllFreeVideos($id){
        $allFreeVideos = Various::where([
         ['group_id' , $id]
        ,['type' , 'free']
        ])->get();

        return  $allFreeVideos ;

    }


    public function showOnePiadVideo($id){

        $PaidDetails = Various::where('type','paid')->with('attachments' , 'reviews')->findorfail($id);
        $recents = Various::where('type','paid')->with('attachments' , 'reviews')->whereNotIn('id' ,[$PaidDetails->id])->take(10)->get();

           return [ $PaidDetails ,$recents];
    }
    public function showOneFreeVideo($id){
      $FreeDetails = Various::where('type','free')->with( 'attachments', 'reviews')->findorfail($id);
      $recents = Various::where('type','free')->where('group_id',$FreeDetails->group_id)->whereNotIn('id' ,[$FreeDetails->id])->take(10)->get();

      return [ $FreeDetails ,$recents];

    }






}
