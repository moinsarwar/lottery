@extends('layouts.app')

@section('title','Lottery Numbers')

@section('content')
    <div class="container">
        @if(session('success'))
            <div class="toast-container position-fixed top-0 end-0 p-3" style="z-index: 1055">
                <div id="successToast" class="toast align-items-center text-bg-success border-0" role="alert"
                     aria-live="assertive" aria-atomic="true">
                    <div class="d-flex">
                        <div class="toast-body">
                            {{ session('success') }}
                        </div>
                        <button type="button" class="btn-close btn-close-white me-2 m-auto"
                                data-bs-dismiss="toast" aria-label="Close"></button>
                    </div>
                </div>
            </div>
        @endif
        {{-- ✅ Validation errors --}}
        @if ($errors->any())
            <div class="toast-container position-fixed top-0 end-0 p-3" style="z-index: 1055">
                @foreach ($errors->all() as $error)
                    <div class="toast align-items-center text-bg-danger border-0 mb-2" role="alert"
                         aria-live="assertive" aria-atomic="true">
                        <div class="d-flex">
                            <div class="toast-body">
                                {{ $error }}
                            </div>
                            <button type="button" class="btn-close btn-close-white me-2 m-auto"
                                    data-bs-dismiss="toast" aria-label="Close"></button>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif

        {{-- ✅ Bootstrap Toast for error --}}
        @if(session('error'))
            <div class="toast-container position-fixed top-0 end-0 p-3" style="z-index: 1055">
                <div id="errorToast" class="toast align-items-center text-bg-danger border-0" role="alert"
                     aria-live="assertive" aria-atomic="true">
                    <div class="d-flex">
                        <div class="toast-body">
                            {{ session('error') }}
                        </div>
                        <button type="button" class="btn-close btn-close-white me-2 m-auto"
                                data-bs-dismiss="toast" aria-label="Close"></button>
                    </div>
                </div>
            </div>
        @endif
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
                    <table id="mytable" class="table table-hover table-bordered align-middle mb-0">
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
        document.addEventListener("DOMContentLoaded", function () {
            // success toast
            var successToastEl = document.getElementById('successToast');
            if (successToastEl) {
                var successToast = new bootstrap.Toast(successToastEl, {delay: 5000});
                successToast.show();
            }

            // error toast
            var errorToastEl = document.getElementById('errorToast');
            if (errorToastEl) {
                var errorToast = new bootstrap.Toast(errorToastEl, {delay: 5000});
                errorToast.show();
            }
        });
        document.querySelectorAll('.toast.text-bg-danger').forEach(toastEl => {
            let toast = new bootstrap.Toast(toastEl, {delay: 5000});
            toast.show();
        });
    </script>
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            document.querySelectorAll(".viewBtn").forEach(btn => {
                btn.addEventListener("click", function () {
                    let id = this.dataset.id;
                    let number = this.dataset.number;
                    document.getElementById("lotteryId").value = id;
                    document.getElementById("editLotteryNumber").value = number;
                });
            });
        });
    </script>
@endsection
