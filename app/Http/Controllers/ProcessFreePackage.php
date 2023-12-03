<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use App\Models\Package;
use Inertia\Ssr\Response;
use Illuminate\Http\Request;
// use Illuminate\Http\Response;
// use Illuminate\Support\Facades\Response;

class ProcessFreePackage extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function SyncToUser(Request $request)
    {
        if (auth()->user()->hasRole('school')) {
            while (auth()->user()->school->package_id === null) {
                $e = auth()->user()->school()->update([
                    "package_id" => $request->id
                ]);
                break;
            }
        } else {
            return to_route('/');
            // return Inertia::location(route('/'), ['message', 'Your message here']);
            // return to_route('/', ['message' => 'You\'re not elligable for buy any package'], 303);
            // return Inertia::render('Home', ['message' => 'You\'re not elligable for buy any package']);
            // return response(['message' => 'You\'re not elligable for buy any package'], 303);
        }
    }

    /**
     * Display a listing of the resource.
     */
    public function index($id)
    {
        dd('Here i am', $id);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Package $package)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Package $package)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Package $package)
    {
        //
    }
}
