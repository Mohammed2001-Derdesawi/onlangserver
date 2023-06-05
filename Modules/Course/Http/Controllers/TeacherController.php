<?php

namespace Modules\Course\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Course\Http\Requests\TeacherRequest;
use Modules\Course\Repositories\Interfaces\TeacherInterface;
use Modules\Course\Transformers\TeacherResource;

class TeacherController extends Controller
{
    protected $teacherinterface;

    public function __construct(TeacherInterface $interface)
    {
        $this->teacherinterface=$interface;

    }
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        $paginate=request()->paginate??10;
        $teachers=$this->teacherinterface->index([],['courses as courses'],['id','name_ar','name_en','created_at',"has_private_learning"],$paginate);
        $info=$this->teacherinterface->getScopes(["count"]);
        return view('course::admin.teacher.index',['teachers'=>$teachers,"info"=>$info]);
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        return view('course::admin.teacher.create');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(TeacherRequest $request)
    {
        $this->teacherinterface->store($request);
        return redirect()->back()->with('success','تم إضافة المعلم بنجاح');



    }


    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        $teacher=$this->teacherinterface->find($id,['*'],['courses:id,title_ar']);
        return view('course::admin.teacher.edit',['teacher'=>$teacher]);
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(TeacherRequest $request, $id)
    {
        $this->teacherinterface->update($id,$request);
        return redirect()->back()->with('success','تم تحديث بيانات المعلم بنجاح');


    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy($id)
    {
        $this->teacherinterface->delete($id);
        return redirect()->back()->with('success','تم حذف بيانات المعلم بنجاح');
    }

    public function getTeacherApi(Request $request)
    {
        $teachers=$this->teacherinterface->index([],[],['id','name_ar as text'],10);

        return new TeacherResource($teachers);
    }

    public function showTeacher($slug){
        $Teachers =  $this->teacherinterface->showTeacher($slug);
        return view('course::User.Teacher.teachersDetails',[
            'Teachers'=>$Teachers]);

    }
    public function showPrivateTeacher($slug){
        $Privateachers =  $this->teacherinterface->showPrivateTeacher($slug);
        return view('course::User.Course.coursePrivateDetails',[
            'Privateachers'=>$Privateachers]);


    }


    public function  allPrivateTeacher(){

        return $this->teacherinterface->allPrivateTeacher();

    }



    public function  allteachers(){

        return $this->teacherinterface->allteachers();

    }


}
