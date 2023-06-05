<?php

namespace Modules\Course\Http\Controllers;

use Illuminate\Http\Request;
use Modules\User\Entities\Plan;
use Illuminate\Routing\Controller;
use Modules\Course\Entities\Review;
use Modules\Course\Entities\Lecture;
use Modules\Course\Entities\Various;
use Illuminate\Contracts\Support\Renderable;
use Modules\Course\Http\Requests\VariousRequest;
use Modules\Course\Repositories\Interfaces\VariousInterface;
use Modules\User\Repositories\Repositories\PlaylistRepository;




class VariousController extends Controller
{
    protected $variousinterface;

    public function __construct(VariousInterface $interface)
    {
        $this->variousinterface=$interface;
    }
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        $paginate=request()->paginate??10;
        $info=$this->variousinterface->getScopes(['count']);
        $variouses=$this->variousinterface->index(['group:id,title_ar'], ['likes as likes','userPlaylist as playlists'], ['id','title_ar','title_en','group_id','type','created_at'], $paginate);
        return view('course::admin.various.index', ['info'=>$info,'variouses'=>$variouses]);
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        return view('course::admin.various.create');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(VariousRequest $request)
    {
        $this->variousinterface->store($request);
        return redirect()->back()->with('success', 'تم إضافة المنوعة بنجاح');
    }



    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        $various=$this->variousinterface->find($id, ['*'], ['group:id,title_ar']);
        return view('course::admin.various.edit', ['various'=>$various]);
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(VariousRequest $request, $id)
    {
        $this->variousinterface->update($id, $request);
        return redirect()->back()->with('success', 'تم تعديل المنوعة بنجاح');
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy($id)
    {
        $this->variousinterface->delete($id);
        return redirect()->back()->with('success', 'تم حذف المنوعة بنجاح');
    }
    public function uploadPage($id)
    {
        $various=$this->variousinterface->find($id, ['id','title_ar'], ['attachments']);
        return view('course::admin.various.upload-file', ['various'=>$various]);
    }
    public function uploadFile($id, Request $request)
    {
        $message=$this->variousinterface->uploadFile($id, $request);
        return $message;
    }

    public function downloadAttachment($various, $id)
    {
        $file=$this->variousinterface->downloadAttachment($various, $id);
             $path = "/".str_replace( '\\', '/', $file->path );
            return response()->download(public_path().$path);    }

    public function deleteAttachment($various, $id)
    {
        $this->variousinterface->deleteAttachment($various, $id);
        return redirect()->route('admin.various.upload.page', $various)->with('success', 'تم حذف الملف بنجاح');
    }

    public function showAllPaidVideos($id)
    {
        $allPaidVideos =  $this->variousinterface->showAllPaidVideos($id);
        $playlists=new PlaylistRepository();
        $playlists=$playlists->myPlaylists();
        return view(
            'course::User.Various.Paid.videosDetails',
            [
         'allPaidVideos'=>$allPaidVideos ,
         'playlists'=>$playlists
        ],
        );
    }


     public function showAllFreeVideos($id)
     {
         $allFreeVideos =  $this->variousinterface->showAllFreeVideos($id);
         $playlists=new PlaylistRepository();
         $playlists=$playlists->myPlaylists();

         return view(
             'course::User.Various.Free.videosDetails',
             [
             'allFreeVideos'=>$allFreeVideos,'playlists'=>$playlists],
         );
     }



     public function showOnePiadVideo($id)
     {
         list($PaidDetails, $recents) =  $this->variousinterface->showOnePiadVideo($id);
         // dd( $this->variousinterface->showOnePiadVideo($id));
         return view(
             'course::User.Various.Paid.viewVideoDetails',
             [
             'PaidDetails'=>$PaidDetails ,
         'recents'=>$recents],
         );
     }

     public function showOneFreeVideo($id)
     {
         list($FreeDetails, $recents) =  $this->variousinterface->showOneFreeVideo($id);

         return view(
             'course::User.Various.Free.viewVideoDetails',
             [
             'FreeDetails'=>$FreeDetails ,
             'recents'=>$recents
             ],
         );
     }


     public function likedVideos($id)
     {
         $various = Various::select('id')->find($id);
         if ($various->liked()) {
             $various->unlike();


             return response()->json([
                 'success'=> false,
                 ]);
         }
         $user = auth()->user();
         $plan=findById(Plan::class,1,[],['id','name']);

         if (  $various->type == 'paid'   &&   ! $user->subscribed($plan->name)) {
             return response()->json([
                 'error'=>'Plaese you should subscribed '
                ]);
         }


         $various->like();

         return response()->json([
             'success'=> true,
             ]);
     }

public function mylikedVideos()
{
    $user = auth()->user();

      $likedVideos = $user->likes()->with("likeable")->paginate(1)  ;

    return view(
        'course::User.Playlist.likedVideos',
        [
        'likedVideos'=>$likedVideos,


        ],
    );
}





public function addWatchlaters(Request $request)
{
    $user = auth()->user()->load('watchlaters');
    $watchlater=$user->watchlaters->firstWhere('various_id', $request->id);

    if ($watchlater) {
        $watchlater->delete();

        return response()->json([
            'success'=> 'delete from watchlater',
            ]);
    }
    $user->watchlaters()->create(['various_id'=>$request->id]);


    return response()->json([
        'success'=> 'add to  watchlater',
        ]);
}

public function myWatchLaterVideos()
{
    $user = auth()->user();
    $plan=findById(Plan::class,1,[],['id','name']);

    $user->load(['watchlaters'=>function ($q) use ($user , $plan) {
        $q->whereHas('video', function ($q) use ($user , $plan) {
            $q->select('id', 'title_ar', 'title_en', 'poster');
            if (!$user->subscribed($plan->name)) {
                $q->where('type', 'free');
            }
        });
    }]);
    $myWatchLaters = $user->watchlaters()->paginate(1);




    return view(
        'course::User.Playlist.watchLaterVideos',
        [
        'myWatchLaters'=>$myWatchLaters],

    );



}


public function deleteFromMyWatchLater($id){
    $user = auth()->user()->load('watchlaters');
    $watchlater=$user->watchlaters->firstWhere('various_id', $id);

    if ($watchlater) {

        $watchlater->delete();

    }

    return redirect()->route('user.my.watchlater');

}



}


