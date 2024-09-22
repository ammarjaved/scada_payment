<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use App\Models\Item;
use App\Models\Order;
use App\Models\Order_info;
use Exception;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class adminOrderController extends Controller
{
    //

    public function index()
    {
        if (Auth::user()->type === true) {
            return view('order.index', [
                'datas' => Order::withCount('orderInfo')
                    ->with('userData')
                    ->where('status', 'Pending')
                    ->get(),
            ]);
        } else {
            return view('order.index', [
                'datas' => Order::withCount('orderInfo')
                    ->with('userData')
                    ->where('status', 'Pending')
                    ->where('user_id', Auth::user()->id)
                    ->get(),
            ]);
        }
    }

    public function completeOrder($id, $con)
    {
        try {
            $order = Order::find($id);

            if ($order) {
                if ($con == 'Complete') {
                    $datas = Order_info::with('itemDetail')
                        ->where('order_id', $id)
                        ->get();
                    $isValid = true;
                    if ($datas) {
                        foreach ($datas as $data) {
                            if ($data->unit > $data->itemDetail->units) {
                                return Redirect::route('admin-order.index')->with('failed', 'Request failed low stock');
                            }
                        }

                        foreach ($datas as $data) {
                            $units = $data->itemDetail->units - $data->unit;
                            Item::find($data->itemDetail->id)->update(['units' => $units]);
                        }
                    }
                }
            }
            $order->update(['status' => $con]);

            return Redirect::route('admin-order.index')->with('success', "Order $con Successfully");
        } catch (Exception $e) {
            return $e->getMessage();
            return Redirect::route('admin-order.index')->with('failed', 'Request failed');
        }
    }

    public function getCOmpleteOrders()
    {
        if (Auth::user()->type === true) {
            return view('order.completeOrders', [
                'datas' => Order::withCount('orderInfo')
                    ->with('userData')
                    ->where('status', 'Complete')
                    ->get(),
            ]);
        } else {
            return view('order.completeOrders', [
                'datas' => Order::withCount('orderInfo')
                    ->with('userData')
                    ->where('status', 'Complete')
                    ->where('user_id', Auth::user()->id)
                    ->get(),
            ]);
        }
    }

    public function getCancelOrders()
    {
        if (Auth::user()->type === true) {
            return view('order.completeOrders', [
                'datas' => Order::withCount('orderInfo')
                    ->with('userData')
                    ->where('status', 'Cancel')
                    ->get(),
            ]);
        } else {
            return view('order.completeOrders', [
                'datas' => Order::withCount('orderInfo')
                    ->with('userData')
                    ->where('status', 'Cancel')
                    ->where('user_id', Auth::user()->id)
                    ->get(),
            ]);
        }
    }
}
