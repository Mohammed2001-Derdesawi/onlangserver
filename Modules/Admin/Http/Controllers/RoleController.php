<?php

namespace Modules\Admin\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Contracts\Support\Renderable;
use Modules\Admin\Http\Requests\RoleRequest;
use Modules\Admin\Repositories\Interfaces\AdminInterface;

class RoleController extends Controller
{
    protected $adminRepo;

    public function __construct(AdminInterface $admininterface)
    {
        $this->adminRepo=$admininterface;


    }

    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        $paginate=request()->paginate??15;
        $roles=$this->adminRepo->getRoles([],['*'],['permissions as permissions_count','users as users_count'],$paginate);
         return view('admin::role.index',['roles'=>$roles]);
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        $permissions=$this->adminRepo->getPermissions();
        return view('admin::role.create',['permissions'=>$permissions]);
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(RoleRequest $request)
    {

       $role=$this->adminRepo->createRole($request);
       return redirect()->back()->with('success','تم إنشاء الصلاحية بنجاح');
    }



    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        $permissions=$this->adminRepo->getPermissions();

        $role=$this->adminRepo->getRole($id,['permissions:id,name']);

        return view('admin::role.edit',['role'=>$role,'permissions'=>$permissions]);
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update($id,RoleRequest $request)
    {
        $role=$this->adminRepo->updateRole($id,$request);
        return redirect()->back()->with('success','تم تعديل الصلاحية بنجاح');

    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy($id)
    {
        $role=$this->adminRepo->deleteRole($id);
        return redirect()->back()->with('success','تم حذف الصلاحية بنجاح');
    }
}
