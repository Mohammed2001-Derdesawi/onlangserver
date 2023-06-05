<?php

namespace Modules\Course\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\User\Http\Requests\ReviewRequest;
use Modules\Course\Repositories\Interfaces\ReviewInterface;

class ReviewController extends Controller
{
    protected $reviewRepo;
    public function __construct(ReviewInterface $reviewRepo)
    {
        $this->reviewRepo=$reviewRepo;

    }

//

  public function index()
  {
    $paginate=request()->paginate??15;
    $info=$this->reviewRepo->getScopes(["count"]);
    $reviews=$this->reviewRepo->AllReviews($paginate,['course','user','various','article'],['*'],[]);

      return view('course::admin.review.index',['reviews'=>$reviews,"info"=>$info]);
  }

  public function destroy($id)
  {
      $this->reviewRepo->delete($id);
      return redirect()->route('admin.review.index')->with('success','تم حذف التقييم بنجاح');

  }


  public function courseReview($id , ReviewRequest $request){
       return $this->reviewRepo->courseReview($id ,$request);


  }
  public function variousReview($id ,ReviewRequest $request){
    return $this->reviewRepo->variousReview($id ,$request);

  }
  public function articleReview($id , ReviewRequest $request){

    return $this->reviewRepo->articleReview($id ,$request);

  }



}
