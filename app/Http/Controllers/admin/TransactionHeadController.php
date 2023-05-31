<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\TransactionHead;
use Illuminate\Http\Request;
use Illuminate\Database\QueryException;


class TransactionHeadController extends Controller
{
    public function create(){
        return view('admin.pages.transaction.TransactionHeadCreate');
    }

    public function store(Request $request){

        try{
            $transHead = new TransactionHead();
            $transHead->title = $request->title;
            $transHead->kind = $request->kind;
            $transHead->save();
            return redirect()->back()->with('success', 'Created Successfully');
        }catch (QueryException $e){
            return redirect()->back()->with('error', 'Failed to store data in the database.');
        }
    }

    public function list(){
        $transHeads =  TransactionHead::all();
        return view('admin.pages.transaction.TransactionHeadList', ['transHeads' => $transHeads]);
    }

    public function edit($id){
        $transHead = TransactionHead::find($id);
        return view('admin.pages.transaction.TransactionHeadUpdate', ['transHead' => $transHead]);
    }

    public function update(Request $request, $id){

        try{
            $transHead =  TransactionHead::find($id);
            $transHead->title = $request->title;
            $transHead->kind = $request->kind;
            $transHead->update();
            return redirect()->back()->with('success', 'Updated Successfully');
        }catch (QueryException $e){
            return redirect()->back()->with('error', 'Failed to store data in the database.');
        }
    }


}
