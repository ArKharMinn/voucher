@extends('layout.master');
@section('content')
    <div class="relative">
        <div class="block">
            <div class="flex justify-between p-4 items-center">
                <form action="" method="GET">
                    <div class="inline">
                        <label>From</label>
                        <input type="text" name="from" class="border formId border-gray-500 rounded-md" />
                    </div>
                    <div class="inline">
                        <label>to</label>
                        <input type="text" name="to" class="border toId border-gray-500 rounded-md" />
                    </div>
                    <button type="submit"
                        class=" bg-green-600 hover:bg-green-400 text-white rounded-md p-1">Filter</button>
                </form>
                <form action="" method="GET">
                    <div class="">
                        <label>Customer</label>
                        <input type="text" name="name" id="cus" class="border border-gray-500 rounded-md" />
                    </div>
                </form>
                <form action="" method="GET">
                    <div class="">
                        <label>Invoice</label>
                        <input type="number" name="name" id="invoiceKey" class="border border-gray-500 rounded-md" />
                        <a href="{{ route('customers#export') }}" class="mx-3 text-blue-600 underline">Excel</a>
                        <a href="{{ route('customer#pdf') }}" class=" text-blue-600 underline">PDF</a>
                    </div>
                </form>
            </div>
        </div>
        <div class="">
            <div class="">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-white border">
                        <tr>
                            <th scope="col"
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">No
                            </th>
                            <th scope="col"
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Date
                            </th>
                            <th scope="col"
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Invoice
                            </th>
                            <th scope="col"
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Customer
                            </th>
                            <th scope="col"
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Address</th>
                            <th scope="col"
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Amount</th>
                            <th scope="col"
                                class="px-6 py-3 text-left text-xs font-medium underline cursor-pointer text-blue-500 uppercase tracking-wider">
                                <a href="{{ route('item#list') }}">New Invoice</a>
                            </th>
                        </tr>
                    </thead>
                    @if (count($customer) != 0)
                        <tbody class="bg-white divide-y dataShow divide-gray-200">
                            @foreach ($customer as $c)
                                <tr id="tableData">
                                    <td class="px-6 py-4 cusId whitespace-nowrap text-sm font-medium text-gray-900">
                                        {{ $c->id }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                        {{ $c->date }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                        {{ $c->invoice }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                        {{ $c->name }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                        {{ $c->address }}</td>
                                    >
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                        {{ $c->total }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap space-x-6 text-sm underline text-blue-500">
                                        <span class="editBtn cursor-pointer">Edit</span>
                                        <a href="{{ route('customer#delete', $c->id) }}"
                                            class="deleteBtn cursor-pointer">Delete</a>
                                        <a href="{{ route('customer#detail', $c->id) }}"
                                            class="deleteBtn cursor-pointer">Detail</a>
                                    </td>
                                </tr>
                            @endforeach

                        </tbody>
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

        <div class="absolute hideEditDiv hidden w-6/12 z-50 bg-white top-6 left-4 shadow-lg p-3 px-10 rounded-md">

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

            $('.editBtn').click(function() {
                $('.hideEditDiv').removeClass('hidden')
                $parentNode = $(this).parents('tr');
                $id = $parentNode.find('.cusId').text();

                $.ajax({
                    type: 'get',
                    url: '{{ route('customer#edit') }}',
                    data: {
                        id: $id
                    },
                    dataType: 'json',
                    success: function(response) {
                        $list = '';
                        for ($i = 0; $i < response.length; $i++) {
                            $list += `
                            <form action="{{ route('customer#update') }}" method="POST">
                    <div class="">
                        @csrf
                        <div class="">
                            <label>Name</label>
                            <input name="id" value="${response[$i].id}" class="border p-1 px-2  w-full border-gray-500 rounded-md block"
                                type="hidden" />
                            <input name="name" value="${response[$i].name}" class="border p-1 px-2  w-full border-gray-500 rounded-md block"
                                type="text" />

                        </div>
                        <div class="my-3">
                            <label>Address</label>
                            <textarea name="address" class="border addressValue w-full p-1 px-2 border-gray-500 rounded-md block" cols="21"
                                rows="5">${response[$i].address}</textarea>

                        </div>
                        <button type="submit"
                            class="my-4 bg-green-600 hover:bg-green-500 text-white rounded-md px-4 p-2">Update</button>
                    </div>
                </form>
                              `
                        }
                        $('.hideEditDiv').html($list);

                    }
                })
            })
        })
    </script>
@endsection
