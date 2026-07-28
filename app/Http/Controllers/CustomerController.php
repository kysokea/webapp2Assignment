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
    public function update($id){
        $customer = Customer::findOrFail($id);
        return view('customers.edit',compact('customer'));
    }
    public function updateCustomer(Request $request, $id)
    {
        $request->validate([
            'customer_type_kh' => 'required|string|max:255',
            'customer_type_en' => 'required|string|max:255',
        ]);

        $customer = Customer::findOrFail($id);

        $customer->update([
            'customer_type_kh' => $request->customer_type_kh,
            'customer_type_en' => $request->customer_type_en,
        ]);

        return redirect()->route('customer.index')
            ->with('success', 'Customer type updated successfully.');
    }
    public function drop($id)
    {
        $customer = Customer::findOrFail($id);
        $customer->delete();

        return redirect()->route('customer.index')
            ->with('success', 'Customer type deleted successfully.');
    }
}
