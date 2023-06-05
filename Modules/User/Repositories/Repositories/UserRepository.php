<?php

namespace Modules\User\Repositories\Repositories;

use Modules\User\Entities\User;
use Ramsey\Uuid\Rfc4122\UuidV4;
use Modules\Course\Entities\Course;
use Modules\User\Entities\Campaign;
use Illuminate\Support\Facades\Hash;
use Modules\Course\Entities\Article;
use Modules\Course\Entities\Opinion;
use Modules\User\Notifications\LevelGift;
use Modules\User\Notifications\LevelPoint;
use Modules\User\Notifications\StartCampaign;
use Modules\User\Notifications\StartNewLevel;
use Modules\User\Http\Requests\ProfileRequest;
use Modules\User\Notifications\FinsihCampaign;
use Modules\User\Notifications\NewUserRegisterBy;
use Modules\User\Repositories\Interfaces\UserInterface;
use Modules\Course\Repositories\Repositories\CourseRepository;

class UserRepository implements UserInterface{
    protected $path="images\users";
    public function index($relations = [],$count=[], $params=['*'],$paginate = 10)
    {
        if($paginate>50)
         $paginate=50;
        return  User::with($relations)->select($params)->withCount($count)->search()->group()->date()->courseSubscribes()->paginate($paginate);
    }
    public function getScopes($scopes)
    {

        $allscopes=["count"=>"COUNT(id)","max"=>"MAX(id)","min"=>"MIN(id)"];
        $keys=array_keys($allscopes);
        $search=[];
        foreach($scopes as $scope)
        {

            if(in_array($scope,$keys)){
                $search[$scope]=$allscopes[$scope]." as ".$scope;
            }
        }
        if(count($search)==0)
        return collect();

        $search=implode(',',array_values($search));



        return User::SelectRaw($search)->search()->date()->courseSubscribes()->first();    }
    public function getAll($relations = [], $params = ['*'], $count = [])
    {
        return User::with($relations)->select($params)->withCount($count)->get();

    }
    public function getmodel($relations=[],$params=[],$count=[]){
        return User::with($relations)->select($params)->withCount($count);
    }
    public function store($request)
    {
        $create=[
            "name"=>$request->name,
            "email"=>$request->email,
            "password"=>Hash::make($request->password),
            "age"=>$request->age,
            "gender"=>$request->gender,
            "phone"=>$request->phone,
            "uuid"=>UuidV4::uuid1()

        ];
        if($request->file("image")){
            $create["image"]='storage\\'.$this->path."\\".storeImage($this->path,$request->image);
        }
        $user=User::create($create);
        if($request->courses && $request->courses[0]!='')
        {
            $courserepo=new CourseRepository();

            $courses=[];
            foreach($request->courses as $id)
            {
                $course=$courserepo->find($id,['id','price']);
                $courses[$course->id]=[
                    "paid_by"=>"manual",
                    "joined_at"=>now(),
                    "price"=>$course->price
                ];
            }
            $user->courses()->attach($courses);


        }

        return $user;

    }
    public function find($id,$params=['*'],$relations = [], $count = [])
    {

         return findById(User::class,$id,$relations,$params,$count);
    }

    public function delete($id)
    {
        $user=$this->find($id,['id']);
        if($user->image)
        deleteImage($user->image);
        $user->delete();
        return true;

    }
    public function update($id, $request)
    {
        $user=$this->find($id);
        $update=[
            "name"=>$request->name,
            "email"=>$request->email,
            "age"=>$request->age,
            "gender"=>$request->gender,
            "phone"=>$request->phone,


        ];
        if($request->file("image")){
            $update["image"]='storage\\'.$this->path."\\".editImage($this->path,$request->image,$user->image);
        }
        if($request->password){
            $update["password"]=Hash::make($request->password);
        }
        $courses=[];

        if($request->courses && $request->courses[0]!='')
        {
            $courserepo=new CourseRepository();


            foreach($request->courses as $id)
            {
                $course=$courserepo->find($id,['id','price']);
                $courses[$course->id]=[
                    "paid_by"=>"manual",
                    "joined_at"=>now(),
                    "price"=>$course->price
                ];
            }




        }

        $user->update($update);
        $user->courses()->sync($courses);
        return $user;
    }



    public function mainPage(){
        $Reviews =Opinion::inRandomOrder()->take(4)->get();
        $articles = Article::latest()->take(4)->get();
        return view('user::User.home' , [
            'Reviews' =>$Reviews ,
            'articles'=>$articles,
        ]);




    }
    public function aboutUs(){
        $Recents =Article::latest()->take(3)->get();
        return view('user::User.aboutUs' , [
                'Recents'=>$Recents
        ] );

    }





