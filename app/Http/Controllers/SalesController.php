<?php

namespace App\Http\Controllers;

use App\Http\Requests\SaleRequest;
use App\Models\Account;
use App\Models\Item;
use App\Models\Outward;
use App\Models\OutwardDetail;
use App\Models\SaleBook;
use App\Models\AccountLedger;
use Illuminate\Http\Request;

class SalesController extends Controller
{
    public function index(){
        $data = array(
            'title'     => 'Sale Book',
            'accounts'  => Account::latest()->get(),
            'items'     => Item::latest()->get(),
            'sales'     => SaleBook::with(['item', 'account'])->latest()->get(),
            'outwards'  => Outward::with(['item', 'account'])->latest()->get(),
            
            
        );
        return view('admin.sales_book.add_sale')->with($data);
    }

    public function store(SaleRequest $req){
        // dd($req->all());
        // if(check_empty($req->sale_id)){
        //     $sale = SaleBook::findOrFail(hashids_decode($req->sale_id));
        //     $msg  = 'Sale updated successfully';
        // }else{
        //     $sale = new SaleBook();
        //     $msg  = 'Sale added successfully';
        // }
        // dd(array_sum($req->bags));
        $outward = Outward::findOrFail(hashids_decode($req->sale_id));//sale id is outward id here
        $sale = new SaleBook();
        $sale->date            = $req->sale_date;
        $sale->gp_no           = $req->gp_no;
        $sale->item_id         = $outward->id;//item id is outward id
        $sale->account_id      = hashids_decode($req->account_name);
        $sale->sub_dealer_name = $req->sub_dealer_name;
        $sale->vehicle_no      = $req->vehicle_no;
        $sale->bag_rate        = $req->bags_value;
        $sale->no_of_bags      = array_sum($req->bags);
        $sale->commission      = $req->commission;
        $sale->discount        = $req->discount;
        $sale->fare            = $req->fare_value;
        $sale->net_ammount     = $req->net_value;
        $sale->remarks         = $req->remarks;
        $sale->bilty_no        = 0;
        $sale->fare_status     = $req->fare_status;
        $sale->save();
        
        //Account Ledger
        $accountledger = new AccountLedger();

        // $id = SaleBook::latest('created_at')->first();
        $id    = SaleBook::find($sale->id);
        $accountledger->account_id = hashids_decode($req->account_name);
        $accountledger->sale_id          = $id->id;
        $accountledger->purchase_id      = 0;
        $accountledger->cash_id          = 0;
        $accountledger->debit            = $req->net_value ;
        $accountledger->credit           = 0 ;
        $accountledger->description      = $req->vehicle_no . ' '.$req->begs;
        $accountledger->save();
    
        return response()->json([
            'success' => 'Sale added successfully',
            'redirect'  => route('admin.sales.index'),
        ]);


    }

    public function edit($id){
        $data = array(
            'title'     => 'Sale Book',
            'accounts'  => Account::latest()->get(),
            'items'     => Item::latest()->get(),
            // 'sales'     => SaleBook::with(['item', 'account'])->latest()->get(),
            'outwards'  => Outward::with(['item', 'account'])->latest()->get(),
            'edit_sale' => Outward::with(['outardDetails', 'outardDetails.item'])->where('id',hashids_decode($id))->first(),
            // 'edit_sale' => Outward::with(['item', 'account'])->where('id',hashids_decode($id))->latest()->get(),
            // 'item_detail' => OutwardDetail::with(['item',])->where('outward_id',hashids_decode($id))->latest()->get(),
            // 'item_count' => OutwardDetail::with(['item',])->where('outward_id',hashids_decode($id))->latest()->count(),
            'is_update' => true,
        );
        //dd($data['item_detail']);
        return view('admin.sales_book.add_sale')->with($data);
    }

    public function delete($id){
        SaleBook::destroy(hashids_decode($id));

        return response()->json([
            'success'   => 'Sale delted successfully',
            'reload'    => true,
        ]);
    }

    public function accountDetails($id){
        $account = Account::findOrFail(hashids_decode($id));
        return response()->json([
            'account'   => $account
        ]);
    }
}
