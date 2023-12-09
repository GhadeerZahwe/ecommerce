<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    /**
     * Constructor method to set middleware for authentication.
     */
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    /**
     * Get all transactions related to the logged-in user.
     */
    public function get_all_transactions()
    {
        // Get the user role of the authenticated user
        $user_role = auth()->user()->user_role;

        // If the user is a seller
        if ($user_role == 1) {
            // Get the user ID of the authenticated user
            $user_id = auth()->user()->id;

            // Join the transactions and products tables and select transactions related to the user
            $transactions = Transaction::join('products', 'transactions.product_id', '=', 'products.id')
                ->where('products.user_id', $user_id)
                ->select('transactions.*')
                ->get();

            return response()->json([
                'success' => true,
                'data' => $transactions
            ], 200);
        }
    }
}
