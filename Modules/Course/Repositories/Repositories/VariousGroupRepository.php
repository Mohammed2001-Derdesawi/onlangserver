<?php

namespace Modules\Course\Repositories\Repositories;

use Modules\User\Entities\Playlist;

use Modules\Course\Entities\Various;
use Modules\Course\Entities\VariousGroup;
use Modules\Course\Repositories\Interfaces\VariousGroupInterface;
use DB;
class VariousGroupRepository implements VariousGroupInterface
{
    protected $path="images\groups";
    public function index($relations=[], $count=[], $params=['*'], $paginate=10)
    {
        if ($paginate>50) {
            $paginate=50;
        }
        $articles=VariousGroup::with($relations)->select($params)->withCount($count)->search()->paginate($paginate);
        return $articles;
    }

     public function getScopes($scopes)
     {
         $allscopes=["count"=>"COUNT(id)","max"=>"MAX(id)","min"=>"MIN(id)"];
         $keys=array_keys($allscopes);
         $search=[];
         foreach ($scopes as $scope) {
             if (in_array($scope, $keys)) {
                 $search[$scope]=$allscopes[$scope]." as ".$scope;
             }
         }
         if (count($search)==0) {
             return collect();
         }

         $search=implode(',', array_values($search));



         return VariousGroup::SelectRaw($search)->search()->first();
     }
    public function store($request)
    {
        $create=[
            'title_ar'=>$request->title_ar,
            'title_en'=>$request->title_en,
            'description_ar'=>$request->description_ar,
            'description_en'=>$request->description_en,
            'poster'=>'storage\\'.$this->path."\\".storeImage($this->path, $request->image),
            'added_id'=>auth()->guard('admin')->user()->id,


        ];

        $group=VariousGroup::create($create);

        return $group;
    }
    public function find($id, $params = ['*'], $relations = [], $count = [])
    {
        return findById(VariousGroup::class, $id, $relations, $params, $count);
    }
    public function delete($id)
    {
        $group=$this->find($id, ['id','poster']);
        if ($group->poster) {
            deleteImage($group->poster);
        }
        $group->delete();
        return true;
    }
    public function update($id, $request)
    {
        $group=$this->find($id, ['*']);
        $update=[
           'title_ar'=>$request->title_ar,
           'title_en'=>$request->title_en ,
           'description_ar'=>$request->description_ar,
           'description_en'=>$request->description_en,
        ];
        if ($request->image && $group->poster) {
            $update['poster']='storage\\'.$this->path."\\".editImage($this->path, $request->image, $group->poster);
        }
        $group->update($update);
        return $group;
    }


    public function showAllPlayLists()
    {


            if(request()->type=='playlists'){
                    $languageLists =VariousGroup::select('id','title_ar','title_en','poster')->paginate(12);
            return  $languageLists;
           
            }
                 $type=str_contains(url()->current(),'Paid')?'paid':'free';
             $languageLists=Various::select('id','title_ar','title_en','poster','type')->where('type',$type)->orderBy(DB::raw('RAND()'))->paginate(25);
            return  $languageLists;
            
            
    }

}
