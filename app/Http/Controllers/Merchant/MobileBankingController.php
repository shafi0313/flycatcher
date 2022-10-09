<?php

namespace App\Http\Controllers\Merchant;

use App\Http\Controllers\Controller;
use App\Http\Requests\MerchantMobileBankingRequest;
use App\Models\MerchantMobileBanking;
use App\Repository\Interfaces\MerchantMobileBankingInterface;
use Illuminate\Http\Request;

class MobileBankingController extends Controller
{
    protected $mobileBanking;
    public function __construct(MerchantMobileBankingInterface $mobileBanking)
    {
        $this->mobileBanking = $mobileBanking;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['merchantBankings'] = $this->mobileBanking->allMerchantMobileBankingWithCondition(['merchant_id'=>auth('merchant')->user()->id]);
        $data['bankings'] = $this->mobileBanking->allMobileBanking();
        return view('merchant.settings.mobile-banking.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(MerchantMobileBankingRequest $request)
    {
        $data = $request->validated();
        $data['merchant_id'] = auth('merchant')->user()->id;
        $this->mobileBanking->MerchantMobileBankingCreate($data);
        return \response()->successRedirect('Info Created Successfully', '');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
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
     * @return \Illuminate\Http\Response
     */
    public function update($id, MerchantMobileBankingRequest $request)
    {
        $data = $request->validated();
        $merchantMobileBanking = $this->mobileBanking->getAnInstance($id);
        $this->mobileBanking->updateMerchantMobileBanking($data, $merchantMobileBanking);
        return \response()->successRedirect('Info updated Successfully', '');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
