<?php

namespace Modules\Course\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Course\Entities\Article;
use Illuminate\Contracts\Support\Renderable;
use Modules\Course\Http\Requests\ArticleReqest;
use Modules\Course\Http\Requests\ArticleRequest;
use Modules\Course\Repositories\Interfaces\ArticleInterface;

class ArticleController extends Controller
{
    protected $articleinterface;

    public function __construct(ArticleInterface $interface)
    {
        $this->articleinterface=$interface;

    }
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        $paginate=request()->paginate??10;
        $articles=$this->articleinterface->index([],["attachments as attachments"],['title_ar',"title_en","created_at","id"],$paginate);
        $info=$this->articleinterface->getScopes(["count"]);
        return view('course::admin.article.index',['articles'=>$articles,"info"=>$info]);
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        return view('course::admin.article.create');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(ArticleRequest $request)
    {
        $this->articleinterface->store($request);
        return redirect()->back()->with('success','تم إضافة المقال بنجاح');

    }



    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        $article=$this->articleinterface->find($id);
        return view('course::admin.article.edit',['article'=>$article]);
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(ArticleRequest $request, $id)
    {
        $this->articleinterface->update($id,$request);
        return redirect()->back()->with('success','تم تعديل المقال بنجاح');
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy($id)
    {
        $this->articleinterface->delete($id);
        return redirect()->back()->with('success','تم حذف المقال بنجاح');
    }

    public function uploadPage($id)
    {

        $article=$this->articleinterface->find($id,['id','title_ar'],['attachments']);
        return view('course::admin.article.upload-file',['article'=>$article]);
    }
    public function uploadFile($id,Request $request){

         $message=$this->articleinterface->uploadFile($id,$request);
         return $message;
    }

    public function downloadAttachment($various,$id){

        $file=$this->articleinterface->downloadAttachment($various,$id);
         $path = "/".str_replace( '\\', '/', $file->path );
            return response()->download(public_path().$path);

    }

    public function  deleteAttachment($various,$id)
    {

        $this->articleinterface->deleteAttachment($various,$id);
        return redirect()->route('admin.article.upload.page',$various)->with('success','تم حذف الملف بنجاح');

    }
    public function showAllArticles( ){

        return $this->articleinterface->showAllArticles();
    }
    public function showArticle  ($slug){
        list($article_details,$Recents)=$this->articleinterface->showArticle($slug, ['attachments' , "reviews"=>function($q){
            $q->latest()->take(10)->get();

        }],['*']);
        if(!$article_details){
            return redirect()->back()->with('error' , 'the course is not found in our records');
         }
        return view(
            'course::User.Article.articleDetails',
            [
                'article_details'=> $article_details,
                'Recents' =>$Recents,
                // 'socialShare' =>$socialShare,
                ]
        ) ;

    }

    // public function articleReview( $id , ReviewRequest $request){

    //     return $this->articleinterface->articleReview($id ,$request);
    // }
}
