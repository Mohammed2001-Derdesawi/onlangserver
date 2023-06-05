<?php

namespace Modules\User\Repositories\Repositories;

use App\Models\User;
use Modules\User\Entities\Campaign;
use Illuminate\Support\Facades\Hash;
use Modules\Course\Entities\Article;
use Illuminate\Support\Facades\Event;
use Modules\User\Http\Requests\ProfileRequest;
use Modules\User\Repositories\Interfaces\UserInterface;
use Modules\User\Repositories\Interfaces\CampaignInterface;
use Modules\Course\Repositories\Repositories\CourseRepository;

class CampaignRepository implements CampaignInterface{

    public function index($relations = [],$count=[], $params=['*'],$paginate = 10)
    {
        if($paginate>50)
         $paginate=50;
        return Campaign::with($relations)->select($params)->withCount($count)->search()->paginate($paginate);

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



        return Campaign::SelectRaw($search)->search()->first();
    }
    public function getAll($relations = [], $params = ['*'], $count = [])
    {
        return Campaign::with($relations)->select($params)->withCount($count)->get();

    }
    public function getmodel($relations=[],$params=[],$count=[]){
        return Campaign::with($relations)->select($params)->withCount($count);
    }
    public function store($request)
    {
        $create=[
            "title_ar"=>$request->title_ar,
            "title_en"=>$request->title_en,
            "description_ar"=>$request->description_ar,
            "description_en"=>$request->description_en,
            "start_at"=>$request->start_at,
            "end_at"=>$request->end_at,
            "total_points"=>$request->total_points,
            "feachers_en"=>$request->feachers_en,
            "feachers_ar"=>$request->feachers_ar
        ];

        $campaign=Campaign::create($create);


        return $campaign;

    }
    public function find($id,$params=['*'],$relations = [], $count = [])
    {

         return findById(Campaign::class,$id,$relations,$params,$count);
    }

    public function delete($id)
    {
        $campaign=$this->find($id,['id']);
        $campaign->delete();
        return true;

    }
    public function update($id, $request)
    {
        $campaign=$this->find($id);
        $update=[
            "title_ar"=>$request->title_ar,
            "title_en"=>$request->title_en,
            "description_ar"=>$request->description_ar,
            "description_en"=>$request->description_en,
            "start_at"=>$request->start_at,
            "end_at"=>$request->end_at,
            "total_points"=>$request->total_points,
            "feachers_en"=>$request->feachers_en,
            "feachers_ar"=>$request->feachers_ar
        ];

        $campaign->update($update);
        return $campaign;
    }

    public function findBySlug($slug,$relations=[],$params=['*'],$count=[]){
         $campaign=$this->getmodel($relations,$params,$count)->where('slug',$slug)->first();
         return $campaign;
    }








}
