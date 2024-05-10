<?php

namespace App\Http\Controllers\Api\V1;

use App\Contruct\CurrencyInterface;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\v1\MakeTransactionRequest;
use App\Models\Api\v1\AccountInfo;
use App\Trait\ApiResponse;
use Exception;

class TransactionController extends Controller
{
    use ApiResponse;
    public function makeTransaction(MakeTransactionRequest $request, CurrencyInterface $currency){
        try{
            $request->headers->set('X-Mock-Status', true);

            $userInfo = AccountInfo::where('user_id', $request->user_id)
                    ->where('currency', $currency->getCurrency())
                -first();

            if($userInfo->amount < $request->amount){
                return $this->failResponse($request->all(), 'Insufficient balance ', 400);
            }

            // TODO:: have to hit for payment like: $paymentSystem->makePayment($request->validated())

            return $this->successResponse($request->all(), 'Transaction Success', 201);
        }catch (Exception $exception){
            return $this->failResponse($exception->getMessage(), 'Transaction fails', '400');
        }
    }
}
