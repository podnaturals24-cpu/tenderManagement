@extends('layouts.app')

@section('content')
<div class="max-w-lg mx-auto bg-white p-6 rounded shadow">
    <h2 class="text-xl font-bold mb-4">Login</h2>
    <form method="POST" action="{{ url('login') }}">
        @csrf
        <label class="block">Email<input name="email" type="email" class="border p-2 w-full" required></label>
        <label class="block mt-2">Password<input name="password" type="password" class="border p-2 w-full" required></label>
        <label class="block mt-2"><input type="checkbox" name="remember"> Remember me</label>
        <div class="mt-4">
            <button class="bg-blue-600 text-white px-4 py-2 rounded">Login</button>
        </div>
    </form>
</div>
@endsection
