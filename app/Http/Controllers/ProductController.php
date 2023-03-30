<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use App\Models\Supplier;
use App\Models\Unit;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::all();
        return view('pages.products.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        $brands = Brand::all();
        $units = Unit::all();
        $suppliers = Supplier::all();
        return view('pages.products.create', compact('categories', 'brands', 'units', 'suppliers'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request->all());
        Product::create([
            'product_name' => $request['product_name'],
            'product_description' => $request['product_description'],
            'product_price' => $request['product_price'],
            'unit_id' => $request['product_unit'],
            'category_id' => $request['product_category'],
            'brand_id' => $request['product_brand'],
            'supplier_id' => $request['product_supplier']
        ]);

        return redirect()->route('products.index')->with('success', 'Product Added Successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $product = Product::find($id);
        $categories = Category::all();
        $brands = Brand::all();
        $units = Unit::all();
        $suppliers = Supplier::all();
        return view('pages.products.edit', compact('product', 'categories', 'brands', 'units', 'suppliers'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $product = Product::find($id);

        $product->product_name = $request['product_name'];
        $product->product_description = $request['product_description'];
        $product->product_price = $request['product_price'];
        $product->unit_id = $request['product_unit'];
        $product->category_id = $request['product_category'];
        $product->brand_id = $request['product_brand'];
        $product->supplier_id = $request['product_supplier'];

        $product->save();

        return redirect()->route('products.index')->with('success', 'Product Updated Successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = Product::find($id);

        $product->delete();

        return redirect()->route('products.index')->with('success', 'Product Removed Successfully!');
    }

    // public function opa($search=null)
    // {
    //     $products = '';
    //     if ($search) {
    //         $products = Product::where('type', 1)->where('name', 'like', $search.'%')->orderBy('name')->get();
    //     } else {
    //         $products = Product::where('type', 1)->orderBy('name')->get();
    //     }
    //     return $products;
    // }

    // public function opb($search=null)
    // {
    //     $products = '';
    //     if ($search) {
    //         $products = Product::where('type', 2)->where('name', 'like', $search.'%')->orderBy('name')->get();
    //     } else {
    //         $products = Product::where('type', 2)->orderBy('name')->get();
    //     }
    //     return $products;
    // }

}
