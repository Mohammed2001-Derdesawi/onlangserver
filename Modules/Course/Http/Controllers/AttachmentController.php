<?php

namespace Modules\Course\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Course\Entities\Course;
use Modules\Course\Entities\Lecture;
use Modules\Course\Entities\Various;
use Illuminate\Support\Facades\Storage;
use Modules\Course\Entities\Attachment;
use Modules\Course\Entities\VariousGroup;
use Illuminate\Contracts\Support\Renderable;
use Pion\Laravel\ChunkUpload\Receiver\FileReceiver;
use Pion\Laravel\ChunkUpload\Handler\HandlerFactory;
use Modules\Course\Repositories\Repositories\CourseRepository;
use Modules\Course\Repositories\Repositories\LectureRepository;

class AttachmentController extends Controller
{
    public function downloadCourseAttachment( $courseId  ,  $attachmentId){

        $course = Course::select('id')->findOrFail($courseId);
        $download = $course->attachment()->findOrFail($attachmentId);

        $exists=Storage::disk('public')->exists(substr($download->path,8));


   if($exists)
       {
           $path = "/".str_replace( '\\', '/', $download->path );
            return response()->download(public_path().$path);
       }

       else
       return back();

    }


    public function downloadLectureAttachment( $lectureId  ,  $attachmentId){
        $lecture = Lecture::select('id')->findOrFail($lectureId);
        $download =  $lecture->attachments()->findOrFail($attachmentId);

        $exists=Storage::disk('public')->exists(substr($download->path,8));


   if($exists)
       {
           $path = "/".str_replace( '\\', '/', $download->path );
            return response()->download(public_path().$path);
       }

       else
       return back();

    }

    public function downloadVariousAttachment( $variousId  ,  $attachmentId){
        $various = Various::select('id')->findOrFail($variousId);
        $download =    $various->attachments()->findOrFail($attachmentId);

        $exists=Storage::disk('public')->exists(substr($download->path,8));


   if($exists)
       {
           $path = "/".str_replace( '\\', '/', $download->path );
            return response()->download(public_path().$path);
       }

       else
       return back();

    }

    public function tynymicUpload(Request $request){
         try{
            $path='storage/photos/'.storeImage("/photos",$request->file);
            return $path;
         }catch(Exception $e)
         {
            return response()->json(["message"=>"unknown error"],500);
         }

    }



}
