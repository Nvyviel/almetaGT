<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class StatusMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        if ($request->routeIs('login') || $request->routeIs('register') || $request->routeIs('logout')) {
            return $next($request);
        }

        if (!Auth::check()) {
            return redirect()->route('login');
        }

        $user = Auth::user();
        $currentRoute = $request->route() ? $request->route()->getName() : 'NO_ROUTE_NAME';

        // Check for restricted statuses first, regardless of admin status
        if ($user->status === 'Under Verification' || $user->status === 'Warned') {
            $allowedRoutes = ['pending-view', 'landing-page', 'update-document'];

            if ($request->routeIs('pending-view') || $request->routeIs('landing-page') || $request->routeIs('update-document')) {
                return $next($request);
            } else {
                return redirect()->route('pending-view')->with('warning', 'Akses terbatas. Status akun Anda: ' . $user->status);
            }
        }

        // Handle approved status
        if ($user->status === 'Approved') {
            // Check if user is admin
            if ($user->is_admin) {
                // If admin is trying to access pending-view, redirect to admin dashboard
                if ($request->routeIs('pending-view')) {
                    return redirect()->route('dashboard-admin');
                }

                return $next($request);
            } else {
                // Regular user with approved status
                if ($request->routeIs('pending-view')) {
                    return redirect()->route('dashboard');
                }

                return $next($request);
            }
        }

        // If user is admin but status is not approved/restricted, allow access
        if ($user->is_admin) {
            return $next($request);
        }

        return redirect()->route('login');
    }
}
