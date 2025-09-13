<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>Tender Management</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@3.4.0/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100 min-h-screen">
    <nav class="bg-white shadow p-4 flex justify-between">
        <div><a href="{{ route('dashboard') }}" class="font-bold">Tender System</a></div>
        <div class="space-x-4">
            @auth
                <span>{{ auth()->user()->name }} ({{ auth()->user()->role }})</span>
                <form method="POST" action="{{ route('logout') }}" class="inline">
                    @csrf
                    <button class="text-sm underline">Logout</button>
                </form>
            @else
                <a href="{{ route('login') }}" class="underline">Login</a>
                <a href="{{ route('register') }}" class="underline">Register</a>
            @endauth
        </div>
    </nav>

    <div class="container mx-auto p-6">
        @if(session('success'))
            <div class="bg-green-100 p-3 mb-4">{{ session('success') }}</div>
        @endif
        @if($errors->any())
            <div class="bg-red-100 p-3 mb-4">
                <ul>
                    @foreach($errors->all() as $err)<li>{{ $err }}</li>@endforeach
                </ul>
            </div>
        @endif

        @yield('content')
    </div>
</body>
</html>
