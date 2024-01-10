<?php

namespace App\Actions\Fortify;

use Exception;
use App\Models\Role;
use App\Models\User;
use App\Models\School;
use App\Models\Package;
use App\Models\Student;
use Illuminate\Http\Request;
use App\Models\BkashTransection;
use Laravel\Jetstream\Jetstream;
use Illuminate\Support\Facades\DB;
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
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => $this->passwordRules(),
            'terms' => Jetstream::hasTermsAndPrivacyPolicyFeature() ? ['accepted', 'required'] : '',
        ])->validate();
        if ($input['trx_id'] !== null && $input['msisdn'] !== null) {
            try {
                DB::beginTransaction();

                $userRole = Role::where('slug', $input['role'])->firstOrFail();
                $user = User::create([
                    'role_id' => $userRole->id,
                    'name' => $input['name'],
                    'email' => $input['email'],
                    'password' => Hash::make($input['password']),
                    'status' => true,
                ]);
                if ($user->role->slug == User::SCHOOL) {
                    $school = School::create([
                        'user_id' => $user->id,
                        'name' => $input['name'],
                        // 'status' => true,
                        // Add other school-specific fields
                    ]);
                }

                //Check this newly registerd user has any purchased transection
                $e = BkashTransection::where('customer_msisdn', $input['msisdn'])
                    ->where('trx_id', $input['trx_id'])
                    ->where('is_used', false)
                    ->firstOrFail();

                if ($e !== null) {
                    // Add package to user
                    $user->school->update([
                        'package_id' => $e->id,
                    ]);

                    // Also expired transection
                    $e->update([
                        'is_used' => true,
                    ]);
                }

                //Notify user
                if (isset($user)) {
                    session()->put('new_register_successfull', 'Congratulation! 🥳 You\'ve success registered.');
                }
                DB::commit();
                return $user;
                // Return the user or any other result if needed
                return $user;
            } catch (\Exception $e) {
                dd($e);
                // Something went wrong, rollback the transaction
                DB::rollback();

                // Handle the exception or log it
                // ...

                // Return null or any other error response
                return null;
            };
        } else {
            try {
                DB::beginTransaction();

                $userRole = Role::where('slug', 'demo_school')->firstOrFail();
                $user = User::create([
                    'role_id' => $userRole->id,
                    'name' => $input['name'],
                    'email' => $input['email'],
                    'password' => Hash::make($input['password']),
                    'status' => true,
                ]);

                $user->subscription()->updateOrCreate([
                    'package_id' => Package::where('price', '<=', '0')->firstOrFail()->id,
                    'will_expire' => now()->addDays(3),
                ]);

                if ($user->role->slug == User::SCHOOL || $user->role->slug == User::DEMO_SCHOOL) {
                    $school = School::create([
                        'user_id' => $user->id,
                        'institute_name' => $input['name'],
                        'package_id' => $user->subscription->package_id,
                        // Add other school-specific fields
                    ]);
                }

                // Notify user
                if (isset($user)) {
                    session()->put('new_register_successful', 'Congratulations! 🥳 You\'ve successfully registered.');
                }
                DB::commit();

                return $user;
            } catch (\Exception $e) {
                // Something went wrong, rollback the transaction
                DB::rollback();

                throw new Exception("Something went wrong", 404);
            }
        }
    }
}
