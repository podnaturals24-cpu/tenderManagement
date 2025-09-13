@extends('layouts.app')
@section('content')
<div class="bg-white p-4 rounded shadow">
    <h1 class="text-xl font-bold">{{ $tender->title }}</h1>
    <p>Status: {{ $tender->status }}</p>
    <p>{{ $tender->description }}</p>
</div>
@endsection
