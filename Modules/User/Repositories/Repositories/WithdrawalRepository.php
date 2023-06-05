<?php

namespace Modules\User\Repositories\Repositories;

use Exception;

use Modules\User\Repositories\Interfaces\WithdrawalInterface;

class WithdrawalRepository implements WithdrawalInterface{
    public function makeTrasferTo($user,$amount){
        \Stripe\Stripe::setApiKey(config('services.stripe.secret_key'));

            try{
                $transfer = \Stripe\Transfer::create([
                    "amount" =>((int)$amount)*100, // in cent
                    "currency" => "usd",
                    "destination" =>$user->connect_account_id,
                    ]);
                $user->wallet()->update([
                    'total'=>$user->wallet->total-$amount
                ]);
                $user->wallet->withdraws()->create([
                    'total'=>$amount,
                    'withdraw_date'=>now()
                ]);
                return [true,'Successfuly Added '.$amount." To your account"];
            }catch(Exception $e){
                dd($e->getMessage());
                return [false,$e->getMessage()];
            }




    }
    public function createExpressAccount($user){
        $stripe = new \Stripe\StripeClient(config('services.stripe.secret_key'));
         try{

            $account=$stripe->accounts->create(['type' => 'express',"email"=>$user->email]);
            $accountlink=$stripe->accountLinks->create(
                [
                  'account' =>$account->id,
                  'refresh_url' =>route('affiliate.wallet.withdrawpage'),
                  'return_url' =>route('affiliate.wallet.withdrawal.confrim.onboarding'),
                  'type' => 'account_onboarding',
                ]
              );
              $user->update(['connect_account_id'=>$account->id]);
              return [true,$accountlink->url];

         }catch(Exception $e){
           
            return [false,$e->getMessage()];
         }
    }
  
  public function confirmCompleteBoarding($request){
          $user=auth()->user();
          $stripe = new \Stripe\StripeClient(config('services.stripe.secret_key'));
try {
    // Retrieve the account details
    $account = $stripe->accounts->retrieve($user->connect_account_id);

    // Check if charges and payouts are enabled
    if ($account->charges_enabled && $account->payouts_enabled) {
        $user->update(["has_completed_on_boarding"=>true]);
        return true;

    } else {

      return false ;
    }
} catch (Exception $e) {
    // Handle any exceptions
    return [false, $e->getMessage()];
}

}
  
  
    public function loginToExpressDashboard(){
        $stripe = new \Stripe\StripeClient(config('services.stripe.secret_key'));
        try
        {
            $loginlink=$stripe->accounts->createLoginLink(
                auth()->user()->connect_account_id,
                []
              );
              return [true,$loginlink->url];
        }catch(Exception $e){
            return [false,$e->getMessage()];
        }
    }
    public function redirectToCompleteOnBoarding($user){
        $stripe = new \Stripe\StripeClient(config('services.stripe.secret_key'));
        try{


           $accountlink=$stripe->accountLinks->create(
               [
                 'account' =>$user->connect_account_id,
                 'refresh_url' =>route('affiliate.wallet.withdrawpage'),
                 'return_url' =>route('affiliate.wallet.withdrawal.confrim.onboarding'),
                 'type' => 'account_onboarding',
               ]
             );
             return [true,$accountlink->url];

        }catch(Exception $e){
           return [false,$e->getMessage()];
        }
    }



}
