<?php

namespace App\Http\Controllers;

use App\Models\Lottery;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function home(){
        $latestLotteries = Lottery::orderBy('created_at', 'desc')->take(3)->get();
        $oldLotteries = Lottery::orderBy('created_at', 'desc')->skip(3)->take(100)->get();
        return view('home.index',['latestLottries'=>$latestLotteries,'oldLotteries'=>$oldLotteries]);
    }
}
