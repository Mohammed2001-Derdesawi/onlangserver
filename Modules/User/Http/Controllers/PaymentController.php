<?php

namespace Modules\User\Http\Controllers;

use Stripe;
use Stripe\Order;
use App\Mail\OPayment;
 use  Modules\User\Entities\Subscription as subModel;
use Stripe\Subscription;
use App\Mail\StripePayment;
use App\Mail\VisitorContact;
use Illuminate\Http\Request;
use Couchbase\QueryException;
use Modules\User\Entities\User;
use Psy\Command\ThrowUpCommand;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Modules\User\Entities\Payment;
use Illuminate\Support\Facades\App;
use Modules\Course\Entities\Course;
use Modules\User\Entities\Playlist;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Modules\User\Entities\OtherPayment;
use Modules\User\Entities\VariousPayment;
use Illuminate\Contracts\Support\Renderable;
use Modules\User\Entities\Plan as ModelsPlan;
use Facade\FlareClient\Http\Exceptions\NotFound;
use Modules\User\Http\Requests\otherPaymentRequest;
use Illuminate\Contracts\Filesystem\FileNotFoundException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Modules\User\Repositories\Interfaces\PaymentRepositoryInterface;
use Exception;

use Modules\User\Repositories\Repositories\UserRepository;

class PaymentController extends Controller

{

    public function payment()

    {

          try{
        $user=auth()->user()->id;

        if ($user) {
            $total = \Cart::session($user)->getTotal();
            $cart = \Cart::session($user)->getContent();
        } else {
            $total = \Cart::getTotal();
            $cart = \Cart::getContent();
        }
    


        \Stripe\Stripe::setApiKey(config('services.stripe.secret_key'));
        $items= [
            'payment_method_types' => ['card'],
            'line_items' => [

            ],
            'mode' => 'payment',
            'success_url' => 'https://onlanguagecourses.com/confirm/payment/'.auth()->user()->email."?session_id={CHECKOUT_SESSION_ID}",
            'cancel_url' => 'https://onlanguagecourses.com',
            "payment_intent_data"=>[
                "metadata"=>[]
            ]
    
        ];
        foreach($cart as $cart_item){
            $items["line_items"][]=[
                'price_data' => [
                    'currency' => 'usd',
                    'unit_amount' =>$cart_item->price*100,

                    'product_data' => [

                        'name' =>$cart_item->name,
                    ],

                ],
                'quantity' => 1,
            ];
            $items["payment_intent_data"]["metadata"]["course_id_" . $cart_item->id] = strval($cart_item->id);
        $items["payment_intent_data"]["metadata"]["price_" . $cart_item->id] = strval($cart_item->price);

        }


        $session = \Stripe\Checkout\Session::create($items);

        return redirect()->to($session->url);
    }catch(Exception $e)
    {
       return redirect()->route('cart.details')->with('error' ,  trans('cart_trans.carterror')) ;   
    
    }

    }






    public function various_payment(){

        try{

        $settings=cache()->get('settings') && isset(cache()->get('settings')['subscribes_page'])?cache()->get('settings')['subscribes_page']:config('front_settings.subscribes_page');

        \Stripe\Stripe::setApiKey(config('services.stripe.secret_key'));
        $session = \Stripe\Checkout\Session::create([
            'line_items' => [[
                'price_data' => [
                    'currency' => 'usd',
                    'product_data' => [
                        'name' =>'Paid Contant (videos . Stories )',
                    ],
                    'unit_amount' =>$settings['price']*100 ,
                ],
                'quantity' => 1,
            ]],
            'mode' => 'payment',
            'success_url' => 'https://onlanguagecourses.com/variousPayment/payment/confirm?session_id={CHECKOUT_SESSION_ID}',
            'cancel_url' => 'https://onlanguagecourses.com',
        ]);


        return redirect()->to($session->url);

    }catch(Exception $e)
    {
       return redirect()->route('home')->with('error' ,  trans('cart_trans.carterror')) ;   
    
    }
    }

    public function confirmPayment(Request $request ,$email){
        try{

        \Stripe\Stripe::setApiKey(config('services.stripe.secret_key'));

        $session = \Stripe\Checkout\Session::retrieve($request->get('session_id'));
        $paymentIntent=\Stripe\PaymentIntent::retrieve($session->payment_intent);
        $paymentMethod=\Stripe\PaymentMethod::retrieve($paymentIntent->payment_method);

        if(! $session ){
            throw new NotFoundHttpException;
        }

        $metadata=$paymentIntent->metadata->toArray();
           $paymentItems=[];
           $courses=[];

           foreach($metadata as $key=>$value){
            if (strpos($key, 'course_id_') === 0) {
                $courseId = substr($key, strlen('course_id_'));
                $price_key = 'price_' . $courseId;
                $price = $metadata[$price_key];

                $paymentItems[] = [
                    'course_id' => $courseId,
                    'price' => $price,
                ];
                $courses[$courseId] = [
                    'price' => $price,
                ];



            }
           }
            $user = User::with('loginBy.shareUser', 'courses')->where('email', $email)->firstOrFail();
            $payment = $user->payments()->create([
                'total' => $paymentIntent->amount,
                'payment_type' => 'Stripe',
                'session_id' => $session->id,
                'payment_method'=>$paymentMethod->card->brand,
            ]);

            $payment->payments_details()->createMany($paymentItems);
            $user->courses()->syncWithoutDetaching($courses);
            $cart = \Cart::session($user->id)->clear();
            if ($user->loginBy) {
                $userRepo = new UserRepository();
                $userRepo->addPointsToLoginByUser($user);
            }

         Mail::to($user->email)->send(new StripePayment($payment));


        return redirect()->route('user.myCourses')->with('success',  trans('alertMessage.buyCourse') );
    }catch(Exception $e)
    {
       return redirect()->route('cart.details')->with('error' ,  trans('cart_trans.carterror')) ;   
    
    }
}





