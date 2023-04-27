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
        $unique_purchases = [];

        $allPurchases = Purchase::orderBy('date', 'desc')->orderBy('id', 'desc')->get();

        foreach ($allPurchases as $purchase) {
            if (!in_array($purchase->purchase_no, $unique_purchases)) {
                $unique_purchases[] = $purchase->purchase_no;
            }
        }

        $purchases = [];
        foreach ($unique_purchases as $unique_purchase) {
            $latest_purchase = Purchase::where('purchase_no', $unique_purchase)
                ->orderBy('date', 'desc')
                ->first();
            // move the check for purchase status here
            if ($latest_purchase->status == '1' || $latest_purchase->status == '0') {
                array_push($purchases, $latest_purchase);
            }
        }


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
            $count_products = count($request->product_id_val);
            $last_purchase = Purchase::orderBy('id', 'desc')->first(); // Get the latest purchase
            $serial_no = $last_purchase ? intval(substr($last_purchase->purchase_no, -3)) + 1 : 1; // Generate the next serial number

            for ($i = 0; $i < $count_products; $i++) {
                $purchase = new Purchase();
                $purchase->date = $request->date[$i];
                $purchase->supplier_id = $request->supplier_id[$i];
                $purchase->product_id = $request->product_id_val[$i];
                $purchase->buying_quantity = $request->buying_quantity_val[$i];
                $purchase->unit_price = $request->unit_price_val[$i];
                $purchase->buying_price = $request->buying_price_val[$i];

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
    public function show($purchase_no)
    {
        //
        $purchases = [];
        $allPurchases = Purchase::where('purchase_no', $purchase_no)->get();
        foreach ($allPurchases as $purchase) {
            if ($purchase->status == '0') {
                array_push($purchases, $purchase);
            }
        }
        return view('pages.purchases.view', compact('purchases'));
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
        $purchase = Purchase::find($id);
        $purchase->delete();
        return redirect()->route('purchases.index')->with('success', 'Purchases Removed Successfully!');
    }
    public function pending()
    {
        // 
        $purchases = Purchase::orderBy('date', 'desc')->orderBy('id', 'desc')->where('status', '0')->get();
        return view('pages.purchases.pending', compact('purchases'));
    }
    public function approve($id)
    {
        // 
        // Getting the Purchase and we get the product and increament the proudtc quantity by buying_quantity
        $purchase = Purchase::find($id);
        $purchases = Purchase::orderBy('date', 'desc')->orderBy('id', 'desc')->get();
        // $purchases = Purchase::orderBy('date', 'desc')->orderBy('id', 'desc')->where('status', '0')->get();
        $product = Product::where('id', $purchase->product_id)->first();
        $purchase_quantity = (($purchase->buying_quantity)) + (($product->quantity));
        $product->quantity = $purchase_quantity;
        $product->save();
        // dd($product);
        Purchase::find($id)->update(['status' => '1']);
        return view('pages.purchases.index', compact('purchases'));
    }
}
