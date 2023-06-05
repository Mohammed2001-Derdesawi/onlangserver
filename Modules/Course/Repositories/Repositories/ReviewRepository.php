<?php

namespace Modules\Course\Repositories\Repositories;



use Modules\Course\Entities\Review;
use Modules\Course\Repositories\Interfaces\ReviewInterface;


class ReviewRepository implements ReviewInterface{

    public function getReview($id,$relations=[],$params=['*'],$count=[]){
        return findById(Review::class,$id,$relations,$params,$count);

    }
    public function getCountAll($get){
        return Review::count($get);
    }
    public function AllReviews($paginate=15,$relations=[],$params=['*'],$count=[])
    {
        $query=Review::with($relations)->select($params)->withCount($count)->search();
        if($paginate==0)
            return $query->get();

            if($paginate>50)
            $paginate=50;

        return $query->paginate($paginate);


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



         return Review::SelectRaw($search)->search()->first();
     }



    public function delete($id){
        $review=findById(Review::class,$id,[],['*'],[]);
        if($review->image)
            deleteImage($review->image);
        $review->delete();
        return true;
    }
 public function courseReview($id ,$request){
       $reviews =Review::create([

           'user_id'=>auth()->user()->id,
           'course_id'=>$id,
           'article_id'=>null,
           'variouse_id'=>null,
           'review'=>$request->review,

       ]);

       $slug = $reviews->course->slug;
return  redirect()->route('user.courseDetails' ,[
    'slug'=>$slug
] );
 }


 public function variousReview($id ,$request){

    $reviews =Review::create([

        'user_id'=>auth()->user()->id,
        'variouse_id'=>$id,
        'review'=>$request->review,

    ]);
if ($reviews->variouse->type == 'free') {
    return  redirect()->route('user.freeVideoShow', [
     'id'=>$id
    ]);


}
if ($reviews->variouse->type == 'paid') {
    return  redirect()->route('user.paidVideoShow', [
     'id'=>$id
    ]);


}




}

public function articleReview($id ,$request){

    $reviews =Review::create([

        'user_id'=>auth()->user()->id,
        'article_id'=>$id,
        'review'=>$request->review,

    ]);
      $slug = $reviews->article->slug;
return  redirect()->route('user.showArticle' ,[
 'slug'=>$slug
] );
}
}
