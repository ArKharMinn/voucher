@extends('layout.master');
@section('content')
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
                    </tr>
                </thead>

                <tbody class="bg-white divide-y dataShow divide-gray-200">
                    @foreach ($data as $data)
                        <tr id="tableData">
                            <td class="px-6 py-4 cusId whitespace-nowrap text-sm font-medium text-gray-900">
                                {{ $data->id }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                {{ $data->item_code }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                {{ $data->item_name }}</td>
                            @if ($data->unit)
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    {{ $data->unit }}</td>
                            @else
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    No</td>
                            @endif
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                {{ $data->price }}</td>
                            >
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                {{ $data->qty }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                {{ $data->amount }}</td>
                        </tr>
                    @endforeach
                </tbody>


            </table>
            @if ($total)
                <div class="text-end px-72 py-4 total space-x-3 ">
                    <span class="">Total</span>
                    <span class="border p-3">{{ $total }}</span>
                </div>
            @endif
        </div>
    </div>
@endsection
