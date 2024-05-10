<?php

namespace App\Http\Controllers;

use App\Http\Requests\Api\v1\UpdatePaymentInfoRequest;
use App\Models\TransactionInfo;
use App\Trait\ApiResponse;
use Illuminate\Support\Facades\Route;
use App\Http\Requests\Api\v1\TransactionRequest;
use Illuminate\Http\Request;
use Exception;

class TransactionInfoController extends Controller
{
    use ApiResponse;
    public function transaction(TransactionRequest $request){
        try {
            $request->headers->set('Cache-Control', 'no-store');

            $data = ['user_id' => $request->user_id, 'amount' => $request->amount];
            $request = Request::create('api/v1/make_transaction', 'POST', $data);

            $response = json_decode(Route::dispatch($request), true);

            if($response['status'] == true){
                $transactionInfo  = new TransactionInfo();
                $transactionInfo->user_id = $request->user_id;
                $transactionInfo->transaction_id = $response['data']['transaction_id']; // assume here is transaction_id
                $transactionInfo->amount = $request->amount;
                $transactionInfo->transaction_status = 1;
                $transactionInfo->save();

                return $this->successResponse($response, 'Transaction success', '200');
            }else{
                $transactionInfo  = new TransactionInfo();
                $transactionInfo->user_id = $request->user_id;
                $transactionInfo->amount = $request->amount;
                $transactionInfo->transaction_status = 0;
                $transactionInfo->remarks = json_encode($response['message']);
                $transactionInfo->save();

                return $this->failResponse($response['message'], 'Transaction Fails', '400');
            }
        }catch (Exception $exception){
            return $this->failResponse($exception->getMessage(), 'Transaction fails', '400');
        }
    }

    public function updatePaymentInfo(UpdatePaymentInfoRequest $request){
        try {
            TransactionInfo::where('transaction_id', $request->transaction_id)->update([
                'status' => $request->status
            ]);

            return $this->successResponse('', 'Transaction update success', '200');
        }catch (Exception $exception){
            return $this->failResponse($exception->getMessage(), 'Transaction update fails', '400');
        }
    }
}
