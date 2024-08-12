@extends('layout.authMaster')
@section('content')
    <div class="h-screen flex justify-center items-center">
        <div class="w-1/2 p-36">
            <form action="{{ route('login') }}" method="POST">
                @csrf
                <div class="">
                    <label class="">Email</label>
                    <input type="email" name="email"
                        class="block w-full rounded-md border-0 py-1.5 pl-7 pr-20 text-gray-900 ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                    @error('email')
                        <small class=" text-red-500">{{ $message }}</small>
                    @enderror
                </div>
                <div class="my-5">
                    <label class="">Password</label>
                    <input type="password" name="password"
                        class="block w-full rounded-md border-0 py-1.5 pl-7 pr-20 text-gray-900 ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                    @error('password')
                        <small class=" text-red-500">{{ $message }}</small>
                    @enderror
                </div>
                <div class=" text-center">
                    <button type="submit"
                        class="text-white w-full p-3 px-8 rounded-md bg-green-600 hover:bg-green-400">Login</button>
                </div>
                <div class="my-4 text-center">or</div>
                <div class=" text-center">
                    Don't have account ? <a href="/register" class=" text-red-500">Sign up</a>
                </div>
            </form>
        </div>
    </div>
@endsection
