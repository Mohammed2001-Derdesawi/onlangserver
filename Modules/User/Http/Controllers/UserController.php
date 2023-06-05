<?php

namespace Modules\User\Http\Controllers;

use Modules\User\Entities\User;
use Illuminate\Routing\Controller;
use Modules\User\Entities\Article;
use Modules\Course\Entities\Course;
use Modules\User\Entities\WhatsappRecord;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request as HttpRequest;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Request as FacadesRequest;
use Modules\User\Http\Requests\ProfileRequest;
use Modules\User\Http\Requests\User\UserRequest;
use Modules\User\Repositories\Interfaces\UserInterface;
use Modules\Course\Repositories\Interfaces\CourseInterface;

class UserController extends Controller
{




    protected $userRepo;
    protected $courseRepo;
    public function __construct(UserInterface $userInterface,CourseInterface $courseInterface)
    {
        $this->userRepo=$userInterface;
        $this->courseRepo=$courseInterface;
    }

    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        $paginate=request()->paginate??10;
        $info=$this->userRepo->getScopes(["count"]);
        $students=$this->userRepo->index([],['courses as courses'],['name','email','gender','id','created_at'],$paginate);
        return view('user::admin.user.index',['students'=>$students,'info'=>$info]);
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        return view('user::admin.user.create');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(UserRequest $request)
    {
        $this->userRepo->store($request);
        return redirect()->back()->with('success','تمت إضافة الطالب بنجاح');
    }

    public function edit($id)
    {
        $student=$this->userRepo->find($id,['*'],['courses:id,title_ar']);
        return view('user::admin.user.edit',['student'=>$student]);
    }
    public function update(UserRequest $request,$id)
    {
        $this->userRepo->update($id,$request);
        return redirect()->back()->with('success','تمت تعديل بيانات الطالب بنجاح');
    }



    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy($id)
    {

        $this->userRepo->delete($id);
        return redirect()->back()->with('success','تم حذف الطالب بنجاح');

    }










    // public  function  addToCart(Request $request){
    //    return $this->userRepo->addToCart($request);
    // }


    public function profileUpdate(ProfileRequest $request)

    {

        return $this->userRepo->profileUpdate($request);


    }
    public function profileShow()

    {

    return $this->userRepo->profileShow();



    }



    public function mainPage(){

        return $this->userRepo->mainPage();
    }
    public function profile(){


       $user =  auth()->user();
        return view("user::User.Profile.yourAccount" ,
    ['user'=>$user]);
    }




    public function aboutUs(){


        return $this->userRepo->aboutUs();



    }



    public function recordWhatsapp( HttpRequest $request){

       $request->validate([
        'uiqueId'=> 'string|min:1' ,
        'teacherId'=> 'integer|min:1|exists:teachers,id' ,

      ]);
         $whatsappRecord = WhatsappRecord::where('unique_Id' , $request->uiqueId)->where('teacher_Id' , $request->teacherId)->first();
        if($whatsappRecord){
            return true;
        }
        $whatsappRecord = WhatsappRecord::create([
            'unique_Id'=>$request->uiqueId,
            'teacher_Id'=>$request->teacherId,

        ]);
        return true;

    }
}
