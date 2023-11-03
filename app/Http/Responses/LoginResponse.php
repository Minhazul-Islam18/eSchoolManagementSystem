<?php

namespace App\Http\Responses;

use Laravel\Fortify\Contracts\LoginResponse as ContractsLoginResponse;

class LoginResponse implements ContractsLoginResponse
{
    public function toResponse($request)
    {

        return $request->wantsJson()
            ? response()->json(['two_factor' => false])
            : redirect()->intended(config('fortify.school.home'));

        // if (auth()->user()->role->slug == 'school') {
        //     return redirect()->intended(config('fortify.school.home'));
        // }
        // return redirect()->intended(config('fortify.student.home'));
    }
}
