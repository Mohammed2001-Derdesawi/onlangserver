<?php

namespace Modules\Course\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Course\Http\Requests\VariousGroupRequest;
use Modules\Course\Http\Requests\VariousRequest;
use Modules\Course\Repositories\Interfaces\VariousGroupInterface;
use Modules\Course\Transformers\VariousGroupResource;
use Modules\User\Entities\Plan;

class VariousGroupController extends Controller
{
     protected $groupinterface;

     public function __construct(VariousGroupInterface $interface)
     {
        $this->groupinterface=$interface;

     }
    /**
     * Display a listing of the resource.
     * @return Renderable
     */

    public function index()
    {
        $paginate=request()->paginate??10;
        $info=$this->groupinterface->getScopes(['count']);
        $groups=$this->groupinterface->index([],['variouses as variouses'],['title_ar','title_en','created_at','id'],$paginate);
        return view('course::admin.variousgroup.index',['groups'=>$groups,'info'=>$info]);
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        return view('course::admin.variousgroup.create');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(VariousGroupRequest $request)
    {

        $this->groupinterface->store($request);
        return redirect()->back()->with('success','تم إضافة playlist بنجاح');

    }


    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        $group=$this->groupinterface->find($id,['*']);
        return view('course::admin.variousgroup.edit',['group'=>$group]);
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(VariousGroupRequest $request, $id)
    {
        $this->groupinterface->update($id,$request);
        return redirect()->back()->with('success','تم تعديل playlist بنجاح');
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy($id)
    {
        $this->groupinterface->delete($id);
        return redirect()->back()->with('success','تم حذف playlist بنجاح');
    }

    public function getGroupsApi(Request $request)
    {

        $groups=$this->groupinterface->index([],[],['id','title_ar as text'],10);

        return new VariousGroupResource($groups);
    }


    public function showAllPaidPlayLists()
    {
        $PlayListPaid = $this->groupinterface->showAllPlayLists();
        return view('course::User.Various.Paid.home', [
         'PlayListPaid' =>$PlayListPaid,

    ]);
    }
    public function showAllFreePlayList()
    {
        $PlayListFree = $this->groupinterface->showAllPlayLists();
        return view('course::User.Various.Free.home', [
            'PlayListFree' =>$PlayListFree
       ]);
    }


}
