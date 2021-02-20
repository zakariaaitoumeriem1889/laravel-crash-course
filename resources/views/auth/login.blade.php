@extends('layouts.app')

@section('content')
    <div class="flex justify-center">
        <div class="w-8/12 bg-white p-6 rounded-lg">
            @if (session('status'))
                <div class="text-red-900 p-4 border-0 rounded-lg mb-6 bg-red-100 text-center">
                    <span class="inline-block align-middle mr-8">
                        {{session('status')}}
                    </span>
                </div>
            @endif
            <form action="{{route('login')}}" method="post">
                @csrf

                <div class="mb-4">
                    <label for="email" class="sr-only">Email</label>
                    <input type="text" name="email" id="email" placeholder="Your email"
                           class="bg-gray-100 border-2 w-full p-4 rounded-lg @error('email') border-red-500 @enderror"
                           value="{{@old('email')}}"/>
                    @error('email')
                    <div class="text-red-500 mt-2 text-sm">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
                <div class="mb-4">
                    <label for="password" class="sr-only">Password</label>
                    <input type="password" name="password" id="password"
                           placeholder="Choose a password"
                           class="bg-gray-100 border-2 w-full p-4 rounded-lg @error('password') border-red-500 @enderror"
                           value="{{@old('password')}}"/>
                    @error('password')
                    <div class="text-red-500 mt-2 text-sm">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
                <div>
                    <input type="submit" value="Login"
                           class="bg-blue-500 text-white px-4 py-3 rounded font-medium w-full"/>
                </div>
            </form>
        </div>
    </div>
@endsection
