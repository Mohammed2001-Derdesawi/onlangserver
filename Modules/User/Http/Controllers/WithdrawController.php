<?php

namespace Modules\User\Http\Controllers;

use Stripe\SetupIntent;
use Stripe\PaymentMethod;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Contracts\Support\Renderable;
use Modules\User\Http\Requests\WithdrawRequest;
use Modules\User\Http\Requests\WithdrawalRequest;
use Modules\User\Repositories\Interfaces\WithdrawalInterface;

class WithdrawController extends Controller
{
    protected $withRepo;
    public function __construct(WithdrawalInterface $interface)
    {
        $this->withRepo=$interface;
    }
   public function withdrawPage()
   {
      $user=auth()->user()->load('wallet.withdraws');
      $wallet=$user->wallet;
      return view('user::User.Affiliate.withdraw',['wallet'=>$wallet,"user"=>$user,'intent' =>$user->createSetupIntent()]);
   }

   public function withdrawal(WithdrawalRequest $request){


    $user = auth()->user()->load('wallet');
    $amount=$request->amount-$user->wallet->total;

   if($amount>0)
    return redirect()->back()->with('warning','The amount is should be equal or lower than '.$user->wallet->total);

    if($user->campaign_type=='course')
        return redirect()->back()->with('warning','Your  account type is not allowed to withdrawal');

    if(!$user->connect_account_id || !$user->has_completed_on_boarding)
    {
        return redirect()->back()->with('error',"You need To complete your account first");

    }




      [$complete,$message]=$this->transferMoney($user,$request->amount);

      if(!$complete)   // error in transfer
      return redirect()->back()->with('error',"There's Unknown error Please Try Again!");

      return redirect()->back()->with('success',$message);

    }




    public function createExpressAccount(){
        $user=auth()->user()->load('wallet');
        [$complete,$message]=$this->withRepo->createExpressAccount($user);
        if($complete)  // retrun to onboarding dahboard url
        return redirect()->to($message);
        return redirect()->back()->with('error',"There's Unknown error Please Try Again!");


    }
    public function redirectToCompleteOnBoarding(){
        $user=auth()->user()->load('wallet');
        [$complete,$message]=$this->withRepo->redirectToCompleteOnBoarding($user);
        if($complete)  // retrun to onboarding dahboard url
        return redirect()->to($message);
        return redirect()->back()->with('error',"There's Unknown error Please Try Again!");
    }

    public function transferMoney($user,$amount){
        [$complete,$message]=$this->withRepo->makeTrasferTo($user,$amount);
        return [$complete,$message];
    }

    public function loginToExpressDashboard()
    {
        [$complete,$message]=$this->withRepo->loginToExpressDashboard();
        if(!$complete)   // error in transfer
        return redirect()->back()->with('error',"There's Unknown error Please Try Again!");

        // redirect user to express account
        return redirect()->to($message);

    }

    public function confirmCompleteBoardingAccount(Request $request){
        $this->withRepo->confirmCompleteBoarding($request);
        return redirect()->route('affiliate.wallet.withdrawpage')->with('success','You are completed Created Your Account Successfully');
    }


}
