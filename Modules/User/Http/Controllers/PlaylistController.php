<?php

namespace Modules\User\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Contracts\Support\Renderable;
use Modules\User\Repositories\Interfaces\PlaylistInterface;

class PlaylistController extends Controller
{
    protected $playlistRepo;
    public function __construct(PlaylistInterface $playlistRepo)
    {
        $this->playlistRepo=$playlistRepo;
    }

    public function addAdminPlayListToMy(Request $request){
        $message=$this->playlistRepo->addAdminPlayListToMy($request->id);
        return  response()->json($message);

    }

    public function SaveVideoToPlaylist(Request $request){
        $message=$this->playlistRepo->SaveVideoToPlaylist($request->id,$request->video);
        return  response()->json($message);
    }

    public function StorePlaylist(Request $request){
        $message=$this->playlistRepo->storePlaylist($request);
        return response()->json($message);
    }

    public function myPlaylists(){
        $myplaylist=$this->playlistRepo->myPlaylists();
        return view('course::User.Playlist.home',[
            'myplaylist' => $myplaylist,
        ]);
    }
    public function ShowMyPlaylistsVideos($id){

        $playlist=$this->playlistRepo->ShowMyPlaylistsVideos($id);
        if(!$playlist){
            toastr('The PlayList is not found inyour records','error');
            return redirect()->back();
        }
        $myplaylistVideos=$playlist->playlistVideos;

        return view('course::User.Playlist.playlistList',[
            'myplaylistVideos' => $myplaylistVideos,
            'playlist'=>$playlist
        ]);
    }

    public function updatePlaylist($id,Request $request){
        $message=$this->playlistRepo->updatePlaylist($request , $id);
        return response()->json($message);

    }
    public function deletePlaylist($id){
         $this->playlistRepo->deletePlaylist($id);
        return redirect()->route('user.my.playlist');

    }
    public function deleteVideoFromPlaylist( $palylistId , $id)
    {



        $playlist = $this->playlistRepo->deleteVideoFromPlaylist( $palylistId ,   $id);

        if(!$playlist ){
            toastr('The video is not found in your Playlist','error');
            return redirect()->back();
        }

        return redirect()->back()->with('sucess','تم حذف الفيديو من قائمة الفيديوهات ');


    }

    public function showMyPlaylistOneVideo( $palylistId , $id)

{

  list($video , $recents , $playlist) = $this->playlistRepo->showMyPlaylistOneVideo( $palylistId ,   $id);

  return view('course::User.Playlist.playlistDetails' ,[
    'video'=>$video,
          'recents'=>$recents,
          'playlist'=>$playlist,

  ] );


}

public function getUserPlaylistFromVideo($id){
    $playlists = $this->playlistRepo->getUserPlaylistFromVideo($id);
    return response()->json(['playlists'=>$playlists]);


}

}
