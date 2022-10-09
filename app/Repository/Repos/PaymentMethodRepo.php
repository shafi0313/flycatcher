<?php

namespace App\Repository\Repos;

use App\Models\PaymentMethod;
use App\Repository\Interfaces\PaymentMethodInterface;

class PaymentMethodRepo implements  PaymentMethodInterface
{
    public function getAllPaymentMethod(){
        return PaymentMethod::where(['status'=>'active'])->get();
    }
}
