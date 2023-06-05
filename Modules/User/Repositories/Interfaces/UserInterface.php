<?php
namespace Modules\User\Repositories\Interfaces;

use Modules\User\Http\Requests\ProfileRequest;

interface UserInterface{
    public function index($relations=[],$count=[],$params=['*'],$paginate=10);
    public function store($request);
    public function update($id,$request);
    public function find($id,$params=['*'],$relations=[],$count=[]);
    public function delete($id);
    public function mainPage();
    public function aboutUs();
    public function profileUpdate(ProfileRequest $request);
    public function profileShow();
    public function getScopes($scopes);
    public function usersStatistics($params=['*'],$relations=[],$count=[],$paginate=15);
    public function userStatistic($id);
    public function subscribeOnCampaigns($request);
    public function AssignUserToWithCamp($share_id,$camp_id);
    public function addPointsToLoginByUser($user);
}
