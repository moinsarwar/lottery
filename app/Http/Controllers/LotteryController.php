<?php

// app/Http/Controllers/LotteryController.php
namespace App\Http\Controllers;

use App\Models\Lottery;
use Illuminate\Http\Request;

class LotteryController extends Controller
{
    // show all lottery numbers
    public function index()
    {
        $lotteries = Lottery::all();
        return view('lottery.index', compact('lotteries'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'number' => 'required|string|max:255'
        ]);

        if ($request->id) {
            $lotteryNumber = Lottery::find($request->id);
            if (!$lotteryNumber) {
                return redirect()->back()->with('error', 'Lottery not found!');
            }
            $lotteryNumber->number = $request->number;
            $lotteryNumber->save();
            return redirect()->back()->with('success', 'Lottery number updated!');
        }
        else {
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

    public function delete($id){
        Lottery::destroy($id);
        return redirect()->back()->with('success', 'Lottery number deleted!');
    }

}
