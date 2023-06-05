<?php
namespace Modules\User\Repositories\Interfaces;

interface WithdrawalInterface{


    public function makeTrasferTo($user,$amount);
    public function createExpressAccount($user);
    public function confirmCompleteBoarding($request);
    public function redirectToCompleteOnBoarding($user);
    public function loginToExpressDashboard();




 }
