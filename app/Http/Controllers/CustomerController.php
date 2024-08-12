<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Customer;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;

class CustomerController extends Controller
{
    //
    public function list()
    {
        $customer = Customer::when(request('name'), function ($query) {
            $query->orWhere('name', 'like', '%' . request('name') . '%');
            $query->orWhere('invoice', 'like', '%' . request('name') . '%');
        })->get();
        $total = Customer::sum('total');
        return view('components.customer', compact('customer', 'total'));
    }

    public function filter(Request $request)
    {

        $from = $request->from;
        $to = $request->to;

        $query = Customer::query();

        if ($from) {
            $query->where('id', '>=', $from);
        }

        if ($to) {
            $query->where('id', '<=', $to);
        }

        $customer = $query->get();

        return view('components.customer', compact('customer'));
    }
    public function exportPdf()
    {
        $customer = Customer::all();
        $total = Customer::sum('total');
        $pdf = Pdf::loadView('components.customer', compact('customer', 'total'));

        return $pdf->download('customers.pdf');
    }


    public function detail($id)
    {
        $data = Cart::select('customers.name', 'carts.*')
            ->leftJoin('customers', 'customers.id', 'carts.cus_id')
            ->where('cus_id', $id)
            ->get();
        $total = Cart::sum('amount');
        return view('components.detail', compact('data', 'total'));
    }

    public function delete($id)
    {
        Customer::where('id', $id)->delete();
        return back();
    }

    public function edit(Request $request)
    {
        $data = Customer::where('id', $request->id)->get();
        return response()->json($data);
    }

    public function update(Request $request)
    {
        $data = [
            'name' => $request->name,
            'address' => $request->address,
        ];
        Customer::where('id', $request->id)->update($data);
        return back();
    }
}
