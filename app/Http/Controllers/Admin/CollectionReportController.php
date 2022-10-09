<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Collection;
use App\Models\Parcel;
use App\Repository\Interfaces\AreaInterface;
use App\Repository\Interfaces\MerchantInterface;
use App\Repository\Interfaces\ParcelInterface;
use App\Repository\Interfaces\RiderInterface;
use App\services\ParcelReportService;
use Illuminate\Http\Request;

class CollectionReportController extends Controller
{
    protected $merchantRepo;
    protected $parcelRepo;
    protected $areaRepo;
    protected $riderRepo;

    public function __construct(MerchantInterface $merchant, ParcelInterface $parcel, AreaInterface $area, RiderInterface $rider)
    {
        $this->merchantRepo = $merchant;
        $this->parcelRepo = $parcel;
        $this->areaRepo = $area;
        $this->riderRepo = $rider;
    }
    public function collectionReport()
    {
        $data = [
            'merchants' => $this->merchantRepo->allMerchantList(),
            'riders' => $this->riderRepo->allRiderList()
        ];
        return view('admin.report.collection-report.show', $data);
    }

    public function collectionSearch(Request $request)
    {
        $request->validate([
            'merchant_id' => 'required_if:rider_id,null',
            'rider_id' => 'required_if:merchant_id,null',
        ]);

        if ($request->ajax()) {
            $query = Parcel::with(['merchant'=>function($query){
                $query->select(['id', 'name']);
            }, 'rider'=>function($query){
                $query->select(['id', 'name']);
            }, 'parcel'=>function($query){
               $query->select(['id', 'parcel_id', 'rider_collected_by', 'incharge_collected_by', 'accounts_collected_by', 'merchant_paid',  'merchant_id', 'amount', 'delivery_charge', 'cod_charge', 'net_payable', 'created_at']);
            }])->select(['id', 'tracking_id', 'invoice_id', 'collection_amount', 'payment_type', 'status']);

            $query->when(request('filter_by') == 'likes', function ($q) {
                return $q->where('likes', '>', request('likes_amount', 0));
            });

            $query = Collection::with(['merchant' => function ($query) {
                $query->select('id', 'name', 'company_name', 'mobile');
            },
                'rider' => function ($query) {
                    $query->select('id', 'name', 'mobile');
                },
                'parcel' => function ($query) {
                    $query->select('id', 'tracking_id', 'invoice_id', 'collection_amount', 'payment_type', 'status');
                }])
                ->select(['id', 'parcel_id', 'rider_collected_by', 'incharge_collected_by', 'accounts_collected_by', 'merchant_paid',  'merchant_id', 'amount', 'delivery_charge', 'cod_charge', 'net_payable', 'created_at']);
            if ($request->has('merchant_id') && $request->daterange === null && $request->rider_id === null) {
                $merchant_id = $request->merchant_id;
                $collections = $query->where(['merchant_id' => $merchant_id])->latest('id')->latest('id')->get();
                return response()->view('admin.report.collection-report.search-result', compact('collections', 'merchant_id'));
            } elseif ($request->has('rider_id') && is_null($request->merchant_id) && is_null($request->daterange)) {
                $rider_id = $request->rider_id;
                $collections = $query->where(['rider_collected_by' => $rider_id])->latest('id')->get();
                return response()->view('admin.report.collection-report.search-result', compact('collections', 'rider_id'));
            } elseif ($request->has('merchant_id') && $request->has('rider_id') && is_null($request->daterange)) {
                $merchant_id = $request->merchant_id;
                $rider_id = $request->rider_id;
                $collections = $query->where(['merchant_id' => $merchant_id, 'rider_collected_by' => $rider_id])->latest('id')->get();
                return response()->view('admin.report.collection-report.search-result', compact('collections', 'merchant_id', 'rider_id'));
            } elseif ($request->has('merchant_id') && $request->has('daterange') && is_null($request->rider_id)) {
                $dateRange = explode(' ', \request()->daterange);
                $startDate = "$dateRange[0] 00:00:00";
                $endDate = "$dateRange[2] 23:59:59";
                $merchant_id = $request->merchant_id;
                $collections = $query->where(['merchant_id' => $request->merchant_id])->whereBetween('created_at', [$startDate, $endDate])->latest('id')->get();
                return response()->view('admin.report.collection-report.search-result', compact('collections', 'merchant_id', 'startDate', 'endDate'));
            } elseif ($request->has('rider_id') && $request->has('daterange') && $request->merchant_id === null) {
                $dateRange = explode(' ', \request()->daterange);
                $startDate = "$dateRange[0] 00:00:00";
                $endDate = "$dateRange[2] 23:59:59";
                $rider_id = $request->rider_id;
                $collections = $query->where(['rider_collected_by' => $rider_id])->whereBetween('created_at', [$startDate, $endDate])->latest('id')->get();
                return response()->view('admin.report.collection-report.search-result', compact('collections', 'startDate', 'endDate', 'rider_id'));
            } elseif ($request->has('rider_id') && $request->has('daterange') && $request->has('merchant_id')) {
                $dateRange = explode(' ', \request()->daterange);
                $startDate = "$dateRange[0] 00:00:00";
                $endDate = "$dateRange[2] 23:59:59";
                $merchant_id = $request->merchant_id;
                $rider_id = $request->rider_id;
                $collections = $query->where(['merchant_id' => $merchant_id, 'rider_collected_by' => $rider_id])->whereBetween('created_at', [$startDate, $endDate])->latest('id')->get();
                return response()->view('admin.report.collection-report.search-result', compact('collections', 'startDate', 'endDate', 'rider_id', 'merchant_id'));
            };
        }
    }

