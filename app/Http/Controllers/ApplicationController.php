<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Application;
use App\Models\Tender;
use Illuminate\Support\Facades\Auth;
use App\Notifications\ApplicationStatusChanged;

class ApplicationController extends Controller {

    public function store(Request $request, Tender $tender) {
        $request->validate(['message'=>'nullable|string']);
        if ($tender->status !== 'approved') {
            return back()->withErrors(['tender'=>'This tender is not open for applications.']);
        }

        $application = Application::create([
            'tender_id'=>$tender->id,
            'user_id'=>Auth::id(),
            'message'=>$request->message,
        ]);

        // notify party (if assigned) and admin
        if ($tender->party) {
            $tender->party->notify(new \App\Notifications\NewApplication($application));
        }

        // optionally notify admin: find all admins and notify
        $admins = \App\Models\User::where('role','admin')->get();
        \Illuminate\Support\Facades\Notification::send($admins, new \App\Notifications\NewApplication($application));

        return back()->with('success','Applied to tender.');
    }

    // party approves application
    public function approve(Application $application) {
        $this->authorizePartyForApplication($application);
        $application->status = 'approved';
        $application->save();

        // notify user & admin
        $application->user->notify(new ApplicationStatusChanged($application));
        \App\Models\User::where('role','admin')->each(fn($a)=> $a->notify(new ApplicationStatusChanged($application)));

        return back()->with('success','Application approved.');
    }

    public function reject(Application $application) {
        $this->authorizePartyForApplication($application);
        $application->status = 'rejected';
        $application->save();

        $application->user->notify(new ApplicationStatusChanged($application));
        \App\Models\User::where('role','admin')->each(fn($a)=> $a->notify(new ApplicationStatusChanged($application)));

        return back()->with('success','Application rejected.');
    }

    protected function authorizePartyForApplication(Application $app) {
        if (!auth()->user() || !auth()->user()->isParty() || $app->tender->party_id !== auth()->id()) {
            abort(403);
        }
    }
}
