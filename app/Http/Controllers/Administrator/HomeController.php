<?php

namespace App\Http\Controllers\Administrator;

use App\Http\Controllers\Administrator\AdminController;
use App\Models\Consumption;
use App\Models\SaleBook;
use App\Models\PurchaseBook;

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;

class HomeController extends AdminController
{
    public function index()
    {   

        $sale = SaleBook::select(DB::raw("COUNT(*) as count, Month(date) as month, SUM(no_of_bags) as bag"))
                ->whereYear('date', date('Y'))
                ->groupBy(DB::raw("Month(date)"))
                ->get();

        $consumption = Consumption::select(DB::raw("COUNT(*) as count, Month(date) as month, SUM(qunantity) as qty"))
        ->whereYear('date', date('Y'))
        ->groupBy(DB::raw("Month(date)"))
        ->get();
        
        
        // dd($sale->pluck('month'));
        // $sale_months = SaleBook::select(DB::raw("Month(date) as month"))
        //             ->whereYear('date', date('Y'))
        //             ->groupBy(DB::raw("Month(date)"))
        //             ->pluck('month');
        // $sale_array =  array();
        $sale_array     = [0,0,0,0,0,0,0,0,0,0,0,0];
        $sale_bag_array = [0,0,0,0,0,0,0,0,0,0,0,0];
        $consumption_array     = [0,0,0,0,0,0,0,0,0,0,0,0];
        $consumption_qty = [0,0,0,0,0,0,0,0,0,0,0,0];
        

        foreach($sale->pluck('month') AS $index=>$month){
            $sale_array[$month-1]     = $sale->pluck('count')[$index];
            $sale_bag_array[$month-1] = intVal($sale->pluck('bag')[$index]);
        }

        foreach($consumption->pluck('month') AS $index=>$month){
            $consumption_array[$month-1]     = $consumption->pluck('count')[$index];
            $consumption_qty[$month-1] = intVal($consumption->pluck('qty')[$index]);
        }
        $month = date('m');
        $data = array(
            "title"     => "Dashboad",
            'sale'      => $sale_array,
            'sale_bags' => $sale_bag_array,
            'consumption' => $consumption_array,
            'consumption_qty' =>   $consumption_qty,
            'total_sales' => SaleBook::with(['item', 'account'])->whereMonth('created_at', '=', $month)->orderBy('created_at', 'desc')->take(10)->latest()->get(),
            'total_purchases' => PurchaseBook::with(['item', 'account'])->whereMonth('created_at', '=', $month)->orderBy('created_at', 'desc')->take(10)->latest()->get(),

        );
       
        return view('admin.home')->with($data);
    }

}
