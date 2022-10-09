<?php

namespace App\Http\Controllers;

use App\Models\District;
use App\Models\Upazila;
use App\Models\Division;
use Illuminate\Http\Request;
use Brian2694\Toastr\Facades\Toastr;

class UpazilaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = [
            'upazilas' => Upazila::with('district')->latest('id')->get(),
        ];
        return view('admin.upazila.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data = [
            'model' => new Upazila(),
            'districts' => District::latest('id')->get(),
            'divisions' => Division::latest('id')->get(),
        ];
        return view('admin.upazila.create', $data);
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
            'name' => 'required|unique:upazilas,name',
            'district_id' => 'required',
            'division_id' => 'required',

        ]);

        $upazila = Upazila::create(['name' => $request->input('name'), 'district_id' => $request->input('district_id')]);


        Toastr::success('Upazila Information Created Successfully!.', '', ["progressBar" => true]);
        return redirect()->route('admin.upazila.index');
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
    public function edit(Upazila $upazila)
    {
        $data = [
            'model' => $upazila,
            'divisions' => Division::latest('id')->get(),
            'districts' => District::latest('id')->get(),
        ];
        return view('admin.upazila.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Upazila $upazila)
    {
        $request->validate([
            'name' => 'required|unique:upazilas,name,' . $upazila->id,
        ]);

        $upazila->name = $request->input('name');
        $upazila->district_id = $request->input('district_id');
        $upazila->save();
        Toastr::success('Upazila Information crated Successfully!.', '', ["progressBar" => true]);
        return redirect()->route('admin.upazila.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Upazila $upazila)
    {
        $upazila->delete();
        Toastr::success('Upazila Deleted Successfully!.', '', ["progressBar" => true]);
        return redirect()->back();
    }
}
