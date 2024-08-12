<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Customer;
use App\Models\Item;
use Dotenv\Validator;
use Illuminate\Http\Request;

class ItemController extends Controller
{
    //
    public function list()
    {
        $item = Item::get();
        $total = Item::sum('amount');
        return view('components.voucher', compact('item', 'total'));
    }
    public function getItem()
    {
        $item = Item::get();
        return response()->json($item);
    }
    public function create(Request $request)
    {
        $data = [
            'item_name' => $request->name,
            'unit' => $request->unit,
            'price' => $request->price,
            'qty' => $request->qty,
            'item_code' => rand(1000, 9999),
        ];
        if ($request->unit || $request->qty) {

            $data['amount'] = $request->price * $request->qty;
        } else {
            $data['amount'] = $request->price;
        }
        if ($request->name && $request->price) {
            Item::create($data);
            return back();
        }
        return back();
    }

    public function customer(Request $request)
    {
        $data = [
            'date' => $request->date,
            'total' => $request->total,
            'invoice' => $request->invoice,
            'name' => $request->name,
            'address' => $request->address,
        ];

        if ($request->name && $request->date && $request->invoice && $request->address) {
            $cus = Customer::get();
            $cusInvoice = $cus->invoice;
            if ($cusInvoice != $request->invoice) {
                Customer::create($data);
                $id = Customer::select('id')->first();
                $cus_id = $id->id;
                $item = Item::get();
                foreach ($item as $item) {
                    Cart::create([
                        'item_name' => $item->item_name,
                        'unit' => $item->unit,
                        'price' => $item->price,
                        'qty' => $item->qty,
                        'item_code' => $item->item_code,
                        'amount' => $item->amount,
                        'cus_id' => $cus_id
                    ]);
                };
                Item::truncate();
                return redirect()->route('customer#list');
            } else {
                return back();
            }
        }
        return back();
    }

    public function delete(Request $request)
    {
        Item::where('id', $request->id)->delete();
        return back();
    }
}
