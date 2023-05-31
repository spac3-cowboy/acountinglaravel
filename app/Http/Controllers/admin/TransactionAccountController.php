<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Transaction;
use App\Models\TransactionAccount;
use App\Models\TransactionHead;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Database\QueryException;
use App\Services\Helpers\Converter;
use App\Services\Helpers\Trx;
use function Symfony\Component\HttpFoundation\Session\Storage\save;

class TransactionAccountController extends Controller
{
    use Converter;
    use Trx;
    public function create(){
        return view('admin.pages.account.AccountCreate');
    }

    public function store(Request $request){

        try{
            $transAccount = new TransactionAccount();
            $transAccount->title = $request->title;
            $transAccount->details = $request->details;
            $transAccount->balance = $this->toPaisa($request->balance);
            $transAccount->save();

            $transHead = new TransactionHead();
            $transHead->title = $request->title.' Account Deposit';
            $transHead->kind = 'income';
            $transHead->save();

            $transaction = new Transaction();
            $transaction->title = $request->title;
            $transaction->note = $request->note;
            $date = Carbon::today()->toDateString();
            $transaction->date = $date;
            $transaction->transaction_head_id =  $transHead->id;
            $transaction->transaction_account_id = $transAccount->id;
            $transaction->amount = $this->toPaisa($request->balance);
            $transaction->position_key = $this->generatePositionKey($date);

            $transaction->ac_balance = $transAccount->balance;
            $totalBalance = TransactionAccount::totalBalance();
            $transaction->main_balance = $totalBalance ;
            $transaction->save();

            return redirect()->back()->with('success', 'Created Successfully');
        }catch (QueryException $e){
            return redirect()->back()->with('error', 'Failed to store data in the database.');
        }
    }

    public function list(){
        $accounts = TransactionAccount::all();
        return view('admin.pages.account.AccountList', ['accounts' => $accounts]);
    }

    public function edit($id)
    {
        $account = TransactionAccount::find($id);
        return view('admin.pages.account.AccountUpdate', ['account' => $account]);

    }

    public function update(Request $request, $id){
        try{
            $transHead =  TransactionAccount::find($id);
            $transHead->title = $request->title;
            $transHead->details = $request->details;
            $transHead->balance = $this->toPaisa($request->balance);
            $transHead->update();
            return redirect()->back()->with('success', 'Updated Successfully');
        }catch (QueryException $e){
            return redirect()->back()->with('error', 'Failed to store data in the database.');
        }

    }
}
