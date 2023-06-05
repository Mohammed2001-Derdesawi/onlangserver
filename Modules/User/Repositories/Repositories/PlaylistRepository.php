<?php

namespace Modules\User\Repositories\Repositories;

use Modules\User\Entities\Plan;
use Modules\User\Entities\Playlist;
use Modules\Course\Entities\Various;
use Modules\Course\Entities\VariousGroup;
use Modules\User\Entities\playlistVideos;
use Modules\User\Repositories\Interfaces\PlaylistInterface;




class PlaylistRepository implements PlaylistInterface{



    public function find($id, $params = ['*'], $relations = [], $count = [])
    {
       return findById(Playlist::class,$id,$relations,$params,$count);
    }
    public function myPlaylists($video = null)
    {
        if(!$video)
        $user=auth()->user()->load('playlists:id,title,user_id');
        else


        $user=auth()->user()->load(['playlists'=>function($q) use($video){
            $q->whereDoesntHave('playlistVideos',function($q) use($video){
              $q->where('video_id','<>',$video);
            });
        }]);
        return $user->playlists;
    }
    public function ShowMyPlaylistsVideos($id)
    {
        $user=auth()->user();

        $plan=findById(Plan::class,1,[],['id','name']);
    $playlists=Playlist::where('user_id', auth()->user()->id)->with(['playlistVideos'=>function($q) use($user , $plan){
        $q->with(['video'=>function($q) use($user , $plan){
          $q->select("id","title_en","title_ar","poster","type");

          if(!$user->subscribed( $plan->name))
          $q->where('type','free');
        }]);
    }])->find($id);

    if (!$playlists) {
        return null;
    }
    return $playlists;
}
    public function SaveVideoToPlaylist($id,$video){
        $playlist=$this->find($id,['id','user_id'],['playlistVideos:video_id,playlist_id,id']);
        $user=auth()->user();
        if($playlist->user_id!=$user->id)
        return ['error'=>'The PlayList not found in our record'];

        $playlistvideo=$playlist->playlistVideos->firstwhere('video_id',$video);
        if($playlistvideo)
        {

            $playlistvideo->delete();
            return ['success'=>'Successfully remove video from the Playlist'];

        }
        $video=findById(Various::class,$video,[],['id','type']);
        $plan=findById(Plan::class,1,[],['id','name']);

        if(!$playlistvideo)
        {
            if($video->type=='paid' && !$user->subscribed($plan->name))
            return ['error'=>'The Video Type is paid and your not subscribed!'];

            $playlist->playlistVideos()->create([
                'video_id'=>$video->id
            ]);
        }


        return ['success'=>'Successfully Added video To the Playlist'];

    }
    public function addAdminPlayListToMy($id){
        $group=findById(VariousGroup::class,$id,['variouses:id,group_id,type'],['id','title_en']);

        $user=auth()->user()->load(['playlists'=>function($q){
              return $q->whereNotNull('group_id');
        }]);

        $playlists=$user->playlists;
        if($playlists->firstWhere('group_id',$group->id)){
           return [
               'error'=>'The PlayList is already added to your PlayLists!'
           ];
        }

        $plan=findById(Plan::class,1,[],['id','name']);

           $videos=$group->variouses->map(function($video) use($user , $plan){

            if(!$user->subscribed($plan->name) && $video->type=='paid')
            return;
            else
            return ['video_id'=>$video->id];


          })->filter();

      if(count($videos)>0){
       $playlist=Playlist::create([
           'group_id'=>$group->id,
           'user_id'=>$user->id,
           'title'=>$group->title_en,
          ]);

       $playlist->playlistVideos()->createMany($videos);
       return [
           'success'=>'The PlayList is  added to your PlayLists!'
       ];

      }
      return [
       'error'=>"The PlayList it doesn't have any video wait the author to post videos!"
   ];

   }

   public function storePlaylist($request){
      $user=auth()->user();
      $playlist=$user->playlists()->create([
        'title'=>$request->title
      ]);
      $playlist->playlistVideos()->create([
        'video_id'=>$request->video
      ]);
      return [
        'success'=>'The PlayList is created and save video to it!'
    ];
   }

   public function updatePlaylist($request , $id){

    $playlist= Playlist::where('user_id',auth()->user()->id)->select('id','user_id')->find($id);



    if(!$playlist){
        return [
            'error'=>'The PlayList is not found !'
        ];
    }

    $update=[
        'title'=>$request->title,
    ];
    $playlist->update( $update);
    return [
      'success'=>'The Title  is updatd !',
      'title'=>$playlist->title
  ];
    }

    public function deletePlaylist($id)
    {
    $playlist= Playlist::select('id', 'user_id')->where('user_id', auth()->user()->id)->find($id);
    if (!$playlist) {
        return [
            'error'=>'The PlayList is not found !'
        ];




    }


    $playlist->delete();

}
    public function deleteVideoFromPlaylist(  $playlistId ,  $id)
    {
        $playlist= playlist::select('id','user_id')->where( 'user_id', auth()->user()->id )->find($playlistId);
        if(!$playlist)
        {

            return false;
        }

       $playlistvideo= playlistVideos::where( 'video_id', $id)->where( 'playlist_id', $playlist->id)->first();
       if(!$playlistvideo)
       {
        return false;

       }
    $playlistvideo->delete();

            return $playlist;
    }






    public function showMyPlaylistOneVideo( $palylistId , $id){
        $user=auth()->user()->load('playlists');
        $playlist=$user->playlists->find($palylistId);

        if(!$playlist ){
            toastr('The playlist is not found in your Playlist','error');
            return redirect()->back();
        }

        $videos =  $playlist->playlistVideos()->with('video');
         $video = $videos->firstWhere('video_id', $id);
         $recents =  $videos->whereNotIn('video_id' , [$id]);


        if(!$video ){
            toastr('The video is not found in your Playlist','error');
            return redirect()->back();
        }
        $video = $video->video;

        return [$video , $recents , $playlist];

    }

    public function getUserPlaylistFromVideo($id){

        $user = auth()->user()->load(['playlists'=>function($q) use($id){
            $q->select('id','user_id')->whereHas('playlistVideos',function($q) use($id){
              $q->where('video_id',$id);
            });
          }]);
          $playlists=$user->playlists->pluck('id')->toArray();

         return $playlists ;
 }

}


