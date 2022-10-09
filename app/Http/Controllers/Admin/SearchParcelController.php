<?php

namespace App\Http\Controllers\Admin;

use App\Models\Admin\Rider;
use App\Models\PrintParcel;
use Illuminate\Http\Request;
use App\Models\PrintParcelItem;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use App\services\ParcelReportService;
use App\Repository\Interfaces\AreaInterface;
use App\Repository\Interfaces\RiderInterface;
use App\Repository\Interfaces\ParcelInterface;
use App\Repository\Interfaces\SubAreaInterface;
use App\Repository\Interfaces\MerchantInterface;

class SearchParcelController extends Controller
{

    protected $merchantRepo;
    protected $parcelRepo;
    protected $areaRepo;
    protected $riderRepo;
    protected $subArea;

    public function __construct(MerchantInterface $merchant, ParcelInterface $parcel, AreaInterface $area, RiderInterface $rider, SubAreaInterface $subArea)
    {
        $this->merchantRepo = $merchant;
        $this->parcelRepo = $parcel;
        $this->areaRepo = $area;
        $this->riderRepo = $rider;
        $this->subArea = $subArea;
    }
    public function index()
    {
        $data = [
            'riders' => Rider::all(),
            // 'parcels' => Parcel::where('status', 'cancelled')->get(),
        ];
        return view('admin.search-parcel.create', $data);
    }
    public function pdf1(Request $request)
    {
       
        return $request->all();
    }
    public function pdf(Request $request, ParcelReportService $reportService)
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
            $reportService->reportPdf('admin.report.rider-wise.pdf', $data);
        } catch (\Exception $e) {
            DB::rollBack();
            Log::info($e->getMessage());
            return response()->errorRedirect($e->getMessage(), '');
        }
      
    }
}
