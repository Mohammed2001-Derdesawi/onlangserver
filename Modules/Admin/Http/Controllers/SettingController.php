<?php

namespace Modules\Admin\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Admin\Http\Requests\AboutUsSettingRequest;
use Modules\Admin\Http\Requests\HomeSettingRequest;
use Modules\Admin\Http\Requests\MonthlySubscribeSettingRequest;
use Modules\Admin\Repositories\Interfaces\SettingInterface;

class SettingController extends Controller
{
   protected $settingRepo;
    public function __construct(SettingInterface $interface)
    {
       $this->settingRepo=$interface;
    }
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function homePage()
    {
        return view('admin::setting.home');
    }

    public function updatehomePage(HomeSettingRequest $request){
       $this->settingRepo->updateHomePage($request);
       return redirect()->back()->with('success','تم تعديل إعدادات الصفحة الرئيسية');
    }

    public function aboutusPage(){
       return view('admin::setting.aboutus');
    }
    public function updateaboutUs(AboutUsSettingRequest $request){
        $this->settingRepo->updateuAboutUsPage($request);
        return redirect()->back()->with('success','تم تعديل إعدادات صفحة من نحن ');
    }
    public function monthlyPage(){
        return view('admin::setting.subscribe');
     }
    public function updateMonthlyPage(MonthlySubscribeSettingRequest $request){
         $this->settingRepo->updateMonthlySubscribesPage($request);
         return redirect()->back()->with('success','تم تعديل إعدادات صفحة  الإشتراك الشهري ');
    }
    public function generalInfoPage(){
        return view('admin::setting.general');
    }
    public function updategeneralInfoPage(Request $request){
        $this->settingRepo->updateGeneralInfo($request);
        return redirect()->back()->with('success','تم تعديل إعدادات العامة للموقع');

    }
}
