<?php

namespace App\Http\Controllers;

use App\Models\Lottery;
use Carbon\Carbon;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function home(){
        $today = Carbon::today()->toDateString();
        $todayLottery = Lottery::whereDate('created_at', $today)->first();
        if (!$todayLottery) {
            $todayLottery = new \stdClass();
            $todayLottery->number = '0000';
        }
        $latestLotteries = Lottery::whereDate('created_at', '<', $today)->orderBy('created_at', 'desc')->take(3)->get();
        $oldLotteries = Lottery::orderBy('created_at', 'desc')->skip(3)->take(PHP_INT_MAX)->get();
        return view('home.index',['latestLottries'=>$latestLotteries,'oldLotteries'=>$oldLotteries , 'todayLottery'=>$todayLottery]);
    }
}
