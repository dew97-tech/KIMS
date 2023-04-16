<?php

namespace App\Http\Controllers;

use App\Models\Purchase;
use App\Models\Product;
use App\Models\Category;
use App\Models\Supplier;
use App\Models\Unit;
use PhpParser\Node\Stmt\Catch_;

use Illuminate\Http\Request;

class ExclusiveController extends Controller
{
    // public function GetCategory(Request $request)
    // {
    //     $supplier_id = $request->input('supplier_id');
    //     // $allCategory = Product::select('category_id')->where('supplier_id', $supplier_id)->groupBy('category_id')->get();
    //     // dd($categories);
    //     // Gets Category by Suppliers from Products table
    //     $categories = Category::whereIn('id', function ($query) use ($supplier_id) {
    //         $query->select('category_id')
    //             ->from('products')
    //             ->where('supplier_id', $supplier_id);
    //     })->get();

    //     return response()->json($categories);
    // }

    // public function GetCategory(Request $request)
    // {

    //     $supplier_id = $request->supplier_id;
    //     // dd($supplier_id);
    //     $allCategory = Product::with(['category'])->select('category_id')->where('supplier_id', $supplier_id)->groupBy('category_id')->get();
    //     return response()->json($allCategory);
    // } // End Mehtod 

    public function GetProduct(Request $request)
    {

        $supplier_id = $request->supplier_id;
        $allProduct = Product::where('supplier_id', $supplier_id)->get();
        return response()->json($allProduct);
    }
}
