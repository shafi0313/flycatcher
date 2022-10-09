<?php

namespace App\Observers;

use App\Models\Merchant;
use App\Models\MerchantBankAccount;
use App\Models\MobileBanking;
use App\Repository\Interfaces\MerchantBankAccountInterface;
use App\Repository\Interfaces\PaymentMethodInterface;

class MerchantObserver
{
    protected $merchantBankAccountRepo;
    protected $paymentMethodRepo;
    public function __construct(MerchantBankAccountInterface $merchantBankAccount, PaymentMethodInterface $paymentMethod)
    {
        $this->merchantBankAccountRepo = $merchantBankAccount;
        $this->paymentMethodRepo = $paymentMethod;
    }

    /**
     * Handle the Merchant "created" event.
     *
     * @param Merchant $merchant
     * @return void
     */
    public function created(Merchant $merchant)
    {
        $this->merchantBankAccountRepo->createPaymentMethod([
            'merchant_id'=>$merchant->id,
        ]);
    }

    /**
     * Handle the Merchant "updated" event.
     *
     * @param Merchant $merchant
     * @return void
     */
    public function updated(Merchant $merchant)
    {
        //
    }

    /**
     * Handle the Merchant "deleted" event.
     *
     * @param Merchant $merchant
     * @return void
     */
    public function deleted(Merchant $merchant)
    {
        //
    }

    /**
     * Handle the Merchant "restored" event.
     *
     * @param Merchant $merchant
     * @return void
     */
    public function restored(Merchant $merchant)
    {
        //
    }

    /**
     * Handle the Merchant "force deleted" event.
     *
     * @param Merchant $merchant
     * @return void
     */
    public function forceDeleted(Merchant $merchant)
    {
        //
    }
}
