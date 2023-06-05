<?php

namespace Modules\User\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Contracts\Support\Renderable;
use Modules\User\Http\Requests\CampaignRequest;
use Modules\User\Repositories\Interfaces\CampaignInterface;

class CampaignController extends Controller
{
     protected $campaigninterface;

     public function __construct(CampaignInterface $interface)
     {
        $this->campaigninterface=$interface;
     }
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
         $paginate=request()->paginate??10;
         $info=$this->campaigninterface->getScopes(["count"]);
         $campaigns=$this->campaigninterface->index([],
         ['levels as levels','levels as user_count' => function($query){
            $query->selectRaw('count(*)')->join('user_levels', 'levels.id', '=', 'user_levels.level_id')
                  ->whereColumn('levels.campaign_id', 'campaigns.id');
        }],['id','title_ar','title_en','total_points','start_at','end_at']);

         return view('user::admin.campaign.index',['campaigns'=>$campaigns,"info"=>$info]);
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        return view('user::admin.campaign.create');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(CampaignRequest $request)
    {
         $this->campaigninterface->store($request);
         return redirect()->back()->with('success','تم حفظ نظام التربح بنجاح');
        }



    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        $campaign=$this->campaigninterface->find($id);
        return view('user::admin.campaign.edit',['campaign'=>$campaign]);
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(CampaignRequest $request, $id)
    {
        $campaign=$this->campaigninterface->update($id,$request);
        return redirect()->back()->with('success','تم تعديل نظام التربح');
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy($id)
    {
        $this->campaigninterface->delete($id);
        return redirect()->back()->with('success','تم حذف نظام التربح');
    }
}