    public function variousPaymentConfirm(Request $request)
    {
        try{

        $plan = ModelsPlan::where('plan_id', 'price_1MzkIrFaFUqOAhzblSex1o0L')->first();

        if(auth()->user()->subscribed($plan->name)){
            Session::flash('message', 'You Already subscribed');

               return redirect()->back();
        }
        \Stripe\Stripe::setApiKey(config('services.stripe.secret_key'));

        $user = auth()->user();
        $user->createOrGetStripeCustomer();
        $paymentMethod = null;

        $paymentMethod=$request->payment_method;
        if($paymentMethod != null){
            $paymentMethod = $user->addPaymentMethod($paymentMethod);
        }

        try {
            $user->newSubscription(
                $plan->name, $plan->plan_id
            )->create( $paymentMethod != null ? $paymentMethod->id: '');
        }
        catch(Exception $ex){
            return back()->withErrors([
                'error' => 'Unable to create subscription due to this issue '. $ex->getMessage()
            ]);
        }


        $various_payment = VariousPayment::create([
            'user_id'=>auth()->user()->id,
            'price'=>10,
            'plan_id'=>$plan->plan_id,
            'payment_method_id'=>$paymentMethod->id

        ]);
        // add paid videos to admin playlist that user added it
        $playlists=Playlist::with('group.variouses:id,group_id')->whereNotNull('group_id')->where('user_id',$user->id)->get();
        foreach($playlists as $playlist){
            if($playlist->group->variouses){
                $variouses=$playlist->group->variouses->map(function($video){
                  return ['video_id'=>$video->id];
                });
                $playlist->playlistVideos()->delete();

                $playlist->playlistVideos()->createMany($variouses);

            }
            $variouses=[];

        }



        return redirect()->route('user.paidPlayList')->with('success',trans('cart_trans.thx'));

    }catch(Exception $e)
    {
       return redirect()->route('user.paidPlayList')->with('error' ,  trans('cart_trans.carterror4')) ;   
    
    }


    }
    public function cancelSubscription()
    {

        try{

    $plan = ModelsPlan::where('plan_id', 'price_1MzkIrFaFUqOAhzblSex1o0L')->first();
    $user = auth()->user();
    if ($plan && $user->subscribed($plan->name)) {
        $user->subscription($plan->name)->cancel();
        toastr('تم إلغاء الإشتراك في الفيديوهات المدفوعة');
        return redirect()->back();
    }
    toastr('عذرا انت غير مشترك في خدمة الفيديوهات المدفوعة ');
    return redirect()->back();

}catch(Exception $e)
{
   return redirect()->route('subscription.Info')->with('error' , trans('cart_trans.carterror3')) ;   

}

    }
    public function unSubscribed(){

        toastr( trans('cart_trans.plz'),'warning');
        return view('course::User.Various.Paid.unsubscribed',[
            'intent' => auth()->user()->createSetupIntent(),
        ]);

        
    }




      public function otherPayment(otherPaymentRequest $request){

          try{


        \Stripe\Stripe::setApiKey(config('services.stripe.secret_key'));
        $session = \Stripe\Checkout\Session::create([
            'line_items' => [[
                'price_data' => [
                    'currency' => 'usd',
                    'product_data' => [
                        'name' =>'Money transfer from ""'.$request->name .'"" To Onlanguage Courses Company',
                    ],
                    'unit_amount' =>$request->price*100 ,
                ],
                'quantity' => 1,
            ]],
            'mode' => 'payment',
            'success_url' => 'https://onlanguagecourses.com/otherPayment/Confirm?session_id={CHECKOUT_SESSION_ID}',
            'cancel_url' => 'https://onlanguagecourses.com',
        ]);


        return redirect()->to($session->url);

    }catch(Exception $e)
    {
       return redirect()->route('other.payment')->with('error' , trans('cart_trans.send')) ;   
    
    }
      }

      public function otherPaymentConfirm(Request $request){
        try{


        \Stripe\Stripe::setApiKey(config('services.stripe.secret_key'));

        $session = \Stripe\Checkout\Session::retrieve($request->get('session_id'));
        if(! $session ){
            throw new NotFoundHttpException;

        }
        $payments =  OtherPayment::create([
            'name'=>$session->customer_details->name ,
            'email'=>$session->customer_details->email ,
            'price'=>$session->amount_total/100 ,
            'session_id'=>$session->id,

        ]);



         Mail::to($session->customer_details->email)->send (new OPayment($payments));




         return redirect()->route('home')->with('success', ' thank you for pay');;

        }catch(Exception $e)
        {
           return redirect()->route('other.payment')->with('error' , trans('cart_trans.send')) ;   
        
        }

      }
       public function privatePayment(){

            return view('user::User.Payment.otherPayment');
       }

        }
