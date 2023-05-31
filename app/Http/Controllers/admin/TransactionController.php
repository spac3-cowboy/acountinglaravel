<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Transaction;
use App\Models\TransactionAccount;
use App\Models\TransactionHead;
use Illuminate\Http\Request;
use Illuminate\Database\QueryException;
use App\Services\Helpers\Converter;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use App\Services\Helpers\Trx;
use Exception;



class TransactionController extends Controller
{
    use Converter, Trx;
    public function create(){
        $accounts = TransactionAccount::all();
        $transHead = TransactionHead::all();
        return view('admin.pages.transaction.TransactionCreate', [
            'accounts' => $accounts,
            'transHead' => $transHead,
            ]);
    }

    public function store(Request $request){

        try{
            $account = TransactionAccount::find($request->transaction_account_id);
            $transHead = TransactionHead::find($request->transaction_head_id);

            $this->validBalance($request->amount, $account->balance, $transHead->kind);

            $requestDate = Carbon::createFromFormat('Y-m-d', $request->input('date'))->toDateString();
            $currentDate = Carbon::today()->toDateString();
            $latestTdrxOfRequestDate = Transaction::where('date', $requestDate)->orderBy('position_key', 'desc')->limit(1)->first();
            if($requestDate < $currentDate){

                $lastTrx =  $this->prevTransaction($requestDate);
                dd($lastTrx);
                if ($lastTrx){
                    $newTrx = $this->newTransaction($request->title,$request->note, $request->date, $request->transaction_head_id,$request->transaction_account_id, $request->amount);
                    $newTrx->ac_balance = $this->acBalanceMaker($lastTrx->ac_balance, $this->toPaisa($request->amount), $transHead->kind);
                    $newTrx->main_balance = $this->mainBalanceMaker($lastTrx->main_balance, $this->toPaisa($request->amount), $transHead->kind);
                    $newTrx->update();

                    $account->balance = $newTrx->ac_balance;
                    $account->update();
                    $givenDate = Carbon::parse($request->date);
                    $nextDay = $givenDate->addDay()->toDateString();

                    $PREVacBalance = $newTrx->ac_balance;
                    $PREVmainBalance = $newTrx->main_balance;
                    $lastAccountBalance = 0;

                    $rowsToAdjust = Transaction::whereBetween('date',
                        [$nextDay, $currentDate])
                        ->orderBy('date', 'asc')
                        ->orderBy('position_key', 'asc')
                        ->get();

                    dd($rowsToAdjust);

                }else{

                    throw new Exception('SERVER PROBLEM :::: PEEP PEEP PEEEEEEEEEEEEPPPPPP!!!');
                }
            }
            else if($requestDate == $currentDate){

                $lastTrx =  $this->prevTransaction($requestDate);

                if ($lastTrx){
                    $newTrx = $this->newTransaction($request->title,$request->note, $request->date, $request->transaction_head_id,$request->transaction_account_id, $request->amount);
                    $newTrx->ac_balance = $this->acBalanceMaker($lastTrx->ac_balance, $this->toPaisa($request->amount), $transHead->kind);
                    $newTrx->main_balance = $this->mainBalanceMaker($lastTrx->main_balance, $this->toPaisa($request->amount), $transHead->kind);
                    $newTrx->update();

                    $account->balance = $newTrx->ac_balance;
                    $account->update();
                }else{
                    throw new Exception('SERVER PROBLEM :::: PEEP PEEP PEEEEEEEEEEEEPPPPPP!!!');
                }

            }

            else{
                throw new Exception('Future Entry is not allowed.');
            }
        }
        catch(Exception $e){
            dd($e->getMessage());
        }





//            if ($this->toPaisa($request->amount) > $account->balance &&  $transHead->kind == 'expense')
//            {
//                return redirect()->back()->with('error', 'You do not have sufficient balance');
//            }
//            $transaction = new Transaction();
//            $transaction->title = $request->title;
//            $transaction->note = $request->note;
//            $transaction->date = Carbon::parse($request->date);
//            $transaction->transaction_head_id = $request->transaction_head_id;
//            $transaction->transaction_account_id = $request->transaction_account_id;
//            $transaction->amount = $this->toPaisa($request->amount);
//            $transaction->position_key = $this->generatePositionKey($request->date);
//            if ($request->hasFile('file')) {
//                $file = $request->file('file');
//                $extension = $file->getClientOriginalExtension();
//
//                $filename = Str::random(40) . '.' . $extension;
//
//                if (in_array($extension, ['pdf','jpg', 'jpeg', 'png', 'gif'])) {
//                    // Handle image file upload
//                    $path = $file->storeAs('public/file', $filename);
//                } else {
//                    return redirect()->back()->with('error','Invalid file type. Only PDF, JPG, JPEG, PNG, and GIF files are allowed.');
//                }
//
//                $transaction->file = $filename;
//            }
//
//                $requestDate = Carbon::createFromFormat('Y-m-d', $request->input('date'))->toDateString();
//                $currentDate = Carbon::today()->toDateString();
//                    if ($requestDate <= $currentDate) {
//                        $lastTransaction = Transaction::where('date', $requestDate)
//                            ->latest('created_at')
//                            ->first();
//                        $givenDate = null;
//                        $recentTrx = null;
//
//                        if (!$lastTransaction) {
//                            $givenDate = Carbon::parse($requestDate);
//                            $prevDay = $givenDate->subDays(1)->toDateString();
//                            $recentTrx = Transaction::where('date', $prevDay)
//                                ->latest('created_at')
//                                ->first();
//                        }
//                        else{
//                            $givenDate = Carbon::parse($lastTransaction->date);
//                            $recentTrx = $lastTransaction;
//                        }
//
//                        $nextDay = $givenDate->addDay()->toDateString();
//
//                        if(!$recentTrx){
//                            // insert the row as new row
//                            if ($transHead->kind == 'income') {
//                                $account->balance = $account->balance + $this->toPaisa($request->amount);
//                                $account->update();
//                                $transaction->ac_balance = $transaction->ac_balance + $this->toPaisa($request->amount);
//                                $transaction->main_balance = $transaction->main_balance + $this->toPaisa($request->amount);
//                                $transaction->save();
//
//                                $recentTrx = $transaction->fresh();
//
//                            }else {
//                               return redirect()->back()->with('error', 'Backdated entry expense not allowed');
//                            }
//
//
//                        }
//
//
//                        $PREVacBalance = $recentTrx->ac_balance;
//                        $PREVmainBalance = $recentTrx->main_balance;
//                        $lastAccountBalance = 0;
//
//
//                        $results = Transaction::whereBetween('date', [$nextDay, $currentDate])->orderBy('date', 'asc')->orderBy('position_key', 'asc')->get();
//
//                        foreach ($results as $row)
//                        {
//                            if ($transHead->kind == 'income') {
//
//                                $row->ac_balance = $PREVacBalance + $row->amount;
//                                $row->main_balance = $PREVmainBalance + $row->amount;
//
//                                $lastAccountBalance = $PREVacBalance + $row->amount;
//
//                                $PREVacBalance = $row->ac_balance;
//                                $PREVmainBalance = $row->main_balance;
//
//
//                                $row->save();
//
//
//                            }else {
//                                $row->ac_balance = $PREVacBalance - $row->amount;
//                                $row->main_balance = $PREVmainBalance - $row->amount;
//
//                                $lastAccountBalance = $PREVacBalance - $row->amount;
//
//                                $PREVacBalance = $row->ac_balance;
//                                $PREVmainBalance = $row->main_balance;
//
//
//                                $row->save();
//                            }
//
//                        }
//
//                        $account->balance = $lastAccountBalance;
//
//
//                } else{
//
//                        return redirect()->back()->with('error', 'Future Entry is not allowed');
//
//                    }
//
//            return redirect()->back()->with('success', 'Created Successfully');
    }

