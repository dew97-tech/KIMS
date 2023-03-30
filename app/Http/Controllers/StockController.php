<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use App\Models\Stock;
use App\Models\Supplier;
use App\Models\Unit;
use Illuminate\Http\Request;

class StockController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $stocks = Stock::all();
        return view('pages.stocks.index', compact('stocks'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $products = Product::all();
        $units = Unit::all();
        $categories = Category::all();
        $suppliers = Supplier::all();
        return view('pages.stocks.create', compact('categories', 'suppliers', 'units', 'products'));
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
        Stock::create([
            'product_id' => $request['product_id'],
            'unit_id' => $request['unit_id'],
            'category_id' => $request['category_id'],
            'supplier_id' => $request['supplier_id'],
            'in_quantity' => $request['in_quantity'],
            'remaining_quantity' => $request['remaining_quantity']
        ]);

        return redirect()->route('stocks.index')->with('success', 'Stock Added Successfully!');
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
        $stock = Stock::find($id);
        $categories = Category::all();
        $products = Product::all();
        $units = Unit::all();
        $suppliers = Supplier::all();
        return view('pages.stocks.edit', compact('products', 'categories', 'stock', 'units', 'suppliers'));
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
        $stock = Stock::find($id);

        $stock->product_id = $request['product_id'];
        $stock->category_id = $request['category_id'];
        $stock->unit_id = $request['unit_id'];
        $stock->supplier_id = $request['supplier_id'];
        $stock->in_quantity = $request['in_quantity'];
        $stock->remaining_quantity = $request['remaining_quantity'];


        $stock->save();

        return redirect()->route('stocks.index')->with('success', 'Stock Updated Successfully!');
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
        $stock = stock::find($id);

        $stock->delete();

        return redirect()->route('stocks.index')->with('success', 'Stock Removed Successfully!');
    }
    public function viewPurchase($id)
    {
        //
        $stock = stock::find($id);

        $stock->delete();

        return redirect()->route('stocks.index')->with('success', 'Stock Removed Successfully!');
    }
}
