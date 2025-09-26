@extends('layouts.home')
@section('content')
<div class="container">
    <section class="hero">
        <h1>Today's Lottery Results</h1>
        <p>Check the latest winning numbers and see if you've hit the jackpot!</p>
    </section>

    <section class="timer-section">
        <h2>Next Draw In:</h2>
        <div id="countdown">
            <div class="countdown-unit">
                <div class="countdown-value" id="hours">00</div>
                <div class="countdown-label">Hours</div>
            </div>
            <div class="countdown-unit">
                <div class="countdown-value" id="minutes">00</div>
                <div class="countdown-label">Minutes</div>
            </div>
            <div class="countdown-unit">
                <div class="countdown-value" id="seconds">00</div>
                <div class="countdown-label">Seconds</div>
            </div>
        </div>
    </section>

    <section class="results-section">
        <h2>Latest Winning Numbers</h2>

        @foreach($latestLottries as $latestLottery)
            <div class="draw-date">
                Draw Date: {{ \Carbon\Carbon::parse($latestLottery->created_at)->format('M d, Y') }}
            </div>

            <div class="numbers-display">
                @foreach(str_split($latestLottery->number) as $digit)
                    <div class="number-ball">{{ $digit }}</div>
                @endforeach
            </div>
        @endforeach

        <p>If you have the winning numbers, claim your prize within 3 days.</p>
    </section>
    <section class="results-section">
        <h2>Previous Records</h2>
        <table class="dark-table">
            <thead>
            <tr>
                <th>Draw Date</th>
                <th>Number</th>
            </tr>
            </thead>
            <tbody>
            @foreach($oldLotteries as $oldlottery)
                <tr>
                    <td>{{ $oldlottery->created_at->format('M d, Y') }}</td>
                    <td >
                        @foreach(str_split($oldlottery->number) as $digit)
                            <span class="number-ball2">{{ $digit }}</span>
                        @endforeach
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </section>

</div>

<footer>
    <div class="container">
        <p>&copy; <span id="year"></span> Paradise Lottery. All rights reserved. Play responsibly.</p>
    </div>
</footer>

@endsection
