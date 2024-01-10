<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use Illuminate\Http\Request;
use App\Models\BkashTransection;
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
            // dd(auth()->user()->role);
            if (session()->has('invoice_amount')) {
                session()->forget('invoice_amount');
            }
            session()->put('invoice_amount', intval($request->amount) * 12);
            $this->amount = session()->get('invoice_amount');

            Inertia::share('bkashSandox', config('bkash.sandbox'));
            return view('bkashT::bkash-payment');
        } else {
            dd(auth()->user()->role);
            return Redirect::route('/')->with('message', 'Something went wrong.');
        }
    }
    public function createPayment(Request $request)
    {
        // dd(session()->get('package_id'));
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
        //$response =  BkashPaymentTokenize::cPayment($request_data_json,1); //last parameter is your account number for multi account its like, 1,2,3,4,cont..

        //store paymentID and your account number for matching in callback request
        dd($response); //if you are using sandbox and not submit info to bkash use it for 1 response
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
        // dd(isset($response['bkashURL']));
        if (isset($response['bkashURL'])) return redirect()->away($response['bkashURL']);
        // else return redirect()->back()->with('error-alert2', $response['statusMessage']);
        else return redirect()->back()->with('message', $response['statusMessage']);
    }

    public function callBack(Request $request)
    {
        //callback request params
        // paymentID=your_payment_id&status=success&apiVersion=1.2.0-beta
        //using paymentID find the account number for sending params

        if ($request->status == 'success') {
            $response = BkashPaymentTokenize::executePayment($request->paymentID);
            dd($response);
            //$response = BkashPaymentTokenize::executePayment($request->paymentID, 1); //last parameter is your account number for multi account its like, 1,2,3,4,cont..
            if (!$response) { //if executePayment payment not found call queryPayment
                $response = BkashPaymentTokenize::queryPayment($request->paymentID);
                //$response = BkashPaymentTokenize::queryPayment($request->paymentID,1); //last parameter is your account number for multi account its like, 1,2,3,4,cont..
            }

            if (isset($response['statusCode']) && $response['statusCode'] == "0000" && $response['transactionStatus'] == "Completed") {
                /*
                 * for refund need to store
                 * paymentID and trxID
                 * */
                return BkashPaymentTokenize::success('Thank you for your payment', $response['trxID']);
            }
            return BkashPaymentTokenize::failure($response['statusMessage']);
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
