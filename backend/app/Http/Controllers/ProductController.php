<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    public function index()
    {
        return Product::with('category')->where('is_sales',1)->orderBy('updated_at', 'desc')->get();
    }

    public function search(Request $request)
    {
        $lstProduct = Product::with('category')->Where(function ($q) use ($request) {
            $q->when($request->filled('name'), function ($q) use ($request) {
                $q->where('name', 'LIKE', '%' . $request->name . '%');
            })->when($request->filled('category'), function ($q) use ($request) {
                $q->where('category_id', $request->category);
            })->when($request->filled('is_sales'), function ($q) use ($request) {
                    $q->where('is_sales', $request->is_sales);
            })->when($request->filled('price_min', 'price_max'), function ($q) use ($request) {
                    $q->whereBetween('price', [(int)$request->price_min, (int)$request->price_max]);
            });
        })->orderBy('updated_at', 'desc')->paginate(5);
        return response()->json([
            'lstProduct' => $lstProduct
        ], 200);
    }

    public function storeAdd(Request $request)
    {
        $messages = [
            'productName.required' => 'Product name cannot be empty',
            'productName.min' => 'Product name must not be less than 5 characters',

            'productPrice.required' => "Product price cannot be empty",
            'productPrice.numeric' => "Product price must be a number",
            'productPrice.gt' => "Product price must be a positive number",

            'productQuantity.required' => "Product quantity cannot be empty",
            'productQuantity.numeric' => "Product quantity must be a number",
            'productQuantity.gt' => "Product quantity must be a positive number",

            'productDescription.required' => 'Product description cannot be empty',

        ];
        $this->validate($request, [
            'productName' => 'required|min:5',

            'productPrice' => 'required|numeric|gt:0',

            'productQuantity' => 'required|numeric|gt:0',

            'productDescription' => 'required',

            'productImage' => 'mimes:jpeg,jpg,png|max:2048|dimensions:max_width=1024',

        ], $messages);
        $count = Product::count();
        $product = new Product();
        $product->product_id = 'SP' . substr("000000000", strlen($count + 1)) . ($count + 1);
        $product->name = $request->productName;
        $product->price = $request->productPrice;
        $product->quantity = $request->productQuantity;
        $product->description = $request->productDescription;
        $product->category_id = $request->productCategory;
        $product->discount = $request->productDiscount;
        if ($request->hasFile('productImage')) {

            $file = $request->file('productImage');
            $extension = $file->getClientOriginalExtension(); // Lấy đuôi file
            $filename = 'SP' . substr("000000000", strlen($count + 1)) . ($count + 1) . '.' . $extension; // Đặt tên file theo ID
            $path = $file->storeAs('public/products', $filename); // Lưu file
            $product->image = 'products/' . $filename;
        }

        $product->save();

        return response()->json([
            'message' => 'Add Success',
            'status' => 'success',
        ]);
    }

    public function storeEdit(Request $request)
    {


        $messages = [
            'productName.required' => 'Product name cannot be empty',
            'productName.min' => 'Product name must not be less than 5 characters',

            'productPrice.required' => "Product price cannot be empty",
            'productPrice.numeric' => "Product price must be a number",
            'productPrice.gt' => "Product price must be a positive number",

            'productQuantity.required' => "Product quantity cannot be empty",
            'productQuantity.numeric' => "Product quantity must be a number",
            'productQuantity.gt' => "Product quantity must be a positive number",

            'productDescription.required' => 'Product description cannot be empty',

        ];
        $this->validate($request, [
            'productName' => 'required|min:5',

            'productPrice' => 'required|numeric|gt:0',

            'productQuantity' => 'required|numeric|gt:0',

            'productDescription' => 'required',

            'productImage' => 'image:mimes:jpeg,jpg,png|max:2048|dimensions:max_width=1024',

        ], $messages);
        $product = Product::where('product_id', $request->productId)->first();
        if ($request->hasFile('productImage')) {
            
            if (file_exists(public_path() . '/storage/' . $product->image)) {
                @unlink(public_path() . '/storage/' . $product->image,);

                $file = $request->file('productImage');
                $extension = $file->getClientOriginalExtension(); // Lấy đuôi file
                $filename = $product->product_id . '.' . $extension; // Đặt tên file theo ID
                $path = $file->storeAs('public/products', $filename); // Lưu file
               $product_image = 'products/' . $filename;
            }
        } else {
            $product_image = $product->image;
        }

        $product = Product::where('product_id', $request->productId)->update(array(
            'name' => $request->productName,
            'price' => $request->productPrice,
            'quantity' => $request->productQuantity,
            'description' => $request->productDescription,
            'category_id' => $request->productCategory,
            'discount' => $request->productDiscount,
            'is_sales' => $request->has('productStatus')?$request->productStatus:0,
            'image' => $product_image,
        ));

        return response()->json([
            'message' => 'Update Success',
            'status' => 'success',
        ]);
    }

    public function storeDelete($id){
        $product = Product::with('category')->where('product_id', $id)->first();
        $product->is_sales=0;
        $product->save();
        return response()->json([
            'message' => 'Delete Success',
            'status' => 'success',
        ]);
    }
    public function detail($id)
    {
        $product = Product::with('category')->where('product_id', $id)->get();
        return response()->json([
            'product' => $product
        ], 200);
    }
}
