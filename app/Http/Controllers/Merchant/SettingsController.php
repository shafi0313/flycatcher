<?php

namespace App\Http\Controllers\Merchant;

use App\Http\Controllers\Controller;
use App\Http\Requests\Merchant\MerchantSettingsRequest;
use App\Repository\Interfaces\AreaInterface;
use App\Repository\Interfaces\BankInterface;
use App\Repository\Interfaces\HubInterface;
use App\Repository\Interfaces\MerchantBankAccountInterface;
use App\Repository\Interfaces\MerchantInterface;
use App\Repository\Interfaces\MerchantPickupMethodInterface;
use App\Repository\Interfaces\PaymentMethodInterface;
use Illuminate\Support\Facades\Hash;

class SettingsController extends Controller
{
    protected $merchantSettingsRepo;
    protected $areaRepo;
    protected $hubRepo;
    protected $pickupMethodRepo;
    protected $paymentMethodRepo;
    protected $merchantAccountRepo;

    public function __construct(MerchantInterface $merchantInterface, AreaInterface $areaInterface, HubInterface $hubInterface, MerchantPickupMethodInterface $merchantPickupMethodInterface, PaymentMethodInterface $paymentMethodInterface, MerchantBankAccountInterface $accountInterface)
    {
        $this->merchantSettingsRepo = $merchantInterface;
        $this->areaRepo = $areaInterface;
        $this->hubRepo = $hubInterface;
        $this->pickupMethodRepo = $merchantPickupMethodInterface;
        $this->paymentMethodRepo = $paymentMethodInterface;
        $this->merchantAccountRepo = $accountInterface;
    }

    public function index()
    {
////        return $this->merchantAccountRepo->getMobileBanksMerchantBasis(auth('merchant')->user()->id);
        $data = [
            'areas'=> $this->areaRepo->allAreaList(),
//            'hubs'=>$this->hubRepo->getHubList(),
//            'pickupMethod' =>  $this->pickupMethodRepo->getInstanceMerchantBasis(auth('merchant')->user()->id),
//            'paymentMethods' =>$this->paymentMethodRepo->getAllPaymentMethod(),
            'merchant' => $this->merchantSettingsRepo->getAnInstance(auth('merchant')->user()->id),
//            'banks'=>$this->merchantAccountRepo->getBankList(),
//            'bankAccount'=>$this->merchantAccountRepo->getBankAccountInstanceMerchantBasis(auth('merchant')->user()->id),
//            'merchantPaymentMethod' => $this->merchantAccountRepo->getPaymentMethodInstanceMerchantBasis(auth('merchant')->user()->id),
//            'mobileBanking'=>$this->merchantAccountRepo->getMobileBankMerchantBasis(auth('merchant')->user()->id),
        ];
        return view('merchant.settings.index', $data);
    }

    public function personal(MerchantSettingsRequest $request){
        $this->merchantSettingsRepo->updateMerchant($request->all(), auth('merchant')->user());
        return response()->successRedirect('Personal Info Updated !','merchant.settings.index');
    }

    public function passwordReset(MerchantSettingsRequest $request){
        if (! Hash::check($request->old_password, auth('merchant')->user()->password)) {
            return response()->errorRedirect('sorry Your Old Password Does not Match Our Records', '');
        }else{
            if(Hash::check($request->password, auth('merchant')->user()->password)){
                return response()->errorRedirect('Opp! You enter your old password', '');
            }else{
                $this->merchantSettingsRepo->updateMerchant(['password'=>bcrypt($request->password)], auth('merchant')->user());
                return response()->successRedirect('Your password reset successfully', '');
            }
        }
    }

    public function company(MerchantSettingsRequest $request){
        $this->merchantSettingsRepo->updateMerchant($request->all(), auth('merchant')->user());
        return response()->successRedirect('Company Info updated !','merchant.settings.index');
    }

//    public function paymentMethod(MerchantSettingsRequest $request){
//        $paymentMethod=$this->merchantAccountRepo->getPaymentMethodInstanceMerchantBasis(auth('merchant')->user()->id);
//        $this->merchantAccountRepo->updateMerchantPaymentMethod($request->validated(), $paymentMethod);
//        return response()->successRedirect('Payment Method Info Updated !','merchant.settings.index');
//    }
//    public function pickupMethod(MerchantSettingsRequest $request){
//        $pickupMethod =  $this->pickupMethodRepo->getInstanceMerchantBasis(auth('merchant')->user()->id);
//        if(empty($pickupMethod)){
//            $data = $request->validated();
//            $data['merchant_id'] = auth('merchant')->user()->id;
//            $this->pickupMethodRepo->createMerchantPickupMethod($data);
//        }else{
//            $this->pickupMethodRepo->updatePickupMethod($request->validated(), $pickupMethod);
//        }
//        return response()->successRedirect('Pickup Info updated !','merchant.settings.index');
//    }
//
//    public function bankAccount(MerchantSettingsRequest $request){
//        $accountInfo=$this->merchantAccountRepo->getBankAccountInstanceMerchantBasis(auth('merchant')->user()->id);
//        $this->merchantAccountRepo->updateBankAccountInfo($request->validated(), $accountInfo);
//        return response()->successRedirect('Mobile banking info updated !','merchant.settings.index');
//    }
//
//    public function mobileBanking(MerchantSettingsRequest $request){
//        $mobileBanking = $this->merchantAccountRepo->getMobileBankMerchantBasis(auth('merchant')->user()->id);
//        $this->merchantAccountRepo->updateMobileBankingInfo($request->validated(), $mobileBanking);
//        return response()->successRedirect('Bank Account Info Updated !','merchant.settings.index');
//    }
}
