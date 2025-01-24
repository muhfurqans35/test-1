<?php

namespace App\Http\Controllers\Customer;
use App\Models\TravelSchedule;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;

class TravelScheduleController extends Controller
{
    public function index()
    {
        $schedules = TravelSchedule::where('quota', '>', 0)->get();

        return Inertia::render('Customer/Orders/Index', [
            'schedules' => $schedules,
        ]);
    }
}
