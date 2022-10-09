<?php

namespace App\Repository\Interfaces;

interface MerchantBankAccountInterface
{
    public function getBankList();
    public function createMerchantBnkAccount(array $bankAccountData);
    public function createPaymentMethod(array $paymentMethodData);
    public function getBankAccountInstanceMerchantBasis($merchantId);
    public function getPaymentMethodInstanceMerchantBasis($merchantId);
    public function updateBankAccountInfo($requestData, $bankAccountInfo);
    public function updateMerchantPaymentMethod($requestData, $paymentMethodInfo);
    public function createMobileBanking(array $mobileBankingData);
    public function getMobileBankMerchantBasis($merchantId);
    public function getMobileBankingInstance($mobileBankId);
    public function updateMobileBankingInfo(array $requestData, $mobileBankInfo);
}
