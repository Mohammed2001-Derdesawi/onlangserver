<?php

namespace Modules\User\Repositories\Repositories;


use Modules\User\Entities\Level;
use Modules\User\Entities\Campaign;
use Modules\User\Repositories\Interfaces\LevelInterface;

class LevelRepository implements LevelInterface{

    public function index($relations = [],$count=[], $params=['*'],$paginate = 10)
    {
        if($paginate>50)
         $paginate=50;
        return Level::with($relations)->select($params)->withCount($count)->search()->campaign()->paginate($paginate);

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



        return Level::SelectRaw($search)->search()->first();
    }
    public function getAll($relations = [], $params = ['*'], $count = [])
    {
        return Level::with($relations)->select($params)->withCount($count)->get();

    }
    public function getmodel($relations=[],$params=[],$count=[]){
        return Level::with($relations)->select($params)->withCount($count);
    }
    public function store($request)
    {
        $create=[
            "title_ar"=>$request->title_ar,
            "title_en"=>$request->title_en,
            "description_ar"=>$request->description_ar,
            "description_en"=>$request->description_en,
            "total_point"=>$request->total_point,
            "point_price"=>$request->point_price,
            "order"=>$request->order,
            "point_per_one"=>$request->point_per_one,
            "campaign_id"=>$request->campaign,
            "point_price_after_done"=>$request->point_price_after_done??0
        ];

        $level=Level::create($create);
        if(is_array($request->courses)){
            $courses=[];
            foreach($request->courses as $course){
                  $courses[]=["course_id"=>$course];
            }
            $level->gifts()->createMany($courses);
        }

        return $level;

    }
    public function find($id,$params=['*'],$relations = [], $count = [])
    {

         return findById(Level::class,$id,$relations,$params,$count);
    }

    public function delete($id)
    {
        $level=$this->find($id,['id']);
        $level->delete();
        return true;

    }
    public function update($id, $request)
    {

        $level=$this->find($id);
        $campain=findById(Campaign::class,$level->campaign_id,["lastLevel"],['id','total_points'],[],["levels as point_levels","total_point"]);
        $leftpoints=$campain->point_levels - $level->total_point;
        $avaliable=$campain->total_points- ($leftpoints+$request->total_point);
        if($avaliable<0)
        return ['total_point'=>'الرجاء التأكد بأن مجموع النقاط للمستويات مساويا أو أقل من النظام'] ;

        $update=[
            "title_ar"=>$request->title_ar,
            "title_en"=>$request->title_en,
            "description_ar"=>$request->description_ar,
            "description_en"=>$request->description_en,
            "total_point"=>$request->total_point,
            "point_price"=>$request->point_price,
            "order"=>$request->order,
            "point_per_one"=>$request->point_per_one,

        ];

        if($level->id == $campain->lastLevel->id)
        $update["point_price_after_done"]=$request->point_price_after_done??0;

        $level->update($update);
        $level->gifts()->delete();
        if(is_array($request->courses)){
            $courses=[];
            foreach($request->courses as $course){
                  $courses[]=["course_id"=>$course];
            }

            $level->gifts()->createMany($courses);
        }

        return $level;
    }







}
