<?php

namespace Modules\User\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\User\Repositories\Interfaces\CampaignInterface;
use Modules\User\Repositories\Repositories\UserRepository;

class AffiliateController extends Controller
{
     protected $campaigninterface;
    public function __construct(CampaignInterface $campaigninterface)
    {
        $this->campaigninterface=$campaigninterface;
    }
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function affiliates()
    {
        $campaigns=$this->campaigninterface->getAll([],['id','slug','title_ar',"total_points",'title_en',"description_ar","description_en","feachers_en","feachers_ar"]);
        return view('user::User.Affiliate.affiliateDefination',['campaigns'=>$campaigns]);
    }



    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function compaignDetails($slug)
    {
        $campaign=$this->campaigninterface->findBySlug($slug,['levels'],["slug",'title_ar','title_en','description_ar','description_en','id','total_points']);
        return view('user::User.Affiliate.compaign',['campaign'=>$campaign]);

    }

    public function subscribes(Request $request)
    {
        $user= new UserRepository();
        $operation=$user->subscribeOnCampaigns($request);

        if($operation)
        {

            return redirect()->back()->with('success',"Congratulations, you have been subscribed to the Affiliate system");

        }

        return redirect()->back()->with('warning',"You have already started affiliate System");

    }

     /*
     use Stripe\Stripe;
use Stripe\Transfer;

// Set your API key and initialize the Stripe PHP library
Stripe::setApiKey('sk_test_your_secret_key_here');

// Create a transfer to the user's bank account
$transfer = Transfer::create([
  'amount' => 1000, // The amount to send in cents
  'currency' => 'usd',
  'destination' => [
    'type' => 'bank_account',
    'account_number' => '000123456789', // The user's bank account number
    'routing_number' => '110000000', // The user's bank routing number
    'account_holder_name' => 'John Doe', // The name on the user's bank account
    'account_holder_type' => 'individual', // The type of the user's bank account (individual or company)
  ],
]);

// Handle any errors or exceptions that may occur
if ($transfer->status == 'failed') {
  // Handle transfer failure
} else {
  // Handle successful transfer
}

use Stripe\Stripe;
use Stripe\Transfer;

// Set your API key and initialize the Stripe PHP library
Stripe::setApiKey('sk_test_your_secret_key_here');

// Create a transfer to the user's debit card
$transfer = Transfer::create([
  'amount' => 1000, // The amount to send in cents
  'currency' => 'usd',
  'destination' => [
    'type' => 'card',
    'card_number' => '4242424242424242', // The user's debit card number
    'exp_month' => 12, // The expiration month of the user's debit card
    'exp_year' => 2023, // The expiration year of the user's debit card
    'cvc' => '123', // The CVC code on the back of the user's debit card
  ],
]);

// Handle any errors or exceptions that may occur
if ($transfer->status == 'failed') {
  // Handle transfer failure
} else {
  // Handle successful transfer
}



// Create a new transfer to the user's bank account
$transfer = Transfer::create([
  'amount' => 1000, // The amount to transfer in cents (10.00 USD)
  'currency' => 'usd', // The currency to transfer (USD)
  'destination' => [
    'type' => 'iban',
    'iban' => 'FR1420041010050500013M02606', // The user's IBAN number
    'account_holder_name' => 'John Doe', // The user's name as it appears on their bank account
    'bank_name' => 'Societe Generale', // The name of the user's bank
    'bank_address' => '29 Boulevard Haussmann, 75009 Paris, France', // The address of the user's bank
  ],
]);

// Handle any errors or exceptions that may occur
if ($transfer->status == 'paid') {
  // Handle successful transfer
} else {
  // Handle transfer failure
}

     */



}
