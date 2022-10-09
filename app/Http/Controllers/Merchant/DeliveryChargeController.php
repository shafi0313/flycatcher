<?php

namespace App\Http\Controllers\Merchant;

use App\Http\Controllers\Controller;
use App\Repository\Interfaces\DeliveryChargeInterface;
use Illuminate\Http\Request;

class DeliveryChargeController extends Controller
{
    protected $deliveryChargeRepo;
    public function __construct(DeliveryChargeInterface $deliveryCharge)
    {
        $this->deliveryChargeRepo = $deliveryCharge;
    }

    public function index(){
        $data['deliveryCharge'] = $this->deliveryChargeRepo;
    }
}
