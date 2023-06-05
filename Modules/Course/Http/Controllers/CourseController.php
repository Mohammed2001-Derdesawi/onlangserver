<?php

namespace Modules\Course\Http\Controllers;

use Illuminate\Http\Request;
use Modules\Course\Entities\Note;
use Illuminate\Routing\Controller;
use Modules\Course\Entities\Course;
use Modules\Course\Entities\Lecture;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Support\Facades\Validator;
use Modules\Course\Http\Requests\CourseRequest;
use Modules\Course\Transformers\CourseResource;
use Modules\Course\Repositories\Interfaces\CourseInterface;
use Modules\Course\Repositories\Repositories\LanguageRepository;

class CourseController extends Controller
{
    protected $courseinterface;
    public function __construct(CourseInterface $interface)
    {
        $this->courseinterface=$interface;
    }
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        $paginate=request()->paginate??10;
        $languages=new LanguageRepository();
        $languages=$languages->getAll([],['id','title_ar']);
        $info=$this->courseinterface->getScopes(["count"]);
        $courses=$this->courseinterface->index([],['lectures as lectures_num','teachers as teachers'],['id','title_ar','title_en','created_at','language_id'],$paginate);
        return view('course::admin.course.index',['courses'=>$courses,'languages'=>$languages,"info"=>$info]);
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        $languages=new LanguageRepository();
        $languages=$languages->getAll([],['id','title_ar']);
        return view('course::admin.course.create',['languages'=>$languages]);
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(CourseRequest $request)
    {
        $this->courseinterface->store($request);
        return redirect()->back()->with('success','تم إنشاء الدورة بنجاح');

    }



    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        $course=$this->courseinterface->find($id,['*'],['teachers:id,name_ar']);
        $languages=new LanguageRepository();
        $languages=$languages->getAll([],['id','title_ar']);
        return view('course::admin.course.edit',['course'=>$course,'languages'=>$languages]);
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(CourseRequest $request, $id)
    {
        $course=$this->courseinterface->update($id,$request);
        return redirect()->back()->with('success','تم تعديل الدورة بنجاح');
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy($id)
    {
        $course=$this->courseinterface->delete($id);
        return redirect()->back()->with('success','تم حذف الدورة بنجاح');
    }

    public function getCourseApi(Request $request)
    {

        $courses=$this->courseinterface->index([],[],['id','title_ar as text'],10);

        return new CourseResource($courses);
    }


    public function uploadPage($id)
    {

        $course=$this->courseinterface->find($id,['id','title_ar'],['attachment']);
        return view('course::admin.course.upload-file',['course'=>$course]);
    }
    public function uploadFile($id,Request $request){

         $message=$this->courseinterface->uploadFile($id,$request);
         return $message;
    }

    public function downloadAttachment($course,$id){

        $file=$this->courseinterface->downloadAttachment($course,$id);
          $path = "/".str_replace( '\\', '/', $file->path );
            return response()->download(public_path().$path);

    }

    public function  deleteAttachment($course,$id)
    {

        $this->courseinterface->deleteAttachment($course,$id);
        return redirect()->route('admin.course.upload.page',$course)->with('success','تم حذف الملف بنجاح');

    }


    public function showAllCourses($slug){
       $allcourses =  $this->courseinterface->showAllCourses($slug);

   return view('course::User.Course.courseList',[
    'allcourses'=>$allcourses],
    );
    }

    public function showcourseDetailsPage($slug){

        list($courseDetails , $user_courses , $oneRealated) =  $this->courseinterface->showcourseDetailsPage($slug);

         if(!$courseDetails){
            return redirect()->back()->with('error' , 'the course is not found in our records');
         }

    return view('course::User.Course.courseDetails',[
     'courseDetails'=>$courseDetails,
     'oneRealated'=>$oneRealated,
     'user_courses'=>$user_courses,
    ],
     );
     }



     public function myCourses(){

       $user =$this->courseinterface->myCourses();

        return view('course::User.Course.my_courses' ,[
            'courses'=>$user->courses
        ]);
}

public function storeNote(Request $request){
    $lecture = Lecture::select('id','type')->find($request->id);
    if(!$lecture)
        return response()->json(['message'=>'lecture not found ' ] , 404);


$user = auth()->user()->load(['courses'=>function($q) use ($lecture){
    $q->select('courses.id');

    if($lecture->type==1)
    $q->with('lectures:id,course_id');
}
]);

$user_lectures =$user->courses?$user->courses->pluck('lectures.id')->toArray():[];


if (($lecture->type ==0) || in_array($lecture->id,$user_lectures)) {
    $validate = $request->validate([
        'text' => 'required|string|max:255',
    ]);


    $note = Note::create([
        'text' => $request->text,
        'user_id' => $user->id,
        'lecture_id' => $request->id,
    ]);
    return response()->json([
        'success' => true,
        'note' => $note->text
]);
}

return response()->json([
    'error' => false,
]);

}


   public function getSessionNotes()
{
    $notes = session('notes', []);
    return response()->json(['notes' => $notes]);
}


public function coursesLikedVideos($id)
{
    $lecture = Course::select('id')->find($id);
    if ($lecture->liked()) {
        $lecture->unlike();


        return response()->json([
            'success'=> false,
            ]);
    }

    $user = auth()->user();
    $lecture->like();

    return response()->json([
        'success'=> true,
        ]);

}

}



