@extends('layouts.app')
@section('content')
<h1 class="text-2xl mb-4">Party Dashboard</h1>

<section class="mb-6">
    <h2 class="font-bold">Assigned Tenders</h2>
    @foreach($assigned as $t)
        <div class="bg-white p-3 mt-2 rounded shadow">
            <h3>{{ $t->title }}</h3>
            <p>{{ $t->description }}</p>
        </div>
    @endforeach
</section>

<section>
    <h2 class="font-bold">Pending Applications</h2>
    @foreach($applications as $app)
        <div class="bg-white p-3 mt-2 rounded shadow">
            <p>Applicant: {{ $app->user->name }}</p>
            <p>Tender: {{ $app->tender->title }}</p>
            <p>Message: {{ $app->message }}</p>
            <form method="POST" action="{{ route('applications.approve', $app) }}" class="inline">@csrf <button class="px-3 py-1 bg-green-500 text-white rounded">Approve</button></form>
            <form method="POST" action="{{ route('applications.reject', $app) }}" class="inline">@csrf <button class="px-3 py-1 bg-red-500 text-white rounded">Reject</button></form>
        </div>
    @endforeach
</section>
@endsection
