<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class EmailVerificationPromptController extends Controller
{
    /**
     * Display the email verification prompt.
     */
    public function __invoke(Request $request): RedirectResponse|Response
    {
        if ($request->user()->hasVerifiedEmail()) {
        
            if (Auth::user()->role === 'admin') {
                return redirect()->route('admin.schedules.index');
            }

            return redirect()->route('customer.orders.index');
        }

        return Inertia::render('Auth/VerifyEmail', ['status' => session('status')]);
    }
}
