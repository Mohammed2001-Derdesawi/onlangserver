<?php

namespace Modules\Course\Repositories\Repositories;

use Modules\Course\Entities\Opinion;
use Modules\Course\Repositories\Interfaces\OpinionInterface;

class OpinionRepository implements OpinionInterface{

    protected $path="images\opinions";
    public function index($relations = [],$count=[], $params=['*'],$paginate = 10)
    {
        if($paginate>50)
         $paginate=50;
        return Opinion::with($relations)->select($params)->withCount($count)->search()->paginate($paginate);

    }
    public function getAll($relations = [], $params = ['*'], $count = [])
    {
        return Opinion::with($relations)->select($params)->withCount($count)->get();

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



        return Opinion::SelectRaw($search)->search()->first();
    }
    public function store($request)
    {
        $opinion=Opinion::create([
            'opinion_ar'=>$request->opinion_ar,
            'opinion_en'=>$request->opinion_en,
            "image"=>"storage\\".$this->path."\\".storeImage($this->path,$request->image),

        ]);
        return $opinion;

    }
    public function find($id,$params=['*'],$relations = [], $count = [])
    {

         return findById(Opinion::class,$id,$relations,$params,$count);
    }

    public function delete($id)
    {
        $opinion=$this->find($id,['id']);
        $opinion->delete();
        return true;

    }
    public function update($id, $request)
    {
        $opinion=$this->find($id);
        $update=[
            'opinion_ar'=>$request->opinion_ar,
            'opinion_en'=>$request->opinion_en,
        ];
        if($request->file("image"))
        {
            $update["image"]="storage\\".$this->path."\\".storeImage($this->path,$request->image);
        }
        $opinion->update($update);
        return $opinion;
    }
}
