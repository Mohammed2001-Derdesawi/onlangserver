<?php
namespace Modules\User\Repositories\Interfaces;

interface PlaylistInterface{
    public function addAdminPlayListToMy($id);
    public function SaveVideoToPlaylist($id,$video);
    public function myPlaylists($video = null);
    public function storePlaylist($request);

    public function ShowMyPlaylistsVideos($id);
    public function updatePlaylist($request , $id);
    public function deletePlaylist($id);
    public function deleteVideoFromPlaylist( $playlistId,$id);
    public function showMyPlaylistOneVideo( $palylistId , $id);
    public function getUserPlaylistFromVideo($id);

}
