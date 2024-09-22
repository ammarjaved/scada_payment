<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use App\Models\Item;
use App\Models\Scrap;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class scrapController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //

        return view("scrap.index",[
            "datas"=>Scrap::with('itemDetail')->get(),
            'items' => Item::distinct()->pluck('item')
        ]);
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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        try{

        Scrap::create([
            'item_id'=>$request->type,
            'unit'=>$request->unit
        ]);
        return Redirect::route("scrap.index")->with('success', 'Form Submitted');
    } catch (Exception $e) {
        return $e->getMessage();
        return Redirect::route('scrap.index')->with('failed', 'Request Failed');
    }
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
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        try {
            Scrap::find($id)->delete();

            return redirect()
                ->route('scrap.index')
                ->with('success', 'Record Removed');
        } catch (Exception $e) {
            return redirect()
                ->route('scrap.index')
                ->with('failed', 'Request failed');
        }
    }
}
