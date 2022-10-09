<?php

namespace App\Http\Controllers\Merchant;

use App\Http\Controllers\Controller;
use App\Http\Requests\MerchantBankAccountRequest;
use App\Models\MerchantBankAccount;
use App\Repository\Interfaces\MerchantBankAccountInterface;
use App\Repository\Interfaces\MerchantBankInterface;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class BankAccountController extends Controller
{
    protected $bankAccountRepo;
    public function __construct(MerchantBankInterface $merchantBankAccount)
    {
        $this->bankAccountRepo = $merchantBankAccount;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $data['banks'] = $this->bankAccountRepo->allBankList();
        $data['merchantBankAccounts'] = $this->bankAccountRepo->merchantBankInfoWithCondition(['merchant_id'=>auth('merchant')->user()->id]);
        return view('merchant.settings.bank-info.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return Response
     */
    public function store(MerchantBankAccountRequest $request)
    {
        $data = $request->validated();
        $data['merchant_id'] = auth('merchant')->user()->id;
        $this->bankAccountRepo->createBankAccount($data);
        return \response()->successRedirect('Your Bank Account Created Successfully', '');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return Response
     */
    public function update(MerchantBankAccountRequest $request, $id)
    {
        $requestData = $request->validated();
        $accountInfo = $this->bankAccountRepo->getAnInstance($id);
        $this->bankAccountRepo->updateBankAccount($requestData, $accountInfo);
        return \response()->successRedirect('Your Bank Account Info Updated Successfully', '');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        //
    }
}
