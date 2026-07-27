<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public function index()
    {
        $customers = Customer::all();
        return view('customers.index', compact('customers'));
    }
    public function create()
    {
        return view('customers.create');
    }
    public function createCustomer(Request $request)
    {
        $request->validate([
            'customer_type_kh' => 'required|string',
            'customer_type_en' => 'required|string',
        ]);

        Customer::create([
            'customer_type_kh' => $request->customer_type_kh,
            'customer_type_en' => $request->customer_type_en,
        ]);

        return redirect()
            ->route('customer.index')
            ->with('success', 'Customer type created successfully.');
    }
    // public function update(Request $request, $id) {
    //    $customer =  Customer::findOrFail($id);
    // }
}
