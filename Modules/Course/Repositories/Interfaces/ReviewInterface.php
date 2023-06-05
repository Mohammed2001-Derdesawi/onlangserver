<?php
namespace Modules\Course\Repositories\Interfaces;

interface ReviewInterface{

    public function AllReviews($paginate=15,$relations=[],$params=['*'],$count=[]);
    public function delete($id);
    public function getReview($id,$relations=[],$params=['*'],$count=[]);
    public function getCountAll($count);
    public function getScopes($scopes);
    public function courseReview($id ,$request);
    public function variousReview($id ,$request);
    public function articleReview($id ,$request);


}
