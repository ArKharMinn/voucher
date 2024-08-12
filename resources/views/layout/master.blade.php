<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Shop</title>
    @vite('resources/css/app.css')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://kit.fontawesome.com/17730cb0db.js" crossorigin="anonymous"></script>
</head>

<body>
    <nav class="bg-gray-800 text-white p-3 sticky top-0 z-50">
        <div class="flex justify-between items-center px-32">
            <div class=" bg-gray-600 p-1">Dashboard</div>
            <a href="{{ route('logout') }}">
                <button class="bg-red-600 p-2 rounded-md hover:bg-red-500">Logout</button>
            </a>
        </div>
    </nav>
    <div class="flex">
        <div class="border h-screen border-l-2 w-2/12">
            <div class="border shadow-lg p-2">
                <div class="text-2xl">
                    Voucher System
                </div>
            </div>
            <ul class="p-4 list-none">
                <li class=""><a href="{{ route('home') }}">Customers</a></li>
                <li class="my-2"><a href="{{ route('item#list') }}">Voucher</a></li>
            </ul>
        </div>
        <div class=" w-10/12">
            <div class="">
                @yield('content')
            </div>
        </div>
    </div>
</body>
@yield('scriptSource')

</html>
