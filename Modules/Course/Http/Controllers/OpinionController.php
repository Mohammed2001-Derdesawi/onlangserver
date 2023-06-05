<?php

namespace Modules\Course\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Course\Http\Requests\OpinionRequest;
use Modules\Course\Repositories\Interfaces\OpinionInterface;

class OpinionController extends Controller
{
    protected $opinioninterface;
    public function __construct(OpinionInterface $opinioninterface)
    {
      $this->opinioninterface=$opinioninterface;
    }
    public function index()
    {
        $paginate=request()->paginate??10;
        $opinions=$this->opinioninterface->index([],[],['*'],$paginate);
        $info=$this->opinioninterface->getScopes(["count"]);
        return view('course::admin.opinion.index',['opinions'=>$opinions,"info"=>$info]);
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        return view('course::admin.opinion.create');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(OpinionRequest $request)
    {
        $this->opinioninterface->store($request);
        return redirect()->back()->with('success','تم إنشاء الرأي بنجاح ');

    }


    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        $opinion=$this->opinioninterface->find($id,['*']);
        return view('course::admin.opinion.edit',['opinion'=>$opinion]);
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(OpinionRequest $request, $id)
    {
        $opinion=$this->opinioninterface->update($id,$request);
        return redirect()->back()->with('success','تم تعديل الرأي بنجاح');
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy($id)
    {
        $opinion=$this->opinioninterface->delete($id);
        return redirect()->back()->with('success','تم حذف الرأي بنجاح');

    }
}