    public function profileUpdate(ProfileRequest $request){



        $user=auth()->user();
        $path="images\users";

        $update=[
            'name'=>$request->name,
            'phone'=>$request->phone,
            'age'=>$request->age,
            'gender'=>$request->gender,
        ];
        if($request->file("image")){
            if(!$user->image)
                $update["image"]="storage\\".$path."\\".storeImage($path,$request->file("image"));
            else
                $update["image"]="storage\\".$path."\\".editImage($path,$request->file("image"),$user->image);

        }

        $user->update($update);
        toastr()->success(trans('messages.success'));
        $likedCourse = Course::whereLikedBy($user->id) // find only articles where user liked them
        ->with('likeCounter') // highly suggested to allow eager load
        ->get();
        return view('user::User.Profile.generalProfile' ,[
            'likedCourse'=>$likedCourse
        ]);

    }
    public function profileShow()

    {
        $user = auth()->user()->load('wallet');
      $likedCourse = Course::whereLikedBy($user->id) // find only articles where user liked them
	->with('likeCounter') // highly suggested to allow eager load
	->get();

        return view('user::User.Profile.generalProfile' ,[
            'likedCourse'=>$likedCourse,
            'user'=>$user,

        ]);

    }
    public function usersStatistics($params=['*'],$relations=[],$count=[],$paginate=15)
    {

       $users=User::with($relations)->select($params)->withSum('levels as points','points')->withCount($count)->where('is_start_campaigns',true)->search()->paginate($paginate);
       return $users;
    }

    public function userStatistic($id){

        $user=User::with(['wallet.lastWithdraw','wallet.withdraws','levels'=>function($q){
            $q->with(['level.campaign'=>function($q){
                $q->with(['levels'=>function($q){
                    $q->orderBy('levels.order');
                }]);
            }]);
        }])->withCount(['usersloginByMe as users_inactive'=>function($q){
            $q->where('is_get_point',0);
        }])->findOrFail($id);

        $campaigns=collect();

        if($user->levels){
            $campaigns=$user->levels->pluck('level.campaign')->unique();
        }

        return [$user,$campaigns];
    }

    public function subscribeOnCampaigns($request){
        $user=auth()->user();
        if($user->is_start_campaigns)
        return false;

         $user->update([
            'is_start_campaigns'=>true,
            "campaign_type"=>in_array($request->type,["course","money"])?$request->type:'money'
         ]);
         if($user->campaign_type=="money")
         $user->wallet()->create([
            'total'=>0,
         ]);

         return true;
    }

    public function AssignUserToWithCamp($share_id,$camp_id){
           $user=User::select("id","uuid","is_start_campaigns")->where('uuid',$share_id)->first();
        $camp=Campaign::select('id','slug')->where('slug',$camp_id)->first();
        if( !$user || !$camp ||   !$user->is_start_campaigns)
        return;

        $authuser=auth()->user();
        $authuser->loginBy()->create([
            'login_by'=>$user->id,
            'register_id'=>$authuser->id,
            'campaign_id'=>$camp->id

        ]);

          //notify user that a new User Register By him
        $user->notify(new NewUserRegisterBy($authuser));

        return $authuser;







    }

    public function addPointsToLoginByUser($user){
          if(($user->loginBy->shareUser && !$user->loginBy->shareUser->is_start_campaigns) || $user->loginBy->is_get_point)
          return;
         $camp_id=$user->loginBy->campaign_id;
         $loginBy=$user->loginBy;
        $user=$user->loginBy->shareUser;

        $user=$user->load(['wallet:id,user_id,total','levels'=>function($q)use($camp_id,$user){
            $q->with(['level'=>function($q) use($camp_id,$user){
                if($user->campaign_type=='course')
                $q->with('gifts.course');

                $q->whereHas('campaign',function($q) use($camp_id){
                    $q->where('id',$camp_id);
                });
            }])->latest();
        }]);

        $user->current_level=$user->levels->first();

        $camp=Campaign::with(['levels'=>function($q){
            $q->select('id','campaign_id','point_per_one','point_price','total_point')->orderBy('order');
        }])->select('id','total_points')->find($camp_id);
         $wallet=$user->wallet;
        // create a wallet if the user not have a wallet
        if(!$wallet && $user->campaign_type=='money')
        $wallet=$user->wallet()->create([
            'total'=>0,
            'last_withdraw'=>null
        ]);

        // check if the has start this campaign or not

        if(!$user->current_level && $camp->levels)
        {
            // update a login By after get points
            $loginBy->update([
                'is_get_point'=>1
            ]);

           return $this->startCampain($user,$camp,$wallet);
        }



        // the user is already start campaign
        $currentLevel=$this->addPointToLevel($user,$wallet);
         // update a login By after get points
         $loginBy->update([
            'is_get_point'=>1
        ]);
        return $currentLevel;

    }