    public function collectionSummeryPrint(Request $request, ParcelReportService $reportService)
    {
        $query = Collection::with(['merchant' => function ($query) {
            $query->select('id', 'name', 'company_name', 'mobile');
        },
            'rider' => function ($query) {
                $query->select('id', 'name', 'mobile');
            },
            'parcel' => function ($query) {
                $query->select('id', 'tracking_id', 'invoice_id', 'collection_amount', 'payment_type', 'status');
            }])
            ->select(['id', 'parcel_id', 'rider_collected_by', 'incharge_collected_by', 'accounts_collected_by', 'merchant_paid',  'merchant_id', 'amount', 'delivery_charge', 'cod_charge', 'net_payable', 'created_at']);
        if ($request->has('merchant_id') && $request->startDate === null && $request->endDate === null && $request->rider_id === null) {
            $merchant_id = $request->merchant_id;
            $collections = $query->where(['merchant_id' => $merchant_id])->latest('id')->latest('id')->get();
            $reportService->reportPdf('admin.report.collection-report.pdf', compact('collections'));
        } elseif ($request->has('rider_id') && is_null($request->merchant_id) && is_null($request->startDate) && is_null($request->endDate)) {
            $rider_id = $request->rider_id;
            $collections = $query->where(['rider_collected_by' => $rider_id])->latest('id')->get();
            $reportService->reportPdf('admin.report.collection-report.pdf', compact('collections'));
        } elseif ($request->has('merchant_id') && $request->has('rider_id') && is_null($request->startDate) && is_null($request->endDate)) {
            $merchant_id = $request->merchant_id;
            $rider_id = $request->rider_id;
            $collections = $query->where(['merchant_id' => $merchant_id, 'rider_collected_by' => $rider_id])->latest('id')->get();
            $reportService->reportPdf('admin.report.collection-report.pdf', compact('collections'));
        } elseif ($request->has('merchant_id') && $request->has('startDate') && $request->has('endDate') && is_null($request->rider_id)) {
            $startDate = \request()->startDate;
            $endDate = \request()->endDate;
            $merchant_id = $request->merchant_id;
            $collections = $query->where(['merchant_id' => $request->merchant_id])->whereBetween('created_at', [$startDate, $endDate])->latest('id')->get();
            $reportService->reportPdf('admin.report.collection-report.pdf', compact('collections'));
        } elseif ($request->has('rider_id') && $request->has('startDate') && $request->has('endDate') && $request->merchant_id === null) {
            $startDate = \request()->startDate;
            $endDate = \request()->endDate;
            $rider_id = $request->rider_id;
            $collections = $query->where(['rider_collected_by' => $rider_id])->whereBetween('created_at', [$startDate, $endDate])->latest('id')->get();
            $reportService->reportPdf('admin.report.collection-report.pdf', compact('collections'));
        } elseif ($request->has('rider_id') && $request->has('startDate') && $request->has('endDate') && $request->has('merchant_id')) {
            $startDate = \request()->startDate;
            $endDate = \request()->endDate;
            $merchant_id = $request->merchant_id;
            $rider_id = $request->rider_id;
            $collections = $query->where(['merchant_id' => $merchant_id, 'rider_collected_by' => $rider_id])->whereBetween('created_at', [$startDate, $endDate])->latest('id')->get();
            $reportService->reportPdf('admin.report.collection-report.pdf', compact('collections'));
        };
    }
}
