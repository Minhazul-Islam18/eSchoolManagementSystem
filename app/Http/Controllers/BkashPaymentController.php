<?php

namespace App\Http\Controllers;

use App\Models\Role;
use Inertia\Inertia;
use Illuminate\Http\Request;
use App\Models\BkashTransection;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Karim007\LaravelBkash\Facade\BkashRefund;
use Karim007\LaravelBkash\Facade\BkashPayment;

class BkashPaymentController extends Controller
{
    private $amount = 0;
    private $payment_id;
    private $package_id;
    public function index(Request $request)
    {
        $this->package_id = $request->id;
        session()->put('package_id', intval($request->id));
        if (auth()->user()->hasRole('school') || auth()->user()->hasRole('demo_school')) {
            if (session()->has('invoice_amount')) {
                session()->forget('invoice_amount');
            }
            session()->put('invoice_amount', intval($request->amount) * 12);
            $this->amount = session()->get('invoice_amount');

            Inertia::share('bkashSandox', config('bkash.sandbox'));
            return view('bkash::bkash-payment');
        } else {
            return Redirect::route('/')->with('message', 'Something went wrong.');
        }
    }

    public function getToken()
    {
        if (auth()->user()->hasRole('school') || auth()->user()->hasRole('demo_school')) {
            return BkashPayment::getToken();
        } else {
            return Redirect::route('/')->with('message', 'Something went wrong.');
        }
    }
    public function createPayment(Request $request)
    {
        // $user = auth()->user();
        if (auth()->user()->hasRole('school') || auth()->user()->hasRole('demo_school')) {
            $request['intent'] = 'sale';
            $request['currency'] = 'BDT';
            $request['invoice_amount'] = session()->get('invoice_amount') ?? throw new Exception('Something went wrong.');
            $request['merchantInvoiceNumber'] = rand();
            $request['callbackURL'] = config("bkash.callbackURL");;

            $request_data_json = json_encode($request->all());
            $e = BkashPayment::cPayment($request_data_json);
            // dd($e);
            session()->put('payment_id', $e['paymentID']);
            BkashTransection::create([
                'logo' => $e['orgLogo'],
                'name' => $e['orgName'],
                'payment_id' => $e['paymentID'],
                'currency' => $e['currency'],
                'transaction_status' => $e['transactionStatus'],
                'merchant_invoice_number' => $e['merchantInvoiceNumber'],
                'amount' => $e['amount'],
                'create_time' => $e['createTime'],
            ]);
            return $e;
        } else {
            return Redirect::route('/')->with('message', 'Something went wrong.');
        }
    }

    public function executePayment(Request $request)
    {
        $user = auth()->user();
        if ($user->hasRole('school') || $user->hasRole('demo_school')) {
            $tr = BkashTransection::where('payment_id', $request->paymentID)->first();
            $paymentID = $request->paymentID;
            $e = BkashPayment::executePayment($paymentID);

            if (isset($e['errorCode']) && $e['errorCode'] !== null) {
                //show error message on payment failure'
                dd($e);
            } else {
                if (isset($e['transactionStatus']) && $e['transactionStatus'] !== 'Completed') {
                    $tr->delete();
                } else {
                    DB::transaction(function () use ($user, $tr, $e) {
                        if ($user->hasRole('demo_school')) {
                            $user->role()->dissociate();

                            // Associate the user with the 'demo_school' role
                            $SchoolRole = Role::where('slug', 'school')->firstOrFail();
                            if ($SchoolRole) {
                                $user->role()->associate($SchoolRole);
                                $user->save();
                            }
                        }
                        school()->update(['package_id' => session()->get('package_id')]);
                        $s = $user->subscription;
                        // Update user subscription
                        if ($s === null) {
                            $user->subscription()->create([
                                'package_id' => session()->get('package_id'),
                                'will_expire' => now()->addMonth(12),
                            ]);
                        } else {
                            $user->subscription()->update([
                                'package_id' => session()->get('package_id'),
                                'will_expire' => now()->addMonth(12),
                            ]);
                        }

                        // Update transection info
                        $tr->update([
                            'payment_id' => $e['paymentID'],
                            'transaction_status' => $e['transactionStatus'],
                            'customer_msisdn' => $e['customerMsisdn'],
                            'trx_id' => $e['trxID'],
                            'transaction_reference' => $e['transactionReference'] ?? null,
                        ]);
                    }, 5);
                }
            }
            return $e;
        }
    }
    public function queryPayment(Request $request)
    {
        $paymentID = $request->payment_info['payment_id'];
        return BkashPayment::queryPayment($paymentID);
    }
    public function bkashSuccess(Request $request)
    {
        $pay_success = $request->payment_info['transactionStatus'];
        session()->forget('invoice_amount');
        return BkashPayment::bkashSuccess($pay_success);
    }
    public function refundPage()
    {
        return BkashRefund::index();
    }
    public function refund(Request $request)
    {
        $this->validate($request, [
            'payment_id' => 'required',
            'invoice_amount' => 'required',
            'trx_id' => 'required',
            'sku' => 'required|max:255',
            'reason' => 'required|max:255'
        ]);

        $post_fields = [
            'paymentID' => $request->payment_id,
            'invoice_amount' => $request->amount,
            'trxID' => $request->trx_id,
            'sku' => $request->sku,
            'reason' => $request->reason,
        ];
        return BkashRefund::refund($post_fields);
    }
}
