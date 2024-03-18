<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Order;
use DateTime;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function AllReports(){

        return view('backend.report.report_view');
    }

    public function ReportByDate(Request $req){


        //return $req->all();
        $date = new DateTime($req->date);
        $formatDate = $date->format('d F Y');

        $orders = Order::where('order_date',$formatDate)->latest()->get();
        return view('backend.report.report_show',compact('orders'));
    }

    public function ReportByMonth(Request $req){


        $orders = Order::where('order_month',$req->month)->where('order_year',$req->year_name)->latest()->get();
        return view('backend.report.report_show',compact('orders'));
    }

    public function ReportByYear(Request $req){


        $orders = Order::where('order_year',$req->year)->latest()->get();
        return view('backend.report.report_show',compact('orders'));
    }
}
