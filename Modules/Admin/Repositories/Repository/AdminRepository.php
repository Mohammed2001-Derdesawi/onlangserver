<?php

namespace Modules\Admin\Repositories\Repository;
use Carbon\Carbon;
use Modules\User\Entities\User;
use Modules\User\Entities\Level;
use Modules\Admin\Entities\Admin;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use Modules\Course\Entities\Course;
use Modules\User\Entities\Campaign;
use Illuminate\Support\Facades\Hash;
use Laravel\Cashier\Subscription as CashierSubscription;
use Modules\Course\Entities\Article;
use Modules\Course\Entities\Lecture;
use Modules\Course\Entities\Teacher;
use Modules\Course\Entities\Various;
use Spatie\Permission\Models\Permission;
use Modules\Admin\Repositories\Interfaces\AdminInterface;
use Modules\User\Entities\Subscription;
use Modules\User\Entities\Wallet;
use Modules\User\Entities\WalletWithdraw;
use Modules\User\Entities\WhatsappRecord;
use Modules\User\Entities\Payment;
class AdminRepository implements AdminInterface{

     protected $path="images\\admin\\";

    public function updateMyPassword($request){
        $user=$this->getAuthUser();
        if(password_verify($request->old_password,$user->password))
        {
           $user->update(['password'=>encrypt($request->new_password)]);
           return true;

        }
        else
        return false;
    }

    public function dashboard(){
$from=now()->startOfMonth();
        $to=now()->endOfMonth();

        if(request()->from){
            $from=Carbon::createFromFormat('Y-m-d', request()->from);
        }
        if(request()->to){
            $to=Carbon::createFromFormat('Y-m-d', request()->to);
        }

        $articles=Article::select('title_ar','id')->popularBetween($from,$to)->take(20)->get();
        $courses=Course::select('title_ar','id')->popularBetween($from,$to)->take(20)->get();
        $lectures=Lecture::select('title_ar','id')->popularBetween($from,$to)->take(20)->get();
        $variouses=Various::select('title_ar','id')->popularBetween($from,$to)->take(20)->get();
        $teachers=Teacher::select('name_ar','id')->popularBetween($from,$to)->take(20)->get();
       $users=User::select('name','id','email','created_at')->withCount('courses as courses')->whereBetween("created_at",[$from,$to])->take(15)->get();
        $total_courses=Course::count();
        $total_users=User::count();
        $total_lectures=Lecture::count();
        $total_articles=Article::count();
        $total_variouses=Various::count();
        $total_teachers=Teacher::count();
        $total_campaigns=Campaign::count();
        $total_levels=Level::count();
        $inactive_users=User::whereDoesntHave('courses')->count();
        $active_users=User::whereHas('courses')->count();
        $user_register_campaigns=User::where('is_start_campaigns',1)->count();
        $user_unregister_campaigns=User::where('is_start_campaigns',0)->count();
        $whatsapp_records = WhatsappRecord::count();
        $subscribes_users=CashierSubscription::query()->active()->SelectRaw('count(*) as count,month(created_at) as month')->groupBy('month')->get();
        $subscribes_users = $subscribes_users->mapWithKeys(function ($item) {
            return [$item->month => $item->count];
        });
        $subscribes_users_count=array_sum($subscribes_users->values()->toArray());

        $end_subscribes_users=CashierSubscription::query()->ended()->count();
        $cancelled_subscribes_users=CashierSubscription::query()->canceled()->count();
        $total_earnings=Payment::sum('total');
        $total_wallets=Wallet::sum('total');
        $total_withdraws=WalletWithdraw::sum('total');


        return compact('articles', 'courses', 'lectures', 'variouses',
         'teachers', 'users', 'total_courses', 'total_users',
         'total_lectures', 'total_articles', 'total_variouses', 'total_teachers',
          'total_campaigns', 'total_levels', 'inactive_users', 'active_users'
          , 'user_register_campaigns','user_unregister_campaigns',
          'total_earnings','total_withdraws','total_wallets','subscribes_users'
          ,'end_subscribes_users',"cancelled_subscribes_users","subscribes_users_count" , 'whatsapp_records');

    }
    public function updatemyProfile($request){
        $user=$this->getAuthUser();
        $update=[
            'name'=>$request->name,

        ];

        if($user->can('جميع الصلاحيات super_admin')){
            $update['email']=$request->email;
            if($request->password){

                    $update["password"]=Hash::make($request->password);

            }
        }


        if($request->file("image"))
        {
            if(!$user->image)
            $update["image"]="storage\\".$this->path."\\".storeImage($this->path,$request->file("image"));
            else
            $update["image"]="storage\\".$this->path."\\".editImage($this->path,$request->file("image"),$user->image);

        }

            $user->update($update);
            return;
    }
    private function getAuthUser()
    {
        return auth()->guard('admin')->user();

    }
    public function index($relations=[],$count=[],$params=['*'],$paginate=10)
    {
       if($paginate>50)
       $paginate=50;
       $articles=Admin::with($relations)->select($params)->withCount($count)->search()->paginate($paginate);
       return $articles;

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



        return Admin::SelectRaw($search)->search()->first();
    }

    public function create($request)
    {
       $admin=Admin::create([
            'name'=>$request->name,
            'email'=>$request->email,
            'password'=>Hash::make($request->password)
       ]);
       $admin->syncRoles($request->roles);
       return $admin;

    }

    public function find($id,$relations=[],$params=['*'],$count=[])
    {
       $admin=findById(Admin::class,$id,$relations,$params,$count);
       return $admin;

    }

    public function update($id,$request)
    {
        $admin=$this->find($id,[],['*']);
        if($admin->id==$this->getAuthUser()->id || $admin->id==1)
        return false;

        $update=[
            'name'=>$request->name,
            'email'=>$request->email,

        ];
        if($request->file("image"))
        {
            if(!$admin->image)
            $update["image"]="storage\\".$this->path."\\".storeImage($this->path,$request->file("image"));
            else
            $update["image"]="storage\\".$this->path."\\".editImage($this->path,$request->file("image"),$admin->image);

        }
      if($request->password){
        $update["password"]=Hash::make($request->password);
      }
       $admin->update($update);
       $admin->syncRoles($request->roles);


       return $admin;

    }

    public function delete($id)
    {
        $admin=$this->find($id,[],['*']);
        if($admin->id==$this->getAuthUser()->id || $admin->id==1)
        return false;
        $admin->delete();
        return true;
    }

    public function createRole($request){
        $role=Role::create([
            'name'=>$request->title,
            'guard_name'=>'admin'
        ]);
        if(is_array($request->permissions))
        $role->syncPermissions($request->permissions);
        return $role;

    }
    public function updateRole($id,$request){
        $role=Role::findOrFail($id);
        $role->update([
            'name'=>$request->title,
        ]);

        $permissions=is_array($request->permissions)?$request->permissions:[];
        $role->syncPermissions($permissions);
        return $role;
    }
    public function deleteRole($id){
        $role=Role::findOrFail($id);
        $role->delete();
        return true;
    }
    public function getRoles($relations=[],$params=['*'],$count=[],$paginate=10){
         $roles=Role::with($relations)->select($params)->withCount($count)->paginate($paginate);
         return $roles;
    }
    public function getPermissions(){
        $permissions=Permission::get(['id','name']);
        return $permissions;
   }
   public function getRole($id,$relations=[],$params=['*'],$count=[],$paginate=10){
    $role=findById(Role::class,$id,$relations,$params,$count);
    return $role;
   }






}
