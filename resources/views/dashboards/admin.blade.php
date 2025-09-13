@extends('layouts.app')
@section('content')
<h1 class="text-2xl mb-4">Admin Dashboard</h1>

<section class="mb-6">
    <h2 class="font-bold">Pending Tenders</h2>
    @foreach($pendingTenders as $t)
        <div class="bg-white p-3 mt-2 rounded shadow">
            <h3 class="font-semibold">{{ $t->title }}</h3>
            <p>By: {{ $t->creator->name }} | submitted: {{ $t->created_at->toDateString() }}</p>
            <p>{{ \Illuminate\Support\Str::limit($t->description, 200) }}</p>
            <form method="POST" action="{{ route('tenders.approve', $t) }}" class="inline">@csrf <button class="px-3 py-1 bg-green-500 text-white rounded">Approve</button></form>
            <form method="POST" action="{{ route('tenders.disapprove', $t) }}" class="inline">@csrf <button class="px-3 py-1 bg-red-500 text-white rounded">Disapprove</button></form>
        </div>
    @endforeach
</section>

<section>
    <h2 class="font-bold">Approved Tenders</h2>
    @foreach($approvedTenders as $t)
        <div class="bg-white p-3 mt-2 rounded shadow">
            <h3>{{ $t->title }}</h3>
            <p>Party: {{ $t->party?->company_name ?? 'Not assigned' }}</p>
        </div>
    @endforeach
</section>
@endsection
