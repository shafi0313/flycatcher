<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Area;
use App\Models\CityType;
use Illuminate\Http\Request;
use niklasravnsborg\LaravelPdf\Facades\Pdf;

class AreaReportController extends Controller
{
    public function index(){
        $data['areas'] =  Area::with('sub_areas')->get();
        return view('admin.report.area-report.index', $data);
    }

    public function print(){
        $data['areas'] =  Area::with('sub_areas')->get();
        $pdf = PDF::loadView(
            'admin.report.area-report.print',
            $data,
            [],
            [
                'format' => 'A4-L',
                'orientation' => 'L',
            ]
        );
        $name = 'Area Report -' . date("Y-m-d");
        return $pdf->stream($name . '.pdf');
        //return view('admin.report.area-report.print', $data);
    }
}
