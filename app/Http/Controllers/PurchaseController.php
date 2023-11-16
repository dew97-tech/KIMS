<?php

namespace App\Http\Controllers;

use App\Models\Purchase;
use App\Models\Product;
use App\Models\Supplier;
use App\Models\Stock;
use App\Models\Unit;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\View\View;

class PurchaseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(): View
    {

        $purchases = Purchase::orderBy('date', 'desc')->orderBy('id', 'desc')->get();


        return view('pages.purchases.index', compact('purchases'));

    }



    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(): View
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
    public function store(Request $request): RedirectResponse
    {
        // dd($request->all());

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
    public function show($purchase_no): View
    {
        //
        // $purchases = [];
        $purchases = Purchase::where('purchase_no', $purchase_no)->get();
        // foreach ($allPurchases as $purchase) {
        //     if ($purchase->status == '0') {
        //         array_push($purchases, $purchase);
        //     }
        // }
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
    public function destroy($id, Request $request): RedirectResponse
    {
        $purchase = Purchase::find($id);
        if ($purchase) {
            $totalPurchases = Purchase::count();
            if ($totalPurchases == 1) {
                $purchase->delete();
                return redirect()->route('purchases.index')->with('success', 'Purchase removed successfully!');
            } else {
                $purchase->delete();
                return redirect()->back()->with('success', 'Purchase removed successfully!')->withInput($request->all());
            }
        } else {
            return redirect()->back()->with('error', 'Purchase not found!');
        }
    }
    public function pending()
    {
        //
        $purchases = Purchase::orderBy('date', 'desc')->orderBy('id', 'desc')->where('status', '0')->get();
        return view('pages.purchases.pending', compact('purchases'));
    }
    // Approve purchase with ID
    public function approve($id): RedirectResponse
    {

        $purchase = Purchase::find($id);

        // Update purchase status
        $purchase->update(['status' => '1']);

        // Get related product and supplier
        $product = Product::where('id', $purchase->product_id)->first();
        $supplier = Supplier::where('id', $purchase->supplier_id)->first();

        // Check if stock record exists
        $stock = Stock::where('product_id', $product->id)
            ->where('supplier_id', $supplier->id)
            ->first();

        if ($stock) {
            // Update existing stock record
            $stock->in_quantity += $purchase->buying_quantity;
            $stock->remaining_quantity += $purchase->buying_quantity;
            $stock->update();

        } else {
            // Create new stock record
            $stock = new Stock;
            $stock->product_id = $product->id;
            $stock->supplier_id = $supplier->id;
            $stock->unit_id = $product->unit_id;
            $stock->category_id = $product->category_id;
            $stock->in_quantity = $purchase->buying_quantity;
            $stock->remaining_quantity = $product->quantity + $purchase->buying_quantity;
            $stock->save();
        }

        // Update product quantity
        $product_quantity = $product->quantity + $purchase->buying_quantity;
        $product->update(['quantity' => $product_quantity]);


        // Redirect back
        return redirect()->route('purchases.index');

    }
    // Approve all purchases under a specific purchase_no
    public function approveAll($purchase_no): RedirectResponse
    {
        // Update all pending purchases under the specified purchase_no to approved
        Purchase::where('purchase_no', $purchase_no)
            ->where('status', '0')
            ->update(['status' => '1']);

        // Update stock and product quantities for all approved purchases
        $purchases = Purchase::where('purchase_no', $purchase_no)
            ->where('status', '1')
            ->get();
        foreach ($purchases as $purchase) {
            $product = Product::where('id', $purchase->product_id)->first();
            $supplier = Supplier::where('id', $purchase->supplier_id)->first();

            // Check if stock record exists
            $stock = Stock::where('product_id', $product->id)
                ->where('supplier_id', $supplier->id)
                ->first();

            if ($stock) {
                // Update existing stock record
                $stock->in_quantity += $purchase->buying_quantity;
                $stock->remaining_quantity += $purchase->buying_quantity;
                $stock->update();

            } else {
                // Create new stock record
                $stock = new Stock;
                $stock->product_id = $product->id;
                $stock->supplier_id = $supplier->id;
                $stock->unit_id = $product->unit_id;
                $stock->category_id = $product->category_id;
                $stock->in_quantity = $purchase->buying_quantity;
                $stock->remaining_quantity = $product->quantity + $purchase->buying_quantity;
                $stock->save();
            }

            // Update product quantity
            $product_quantity = $product->quantity + $purchase->buying_quantity;
            $product->update(['quantity' => $product_quantity]);
        }

        // Redirect back
        return redirect()->route('purchases.index');
    }

}
