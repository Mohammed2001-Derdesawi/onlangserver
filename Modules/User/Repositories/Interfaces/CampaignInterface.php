<?php
namespace Modules\User\Repositories\Interfaces;

interface CampaignInterface{
    public function index($relations=[],$count=[],$params=['*'],$paginate=10);
    public function store($request);
    public function update($id,$request);
    public function find($id,$params=['*'],$relations=[],$count=[]);
    public function delete($id);
    public function getScopes($scopes);
    public function getAll($relations = [], $params = ['*'], $count = []);
    public function findBySlug($slug,$relations=[],$params=['*'],$count=[]);


}
