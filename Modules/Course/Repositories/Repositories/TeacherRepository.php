<?php

namespace Modules\Course\Repositories\Repositories;

use Illuminate\Support\Carbon;
use Modules\Course\Entities\Course;
use Modules\Course\Entities\Teacher;
use Modules\Course\Repositories\Interfaces\TeacherInterface;

class TeacherRepository implements TeacherInterface{
    protected $path='images\teachers';
    public function index($relations=[],$count=[],$params=['*'],$paginate=10)
     {
        if($paginate>50)
        $paginate=50;
        $teachers=Teacher::with($relations)->select($params)->withCount($count)->search()->paginate($paginate);
        return $teachers;

     }
     public function getAll($relations = [], $params = ['*'], $count = [])
     {
         return Teacher::with($relations)->select($params)->withCount($count)->get();
     }
     public function getScopes($scopes)
     {

         $allscopes=["count"=>"COUNT(id)","max"=>"MAX(id)","min"=>"MIN(id)"];
         $keys=array_keys($allscopes);
         $search=[];
         foreach($scopes as $scope)
         {

             if(in_array($scope,$keys)){
                 $search[$scope]=$allscopes[$scope]." as ".$scope;
             }
         }
         if(count($search)==0)
         return collect();

         $search=implode(',',array_values($search));



         return Teacher::SelectRaw($search)->search()->first();
     }
    public function store($request)
    {


        $create=[
            'name_ar'=>$request->name_ar,
            'name_en'=>$request->name_en,
            'email'=>$request->email,
            'description_ar'=>$request->description_ar,
            'description_en'=>$request->description_en,
            'image'=>'storage\\'.$this->path."\\".storeImage($this->path,$request->image),
            'preview_video'=>$request->preview_video,
            "has_private_learning"=>$request->has_private_learning,
            "private_video"=>$request->private_video

        ];

        $teacher=Teacher::create($create);
        if($request->courses && $request->courses[0]!=null)
            $teacher->courses()->attach($request->courses);
        return true;

    }
    public function find($id, $params = ['*'], $relations = [], $count = [])
    {
       return findById(Teacher::class,$id,$relations,$params,$count);
    }
    public function delete($id)
    {
       $teacher=$this->find($id,['id']);
       if($teacher->image)
       deleteImage($teacher->image);

       $teacher->delete();
       return true;
    }
    public function update($id, $request)
    {
        $teacher=$this->find($id,['*']);
        $update=[
            'name_ar'=>$request->name_ar,
            'name_en'=>$request->name_en,
            'email'=>$request->email,
            'description_ar'=>$request->description_ar,
            'description_en'=>$request->description_en,
            'preview_video'=>$request->preview_video,
            "has_private_learning"=>$request->has_private_learning,
            "private_video"=>$request->private_video

        ];


         if($request->file("image") && $teacher->image){
            $update["image"]='storage\\'.$this->path."\\".editImage($this->path,$request->image,$teacher->image);

         }
        $teacher->update($update);
        $courses=[];
        if($request->courses && $request->courses[0]!=null)
        {
           $courses=$request->courses;
        }
        $teacher->courses()->sync($courses);
        return true;
    }


    public function  allteachers(){

        $teachers = Teacher::where('has_private_learning', 0)->paginate(12);

          return view('course::User.Teacher.teachers' , [
            'teachers' =>$teachers
        ]);
    }

    public function showTeacher($slug){
        $Teachers = Teacher::where('has_private_learning', 0)->where('slug',$slug)->first();;
            return  $Teachers;

    }



    public function  allPrivateTeacher(){

        $PrivateTeachers = Teacher::where('has_private_learning', 1)->paginate(12);

          return view('course::User.Course.coursePrivate' , [
            'PrivateTeachers' =>$PrivateTeachers
        ]);
    }
    public function showPrivateTeacher($slug){
        $Teachers = Teacher::where('has_private_learning', 1)->where('slug',$slug)->first();;
            return  $Teachers;

    }


}
