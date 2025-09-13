<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tender;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Notifications\TenderStatusChanged;
use Illuminate\Support\Facades\Notification;

class TenderController extends Controller {

    public function create() {
        return view('tenders.create');
    }

    public function store(Request $request) {
        $request->validate([
            'title'=>'required|string|max:255',
            'description'=>'nullable|string',
            'closing_date'=>'nullable|date',
            'party_id'=>'nullable|exists:users,id'
        ]);

        $tender = Tender::create([
            'title'=>$request->title,
            'description'=>$request->description,
            'created_by'=>Auth::id(),
            'party_id'=>$request->party_id,
            'closing_date'=>$request->closing_date
        ]);

        return redirect()->route('dashboard')->with('success','Tender submitted and pending admin review.');
    }

    // admin approves
    public function approve(Tender $tender) {
        $this->authorizeAdmin();
        $tender->status = 'approved';
        $tender->save();

        // notify owner (creator)
        $tender->creator->notify(new TenderStatusChanged($tender));

        return back()->with('success','Tender approved.');
    }

    public function disapprove(Tender $tender) {
        $this->authorizeAdmin();
        $tender->status = 'disapproved';
        $tender->save();

        $tender->creator->notify(new TenderStatusChanged($tender));

        return back()->with('success','Tender disapproved.');
    }

    protected function authorizeAdmin() {
        if (!auth()->user() || !auth()->user()->isAdmin()) {
            abort(403);
        }
    }

    public function show(Tender $tender) {
        return view('tenders.show', compact('tender'));
    }
}
