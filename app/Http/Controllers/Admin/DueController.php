<?php

namespace App\Http\Controllers\Admin;

use App\Models\Collection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use PDF;
use Yajra\DataTables\Facades\DataTables;
use App\Repository\Interfaces\MerchantInterface;
use App\Repository\Interfaces\CollectionInterface;

class DueController extends Controller
{
    protected $collectionRepo;
    protected $merchantRepo;

    public function __construct(CollectionInterface $collection, MerchantInterface $merchant)
    {
        $this->collectionRepo = $collection;
        $this->merchantRepo = $merchant;
    }

    public function list()
    {
        if (\request()->ajax()) {
            $dueList = Collection::with('merchant')->select('*', DB::raw('SUM(net_payable) as total_due'))
                ->where(['accounts_collected_status' => 'collected', 'merchant_paid' => 'unpaid'])
                ->groupBy('merchant_id')
                ->havingRaw('SUM(net_payable) <> 0')
                ->latest('total_due');
            return DataTables::of($dueList)
                ->addIndexColumn()
                ->addIndexColumn()
                ->addColumn('merchant_info', function ($dueList) {
                    return '<b>Name:</b>' . $dueList->merchant->name .
                        '<br><b>Mobile:</b>' . $dueList->merchant->mobile;
                })
                ->addColumn('due', function ($dueList) {
                    return number_format($dueList->total_due);
                })
                ->rawColumns(['merchant_info'])
                ->tojson();
        }
        return view('admin.due.list');
    }

    public function print(){
        $dueList = Collection::with('merchant')->select('*', DB::raw('SUM(net_payable) as total_due'), DB::raw('SUM(delivery_charge) as total_delivery_charge'), DB::raw('SUM(amount) as total_collection'))
            ->where(['accounts_collected_status' => 'collected', 'merchant_paid' => 'unpaid'])
            ->groupBy('merchant_id')
            ->havingRaw('SUM(net_payable) <> 0')
            ->latest('total_due')->get();
        $data = ['dueList' => $dueList];
        $pdf = PDF::loadView(
            'admin.due.pdf',
            $data,
            [],
            [
                'format' => 'A4-P',
                'orientation' => 'P',
            ]
        );
        $name = 'PS Due List';
        return $pdf->stream($name . '.pdf');
    }
}
