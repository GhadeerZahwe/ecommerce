<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ShoppingCart;
use App\Models\ShoppingCartProducts;
use Illuminate\Http\Request;

class ShoppingCartController extends Controller
{
    /**
     * Constructor method to set middleware for authentication.
     */
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    /**
     * Get the shopping cart for the authenticated user.
     */
    public function get_shopping_cart()
    {
        $user_role = auth()->user()->user_role;

        // If the user is a buyer
        if ($user_role == 2) {
            $user_id = auth()->user()->id;

            // Get product ids from ShoppingCartProducts
            $shoppingcartProducts = ShoppingCartProducts::where('user_id', $user_id)->get('product_id');

            $Products = [];
            foreach ($shoppingcartProducts as $product) {
                // Get product names
                $Products[] = Product::find($product->product_id)->product_name;
            }

            return response()->json([
                "status" => "success",
                "data" => $Products
            ]);
        }
    }

    /**
     * Add products to the shopping cart.
     */
    public function add_shopping_cart(Request $request)
    {
        $user_role = auth()->user()->user_role;

        // If the user is a buyer
        if ($user_role == 2) {
            $user_id = ["user_id" => auth()->user()->id];
            $request->merge($user_id);

            $products = $request->products;

            // Create a new shopping cart
            $shopping_cart = ShoppingCart::create($request->all());

            $shopping_cart_product = [];

            // Loop through the added products and add them to ShoppingCartProducts
            foreach ($products as $product) {
                if (isset($product["product_id"]) && isset($product["quantity"])) {
                    $shopping_cart_product[] = ShoppingCartProducts::create([
                        "user_id" => $shopping_cart->user_id,
                        "shopping_cart_id" => $shopping_cart->id,
                        "product_id" => $product["product_id"],
                        "quantity" => $product["quantity"]
                    ]);
                }
            }

            return response()->json([
                "status" => "success",
                "data" => $shopping_cart_product
            ]);
        } else {
            return response()->json([
                "status" => "error",
                "message" => "You are not authorized to perform this action"
            ]);
        }
    }

    /**
     * Delete the shopping cart and its products.
     */
    public function delete_shopping_cart(Request $request)
    {
        $user_role = auth()->user()->user_role;

        // If the user is a buyer
        if ($user_role == 2) {
            $user_id = auth()->user()->id;

            // Get the user's shopping cart
            $shopping_cart = ShoppingCart::where('user_id', $user_id)->first();

            // Get products that are in this cart
            $shopping_cart_products = ShoppingCartProducts::where('shopping_cart_id', $shopping_cart->id)->get();

            foreach ($shopping_cart_products as $shopping_cart_product) {
                $shopping_cart_product->delete(); // Deleting each product
            }

            $shopping_cart->delete();

            return response()->json([
                "status" => "success",
                "message" => "Shopping cart deleted successfully"
            ]);
        } else {
            return response()->json([
                "status" => "error",
                "message" => "You are not authorized to perform this action"
            ]);
        }
    }
}
