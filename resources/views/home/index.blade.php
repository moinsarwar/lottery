@extends('layouts.home')
@section('content')
    <div class="container">
        {{--    <section class="hero">--}}
        {{--        <h1>Today's Lottery Results</h1>--}}
        {{--        <p>Check the latest winning numbers and see if you've hit the jackpot!</p>--}}
        {{--    </section>--}}

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
        <div id="result-container"></div>

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
            <table id="myTable" class="dark-table">
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
                        <td>
                            @foreach(str_split($oldlottery->number) as $digit)
                                <span class="number-ball2">{{ $digit }}</span>
                            @endforeach
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            <div id="customPagination" class="custom-pagination"></div>
        </section>

    </div>

    <footer>
        <div class="container">
            <p>&copy; <span id="year"></span> Paradise Lottery. All rights reserved. Play responsibly.</p>
        </div>
    </footer>
@endsection

@section('script')
    <script>
        $(document).ready(function () {
            var table = $('#myTable').DataTable({
                paging: true,
                searching: false,
                info: false,
                ordering: false,
                lengthChange: false,
                pageLength: 5,
                dom: 't'
            });

            function updatePagination(table) {
                var info = table.page.info();
                var currentPage = info.page;
                var totalPages = info.pages;
                var html = '';
                if (currentPage > 0) {
                    html += `<button class="page-btn" data-page="${currentPage - 1}">Previous</button>`;
                }
                if (currentPage > 2) {
                    html += `<button class="page-btn" data-page="0">1</button>`;
                    if (currentPage > 3) {
                        html += `<span class="dots">...</span>`;
                    }
                }
                var start = Math.max(0, currentPage - 1);
                var end = Math.min(totalPages - 1, currentPage + 1);
                for (var i = start; i <= end; i++) {
                    html += `<button class="page-btn ${i === currentPage ? 'active' : ''}" data-page="${i}">${i + 1}</button>`;
                }
                if (currentPage < totalPages - 3) {
                    html += `<span class="dots">...</span>`;
                    html += `<button class="page-btn" data-page="${totalPages - 1}">${totalPages}</button>`;
                }
                if (currentPage < totalPages - 1) {
                    html += `<button class="page-btn" data-page="${currentPage + 1}">Next</button>`;
                }
                $('#customPagination').html(html);
                var showing = (currentPage + 1) * info.length;
                if (showing > info.recordsTotal) showing = info.recordsTotal;
                $('#resultCount').text(`Showing ${showing} of ${info.recordsTotal} results`);
            }

            updatePagination(table);
            $('#customPagination').on('click', '.page-btn', function () {
                var page = $(this).data('page');
                table.page(page).draw('page');
                updatePagination(table);
            });
        });
    </script>

@endsection
