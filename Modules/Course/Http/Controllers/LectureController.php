<?php

namespace Modules\Course\Http\Controllers;

use Illuminate\Http\Request;
use Modules\User\Entities\Plan;
use Illuminate\Routing\Controller;
use Modules\Course\Entities\Lecture;
use Illuminate\Contracts\Support\Renderable;
use Modules\Course\Http\Requests\LectureRequest;
use Modules\Course\Repositories\Interfaces\LectureInterface;
use Modules\Course\Repositories\Repositories\CourseRepository;

class LectureController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    protected $lectureinterface;
    public function __construct(LectureInterface $interface)
    {
        $this->lectureinterface=$interface;
    }
    public function index()
    {
        $paginate=request()->paginate??10;
        $lectures=$this->lectureinterface->index(['course:id,title_ar'], [], ['id','title_ar','title_en','course_id','order','type','created_at','duration'], $paginate);
        $info=$this->lectureinterface->getScopes(["count"]);
        return view('course::admin.lecture.index', ['lectures'=>$lectures,"info"=>$info]);
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        return view('course::admin.lecture.create');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(LectureRequest $request)
    {
        $this->lectureinterface->store($request);
        return redirect()->back()->with('success', 'تم إنشاء المحاضرة بنجاح');
    }



    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        $lecture=$this->lectureinterface->find($id, ['*'], ['course:id,title_ar']);
        return view('course::admin.lecture.edit', ['lecture'=>$lecture]);
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(Request $request, $id)
    {
        $this->lectureinterface->update($id, $request);
        return redirect()->back()->with('success', 'تم تعديل المحاضرة بنجاح');
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy($id)
    {
        $this->lectureinterface->delete($id);
        return redirect()->back()->with('success', 'تم حذف المحاضرة بنجاح');
    }

    public function getCourseLectures($id)
    {
        $paginate=request()->paginate??10;
        $lectures=$this->lectureinterface->getCourseLecture($id, ['course:id,title_ar'], ['id','title_ar','title_en','course_id','order','type','created_at','duration'], [], $paginate);
        return view('course::admin.course.lectures', ['lectures'=>$lectures]);
    }

    public function uploadPage($id)
    {
        $lecture=$this->lectureinterface->find($id, ['id','title_ar'], ['attachments']);
        return view('course::admin.lecture.upload-file', ['lecture'=>$lecture]);
    }
    public function uploadFile($id, Request $request)
    {
        $message=$this->lectureinterface->uploadFile($id, $request);
        return $message;
    }

    public function downloadAttachment($lecture, $id)
    {
        $file=$this->lectureinterface->downloadAttachment($lecture, $id);
         $path = "/".str_replace( '\\', '/', $file->path );
            return response()->download(public_path().$path);
     
    }

    public function deleteAttachment($lecture, $id)
    {
        $this->lectureinterface->deleteAttachment($lecture, $id);
        return redirect()->route('admin.lecture.upload.page', $lecture)->with('success', 'تم حذف الملف بنجاح');
    }


    public function showLectures($id)
    {
        return $this->lectureinterface->showlectures($id);

        // return view('course::User.Lecture.lectures', [
        //     'Lectures'=>$Lectures ,

        // ]);
    }



    public function lecturesLikedVideos($id)
    {
        $lecture = Lecture::select('id')->find($id);
        if ($lecture->liked()) {
            $lecture->unlike();


            return response()->json([
                'success'=> false,
                ]);
        }
        $user = auth()->user();
        $plan=findById(Plan::class,1,[],['id','name']);

        if (! $user->subscribed( $plan->name) && $lecture->type == 'paid') {
            return response()->json([
                'error'=>'Plaese you should subscribed '
               ]);
        }


        $lecture->like();

        return response()->json([
            'success'=> true,
            ]);


    }





}
