<?php

namespace App\Http\Controllers;

use App\Models\District;
use App\Models\Division;
use Illuminate\Http\Request;
use Brian2694\Toastr\Facades\Toastr;

class DistrictController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = [
            'districts' => District::with('division')->latest('id')->get(),
        ];
        return view('admin.district.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data = [
            'model' => new District(),
            'divisions' => Division::latest('id')->get(),
        ];
        return view('admin.district.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:districts,name',
            'division_id' => 'required',

        ]);

        $district = District::create(['name' => $request->input('name'), 'division_id' => $request->input('division_id')]);


        Toastr::success('district Information Created Successfully!.', '', ["progressBar" => true]);
        return redirect()->route('admin.district.index');
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
    public function edit(District $district)
    {
        $data = [
            'model' => $district,
            'divisions' => Division::latest('id')->get(),
        ];
        return view('admin.district.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, District $district)
    {
        $request->validate([
            'name' => 'required|unique:districts,name,' . $district->id,
        ]);

        $district->name = $request->input('name');
        $district->division_id = $request->input('division_id');
        $district->save();
        Toastr::success('District Information crated Successfully!.', '', ["progressBar" => true]);
        return redirect()->route('admin.district.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $district
     * @return \Illuminate\Http\Response
     */
    public function destroy(District $district)
    {
        $district->delete();
        Toastr::success('District Deleted Successfully!.', '', ["progressBar" => true]);
        return redirect()->back();
    }
}
