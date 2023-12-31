<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use App\Models\Package;
use App\Models\Role;
use Inertia\Ssr\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
// use Illuminate\Http\Response;
// use Illuminate\Support\Facades\Response;

class ProcessFreePackage extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function SyncToUser(Request $request)
    {
        $user = auth()->user();
        //check if user is school
        if ($user->hasRole('school') || $user->hasRole('demo_school')) {
            if ($user->hasRole('school')) {
                $user->role()->dissociate();

                // Associate the user with the 'demo_school' role
                $demoSchoolRole = Role::where('slug', 'demo_school')->firstOrFail();
                $user->role()->associate($demoSchoolRole);

                // Save the changes to the database
                $user->save();
            }

            // can purchase a plan if school doesn't have any package purchased & currently active
            while ($user->school->package_id === null && $user->subscription === null) {
                DB::transaction(function () use ($user, $request) {
                    $s = $user->subscription;
                    // Update or create user subscription
                    if ($s === null) {
                        $user->subscription()->create([
                            'package_id' => $request->id,
                            'will_expire' => now()->addMonth(12),
                        ]);
                    } else {
                        $user->subscription()->update([
                            'package_id' => $request->id,
                            'will_expire' => now()->addMonth(12),
                        ]);
                    }
                    //update school's plan
                    $user->school()->update([
                        "package_id" => $request->id
                    ]);
                }, 5);
                break;
                return Redirect::route('/')->with('package_purchased', 'Package successfully purchased');
            }
        } else {
            // return if there anything wrong.
            flash()->addSuccess('Something wemt wrong.');

            return Redirect::route('/')->with('message', 'Something went wrong.');
        }
    }
}
