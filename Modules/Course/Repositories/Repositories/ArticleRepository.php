<?php

namespace Modules\Course\Repositories\Repositories;

use Illuminate\Support\Carbon;
use Modules\Course\Entities\Review;
use Modules\Course\Entities\Article;
use Pion\Laravel\ChunkUpload\Receiver\FileReceiver;
use Pion\Laravel\ChunkUpload\Handler\HandlerFactory;
use Modules\Course\Repositories\Interfaces\ArticleInterface;


class ArticleRepository implements ArticleInterface{
    protected $attachmentpath="attachments\article";
    protected $path="images\articles";
    public function index($relations=[],$count=[],$params=['*'],$paginate=10)
     {
        if($paginate>50)
        $paginate=50;
        $articles=Article::with($relations)->select($params)->withCount($count)->search()->paginate($paginate);
        return $articles;

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



         return Article::SelectRaw($search)->search()->first();
     }
    public function store($request)
    {

        $create=[
            'title_ar'=>$request->title_ar,
            'title_en'=>$request->title_en,
            'description_ar'=>$request->description_ar,
            'description_en'=>$request->description_en,
            'image'=>'storage\\'.$this->path."\\".storeImage($this->path,$request->picture),
            'added_id'=>auth()->guard('admin')->user()->id,


        ];
        $article=Article::create($create);

        return $article;

    }
    public function find($id, $params = ['*'], $relations = [], $count = [])
    {
       return findById(Article::class,$id,$relations,$params,$count);
    }
    public function delete($id)
    {
       $article=$this->find($id,['id'],['attachments']);
       if($article->attachments)
       {
        foreach($article->attachments as $attachment)
           deleteImage($attachment->path);
           $article->attachments()->delete();
       }
       $article->delete();
       return true;
    }
    public function update($id, $request)
    {

         $article=$this->find($id,['*']);
           $update=[
            'title_ar'=>$request->title_ar,
            'title_en'=>$request->title_en ,
            'description_ar'=>$request->description_ar,
            'description_en'=>$request->description_en,
        ];
        if($request->file("picture")){
            $update["image"]='storage\\'.$this->path."\\".editImage($this->path,$request->picture,$article->image);

         }
        $article->update($update);
        return $article;
    }

    public function uploadFile($id,$request){

        $receiver = new FileReceiver('file', $request, HandlerFactory::classFromRequest($request));

        if (!$receiver->isUploaded()) {
            // file not uploaded
        }

        $fileReceived = $receiver->receive();
       // receive file

        if ($fileReceived->isFinished()) { // file uploading is complete / all chunks are uploaded
            $article=$this->find($id,['id']);

            $file = $fileReceived->getFile(); // get file

            $path="storage\\".$this->attachmentpath."\\".storeImage($this->attachmentpath,$file);




            // delete chunked file
            $size=$file->getSize();
            $type=substr($file->getMimeType(), 0, 5) == 'image'?"image":"file";


            unlink($file->getPathname());

             $article->attachments()->create([
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
    public function downloadAttachment($article,$id){
        $article=$this->find($article);
        $file=$article->attachments()->findOrFail($id);

        return $file;


    }
    public function deleteAttachment($article,$id){
        $article=$this->find($article);
        $file=$article->attachments()->findOrFail($id);
        deleteImage($file->path);
         $file->delete();

         return true;

    }

    public function showAllArticles()
    {
        $Articles_list =Article::paginate(12);
        return view('course::User.Article.article', [
            'Articles_list' =>$Articles_list
        ]);
    }

    public function showArticle($slug, $relations=[],$params=['*'],$count=[])
    {
        $article_details = Article::select($params)->with($relations)->withCount($count)->where('slug',$slug)->first();

        $Recents =Article::latest()->take(3)->get();
        $article_details->visit();
        return [$article_details,$Recents];

    }

     public function articleReview($id, $request)
     {

         $reviews =Review::create([

             'name'=>auth()->user()->name,
             'user_id'=>auth()->user()->id,
             'course_id'=>null,
             'article_id'=>$id,
             'review'=>$request->review,
             'rate'=>$request->rate,

         ]);

         return  redirect()->route('user.showArticle', [
             'id'=>$id
         ]);
     }
}
