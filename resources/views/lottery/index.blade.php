@extends('layouts.app')

@section('title','Lottery Numbers')

@section('content')
    <div class="container">
        @include('partials.alerts')

        <div class="card shadow border-0 rounded-4">
            <div
                class="card-header bg-gradient bg-primary text-white d-flex justify-content-between align-items-center rounded-top-4">
                <h5 class="mb-0">🎟️ Lottery List</h5>
                <button class="btn btn-light btn-sm fw-semibold shadow-sm"
                        data-bs-toggle="modal" data-bs-target="#addLotteryModal">
                    + Add Lottery
                </button>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table id="myTable" class="table table-hover table-bordered align-middle mb-0">
                        <thead class="table-primary text-dark">
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Number</th>
                            <th scope="col">Date</th>
                            <th scope="col" class="text-center">Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($lotteries as $lottery)
                            <tr>
                                <td class="fw-bold">{{ $lottery->id }}</td>
                                <td>{{ $lottery->number }}</td>
                                <td>{{ $lottery->created_at->format('jS M Y') }}</td>
                                <td class="text-center">
                                    <button class="btn btn-sm btn-outline-success rounded-pill px-3 me-1 viewBtn"
                                            data-id="{{ $lottery->id }}"
                                            data-number="{{ $lottery->number }}"
                                            data-bs-toggle="modal"
                                            data-bs-target="#viewLotteryModal">
                                        <i class="bi bi-eye"></i> View
                                    </button>
                                    <a href="{{route('deleteLottery' , ['id' => $lottery->id])}}"
                                       class="btn btn-sm btn-outline-danger rounded-pill px-3">
                                        <i class="bi bi-trash"></i> Delete
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    <div id="customPagination" class="custom-pagination"></div>
                </div>
            </div>
            <div class="card-footer text-muted small text-end">
                Updated: {{ now()->format('d M, Y h:i A') }}
            </div>
            <div class="modal fade" id="addLotteryModal" tabindex="-1" aria-labelledby="addLotteryModalLabel"
                 aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content rounded-4 shadow">
                        <div class="modal-header bg-info text-white rounded-top-4">
                            <h5 class="modal-title" id="addLotteryModalLabel">➕ Add Lottery Number</h5>
                            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                        </div>
                        <form action="{{route('saveLottery')}}" method="POST">
                            @csrf
                            <div class="modal-body">
                                <div class="mb-3">
                                    <label for="lotteryNumber" class="form-label">Lottery Number</label>
                                    <input type="number" class="form-control" id="addLotteryNumber" name="number"
                                           placeholder="Enter lottery number">
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                <button type="submit" class="btn btn-primary">Save Lottery</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="modal fade" id="viewLotteryModal" tabindex="-1" aria-labelledby="viewLotteryLabel"
                 aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header bg-info text-white">
                            <h5 class="modal-title" id="viewLotteryLabel">✏️ Edit Lottery</h5>
                            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                        </div>
                        <div class="modal-body">
                            <form id="editLotteryForm" action="{{route("saveLottery")}}" method="post">
                                @csrf
                                <div class="mb-3">
                                    {{--                                    <label class="form-label">Lottery ID</label>--}}
                                    <input type="text" class="form-control" id="lotteryId" name="id" readonly hidden>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Lottery Number</label>
                                    <input type="number" class="form-control" id="editLotteryNumber" name="number">
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel
                                    </button>
                                    <button type="submit" class="btn btn-primary">Save Lottery</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>


    </div>
@endsection
@section('scripts')
    <script>
        $(document).ready(function () {
            var table = $('#myTable').DataTable({
                paging: true,
                searching: false,
                info: false,
                ordering: true,
                lengthChange: false,
                pageLength: 12,
                dom: 't',
                order: [[0, 'desc']]
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
