@extends('layouts.app')
@section('content')
<h1 class="text-2xl mb-4">Create Tender</h1>
<div class="bg-white p-4 rounded shadow max-w-2xl">
    <form method="POST" action="{{ route('tenders.store') }}">
        @csrf
        <label class="block">Title<input name="title" class="border p-2 w-full" required></label>
        <label class="block mt-2">Description<textarea name="description" class="border p-2 w-full"></textarea></label>
        <label class="block mt-2">Assign Party (optional)
            <select name="party_id" class="border p-2 w-full">
                <option value="">-- Select Party --</option>
                @foreach(\App\Models\User::where('role','party')->get() as $p)
                    <option value="{{ $p->id }}">{{ $p->company_name ?? $p->name }}</option>
                @endforeach
            </select>
        </label>
        <label class="block mt-2">Closing Date<input type="date" name="closing_date" class="border p-2 w-full"></label>
        <div class="mt-4">
            <button class="bg-blue-600 text-white px-4 py-2 rounded">Submit Tender</button>
        </div>
    </form>
</div>
@endsection
