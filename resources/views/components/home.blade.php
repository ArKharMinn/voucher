@extends('layout.master');
@section('content')
    <div class="">
        <div class="block">
            <div class="flex justify-between p-4 items-center">
                <div class="">
                    <label>From</label>
                    <input type="text" class="border border-gray-500 rounded-md" />
                </div>
                <div class="">
                    <label>to</label>
                    <input type="text" class="border border-gray-500 rounded-md" />
                </div>
                <div class="">
                    <label>Customer</label>
                    <input type="text" class="border border-gray-500 rounded-md" />
                </div>
                <div class="">
                    <label>Invoice</label>
                    <input type="text" class="border border-gray-500 rounded-md" />
                    <a href="" class="mx-3 text-blue-600 underline">Excel</a>
                    <a href="" class=" text-blue-600 underline">PDF</a>
                </div>
            </div>
        </div>
        <div class="">
            <div class="">
                <table class="table-auto">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Date</th>
                            <th>Invoice</th>
                            <th>Customer</th>
                            <th>Address</th>
                            <th>Amount</th>
                            <th class="text-blue-600 underline">
                                <div class="cursor-pointer" id="newInvoice">New Invoice</div>
                            </th>
                        </tr>
                    </thead>
                    <tbody>

                    </tbody>
                </table>
            </div>
            <div class="hidden hideDiv">
                <form action="" method="POST">
                    @csrf
                    <div class="">
                        <label>Name</label>
                        <input class="border nameValue border-gray-500 rounded-md block" type="text" />
                        <small class="text-red-600 hidden nameValidation">Name must be fill</small>
                    </div>
                    <div class="">
                        <label>Address</label>
                        <input class="border border-gray-500 rounded-md block" type="text" />
                        <small class="text-red-600 hidden">Address must be fill</small>
                    </div>
                    <div class="">
                        <label>Amount</label>
                        <input class="border border-gray-500 rounded-md block" type="text" />
                        <small class="text-red-600 hidden">Amount must be fill</small>
                    </div>
                    <button type="submit"
                        class="my-4 createBtn bg-green-600 hover:bg-green-500 text-white rounded-md p-2">Create</button>
                </form>
            </div>
        </div>
    </div>
@endsection
@section('scriptSource')
    <script>
        $(document).ready(function() {
            $('#newInvoice').click(function() {
                $('.hideDiv').removeClass('hidden');

            })
        })
    </script>
@endsection
