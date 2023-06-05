<?php
namespace Modules\Course\Repositories\Interfaces;

interface TeacherInterface{
    public function index($relations=[],$count=[],$params=['*'],$paginate=10);
    public function store($request);
    public function update($id,$request);
    public function find($id,$params=['*'],$relations=[],$count=[]);
    public function delete($id);
    public function getAll($relations=[],$params=['*'],$count=[]);
    public function getScopes($scopes);

    public function  allteachers();

    public function showTeacher($slug);
    public function  allPrivateTeacher();

    public function showPrivateTeacher($slug);


}
