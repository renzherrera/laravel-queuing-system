<?php

namespace App\Http\Controllers;

use App\Models\Queue;
use Carbon\Carbon;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
      
        $todayQueuesCount = Queue::select('queue_id', 'created_at')
        ->where('created_at','>=',Carbon::today())
        ->count();

        $todayServedCount = Queue::select('queue_id', 'created_at')
        ->where('served','!=',null)
        ->where('missed','=',false)
        ->where('created_at','>=',Carbon::today())
        ->count();

        $todayMissedCount = Queue::select('queue_id', 'created_at')
        ->where('served','=',null)
        ->where('missed','=',true)
        ->where('created_at','>=',Carbon::today())
        ->count();
       

        $queues = Queue::select('queue_id', 'created_at')
        ->get()
        ->groupBy(function($date) {
            //return Carbon::parse($date->created_at)->format('Y'); // grouping by years
            return Carbon::parse($date->created_at)->format('m'); // grouping by months
        });
        
        $queuesmcount = [];
        $queueArr = [0,0,0,0,0,0,0,0,0,0,0,0];
        
        foreach ($queues as $key => $value) {
            $queuesmcount[(int)$key] = count($value);
        }
        
        for($i = 1; $i <= 12; $i++){
            if(!empty($queuesmcount[$i])){
                $queueArr[$i -1] = $queuesmcount[$i];    
            }else{
                $queueArr[$i] = 0;    
            }
        }


        //SERVED

        $queuesServed = Queue::select('queue_id', 'created_at')
        ->where('served','!=', null)
        ->where('missed','=', 0)
        ->get()
        ->groupBy(function($date) {
            //return Carbon::parse($date->created_at)->format('Y'); // grouping by years
            return Carbon::parse($date->created_at)->format('m'); // grouping by months
        });
        
        $servedmcount = [];
        $servedArr = [0,0,0,0,0,0,0,0,0,0,0,0];
        
        foreach ($queuesServed as $key => $value) {
            $servedmcount[(int)$key] = count($value);
        }
        
        for($i = 1; $i <= 12; $i++){
            if(!empty($servedmcount[$i])){
                $servedArr[$i -1] = $servedmcount[$i];    
            }else{
                $servedArr[$i] = 0;    
            }
        }




         //MISSED

         $queuesMissed = Queue::select('queue_id', 'created_at')
         ->where('served','=', null)
         ->where('missed','=', 1)
         ->get()
         ->groupBy(function($date) {
             //return Carbon::parse($date->created_at)->format('Y'); // grouping by years
             return Carbon::parse($date->created_at)->format('m'); // grouping by months
         });
         
         $missedmcount = [];
         $missedArr = [0,0,0,0,0,0,0,0,0,0,0,0];
         
         foreach ($queuesMissed as $key => $value) {
             $missedmcount[(int)$key] = count($value);
         }
         
         for($i = 1; $i <= 12; $i++){
             if(!empty($missedmcount[$i])){
                 $missedArr[$i -1] = $missedmcount[$i];    
             }else{
                 $missedArr[$i] = 0;    
             }
         }
        return view('home',compact('queueArr','servedArr','missedArr','todayQueuesCount','todayServedCount','todayMissedCount'));
    }

    public function barChart(){
     

    }
}