    public function edit($id){
        $accounts = TransactionAccount::all();
        $transHead = TransactionHead::all();
        $transaction = Transaction::find($id);
        return view('admin.pages.transaction.TransactionUpdate', [
            'transaction' => $transaction,
            'accounts' => $accounts,
            'transHead'  => $transHead
        ]);
    }

    public function update(Request $request, $id)
    {
        $account = TransactionAccount::find($request->transaction_account_id);
        $transHead = TransactionHead::find($request->transaction_head_id);
        if ($request->amount < $account->balance &&  $transHead->kind == 'expense')
        {
            return redirect()->back()->with('error', 'You do not have sufficient balance');
        }
        $transaction =  Transaction::find($id);
        $transaction->title = $request->title;
        $transaction->note = $request->note;
        $transaction->date = Carbon::parse($request->date);
        $transaction->transaction_head_id = $request->transaction_head_id;
        $transaction->transaction_account_id = $request->transaction_account_id;
        $transaction->amount = $this->toPaisa($request->amount);

        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $extension = $file->getClientOriginalExtension();

            $filename = Str::random(40) . '.' . $extension;

            if (in_array($extension, ['pdf','jpg', 'jpeg', 'png', 'gif'])) {
                // Handle image file upload
                if ($transaction->file) {
                    Storage::delete('public/file/' . $transaction->file);
                }
                $path = $file->storeAs('public/file', $filename);
            } else {
                return redirect()->back()->with('error','Invalid file type. Only PDF, JPG, JPEG, PNG, and GIF files are allowed.');
            }

            $transaction->file = $filename;
        }



    }

    public function list(){
        $accounts = TransactionAccount::all();
        $transHead = TransactionHead::all();
        $history = Transaction::with(['transactionHead','account'])->orderBy('date', 'desc')->orderBy('position_key', 'desc')->take(100)->get();
        return view('admin.pages.transaction.TransactionHistory', [
            'history' => $history,
            'accounts' => $accounts,
            'transHead' => $transHead,
        ]);
    }

}
