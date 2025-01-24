<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Auth\Events\Verified;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\RedirectResponse;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class VerifyEmailController extends Controller
{
    /**
     * Mark the authenticated user's email address as verified.
     */
    public function __invoke(EmailVerificationRequest $request): RedirectResponse
    {
        if ($request->user()->hasVerifiedEmail()) {
            if (Auth::user()->role === 'admin') {
                return redirect()->intended(route('admin.schedules.index', absolute: false).'?verified=1');
            }
            
            return redirect()->intended(route('customer.orders.index', absolute: false).'?verified=1');
            
        }

        if ($request->user()->markEmailAsVerified()) {
            event(new Verified($request->user()));
        }

        if (Auth::user()->role === 'admin') {
            return redirect()->intended(route('admin.schedules.index', absolute: false).'?verified=1');
        }
        
        return redirect()->intended(route('customer.orders.index', absolute: false).'?verified=1');
    }
}
