<?php

namespace App\Services\Helpers;

use App\Models\Transaction;
use Illuminate\Support\Facades\DB;
use App\Services\Helpers\Converter;
use Exception;
use Carbon\Carbon;
use Illuminate\Support\Str;


trait Trx{
    use Converter;

    public function generatePositionKey($date){
       return $transactionCount =  Transaction::where('date',$date)->count() + 1 ;

    }

    public function validBalance($requestedAmount, $currentBalanceInPaisa, $trxKind){
        if ($this->toPaisa($requestedAmount) > $currentBalanceInPaisa &&  $trxKind == 'expense')
        {
            throw new Exception('You do not have sufficient balance.');
        }
    }

    public function prevTransaction($carbonDate){

        if(Transaction::first()){
            $sameDayLatestTrx = Transaction::where('date', $carbonDate)
                ->orderBy('position_key', 'desc')
                ->first();
            if($sameDayLatestTrx){
                return $sameDayLatestTrx;
            }
            else{
                // ager date a jabe
                $latestDateLatestTrx = Transaction::whereBetween('date', ['2000-01-01', $carbonDate])
                    ->orderBy('date', 'desc')
                    ->orderBy('position_key', 'desc')
                    ;
                $sql = Str::replaceArray('?', $latestDateLatestTrx->getBindings(), $latestDateLatestTrx->toSql());
                dd($latestDateLatestTrx->getBindings());
                return $latestDateLatestTrx;
            }
        }
        else{
            return null;
        }


        $prevTransaction = Transaction::where('date', $date)->orderBy('position_key', 'desc')->first();
        if ($prevTransaction){
            $lastTrx = $prevTransaction;
        }else{
            $lastTrx = Transaction::latest()->first();
        }
        return $lastTrx;
    }

    public function newTransaction($title, $note, $date, $transaction_head_id, $transaction_account_id,$amount) {
        $transaction = new Transaction();
        $transaction->title = $title;
        $transaction->note = $note;
        $transaction->date = Carbon::parse($date);
        $transaction->transaction_head_id = $transaction_head_id;
        $transaction->transaction_account_id = $transaction_account_id;
        $transaction->amount = $this->toPaisa($amount);
        $transaction->position_key = $this->generatePositionKey($date);
        $transaction->save();
        return $transaction;

    }

    public function acBalanceMaker($prevBalance,$amount,$kind){
        if($kind == 'income'){
            return $prevBalance + $amount;
        }else{
            return $prevBalance - $amount;
        }
    }
    public function mainBalanceMaker($prevBalance,$amount,$kind){
        if($kind == 'income'){
            return $prevBalance + $amount;
        }else{
            return $prevBalance - $amount;
        }
    }

    public function nextTrxRange($againstDate){

    }


}
