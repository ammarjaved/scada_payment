<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use App\Models\Item;
use App\Models\Order;
use App\Models\Order_info;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('user-orders.create', [
            'items' => Item::distinct()->pluck('item'),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // return $request;
        try {
            $order = Order::create([
                'user_id' => Auth::user()->id,
                'status' => 'Pending',
            ]);

            for ($i = 0; $i < sizeof($request->item); $i++) {
                Order_info::create([
                    'order_id' => $order->id,
                    'item' => $request->item[$i],
                    'type' => $request->type[$i],
                    'unit' => $request->unit[$i],
                    'item_id' => $request->type[$i],
                ]);
            }
            return redirect()
                ->route('admin-order.index')
                ->with('success', 'Orders Placed');
        } catch (Exception $e) {
            return $e->getMessage();
            return redirect()
                ->route('admin-order.index')
                ->with('failed', 'Request failed');
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
        $order = Order::with('userData')->find($id);
        $datas = Order_info::with('itemDetail')
            ->where('order_id', $id)
            ->get();

        return view('user-orders.show', [
            'order' => $order,
            'datas' => $datas,
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
        $order = Order::with('userData')->find($id);
        $datas = Order_info::with('itemDetail')
            ->where('order_id', $id)
            ->get();
        $isValid = true;
        if ($datas) {
            foreach ($datas as $data) {
                if ($data->unit > $data->itemDetail->units) {
                    $isValid = false;
                }
            }
        }

        return view('user-orders.edit', [
            'order' => $order,
            'datas' => $datas,
            'isValid' => $isValid,
        ]);
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
}
