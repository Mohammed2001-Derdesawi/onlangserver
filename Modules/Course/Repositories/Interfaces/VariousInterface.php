<?php
namespace Modules\Course\Repositories\Interfaces;

interface VariousInterface{
    public function index($relations=[],$count=[],$params=['*'],$paginate=10);
    public function store($request);
    public function update($id,$request);
    public function find($id,$params=['*'],$relations=[],$count=[]);
    public function delete($id);
    public function getScopes($scopes);
    public function uploadFile($id,$request);
    public function downloadAttachment($course,$id);
    public function deleteAttachment($course,$id);
    public function showAllPaidVideos($id);
    public function showAllFreeVideos($id);
    public function showOnePiadVideo($id);
    public function showOneFreeVideo($id);

}
