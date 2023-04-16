<?php

namespace App\Http\Controllers;

use App\Models\Purchase;
use App\Models\Product;
use App\Models\Supplier;
use App\Models\Unit;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class PurchaseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $purchases = Purchase::orderBy('date', 'desc')->orderBy('id', 'desc')->get();
        return view('pages.purchases.index', compact('purchases'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $suppliers = Supplier::all();
        $units = Unit::all();
        $products = Product::all();

        // get the latest purchase number
        $last_purchase = Purchase::orderBy('created_at', 'desc')->first();
        $purchase_no = 'PO-' . date('Ymd') . '-' . sprintf('%03d', $last_purchase ? substr($last_purchase->purchase_no, -3) + 1 : 1);

        return view('pages.purchases.create', compact('suppliers', 'units', 'products', 'purchase_no'));
    }



    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request);

        if ($request->supplier_id == null) {
            $notification = array(
                'message' => 'Please select at least one item',
                'alert-type' => 'error'
            );
            return redirect()->back()->with($notification);
        } else {
            $count_products = count($request->product_id);
            $last_purchase = Purchase::orderBy('id', 'desc')->first(); // Get the latest purchase
            $serial_no = $last_purchase ? intval(substr($last_purchase->purchase_no, -3)) + 1 : 1; // Generate the next serial number

            for ($i = 0; $i < $count_products; $i++) {
                $purchase = new Purchase();
                $purchase->date = $request->date[$i];
                $purchase->supplier_id = $request->supplier_id[$i];
                $purchase->product_id = $request->product_id[$i];
                $purchase->buying_quantity = $request->buying_quantity[$i];
                $purchase->unit_price = $request->unit_price[$i];
                $purchase->buying_price = $request->buying_price[$i];

                $purchase_no = 'PO-' . date('Ymd') . '-' . str_pad($serial_no, 3, '0', STR_PAD_LEFT); // Generate the Purchase No
                $purchase->purchase_no = $purchase_no;

                $purchase->created_by = Auth::user()->id;
                $purchase->updated_by = Auth::user()->id;
                $purchase->status = '0';
                $purchase->save();
            }
        }

        $notification = array(
            'message' => 'Purchase Order Placed Successfully',
            'alert-type' => 'success'
        );
        return redirect()->route('purchases.index')->with($notification);
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
    }
}
