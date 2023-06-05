<?php

namespace Modules\Course\Repositories\Repositories;

use Modules\Course\Entities\Course;
use Modules\Course\Entities\Language;
use Modules\Course\Repositories\Interfaces\LanguageInterface;

class LanguageRepository implements LanguageInterface{
    protected $path='images\languages';

    public function index($relations = [],$count=[], $params=['*'],$paginate = 10)
    {
        if($paginate>50)
         $paginate=50;
        return Language::with($relations)->select($params)->withCount($count)->search()->paginate($paginate);

    }
    public function getAll($relations = [], $params = ['*'], $count = [])
    {
        return Language::with($relations)->select($params)->withCount($count)->get();

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



        return Language::SelectRaw($search)->search()->first();
    }
    public function store($request)
    {
        $lang=Language::create([
            'title_en'=>$request->title_en,
            'title_ar'=>$request->title_ar,
          'image'=>'storage\\'.$this->path."\\".storeImage($this->path,$request->picture)
,
        ]);
        return $lang;

    }
    public function find($id,$params=['*'],$relations = [], $count = [])
    {

         return findById(Language::class,$id,$relations,$params,$count);
    }

    public function delete($id)
    {
        $lang=$this->find($id,['id']);
        $lang->delete();
        return true;

    }
    public function update($id, $request)
    {
        $lang=$this->find($id);
        $update =[
            'title_en'=>$request->title_en,
            'title_ar'=>$request->title_ar,
        ];
             if($request->file("picture")){
            $update["image"]='storage\\'.$this->path."\\".editImage($this->path,$request->picture,$lang->image);

         }
        $lang->update($update);

        return $lang;
    }






    public function showAllLanguages(){
    if(request()->type=='courses'){
        $type=str_contains(url()->current(),'Paid')?'paid':'free';
        $languageLists=Course::select('title_ar','title_en','id','price','duration','preview_video','image','slug')->paginate(12);
    }
    else
    $languageLists =Language::with([ "courses"=> function ($q){ return $q->where("visiable", 1);
    }])->withSum('courses' , 'price' )->paginate(12);
   return $languageLists;



}
}
