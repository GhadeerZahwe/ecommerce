<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Constructor method to set middleware for authentication.
     */
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    /**
     * Add a new product.
     */
    public function add_product(Request $request)
    {
        $user_role = auth()->user()->user_role;

        // If user is a seller
        if ($user_role == 1) {
            // Merge the user_id from the authenticated user into the request
            $user_id = ["user_id" => auth()->user()->id];
            $request->merge($user_id);

            // Create a new product
            $product = Product::create($request->all());

            return response()->json([
                "status" => "success",
                "data" => $product
            ]);
        }
    }

    /**
     * Get all products.
     */
    public function get_products()
    {
        // Get all products
        return response()->json([
            "status" => "success",
            "data" => Product::all()
        ]);
    }

    /**
     * Delete a product.
     */
    public function delete_product(Request $request, $id)
    {
        $user_role = auth()->user()->user_role;

        // If user is a seller
        if ($user_role == 1) {
            // Find the product by ID
            $product = Product::find($id);

            if (!$product) {
                return response()->json([
                    "status" => "error",
                    "message" => "Product not found"
                ]);
            }

            // Delete the product
            $product->delete();

            return response()->json([
                "status" => "success",
                "message" => "Product deleted"
            ]);
        }
    }

    /**
     * Update a product.
     */
    public function update_product(Request $request, $id)
    {
        $user_role = auth()->user()->user_role;

        // If user is a seller
        if ($user_role == 1) {
            // Find the product by ID
            $product = Product::find($id);

            if (!$product) {
                return response()->json([
                    "status" => "error",
                    "message" => "Product not found"
                ]);
            }

            // Update the product
            $product->update($request->all());

            return response()->json([
                "status" => "success",
                "data" => $product
            ]);
        }
    }
}
