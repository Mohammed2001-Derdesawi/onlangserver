<?php
namespace Modules\Course\Repositories\Interfaces;


interface LectureInterface{
    public function index($relations=[],$count=[],$params=['*'],$paginate=10);
    public function store($request);
    public function update($id,$request);
    public function find($id,$params=['*'],$relations=[],$count=[]);
    public function delete($id);
    public function getCourseLecture($id,$relations=[],$params=['*'],$count=[],$paginate=10);
    public function uploadFile($id,$request);
    public function downloadAttachment($lecture,$id);
    public function deleteAttachment($lecture,$id);
    public function getScopes($scopes);


    public function showlectures($id);

}

