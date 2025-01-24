<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\TravelSchedule;
use Inertia\Inertia;

class ReportController extends Controller
{
    public function index()
    {
        $reports = TravelSchedule::withCount('bookings')
        ->with('bookings.user')
        ->get();

        return Inertia::render('Admin/Reports/Index', [
            'reports' => $reports,
        ]);
    }
}
