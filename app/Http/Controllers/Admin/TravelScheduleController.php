<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\TravelSchedule;
use Inertia\Inertia;
use Illuminate\Http\Request;

class TravelScheduleController extends Controller
{
    public function index()
    {
        $schedules = TravelSchedule::all();
        return Inertia::render('Admin/Schedules/Index', ['schedules' => $schedules]);
    }

    public function create()
    {
        return Inertia::render('Admin/Schedules/Create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'destination' => 'required|string',
            'departure_date' => 'required|date',
            'departure_time' => 'required',
            'quota' => 'required|integer|min:1',
            'ticket_price' => 'required|numeric|min:0',
        ]);

        TravelSchedule::create($request->all());

        return redirect()->route('admin.schedules.index')->with('success', 'Jadwal travel berhasil ditambahkan.');
    }   

    public function update(Request $request, $id)
    {
        $request->validate([
            'destination' => 'required|string',
            'departure_date' => 'required|date',
            'departure_time' => 'required',
            'quota' => 'required|integer|min:1',
            'ticket_price' => 'required|numeric|min:0',
        ]);

        $schedule = TravelSchedule::findOrFail($id);
        $schedule->update($request->all());

        return redirect()->route('admin.schedules.index')->with('success', 'Jadwal travel berhasil diperbarui.');
    }

    public function destroy($id)
    {
        TravelSchedule::findOrFail($id)->delete();

        return redirect()->route('admin.schedules.index')->with('success', 'Jadwal travel berhasil dihapus.');
    }
}
