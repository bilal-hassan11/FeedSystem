<?php

namespace App\Http\Controllers;

use App\Http\Requests\PurchaseRequest;
use App\Models\Account;
use App\Models\Inward;
use App\Models\Item;
use App\Models\PurchaseBook;
use App\Models\AccountLedger;

use Illuminate\Http\Request;

class PurchaseController extends Controller
{
    public function index(){
        $data = array(
            'title'     => 'Purchase Book',
            'accounts'  => Account::latest()->get(),
            'items'     => Item::latest()->get(),
            // 'purchases' => PurchaseBook::with(['account', 'item'])->latest()->get(),
            'inwards'   => Inward::with(['account', 'item'])->latest()->get(),
        );
        return view('admin.purchase_book.add_purchase')->with($data);
    }

    public function add(){
        
    }

    public function store(PurchaseRequest $req){
        
        if(check_empty($req->purchase_id)){
            $purchase = PurchaseBook::findOrFail(hashids_decode($req->purchase_id));
            $msg      = 'Purchase udpated successfully';
        }else{
            $purchase = new PurchaseBook();
            $msg      = 'Purchase added successfully';
        }
        // dd($req->all());
        $purchase->date              = $req->purchase_date;
        $purchase->vehicle_no        = $req->vehicle_no;
        $purchase->bilty_no          = $req->bilty_no;
        $purchase->pro_inv_no        = $req->prod_inv_no;
        $purchase->account_id        = hashids_decode($req->account_id);
        $purchase->item_id           = hashids_decode($req->item_id);
        $purchase->company_weight    = $req->company_weight;
        $purchase->party_weight      = $req->party_weight;
        $purchase->weight_difference = $req->weight_difference;
        $purchase->posted_weight     = $req->posted_weight;
        $purchase->bag_rate          = $req->rate;
        $purchase->fare              = $req->fare;
        $purchase->net_ammount       = $req->net_ammount;
        $purchase->remarks           = $req->remarks;
        $purchase->save();
        
        //Account Ledger
        $accountledger = new AccountLedger();

        $id = PurchaseBook::latest('created_at')->first();
        $accountledger->account_id = hashids_decode($req->account_id);
        $accountledger->sale_id          = 0;
        $accountledger->purchase_id      = $id->id;
        $accountledger->cash_id          = 0;
        $accountledger->debit            = 0;
        $accountledger->credit           = $req->net_ammount ;
        $accountledger->description      = $req->vehicle_no . ' '.$req->remarks;
        $accountledger->save();
    
        Item::find(hashids_decode($req->item_id))->increment('stock_qty', $req->company_weight);//increment item stock
        
        return response()->json([
            'success'   => $msg,
            'redirect'    => route('admin.purchases.index')
        ]);
        
    }

    public function edit($id){
        $data = array(
            'title'     => 'Purchase Book',
            'accounts'  => Account::latest()->get(),
            'items'     => Item::latest()->get(),
            'purchases' => PurchaseBook::with(['account', 'item'])->latest()->get(),
            'edit_purchase' => PurchaseBook::findOrFail(hashids_decode($id)),
            'inwards'   => Inward::with(['account', 'item'])->latest()->get(),
            'is_update'     => true
        );
        return view('admin.purchase_book.add_purchase')->with($data);
    }

    public function delete($id){
        PurchaseBook::destroy(hashids_decode($id));
        return response()->json([
            'success'   => 'Purcahase deleted successfully',
            'reload'    => true
        ]);
    }
}
