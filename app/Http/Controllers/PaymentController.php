<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePaymentRequest;
use App\Search\PaymentSearch;
use App\Services\UserPaymentService;
use Illuminate\Http\Request;


class PaymentController extends Controller
{
    /**
     * return index view
     * @param Request $request
     * @param PaymentSearch $paymentSearch
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Request $request, PaymentSearch $paymentSearch)
    {
        $payments = $paymentSearch->search($request);
        return view('payments.index',compact('payments'));
    }

    /**
     * return create payment view
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        return view('payments.create');
    }

    /**
     * increase or decrease user balance by inserting in user_payments table
     * @param StorePaymentRequest $request
     * @param UserPaymentService $paymentService
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(StorePaymentRequest $request, UserPaymentService $paymentService)
    {

        if ($request->post('paymentMethod') === 'credit'){
            // okay lets increase user balance
            $result = $paymentService->increaseBalance($request->post('amount') ,$request->post('comment'));
            // redirect on success
            if ($result)
                return redirect(route('payments.index'));

        }

        if ($request->post('paymentMethod') === 'debit'){
            // okay lets decrease user balance
            $result = $paymentService->decreaseBalance($request->post('amount') ,$request->post('comment'));

            // redirect on success
            if ($result)
                return redirect(route('payments.index'));

            // redirect back on with error
            return redirect()->back()->withInput($request->post())->withErrors([
                'amount' => "You don't have enough balance"
            ]);
        }

        // 404 on error
        return abort(404);
    }

}
