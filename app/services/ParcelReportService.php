<?php

namespace App\services;

use App\Repository\Interfaces\ParcelInterface;
use niklasravnsborg\LaravelPdf\Facades\Pdf;

class ParcelReportService
{
    protected $parcelRepo;

    public function __construct(ParcelInterface $parcel)
    {
        $this->parcelRepo = $parcel;
    }

    public function reportPdf($view, $data)
    {
        $pdf = PDF::loadView(
            $view,
            $data,
            [],
            [
                'format' => 'A4-L',
                'orientation' => 'L',
            ]
        );
        $name = 'Parcel List-' . date("Y-m-d");
        return $pdf->stream($name . '.pdf');
    }

    public function countParcel($startDate, $endDate)
    {
        $total = $this->parcelRepo->countParcelWithDateRange([], $startDate, $endDate) - $this->parcelRepo->countParcelWithDateRange(['status' => 'wait_for_pickup'], $startDate, $endDate);
        $pending = $this->parcelRepo->countParcelWithDateRange(['status' => 'pending'], $startDate, $endDate);
        $transit = $this->parcelRepo->countParcelWithDateRange(['status' => 'transit'], $startDate, $endDate);
        $delivered = $this->parcelRepo->countParcelWithDateRange(['status' => 'delivered'], $startDate, $endDate);
        $partial = $this->parcelRepo->countParcelWithDateRange(['status' => 'partial'], $startDate, $endDate);
        $hold = $this->parcelRepo->countParcelWithDateRange(['status' => 'hold'], $startDate, $endDate);
        $cancelled = $this->parcelRepo->countParcelWithDateRange(['status' => 'cancelled'], $startDate, $endDate) + $this->parcelRepo->countParcelWithDateRange(['status' => 'cancel_accept_by_incharge'], $startDate, $endDate) + $this->parcelRepo->countParcelWithDateRange(['status' => 'cancel_accept_by_merchant'], $startDate, $endDate);

        return [
            'total' => $total,
            'pending' => $pending,
            'transit' => $transit,
            'delivered' => $delivered,
            'partial' => $partial,
            'hold' => $hold,
            'cancelled' => $cancelled,

            'pendingPercent' => $total > 0 ? number_format(($pending * 100) / $total, 2) : '0',
            'transitPercent' => $total > 0 ? number_format(($transit * 100) / $total, 2) : '0',
            'deliveredPercent' => $total > 0 ? number_format(($delivered * 100) / $total, 2) : '0',
            'partialPercent' => $total > 0 ? number_format(($partial * 100) / $total, 2) : '0',
            'cancelledPercent' => $total > 0 ? number_format(($cancelled * 100) / $total, 2) : '0',
            'holdPercent' => $total > 0 ? number_format(($hold * 100) / $total, 2) : '0',
            'start_date' => $startDate,
            'end_date' => $endDate,
        ];
    }


    public function countAllStatusParcelInMerchantWise($status, $parcel, $request)
    {
        return [
            'parcels' => $parcel->get(),
            'total' => $parcel->count(),
            'pending' => $this->parcelRepo->countParcel(['merchant_id' => $request->merchant_id, 'status' => 'pending'], $request->dateRange),
            'transit' => $this->parcelRepo->countParcel(['merchant_id' => $request->merchant_id, 'status' => 'transit'], $request->dateRange),
            'delivered' => $this->parcelRepo->countParcel(['merchant_id' => $request->merchant_id, 'status' => 'delivered'], $request->dateRange),
            'hold' => $this->parcelRepo->countParcel(['merchant_id' => $request->merchant_id, 'status' => 'hold'], $request->dateRange),
            'partial' => $this->parcelRepo->countParcel(['merchant_id' => $request->merchant_id, 'status' => 'partial'], $request->dateRange),
            'cancel' => $this->parcelRepo->countParcel(['merchant_id' => $request->merchant_id, 'status' => 'cancelled'], $request->dateRange),
            'transfer' => $this->parcelRepo->countParcel(['merchant_id' => $request->merchant_id, 'status' => ''], $request->dateRange),
            'cancel_accept_by_incharge' => $this->parcelRepo->countParcel(['merchant_id' => $request->merchant_id, 'status' => 'cancel_accept_by_incharge'], $request->dateRange),
            'cancel_accept_by_merchant' => $this->parcelRepo->countParcel(['merchant_id' => $request->merchant_id, 'status' => 'cancel_accept_by_merchant'], $request->dateRange),
        ];
    }

    public function countSpecificParcelInMerchantBasis($status, $parcel, $request)
    {
        return [
            'parcels' => $parcel->get(),
            'total' => $parcel->count(),
            $status => $this->parcelRepo->countParcel(['merchant_id' => $request->merchant_id, 'status' => $status], $request->dateRange),
        ];
    }

    public function countAllStatusParcelInRiderWise($status, $parcel, $request)
    {
        return [
            'parcels' => $parcel->get(),
            'total' => $parcel->count(),
            'pending' => $this->parcelRepo->countParcel(['assigning_by' => $request->rider_id, 'status' => 'pending'], $request->dateRange),
            'transit' => $this->parcelRepo->countParcel(['assigning_by' => $request->rider_id, 'status' => 'transit'], $request->dateRange),
            'delivered' => $this->parcelRepo->countParcel(['assigning_by' => $request->rider_id, 'status' => 'delivered'], $request->dateRange),
            'hold' => $this->parcelRepo->countParcel(['assigning_by' => $request->rider_id, 'status' => 'hold'], $request->dateRange),
            'partial' => $this->parcelRepo->countParcel(['assigning_by' => $request->rider_id, 'status' => 'partial'], $request->dateRange),
            'cancel' => $this->parcelRepo->countParcel(['assigning_by' => $request->rider_id, 'status' => 'cancelled'], $request->dateRange),
            'transfer' => $this->parcelRepo->countParcel(['assigning_by' => $request->rider_id, 'status' => ''], $request->dateRange),
            'cancel_accept_by_incharge' => $this->parcelRepo->countParcel(['assigning_by' => $request->rider_id, 'status' => 'cancel_accept_by_incharge'], $request->dateRange),
            'cancel_accept_by_merchant' => $this->parcelRepo->countParcel(['assigning_by' => $request->rider_id, 'status' => 'cancel_accept_by_merchant'], $request->dateRange),
        ];
    }

    public function countSpecificParcelInRiderBasis($status, $parcel, $request)
    {
        return [
            'parcels' => $parcel->get(),
            'total' => $parcel->count(),
            $status => $this->parcelRepo->countParcel(['assigning_by' => $request->rider_id, 'status' => $status], $request->dateRange),
        ];
    }
}
