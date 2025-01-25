<?php    
namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\TravelSchedule;
use Illuminate\Http\Request;
use Inertia\Inertia;


class BookingController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'travel_schedule_id' => 'required|exists:travel_schedules,id',
        ]);

        $schedule = TravelSchedule::findOrFail($request->travel_schedule_id);

        if ($schedule->quota < 1) {
            return back()->with('error', 'Kuota sudah habis.');
        }

        $schedule->decrement('quota');

        Booking::create([
            'user_id' => auth()->id(),
            'travel_schedule_id' => $request->travel_schedule_id,
            'status' => 'pending',
        ]);

        return back()->with('success', 'Pemesanan berhasil dilakukan.');
    }

    public function index()
    {
        $bookings = Booking::with(['user', 'travelSchedule', 'payment'])
            ->where('user_id', auth()->id())
            ->get();

        return Inertia::render('Customer/Bookings/Index', [
            'bookings' => $bookings,
        ]);
    }

     public function pay(Booking $booking)
    {
        if ($booking->status !== 'pending') {
            return back()->withErrors(['error' => 'Pembayaran tidak valid.']);
        }
        
        $amount = $booking->travelSchedule->ticket_price ?? 0;

        $booking->payment()->create([
            'payment_date' => now(),
            'amount' => $amount,
        ]);

        $booking->update(['status' => 'confirmed']);
        return redirect()->back()->with('success', 'Pembayaran berhasil.');
    }
}
