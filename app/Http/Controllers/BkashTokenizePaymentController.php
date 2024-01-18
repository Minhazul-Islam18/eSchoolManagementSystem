<?php

namespace App\Http\Controllers;

use App\Models\Role;
use Inertia\Inertia;
use Illuminate\Http\Request;
use App\Models\BkashTransection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Karim007\LaravelBkashTokenize\Facade\BkashRefundTokenize;
use Karim007\LaravelBkashTokenize\Facade\BkashPaymentTokenize;

class BkashTokenizePaymentController extends Controller
{
    private $package_id;
    private $amount;
    public function index(Request $request)
    {
        session()->put('package_id', intval($request->id));
        session()->put('amount', intval($request->amount));
        $this->package_id = $request->id;
        $this->amount = $request->amount;


        if (auth()->user()->hasRole('school') || auth()->user()->hasRole('demo_school')) {
            if (session()->has('invoice_amount')) {
                session()->forget('invoice_amount');
            }
            session()->put('invoice_amount', intval($request->amount) * 12);
            $this->amount = session()->get('invoice_amount');

            Inertia::share('bkashSandox', config('bkash.sandbox'));
            return view('bkashT::bkash-payment');
        } else {
            return Redirect::route('/')->with('message', 'Something went wrong.');
        }
    }
    public function createPayment(Request $request)
    {
        $inv = uniqid();
        $request['intent'] = 'sale';
        $request['mode'] = '0011'; //0011 for checkout
        $request['payerReference'] = $inv;
        $request['currency'] = 'BDT';
        $request['amount'] = session()->get('amount') * 12;
        $request['merchantInvoiceNumber'] = $inv;
        $request['callbackURL'] = config("bkash.callbackURL");

        $request_data_json = json_encode($request->all());

        $response =  BkashPaymentTokenize::cPayment($request_data_json);

        BkashTransection::create([
            'logo' => $response['orgLogo'] ?? '',
            'name' => $response['orgName'] ?? '',
            'payment_id' => $response['paymentID'],
            'currency' => $response['currency'],
            'transaction_status' => $response['transactionStatus'],
            'merchant_invoice_number' => $response['merchantInvoiceNumber'],
            'amount' => $response['amount'],
            'create_time' => $response['paymentCreateTime'],
        ]);
        if (isset($response['bkashURL'])) return redirect()->away($response['bkashURL']);
        // else return redirect()->back()->with('error-alert2', $response['statusMessage']);
        else return redirect()->back()->with('message', $response['statusMessage']);
    }

    public function callBack(Request $request)
    {
        if ($request->status == 'success') {
            $response = BkashPaymentTokenize::executePayment($request->paymentID);

            if (!$response) { //if executePayment payment not found call queryPayment
                $response = BkashPaymentTokenize::queryPayment($request->paymentID);
            }

            if ($response['transactionStatus'] == "Completed") {
                $tr = BkashTransection::where('payment_id', $response['paymentID'])->first();
                $user = Auth::user();
                DB::transaction(function () use ($user, $tr, $response) {
                    if ($user->hasRole('demo_school')) {
                        $user->role()->dissociate();
                        // Associate the user with the 'demo_school' role
                        $SchoolRole = Role::where(
                            'slug',
                            'school'
                        )->firstOrFail();
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
                        'payment_id' => $response['paymentID'],
                        'transaction_status' => $response['transactionStatus'],
                        'customer_msisdn' => $response['customerMsisdn'],
                        'trx_id' => $response['trxID'],
                        'transaction_reference' => $response['payerReference'] ?? null,
                    ]);
                }, 5);
                return BkashPaymentTokenize::success('Thank you for your payment', $response['trxID']);
            } else {
                $tr = BkashTransection::where('payment_id', $response['paymentID'])->first();
                $tr->delete();
            }
        } else if ($request->status == 'cancel') {
            return BkashPaymentTokenize::cancel('Your payment is canceled');
        } else {
            return BkashPaymentTokenize::failure('Your transaction is failed');
        }
    }

    public function searchTnx($trxID)
    {
        //response
        return BkashPaymentTokenize::searchTransaction($trxID);
        //return BkashPaymentTokenize::searchTransaction($trxID,1); //last parameter is your account number for multi account its like, 1,2,3,4,cont..
    }

    public function refund(Request $request)
    {
        $paymentID = 'Your payment id';
        $trxID = 'your transaction no';
        $amount = 5;
        $reason = 'this is test reason';
        $sku = 'abc';
        //response
        return BkashRefundTokenize::refund($paymentID, $trxID, $amount, $reason, $sku);
        //return BkashRefundTokenize::refund($paymentID,$trxID,$amount,$reason,$sku, 1); //last parameter is your account number for multi account its like, 1,2,3,4,cont..
    }
    public function refundStatus(Request $request)
    {
        $paymentID = 'Your payment id';
        $trxID = 'your transaction no';
        return BkashRefundTokenize::refundStatus($paymentID, $trxID);
        //return BkashRefundTokenize::refundStatus($paymentID,$trxID, 1); //last parameter is your account number for multi account its like, 1,2,3,4,cont..
    }
}
