<?php

namespace App\Http\Controllers\Api\V1;

use App\Contruct\CurrencyInterface;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\v1\MakeTransactionRequest;
use App\Models\AccountInfo;
use App\Trait\ApiResponse;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    use ApiResponse;
    public function make_transaction(MakeTransactionRequest $request, CurrencyInterface $currency){
        $userInfo = AccountInfo::where('user_id', $request->user_id)
                ->where('currency', $currency->getCurrency())
                -first();

        if($userInfo->amount < $request->amount){
            return $this->failResponse($request->all(), 'Insufficient balance ', 400);
        }

        // TODO:: have to hit for payment like: $paymentSystem->makePayment($request->validated())

        return $this->successResponse($request->all(), 'Transaction Success', 201);
    }
}
