<?php

namespace App\Http\Controllers\Api\V1;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\AddPaymentAccountRequest;
use App\Models\PaymentAccount;

class PaymentAccountController extends Controller
{

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AddPaymentAccountRequest $request)
    {
        $this->authorize('create');
        return response()->json([
            'data' =>auth()->user()->paymentAccounts()->create($request->all())
        ], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(PaymentAccount $paymentAccount)
    {
        return response()->json([
            'data' => $paymentAccount
        ], 200);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PaymentAccount $paymentAccount)
    {
        $this->authorize('update', $paymentAccount);

        $paymentAccount->update($request->all());

        return response()->json([
            'data' => 'payment account updated successfully'
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(PaymentAccount $paymentAccount)
    {
        $this->authorize('delete', $paymentAccount);
        
        $paymentAccount->delete();

        return response()->json([
            'data' => 'payment account deleted'
        ], 200);
    }
}
