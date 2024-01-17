<?php

namespace App\Http\Responses;

use Illuminate\Support\Facades\Auth;
use Laravel\Fortify\Contracts\LoginResponse as ContractsLoginResponse;

class LoginResponse implements ContractsLoginResponse
{
    public function toResponse($request)
    {
        $role = Auth::user()->role;
        if ($role->slug == 'admin' || $role->slug == 'super_admin') {
            return redirect()->route('app.dashboard');
        } elseif ($role->slug == 'school' || $role->slug == "demo_school") {
            return redirect()->route('school.index');
        } elseif ($role->slug == 'student') {
            return redirect()->route('student.index');
        }

        return $request->wantsJson()
            ? response()->json(['two_factor' => false])
            : redirect()->intended(config('fortify.school.home'));
    }
}
