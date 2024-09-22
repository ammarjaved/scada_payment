<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use App\Models\Item;
use App\Models\Requisition;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

class requisitionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $distinctItems = DB::table('items')
            ->select('item')
            ->distinct()
            ->get();
        $data = [];
        foreach ($distinctItems as $item) {
            $data[$item->item] = DB::table('items')
                ->where('item', $item->item)
                ->orderBy('id', 'asc')
                ->get();
        }

        return view('requisition.index', [
            'datas' => $data,
            'items' => Item::distinct()->pluck('item'),
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

        try {
            $data = Item::where('item', $request->item)
                ->where('type', $request->type)
                ->first();
            if ($data) {
                $unit = $data->units + $request->unit;
                $data->update(['units' => $unit]);

                Requisition::create(['item_id' => $data->id, 'unit' => $request->unit, 'last_unit' => $data->units]);
            }
            return Redirect::route('requisition.index')->with('success', 'Form Submitted');
        } catch (Exception $e) {
            // return $e->getMessage();
            return Redirect::route('requisition.index')->with('failed', 'Request Failed');
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
        // return Item::with('allRecords')->find($id);
        return view('requisition.show', [
            'data' => Item::with('allRecords')->find($id),
        ]);
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
    }

    public function getType($item)
    {
        $types = Item::where('item', $item)->get();
        return response()->json($types, 200);
    }
}
