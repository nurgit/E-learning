<?php

namespace App\Http\Controllers;

use App\Models\DeliveryModel;
use App\Models\SalesCreditModel;
use App\Models\SalesItemModel;
use App\Models\SalesModel;
use App\Models\SalesPaymentModel;
use Carbon\Carbon;
use Illuminate\Support\Facades\View;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        View::share('main_menu', 'Inicio');
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $data = [];
        $Total_sale = 0;
        $data['main_menu'] = "Inicio";
       
        return view('backend.home.index', $data);
    }
    
}
