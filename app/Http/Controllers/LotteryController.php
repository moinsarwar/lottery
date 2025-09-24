<?php

// app/Http/Controllers/LotteryController.php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Lottery;

class LotteryController extends Controller
{
    // show all lottery numbers
    public function index()
    {
        $lotteries = Lottery::latest()->get();
        return view('lottery.index', compact('lotteries'));
    }

    // store new number (only for logged in users)
    public function store(Request $request)
    {
        $request->validate([
            'number' => 'required|string|max:255'
        ]);

        $exists = Lottery::whereDate('created_at', today())->exists();

        if ($exists) {
            return redirect()->back()->with('error', 'A lottery number has already been added for today.');
        }

        Lottery::create([
            'number' => $request->number
        ]);

        return redirect()->back()->with('success', 'Lottery number added!');
    }

}
