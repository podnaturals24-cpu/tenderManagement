@extends('layouts.app')
@section('content')
<h1 class="text-2xl mb-4">User Dashboard</h1>

<div class="mb-6">
    <a href="{{ route('tenders.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded">Submit Tender</a>
</div>

<section class="mb-6">
    <h2 class="font-bold">Your Submitted Tenders</h2>
    @foreach($submitted as $t)
        <div class="bg-white p-3 mt-2 rounded shadow">
            <h3>{{ $t->title }} <span class="text-sm">({{ $t->status }})</span></h3>
            <p>{{ $t->description }}</p>
        </div>
    @endforeach
</section>

<section class="mb-6">
    <h2 class="font-bold">Approved Tenders (Open)</h2>
    @foreach($visibleTenders as $t)
        <div class="bg-white p-3 mt-2 rounded shadow">
            <h3>{{ $t->title }}</h3>
            <p>{{ $t->description }}</p>
            <form method="POST" action="{{ route('applications.store', $t) }}">
                @csrf
                <label>Message <textarea name="message" class="border p-2 w-full"></textarea></label>
                <button class="mt-2 bg-green-600 text-white px-3 py-1 rounded">Apply</button>
            </form>
        </div>
    @endforeach
</section>

<section>
    <h2 class="font-bold">Your Applications</h2>
    @foreach($applications as $a)
        <div class="bg-white p-3 mt-2 rounded shadow">
            <p>Tender: {{ $a->tender->title }} | status: {{ $a->status }}</p>
        </div>
    @endforeach
</section>
@endsection
