<?php

namespace Modules\User\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\User\Repositories\Interfaces\UserInterface;

class StatisticController extends Controller
{
    protected $userinterface;
    public function __construct(UserInterface $interface)
    {
         $this->userinterface=$interface;
    }
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function usersStatistics()
    {
        $paginate=request()->paginate??15;
        $users=$this->userinterface->usersStatistics(['email','id','name'],['wallet:user_id,total'],['levels as campaigns'=>function($q){
            $q->whereHas('level',function($q){
                 $q->where('order',1);
            });
        },"usersloginByMe as count_users"],$paginate);

        return view('user::admin.statistic.users_statistics',['users'=>$users]);
    }

    public function userStatisticToAdmin($id){
       list($user,$campaigns)=$this->userinterface->userStatistic($id);

       return view('user::admin.statistic.statistic_user',['user'=>$user,"campaigns"=>$campaigns]);

    }

    public function userStatisticToUser(){
        list($user,$campaigns)=$this->userinterface->userStatistic(auth()->user()->id);

        return view('user::User.Affiliate.affiliateProfile',['user'=>$user,'campaigns'=>$campaigns]);
     }


}
