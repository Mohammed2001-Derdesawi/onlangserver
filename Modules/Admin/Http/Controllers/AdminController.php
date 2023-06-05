<?php

namespace Modules\Admin\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Contracts\Support\Renderable;
use Modules\Admin\Http\Requests\AdminRequest;
use Moudules\User\Repositories\Interfaces\UserInterface;
use Modules\Admin\Repositories\Interfaces\AdminInterface;
use Modules\Admin\Http\Requests\Auth\AdminPasswordRequest;
use Modules\Admin\Http\Requests\Admin\UpdateProfileRequest;
use Modules\Course\Repositories\Interfaces\CourseInterface;
use Modules\User\Http\Requests\Setting\AboutUSSettingsRequest;
use Modules\User\Http\Requests\Setting\ContactUSSettingsRequest;
use Modules\User\Http\Requests\Setting\VariousesSettingsRequest;
use Modules\User\Http\Requests\Setting\OtherPaymentsSettingsRequest;


class AdminController extends Controller
{
     protected $courseRepo;
     protected $userRepo;

     protected $adminRepo;

    public function __construct(AdminInterface $admininterface)
    {
        $this->adminRepo=$admininterface;


    }
    public function dashboard()
    {
        $data=$this->adminRepo->dashboard();
        return view('admin::Dashboard.dashboard')->with($data);
    }

    public function loginPage()
    {
        return view('admin::auth.login');
    }

    public function index(){

       $paginate=request()->paginate??15;
       $admins=$this->adminRepo->index([],['roles as roles'],['id','name','email','created_at'],$paginate);
       $info=$this->adminRepo->getScopes(["count"]);
       return view('admin::admin.index',['admins'=>$admins,'info'=>$info]);

    }
    public function create(){
        $roles=$this->adminRepo->getRoles([],['id','name']);
       return view('admin::admin.create',['roles'=>$roles]);
    }
    public function edit($id){
      $admin=$this->adminRepo->find($id,['roles']);
      if($admin->id==auth()->guard('admin')->user()->id)
      return  redirect()->back()->with('warning',"You can't update your information got to profile to update it");

      $roles=$this->adminRepo->getRoles([],['id','name']);


      return view('admin::admin.edit',['admin'=>$admin,"roles"=>$roles]);
    }
    public function store(AdminRequest $request){
        $admin=$this->adminRepo->create($request);
        return redirect()->back()->with('success','تم إنشاء المستخدم');
    }
    public function update($id,AdminRequest $request){
        $admin=$this->adminRepo->update($id,$request);
        if(!$admin)
        return  redirect()->back()->with('warning',"You can't update your information got to profile to update it");

        return redirect()->back()->with('success','تم تعديل بيانات المستخدم');
    }

    public function destroy($id){
        $admin=$this->adminRepo->delete($id);
        if(!$admin)
        return  redirect()->back()->with('warning',"You can't update your information got to profile to update it");

        return redirect()->back()->with('success','تم حذف بيانات المستخدم');


    }


    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function myProfile()
    {

        return view('admin::admin.profile',['admin'=>auth()->guard('admin')->user()]);
    }

    public function updateMyPassword(AdminPasswordRequest $request)
    {
        $valid=$this->adminRepo->updateMyPassword($request);
        if($valid)
        return redirect()->route('admin.myprofile')->with('success','تم تحديث كلمة المرور بنجاح');

        return redirect()->back()->withFragment("#my-security")->with('faild','كلمة المرور القديمة غير صحيحة');

    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function updatemyProfile(UpdateProfileRequest $request)
    {
        $this->adminRepo->updatemyProfile($request);
        return redirect()->route('admin.myprofile')->with('success','تم تعديل بيانات البروفايل بنجاح');
    }
    public function analyzePage()
    {
        return view('course::Admin.analyze.index',['courses'=>$this->courseRepo->AllCourses(15,[],['id','title_ar'],['users as user_count'])]);
    }

    public function otherPaymentSettings()
    {
        return view('user::admin.settings.other_payment');
    }

    // public function updateOtherPaymentSettings(OtherPaymentsSettingsRequest $request)
    // {
    //   $this->adminRepo->updateOtherPaymentSettings($request);
    //   toastr()->success('تم تحديث الإعدادات بنجاح');
    //   return redirect()->route('admin.settings.other_payments.index');
    // }

    // public function aboutUsSetting()
    // {
    //     return view('user::admin.settings.aboutus');
    // }
    // public function updateAboutUsSetting(AboutUSSettingsRequest $request)
    // {

    //   $this->adminRepo->updateAboutUsSetting($request);
    //   toastr()->success('تم تحديث الإعدادات بنجاح');
    //   return redirect()->route('admin.settings.aboutus.index');
    // }
    // public function contactUsSetting()
    // {
    //     return view('user::admin.settings.contactus');
    // }
    // public function updateContactUsSetting(ContactUSSettingsRequest $request)
    // {

    //   $this->adminRepo->updateContactUsSetting($request);
    //   toastr()->success('تم تحديث الإعدادات بنجاح');
    //   return redirect()->route('admin.settings.contactus.index');
    // }
    // public function variousesSetting()
    // {
    //     return view('user::admin.settings.variouses');
    // }
    // public function updateVariousesSetting(VariousesSettingsRequest $request)
    // {

    //   $this->adminRepo->updateVariousesSetting($request);
    //   toastr()->success('تم تحديث الإعدادات بنجاح');
    //   return redirect()->route('admin.settings.variouses.index');
    // }

    // public function googelAdsSetting(){
    //      return view('user::admin.settings.ads');
    // }
    // public function updategoogelAdsSetting(Request $request){
    //      $this->adminRepo->updategoogelAdsSetting($request);
    //      toastr()->success('تم تحديث الإعدادات بنجاح');
    //      return redirect()->route('admin.settings.google.ads');




    // }



}
