<?php

namespace App\Http\Controllers\Merchant;

use App\Http\Controllers\Controller;
use App\Repository\Interfaces\StatusMeaningInterface;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class StatusMeaningController extends Controller
{
    protected $statusMeaning;

    public function __construct(StatusMeaningInterface $statusMeaning)
    {
        $this->statusMeaning = $statusMeaning;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (\request()->ajax()) {
            $statusMeanings = $this->statusMeaning->allStatusMeaning(['name', 'description']);
            return DataTables::of($statusMeanings)
                ->addIndexColumn()
                ->tojson();
        }
        return view('merchant.status-meaning.index');
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
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
