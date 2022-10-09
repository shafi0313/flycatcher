<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Parcel;
use App\Repository\Interfaces\AreaInterface;
use App\Repository\Interfaces\MerchantInterface;
use App\Repository\Interfaces\ParcelInterface;
use App\Repository\Interfaces\RiderInterface;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class ParcelWithCollectionRerportController extends Controller
{
    protected $merchantRepo;

    public function __construct(MerchantInterface $merchant, ParcelInterface $parcel, AreaInterface $area, RiderInterface $rider)
    {
        $this->merchantRepo = $merchant;
    }

    public function show()
    {
        $data = [
            'merchants' => $this->merchantRepo->allMerchantList(),
        ];
        return view('admin.report.parcel-collection.show', $data);
    }

    public function searchResult(Request $request)
    {
        if ($request->ajax()) {
            $data['parcels'] =  Parcel::with(['collection'])
                ->when($request->daterange !== null, function ($query) use ($request) {
                    $dateRange = explode(' ', \request()->daterange);
                    $startDate = "$dateRange[0] 00:00:00";
                    $endDate = "$dateRange[2] 23:59:59";
                    return $query->where(['merchant_id' => $request->merchant_id])->whereBetween('added_date', [$startDate, $endDate]);
                }, function ($query) use ($request) {
                    return $query->where(['merchant_id' => $request->merchant_id]);
                })->latest('id')->get();

            return response()->view('admin.report.parcel-collection.search-result', $data);
        }
    }
}
