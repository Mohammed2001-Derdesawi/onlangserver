<?php

namespace Modules\User\Http\Controllers;

use Darryldecode\Cart\Cart;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Course\Entities\Course;
use Illuminate\Support\Facades\Auth;
use Modules\Course\Entities\Language;
use Modules\User\Repositories\Interfaces\CartInterface;


class CartController extends Controller
{
    protected $cartRepo;
     public function __construct(CartInterface $cartRepo){
        $this->cartRepo=$cartRepo;

     }


    public function AddToCart(Request $request)
    {

        return $this->cartRepo->AddToCart($request);

    }



    public function AddOneToCart(Request $request)
    {

       return $this->cartRepo->AddOneToCart($request);

    }
 // end mehtod

 public function removeCart($id){


    $cart =  $this->cartRepo->removeCart($id);

        return view('user::User.Cart.cart',[
            'cart'=>$cart,


        ]);

    }



 public function cartDetails()
 {
    $cart =  $this->cartRepo->cartDetails();


    return view('user::User.Cart.cart',[
        'cart'=>$cart,


    ]); }


    public function checkout_details(){
        list($total , $cart) =  $this->cartRepo->checkout_details();

        if($cart->count()==0)
        return redirect()->route('checkout.details')->with('error','حدث خطأ ما ');
               return view('user::User.Cart.checkout',[

             'total'=>$total,
             'cart'=>$cart,
 ]);


    }




}
