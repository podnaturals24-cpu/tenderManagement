<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tender;
use App\Models\Application;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller {
    public function index() {
        $user = Auth::user();

        if ($user->isAdmin()) {
            $pendingTenders = Tender::where('status','pending')->with('creator')->get();
            $approvedTenders = Tender::where('status','approved')->with('creator','party')->get();
            return view('dashboards.admin', compact('pendingTenders','approvedTenders'));
        }

        if ($user->isParty()) {
            // party sees tenders assigned to them and applications they need to approve
            $assigned = Tender::where('party_id', $user->id)->where('status','approved')->get();
            $applications = Application::whereHas('tender', fn($q)=> $q->where('party_id', $user->id))->where('status','pending')->with('user','tender')->get();
            return view('dashboards.party', compact('assigned','applications'));
        }

        // normal user
        $submitted = $user->tendersCreated()->get();
        $visibleTenders = Tender::where('status','approved')->get();
        $applications = $user->applications()->with('tender')->get();
        return view('dashboards.user', compact('submitted','visibleTenders','applications'));
    }
}
