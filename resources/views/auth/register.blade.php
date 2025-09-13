@extends('layouts.app')

@section('content')
<div class="max-w-lg mx-auto bg-white p-6 rounded shadow">
    <h2 class="text-xl font-bold mb-4">Register</h2>
    <form method="POST" action="{{ url('register') }}">
        @csrf
        <label class="block">Name<input name="name" class="border p-2 w-full" required></label>
        <label class="block mt-2">Email<input name="email" type="email" class="border p-2 w-full" required></label>
        <label class="block mt-2">Password<input name="password" type="password" class="border p-2 w-full" required></label>
        <label class="block mt-2">Confirm Password<input name="password_confirmation" type="password" class="border p-2 w-full" required></label>
        <label class="block mt-2">Role
            <select name="role" class="border p-2 w-full" required>
                <option value="user">User</option>
                <option value="party">Party (Tender Owner)</option>
                <option value="admin">Admin</option>
            </select>
        </label>
        <label class="block mt-2">Company (if Party)<input name="company_name" class="border p-2 w-full"></label>
        <div class="mt-4">
            <button class="bg-blue-600 text-white px-4 py-2 rounded">Register</button>
        </div>
    </form>
</div>
@endsection
