<?php
namespace Modules\Admin\Repositories\Interfaces;

interface AdminInterface{
 public function dashboard();
 public function updateMyPassword($request);
 public function updatemyProfile($request);
 public function index($relations=[],$count=[],$params=['*'],$paginate=10);
 public function getScopes($scopes);
 public function create($request);
 public function find($id,$relations=[],$params=['*'],$count=[]);
 public function update($id,$request);
 public function delete($id);
 public function createRole($request);
 public function updateRole($id,$request);
 public function deleteRole($id);
 public function getRoles($relations=[],$params=['*'],$count=[],$paginate=10);
 public function getPermissions();
 public function getRole($id,$relations=[],$params=['*'],$count=[],$paginate=10);





}