    // start in a first level in the campaign
    public function startCampain($user,$camp,$wallet){

        $currentlevel=$camp->levels->first();

        $currentLevel=$user->levels()->create([
            'level_id'=>$currentlevel->id,
            'points'=>$currentlevel->point_per_one,
            'is_done'=>false
        ]);
        if($user->campaign_type=='money')
        $wallet->update([
            'total'=>$currentlevel->point_per_one*$currentlevel->point_price
        ]);


        // notify the user that one of his users login has purchase a course
        $user->notify(new StartCampaign($camp));
        return $currentLevel;

    }

    public function addPointToLevel($user,$wallet){

        list($isfinished,$earningpoints)=$user->current_level->isFinished($user->current_level->level->point_per_one);

        // cuurent level is not ended

        if(!$isfinished)
        {
            $currentLevel=$user->current_level->update([
                'points'=>$earningpoints,

            ]);
            $currentLevel=$user->current_level->fresh();
            // update total of wallet if the user campaign type is money
            if($user->campaign_type=='money')
            $wallet->update([
                'total'=>$wallet->total + ($user->current_level->level->point_per_one * $user->current_level->level->point_price) ,

            ]);
            $user->notify(new LevelPoint($user->current_level->level));
                        return $currentLevel;

        }


          // Assign gifts courses to A user if the campaign type is courses
        if($user->campaign_type=='course')
        {
           $this->AssignLevelGiftTo($user,$user->current_level->level->gifts);
        }


        // if the current level in campaign is finished check and start if the last level or not
        return $this->startNewLevel($user,$wallet,$earningpoints);





    }

    public function startNewLevel($user,$wallet,$earningpoints){
        $nextLevel=$user->current_level->level->nextLevel();

        // if the current levels is the last level
        if(!$nextLevel)
        {
            // dd($earningpoints ,$user->current_level->level->point_per_one , $user->current_level->points );

            $pointlevelprice=$user->current_level->level->point_price;
            $point_per_one=$user->current_level->level->point_per_one;
            if($earningpoints > 0)
            {

                $pointlevelprice=$user->current_level->level->point_price_after_done??$pointlevelprice;

            }
            $currentpoints=$user->current_level->level->point_per_one + $user->current_level->points;
            $currentLevel=$user->current_level->update([
                'points'=>$currentpoints,
                 "is_done"=>1
                ]);

            if(!$wallet && $user->campaign_type=='course'){
                $wallet=$user->wallet()->create([
                    'total'=>$pointlevelprice*$point_per_one
    ]);
             }
            else
            $wallet->update([
                'total'=>$wallet->total+ ($pointlevelprice * ($point_per_one))
            ]);



            // notify the user that he has finsied the campaign and he will get in every point  point_price_after_done
            if ( $currentpoints <= $user->current_level->level->total_point)
            {

                $user->notify(new FinsihCampaign($user,$user->current_level->level));

                }
              return $user->current_level;

            }

        $newlevel=$user->levels()->create([
            'points'=>$earningpoints,
            'level_id'=>$nextLevel->id,
            'is_done'=>false
        ]);

        if($user->campaign_type=='money'){
            $total=$wallet->total+($user->current_level->level->point_price *$user->current_level->level->point_per_one);
            if($earningpoints>0)
            $total+=($nextLevel->point_price * ($earningpoints + $nextLevel->point_per_one));
            $wallet->update([
                'total'=>$total
            ]);
        }

        $currentLevel=$user->current_level->update([
            'points'=>$user->current_level->level->total_point,
            "is_done"=>1

        ]);
          // notify the user that he started a new Level in campaign
        $user->notify(new StartNewLevel($nextLevel));
        return $currentLevel;
    }

    public function AssignLevelGiftTo($user,$gifts){

        if($gifts)
        {
           $courses=$gifts->pluck('course.id')->toArray();
           $user->courses()->syncWithoutDetaching($courses);
           // notify user that he got the gift of the level
           $user->notify(new LevelGift($gifts));

        }
        return $user;

    }




}
