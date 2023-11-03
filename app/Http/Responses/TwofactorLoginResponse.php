<?php

namespace App\Http\Responses;

use Laravel\Fortify\Contracts\TwofactorLoginResponse as ContractsTwofactorLoginResponse;

class TwofactorLoginResponse implements ContractsTwofactorLoginResponse
{
    public function toResponse($request)
    {
        if (auth()->user()->role->slug == 'school') {
            return redirect()->intended(config('fortify.school.home'));
        }
        return redirect()->intended(config('fortify.admin.home'));
    }
}
