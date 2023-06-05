<?php

namespace Modules\User\Repositories\Repositories;



use Modules\User\Entities\Payment;
use Modules\User\Repositories\Interfaces\PaymentRepositoryInterface;


class PaymentRepository implements PaymentRepositoryInterface{

    public function sum($sum){
        return Payment::sum('total');
    }


}
