<?php
namespace Modules\User\Http\Controllers;
use \Stripe\Stripe;
use Stripe\Subscription;

 use Illuminate\Support\Facades\Auth;
 use Modules\Course\Entities\Language;
use Illuminate\Http\Request;
use Laravel\Cashier\Cashier;
use Modules\User\Entities\Plan;
use App\Http\Controllers\Controller;
use Modules\User\Entities\Plan as ModelsPlan;

class SubscriptionController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }


    public function showPlanForm()
    {
        return view('stripe.plans.create');
    }
    public function savePlan(Request $request)
    {
        \Stripe\Stripe::setApiKey(config('services.stripe.secret'));

        $amount = ($request->amount * 100);

        try {
            $plan = Plan::create([
                'amount' => $amount,
                'currency' => 'usd',
                'interval' => 1,
                'interval_count' => $request->interval_count,
                'product' => [
                    'name' => $request->name
                ]
            ]);

            ModelsPlan::create([
                'plan_id' => $plan->id,
                'name' => $request->name,
                'price' => $plan->amount,
                'billing_method' => $plan->interval,
                'currency' => $plan->currency,
                'interval_count' => $plan->interval_count
            ]);

        }
        catch(Exception $ex){
            dd($ex->getMessage());
        }

        return "success";
    }
    // public function allPlans()
    // {
    //     $basic = ModelsPlan::where('name', 'basic')->first();
    //     $professional = ModelsPlan::where('name', 'professional')->first();
    //     $enterprise = ModelsPlan::where('name', 'enterprise')->first();
    //     return view('stripe.plans', compact( 'basic', 'professional', 'enterprise'));
    // }

    // public function processPlan(Request $request)
    // {

    //     $user = auth()->user();
    //     $user->createOrGetStripeCustomer();

    //     $paymentMethod = null;

    //     $paymentMethod = $request->payment_method;
    //     if($paymentMethod != null){
    //         $paymentMethod = $user->addPaymentMethod($paymentMethod);
    //     }
    //     $plan = ModelsPlan::where('plan_id', 'plan_NZy2bfGKHWpsRz')->first();

    //     try {
    //         $user->newSubscription(
    //             'default', $plan
    //         )->create( $paymentMethod != null ? $paymentMethod->id: '');
    //     }
    //     catch(Exception $ex){
    //         return back()->withErrors([
    //             'error' => 'Unable to create subscription due to this issue '. $ex->getMessage()
    //         ]);
    //     }

    //     $request->session()->flash('alert-success', 'You are subscribed to this plan');
    //     return to_route('plans.checkout', $plan);
    // }

    public function allSubscriptions()
    {
        if (auth()->user()->onTrial('default')) {
            dd('trial');
        }
        $subscriptions = Subscription::where('user_id', auth()->id())->get();
        return view('stripe.subscriptions.index', compact('subscriptions'));
    }
    // public function cancelSubscriptions(Request $request)
    // {
    //     $subscriptionName = $request->subscriptionName;
    //     if($subscriptionName){
    //         $user = auth()->user();
    //         $user->subscription($subscriptionName)->cancel();
    //         return 'subsc is canceled';
    //     }
    // }
    // public function resumeSubscriptions(Request $request)
    // {
    //     $user = auth()->user();
    //     $subscriptionName = $request->subscriptionName;
    //     if($subscriptionName){
    //         $user->subscription($subscriptionName)->resume();
    //         return 'subsc is resumed';
    //     }
    // }
  public function subscriptionInfo(){
    $plan=findById(Plan::class,1,[],['id','name']);
        return view('user::User.Profile.subscriptionInfo', [
            'plan'=>$plan,
        ]);
  }

}
