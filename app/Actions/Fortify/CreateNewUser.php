<?php

namespace App\Actions\Fortify;

use App\Models\BkashTransection;
use App\Models\Role;
use App\Models\User;
use App\Models\School;
use App\Models\Student;
use Illuminate\Http\Request;
use Laravel\Jetstream\Jetstream;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Laravel\Fortify\Contracts\CreatesNewUsers;

class CreateNewUser implements CreatesNewUsers
{
    use PasswordValidationRules;

    /**
     * Validate and create a newly registered user.
     *
     * @param  array<string, string>  $input
     */
    public function create(array $input): User
    {
        Validator::make($input, [
            'role' => ['required', 'string', 'max:255'],
            'name' => ['required', 'string', 'max:255'],
            'trx_id' => ['required', 'max:255'],
            'msisdn' => ['required', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => $this->passwordRules(),
            'terms' => Jetstream::hasTermsAndPrivacyPolicyFeature() ? ['accepted', 'required'] : '',
        ])->validate();
        $userRole = Role::where('slug', $input['role'])->first();
        $user = User::create([
            'role_id' => $userRole->id,
            'name' => $input['name'],
            'email' => $input['email'],
            'password' => Hash::make($input['password']),
        ]);
        if ($user->role->slug == User::SCHOOL) {
            $school = School::create([
                'user_id' => $user->id,
                'name' => $input['name'],
                // Add other school-specific fields
            ]);
        } elseif ($user->role->slug == User::STUDENT) {
            $student = Student::create([
                'school_id' => $user->id,
                'name' => $input['name'],
                // Add other student-specific fields
            ]);
        }

        //Check this newly registerd user has any purchased transection
        $e = BkashTransection::where('customer_msisdn', $input['msisdn'])
            ->where('trx_id', $input['trx_id'])
            ->where('is_used', false)
            ->firstOrFail();

        if ($e !== null) {
            // Add package to user
            $user->update([
                'package_id' => $e->id,
                'status' => true,
            ]);

            // Also expired transection
            $e->update([
                'is_used' => true,
            ]);
        }

        return $user;
    }
}
