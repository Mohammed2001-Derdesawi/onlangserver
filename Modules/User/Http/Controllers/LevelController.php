<?php

namespace Modules\User\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Contracts\Support\Renderable;
use Modules\User\Http\Requests\CampaignRequest;
use Modules\User\Http\Requests\LevelRequest;
use Modules\User\Repositories\Interfaces\LevelInterface;
use Modules\User\Repositories\Repositories\CampaignRepository;

class LevelController extends Controller
{
    protected $levelinterface;

     public function __construct(LevelInterface $interface)
     {
        $this->levelinterface=$interface;
     }
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
         $paginate=request()->paginate??10;
         $info=$this->levelinterface->getScopes(["count"]);
         $levels=$this->levelinterface->index(['campaign:id,title_ar'],[],['id',"campaign_id",'title_ar','title_en','total_point','point_per_one','point_price',"order"]);
         $campaigns=new CampaignRepository();
        $campaigns=$campaigns->getAll([],['id','title_ar']);
         return view('user::admin.level.index',['levels'=>$levels,"info"=>$info,"campaigns"=>$campaigns]);
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        $campaigns=new CampaignRepository();
        $campaigns=$campaigns->getAll([],['id','title_ar']);
        return view('user::admin.level.create',["campaigns"=>$campaigns]);
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(LevelRequest $request)
    {
         $this->levelinterface->store($request);
         return redirect()->back()->with('success','تم حفظ  المستوى بنجاح');
        }



    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        $level=$this->levelinterface->find($id,['*'],['courses:id,title_ar']);
        return view('user::admin.level.edit',['level'=>$level]);
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(LevelRequest $request, $id)
    {

        $level=$this->levelinterface->update($id,$request);

        if(is_array($level))
        return redirect()->back()->withErrors($level);
        return redirect()->back()->with('success','تم تعديل المستوى');
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy($id)
    {
        $this->levelinterface->delete($id);
        return redirect()->back()->with('success','تم حذف  المستوى');
    }
}
