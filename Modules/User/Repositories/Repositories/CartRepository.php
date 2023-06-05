<?php

namespace Modules\User\Repositories\Repositories;


use Exception;

use Darryldecode\Cart\Cart;
use Modules\User\Entities\Payment;
use Modules\Course\Entities\Course;
use Illuminate\Support\Facades\Auth;
use Modules\Course\Entities\Language;
use Illuminate\Support\Facades\Request;
use Modules\User\Repositories\Interfaces\PaymentRepositoryInterface;
use Modules\User\Repositories\Interfaces\CartInterface;
use Illuminate\Routing\Controller;

class CartRepository implements CartInterface{

    public function AddToCart($request){


        $user=Auth::user();
        if($user){
            $courses=$user->load('courses:id');
            $cart_count=\Cart::session($user->id)->getContent()->count();
        }
        else
        $cart_count=\Cart::getContent()->count();

        $courses=$user?$user->courses:collect();

        $package = Language::select('id')->with(['courses'=>function($q) use($user,$courses){
            $q->select(['id','title_ar','title_en','price','language_id']);
            if($user)
             $q->whereNotIn('id',$courses->modelKeys());

        }])->find($request->id);


         if(!$package)
        return response()->json(
            ['faild' => 'The data is invalid',
            'cart_count'=>$cart_count
        ]);



        foreach($package->courses as $course)
        {
             if($user)
             {


                    \Cart::session($user->id)->add(array(
                        'id' => $course->id, // inique row ID
                        'name' =>  $course->title_ar,
                        'price' =>$course->price,
                        'quantity' => 1,
                        'attributes' => array()

                    ));



             }
             else
             {

                \Cart::add(array(
                    'id' => $course->id, // inique row ID
                    'name' =>  $course->title_ar,
                    'price' =>$course->price,
                    'quantity' => 1,
                    'attributes' => array()

                ));

             }
        }

        if($user)
        $cart_count=\Cart::getContent()->count();
        else
        $cart_count=\Cart::getContent()->count();


        return response()->json(
            ['success' => trans('cart_trans.success'),
            'cart_count'=>$cart_count
        ]);



    }

 public function AddOneToCart($request){

        $package = Course::select('id','title_ar','title_en','price')->find($request->id);
        if (!$package)
    return response()->json(['faild' => 'The data is invalid']);


        $user=Auth::user();
        $cart_count=\Cart::getContent()->count();

    if ($user) {
        $courses=collect();
        $user->load('courses:id');
        $cart_count=\Cart::session($user->id)->getContent()->count();
        if($user->courses)
        {

           $courses=$user->courses;

        }

        if($courses->find($request->id)){
            return response()->json(
                ['error' => trans('cart_trans.already'),
                'cart_count'=>$cart_count
            ]);

        }
        \Cart::session($user->id)->add(array(
            'id' => $package->id, // inique row ID
            'name' =>  $package->title_ar,
            'price' =>$package->price,
            'quantity' => 1,
            'attributes' => array()

        ));
    } else {

        if(\Cart::get($request->id)){
            return response()->json(
                ['error' => trans('cart_trans.already'),
                'cart_count'=>$cart_count
            ]);

        }
    
        \Cart::add(array(
            'id' => $package->id, // inique row ID
            'name' =>  $package->title_ar,
            'price' =>$package->price,
            'quantity' => 1,
            'attributes' => array()

        ));
    }



        return response()->json(['success' => trans('cart_trans.onesuccess'),
        'cart_count'=>$cart_count+1
    ]);



    }
    public function removeCart($id){
        try{

        $user=Auth::user();
        if ($user) {
          \Cart::session($user->id)->remove($id);
          $cart = \Cart::session($user->id)->getContent();

        } else {
          \Cart::remove($id);
         $cart = \Cart::getContent();

        }
        return $cart ;
    }catch(Exception $e)
    {
       return redirect()->route('cart.details')->with('error' ,trans('cart_trans.carterror2')) ;   
    
    }


    }
    public function cartDetails(){
        try{

        $user=Auth::user();

        if($user){

       $cart = \Cart::session($user->id)->getContent();
        }

        else

        {
            $cart = \Cart::getContent();

        }

        $cart =$cart;

         return $cart;
        }catch(Exception $e)
        {
           return redirect()->route('cart.details')->with('error' ,trans('cart_trans.carterror1')) ;   
        
        }

    }
public function checkout_details(){
    try{


  $user=Auth::user();
        if($user){

       $total = \Cart::session($user->id)->getSubTotal();
       $cart = \Cart::session($user->id)->getContent();

        }

        else

        {
            $total = \Cart::getSubTotal();
            $cart = \Cart::getContent();

        }


              return [$total ,$cart ];
            }catch(Exception $e)
            {
               return redirect()->route('cart.details')->with('error' , trans('cart_trans.carterror')) ;   
            
            }

    }
}
