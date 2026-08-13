<?php

namespace App\Http\Controllers;

use App\Models\Sale;
use App\Models\SaleDetail;
use Illuminate\Http\Request;

class ListSaleController extends Controller
{
    public function saleList(){
        $saleList = Sale::orderBy('sale_id','asc')->paginate(10);

        return view('sales.saleList', compact('saleList'));
    }
    public function saleDetailList(){
        $saleDetailLists = SaleDetail::orderBy('saleDetail_id','asc')->paginate(6);
        return view('sales.saleDetailList',compact('saleDetailLists'));
    }
}
