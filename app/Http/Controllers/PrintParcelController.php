<?php

namespace App\Http\Controllers;

use App\Models\PrintParcel;
use Illuminate\Http\Request;
use App\Models\PrintParcelItem;
use App\services\ParcelService;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\services\ParcelReportService;
use niklasravnsborg\LaravelPdf\Facades\Pdf;
use App\Repository\Interfaces\RiderInterface;
use App\Http\Requests\StorePrintParcelRequest;
use App\Repository\Interfaces\ParcelInterface;
use App\Http\Requests\UpdatePrintParcelRequest;
use App\Models\Collection;

class PrintParcelController extends Controller
{

    protected $riderRepo;
    protected $parcelRepo;
    protected $parcelService;

    public function __construct(ParcelService $parcelService, ParcelInterface $parcel, RiderInterface $rider)
    {

        $this->parcelService = $parcelService;
        $this->riderRepo = $rider;
        $this->parcelRepo = $parcel;
    }
    public function index()
    {
        $data['riders'] = $this->riderRepo->allRiderList();
        $data['sheets'] = PrintParcel::whereDate('date', date('Y-m-d'))->latest()->get();
       // dd($data);
        return view('admin.print-parcel.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['riders'] = $this->riderRepo->allRiderList();
        return view('admin.print-parcel.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StorePrintParcelRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePrintParcelRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\PrintParcel  $printParcel
     * @return \Illuminate\Http\Response
     */
    public function show(PrintParcel $printParcel)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\PrintParcel  $printParcel
     * @return \Illuminate\Http\Response
     */
    public function edit(PrintParcel $printParcel)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatePrintParcelRequest  $request
     * @param  \App\Models\PrintParcel  $printParcel
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePrintParcelRequest $request, PrintParcel $printParcel)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\PrintParcel  $printParcel
     * @return \Illuminate\Http\Response
     */
    public function destroy(PrintParcel $printParcel)
    {
        //
    }
    public function printSheetSearch(Request $request)
    {
        if ($request->ajax()) {
            if (is_null($request->daterange)) {

                $sheets = PrintParcel::where('rider_id', $request->rider_id)->latest()->get();
            } elseif ($request->daterange != null) {
                $dateRange = explode('to', request()->daterange);
                $startDate = $dateRange[0];
                $endDate = $dateRange[1];
                $sheets = PrintParcel::where('rider_id', $request->rider_id)->whereBetween('date', [$startDate . " 00:00:00", $endDate . " 23:59:59"])->latest()->get();
            }
            $data = [
                'sheets' => $sheets,
                'riderInfo' => $this->riderRepo->getAnInstance($request->rider_id),
            ];


            return response()->view('admin.print-parcel.sheet-search-result', $data);
        }
    }
    public function riderWiseParcelSearch(Request $request)
    {
        if ($request->ajax()) {
            if (is_null($request->daterange) && $request->status === 'all') {

                $parcels = $this->parcelRepo->riderWiseParcelReport(['assigning_by' => $request->rider_id]);
            } elseif ($request->status !== 'all' && $request->daterange === null) {
                $parcels = $this->parcelRepo->riderWiseParcelReport(['assigning_by' => $request->rider_id, 'status' => $request->status]);
            } elseif ($request->status === 'all' && $request->daterange != null) {
                $dateRange = explode('to', request()->daterange);
                $startDate = $dateRange[0];
                $endDate = $dateRange[1];
                $parcels = $this->parcelRepo->riderWiseParcelReport(['assigning_by' => $request->rider_id], $startDate, $endDate);
            }
            $data = [
                'parcels' => $parcels,
                'riderInfo' => $this->riderRepo->getAnInstance($request->rider_id),
            ];


            return response()->view('admin.print-parcel.search-result', $data);
        }
    }
    public function sheetPrint(PrintParcel $sheet, ParcelReportService $reportService)
    {
        $parcelIds = [];
        foreach ($sheet->items as $key => $value) {
            $parcelIds[] = $value->parcel_id;
        }
        $data = [
            'parcels' =>  $this->parcelRepo->getMultipleInstanceById($parcelIds),
            'riderInfo' => $this->riderRepo->getAnInstance($sheet->rider_id),
        ];
        $reportService->reportPdf('admin.print-parcel.pdf', $data);
    }
    public function sheetHisab(PrintParcel $sheet, ParcelReportService $reportService)
    {
        $parcelIds = [];
        foreach ($sheet->items as $key => $value) {
            $parcelIds[] = $value->parcel_id;
        }
        $data = [
            'parcels' =>  $this->parcelRepo->getMultipleInstanceById($parcelIds),
            'riderInfo' => $this->riderRepo->getAnInstance($sheet->rider_id),
            'sheetInfo' => $sheet,
        ];
        return response()->view('admin.print-parcel.hisab', $data);
    }
    public function sheetAllHisabAccept(Request $request)
    {
        try {
            DB::beginTransaction();


            $pp = PrintParcel::find($request->sheet_id);
            $pp->accepted_by = auth('admin')->user()->id;
            $pp->status = 'done';
            $pp->save();

            foreach ($request->parcelIds as $parcel_id) {
                $collection = Collection::where('parcel_id', $parcel_id)->first();
                if ($collection) {
                    $collection->incharge_collected_by = auth('admin')->user()->id;
                    $collection->incharge_collected_time = now();
                    $collection->incharge_collected_status = 'collected';
                    $collection->rider_collected_status = 'transferred';
                    $collection->rider_transfer_request_time = now();
                    $collection->save();
                }
            }
            DB::commit();
            return \response()->successRedirect('You accept parcel successfully', 'admin.sheet-hisab', $request->sheet_id);
        } catch (\Exception $e) {
            DB::rollBack();
            Log::info($e->getMessage());
            return response()->errorRedirect($e->getMessage(), '');
        }
    }
    public function sheetHisabAccept($status, $parcelId, $sheet_id)
    {
        // Todo
        $parcel = $this->parcelService->parcelRepo->getAnInstance($parcelId);
        switch ($parcel->delivery_status) {
            case 'hold':
                try {
                    DB::beginTransaction();
                    $this->parcelService->parcelRepo->updateParcel(['status' => 'hold_accept_by_incharge', 'delivery_status' => 'hold_accept_by_incharge'], $parcel);
                    $this->parcelService->createTime($parcelId, 'hold_accept_by_incharge');
                    DB::commit();
                    return \response()->successRedirect('You accept parcel successfully', 'admin.sheet-hisab', $sheet_id);
                } catch (\Exception $e) {
                    DB::rollBack();
                    return response()->errorRedirect($e->getMessage(), 'rider.parcel.index');
                }
                break;
            case 'partial':
                try {
                    DB::beginTransaction();
                    $this->parcelService->parcelRepo->updateParcel(['delivery_status' => 'partial_accept_by_incharge'], $parcel);
                    $this->parcelService->createTime($parcelId, 'partial_accept_by_incharge');
                    DB::commit();
                    return \response()->successRedirect('You accept parcel successfully', 'admin.sheet-hisab', $sheet_id);
                } catch (\Exception $e) {
                    DB::rollBack();
                    return response()->errorRedirect($e->getMessage(), 'admin.parcel.index');
                }
                break;
            case 'exchange':
                try {
                    DB::beginTransaction();
                    $this->parcelService->parcelRepo->updateParcel(['delivery_status' => 'exchange_accept_by_incharge'], $parcel);
                    $this->parcelService->createTime($parcelId, 'exchange_accept_by_incharge');
                    DB::commit();
                    return \response()->successRedirect('You accept parcel successfully', 'admin.parcel.index', 'admin.sheet-hisab', $sheet_id);
                } catch (\Exception $e) {
                    DB::rollBack();
                    return response()->errorRedirect($e->getMessage(), 'admin.parcel.index');
                }
                break;
            case 'cancelled':
                try {
                    DB::beginTransaction();
                    $this->parcelService->parcelRepo->updateParcel(['delivery_status' => 'cancel_accept_by_incharge'], $parcel);
                    $this->parcelService->createTime($parcelId, 'cancel_accept_by_incharge');
                    DB::commit();
                    return \response()->successRedirect('You accept parcel successfully', 'admin.sheet-hisab', $sheet_id);
                } catch (\Exception $e) {
                    DB::rollBack();
                    return response()->errorRedirect($e->getMessage(), 'admin.parcel.index');
                }

                break;
        }
    }
    public function printParcelRiderWise(Request $request, ParcelReportService $reportService)
    {
        $data = [
            'parcels' => $this->parcelRepo->getMultipleInstanceById($request->parcelIds),
            'riderInfo' => $this->riderRepo->getAnInstance($request->rider_id),
        ];
        try {
            DB::beginTransaction();
            $printParcel = new PrintParcel();
            $printParcel->date = now("Asia/Dhaka");;
            $printParcel->rider_id = $request->rider_id;
            $printParcel->created_by = auth('admin')->user()->id;
            $printParcel->save();

            foreach ($request->parcelIds as $row) {
                $item = new PrintParcelItem();
                $item->parcel_id = $row;
                $item->print_parcel_id = $printParcel->id;
                $item->save();
            }
            DB::commit();
            $reportService->reportPdf('admin.print-parcel.pdf', $data);
        } catch (\Exception $e) {
            DB::rollBack();
            Log::info($e->getMessage());
            return response()->errorRedirect($e->getMessage(), '');
        }
    }
}
