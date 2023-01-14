<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CashBook;
use App\Models\AccountLedger;
use App\Http\Requests\CashBookRequest;
use App\Models\Account;

class CashController extends Controller
{
    public function index(){
        $data = array(
            'title'     => 'Cash Book',
            'accounts'  => Account::latest()->get(),
            'cash' => CashBook::with(['account'])->latest()->get(),
            
        );
        return view('admin.cash_book.add_cash')->with($data);
    }

    public function add(){
        
    }

    public function store(CashBookRequest $req){
        
        if(check_empty($req->cash_id)){
            $cashbook = CashBook::findOrFail(hashids_decode($req->cash_id));
            $msg      = 'Cash Book udpated successfully';
        }else{
            $cashbook = new CashBook();
            $msg      = 'Cash Book added successfully';
        }
        
        // //check weather payment or receipt 
        if($req->receipt_ammount == null){
            $cashbook->receipt_ammount    = 0;
            $cashbook->payment_ammount    = $req->payment_ammount;
        }else{
            $cashbook->receipt_ammount    = $req->receipt_ammount;
            $cashbook->payment_ammount    = 0;
        }

        $cashbook->date               = $req->date;
        $cashbook->bil_no             = $req->bil_no;
        $cashbook->account_id         = hashids_decode($req->account_id);
        $cashbook->narration          = $req->narration;
        $cashbook->status             = $req->status;
        $cashbook->remarks            = $req->remarks;
        $cashbook->save();
        
        
        $account_detail = AccountLedger::where('account_id','=', hashids_decode($req->account_id))->latest()->get();


            
                if($req->receipt_ammount == null){
                    //Payment Received
                    $accountledger = new AccountLedger();

                    $pay_ammount = $req->payment_ammount;
                    $id = CashBook::latest('created_at')->first();
                    $accountledger->account_id = hashids_decode($req->account_id);
                    $accountledger->sale_id          = 0;
                    $accountledger->purchase_id             = 0;
                    $accountledger->cash_id             = $id->id;
                    $accountledger->debit            = 0;
                    $accountledger->credit          = $pay_ammount;
                    $accountledger->description            = $req->narration;
                    $accountledger->save();
                

                }else{
                    $accountledger = new AccountLedger();

                    $pay_ammount = $req->receipt_ammount;
                    $id = CashBook::latest('created_at')->first();
                    $accountledger->account_id = hashids_decode($req->account_id);
                    $accountledger->sale_id          = 0;
                    $accountledger->purchase_id      = 0;
                    $accountledger->cash_id          = $id->id;
                    $accountledger->debit            = $pay_ammount ;
                    $accountledger->credit           = 0 ;
                    $accountledger->description      = $req->narration;
                    $accountledger->save();
                
                }
            

        //Item::find(hashids_decode($req->item_id))->increment('stock_qty', $req->company_weight);//increment item stock
        
        return response()->json([
            'success'   => $msg,
            'redirect'    => route('admin.cash.index')
        ]);
    }

    public function edit(){
        $data = array(
            'title'     => 'Cash Book',
            'accounts'  => Account::latest()->get(),
            'cash' => CashBook::with(['account'])->latest()->get(),
            'edit_cash' => CashBook::findOrFail(hashids_decode($id)),
            'is_update'     => true
        );
        return view('admin.cash_book.add_cash')->with($data);
    }

    public function delete(){
        PurchaseBook::destroy(hashids_decode($id));
        return response()->json([
            'success'   => 'Purcahase deleted successfully',
            'reload'    => true
        ]);
    }
}
