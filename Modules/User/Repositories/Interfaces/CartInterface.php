<?php
namespace Modules\User\Repositories\Interfaces;

use Illuminate\Support\Facades\Request;

interface CartInterface{


    public function AddToCart($request);
    public function AddOneToCart($request);
    public function removeCart($id);
    public function cartDetails();
    public function checkout_details();



}
