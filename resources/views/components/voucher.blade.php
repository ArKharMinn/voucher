@extends('layout.master');
@section('content')
    <div class="relative">
        <div class="block">
            <form action="{{ route('item#customer') }}" method="POST">
                @csrf
                <div class="flex justify-between p-4 items-center">
                    <div class="">
                        <label>Date</label>
                        <input type="text" name="date" class="border p-3 border-gray-500 rounded-md" />
                    </div>
                    <div class="">
                        <label>Invoice No</label>
                        <input type="number" name="invoice" class="border p-3 border-gray-500 rounded-md" />
                    </div>
                    <div class="">
                        <label>Customer</label>
                        <input name="name" type="text" class="border p-3 border-gray-500 rounded-md" />
                    </div>
                    <div class="">
                        <label>Address</label>
                        <input name="address" type="text" class="border p-3 border-gray-500 rounded-md" />
                    </div>
                    @if ($total)
                        <input type="hidden" name="total" value="{{ $total }}" />
                    @endif
                    <button class=" bg-green-600 hover:bg-green-400 text-white rounded-md p-4">Add</button>
                </div>
            </form>
        </div>
        <div class="">
            <div class="">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-yellow-500 border">
                        <tr>
                            <th scope="col"
                                class="px-6 py-3 border border-black text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Item
                                No
                            </th>
                            <th scope="col"
                                class="px-6 border border-black py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Item
                                Code
                            </th>
                            <th scope="col"
                                class="px-6 border border-black py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Item Name
                            </th>
                            <th scope="col"
                                class="px-6 border border-black py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Unit
                            </th>
                            <th scope="col"
                                class="px-6 border border-black py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Price</th>
                            <th scope="col"
                                class="px-6 border border-black py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Qty</th>
                            <th scope="col"
                                class="px-6 border border-black py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Amount</th>
                            <th scope="col"
                                class="px-6 border border-black py-3 text-left text-xs font-medium underline addCus cursor-pointer text-blue-500 uppercase tracking-wider">
                                Add
                            </th>
                        </tr>
                    </thead>
                    @if (count($item) != 0)
                        <tbody class="bg-white divide-y dataShow divide-gray-200">
                            @foreach ($item as $c)
                                <tr id="tableData">
                                    <td class="px-6 py-4 cusId whitespace-nowrap text-sm font-medium text-gray-900">
                                        {{ $c->id }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                        {{ $c->item_code }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                        {{ $c->item_name }}</td>
                                    @if ($c->unit)
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                            {{ $c->unit }}</td>
                                    @else
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                            No</td>
                                    @endif
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                        {{ $c->price }}</td>
                                    >
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                        {{ $c->qty }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                        {{ $c->amount }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap space-x-6 text-sm underline text-blue-500">
                                        <a href="{{ route('item#delete', $c->id) }}" class=" cursor-pointer">Delete</a>
                                    </td>
                                </tr>
                            @endforeach

                        </tbody>
                    @else
                    @endif


                </table>
                @if ($total)
                    <div class="text-end px-72 py-4 total space-x-3 ">
                        <span class="">Total</span>
                        <span class="border p-3">{{ $total }}</span>
                    </div>
                @endif
            </div>
            {{-- php artisan db:wipe --database=mysql --}}
        </div>
        <div class="absolute hidden hideDiv w-6/12 z-50 bg-white top-6 left-4 shadow-lg p-3 px-10 rounded-md">
            <div class="">
                <div class="flex justify-end closeDiv text-xl cursor-pointer">
                    <i class="fa-solid fa-square-xmark text-red-500 "></i>
                </div>
                <form action="{{ route('item#create') }}" method="POST">
                    @csrf
                    <div class="">
                        <div class="">
                            <label>Item Name</label>
                            <input name="name" class="border p-1 px-2 w-full border-gray-500 rounded-md block"
                                type="text" />
                            @error('name')
                                <small class="text-red-600">Item Name must be fill</small>
                            @enderror
                        </div>
                        <div class="my-3">
                            <label>Unit ( optional )</label>
                            <input name="unit" class="border p-1 w-full px-2 border-gray-500 rounded-md block"
                                type="number" />

                        </div>
                        <div class="my-3">
                            <label>Price</label>
                            <input name="price" class="border p-1 w-full px-2 border-gray-500 rounded-md block"
                                type="number" />
                            @error('price')
                                <small class="text-red-600">Price must be fill</small>
                            @enderror
                        </div>
                        <div class="my-3">
                            <label>Qty ( optional )</label>
                            <input name="qty" class="border  qtyValue p-1 w-full px-2 border-gray-500 rounded-md block"
                                type="number" />
                        </div>
                        <button type="submit"
                            class="my-4 bg-green-600 hover:bg-green-500 text-white rounded-md px-4 p-2">Create</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
@section('scriptSource')
    <script>
        $(document).ready(function() {
            $('.addCus').click(function() {
                $('.hideDiv').removeClass('hidden');

            })
            $('.closeDiv').click(function() {
                $('.hideDiv').addClass('hidden')
            })
        })
    </script>
@endsection
