@extends('layouts.app')

@section('title','Lottery Numbers')

@section('content')
    <div class="container">
        <h2 class="mb-3">Lottery Numbers</h2>

        {{-- ✅ Bootstrap Toast for success --}}
        @if(session('success'))
            <div class="toast-container position-fixed top-0 end-0 p-3" style="z-index: 1055">
                <div id="successToast" class="toast align-items-center text-bg-success border-0" role="alert" aria-live="assertive" aria-atomic="true">
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

        {{-- ✅ Bootstrap Toast for error --}}
        @if(session('error'))
            <div class="toast-container position-fixed top-0 end-0 p-3" style="z-index: 1055">
                <div id="errorToast" class="toast align-items-center text-bg-danger border-0" role="alert" aria-live="assertive" aria-atomic="true">
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

        <ul class="list-group mb-4">
            @forelse($lotteries as $lottery)
                <li class="list-group-item">{{ $lottery->number }}</li>
            @empty
                <li class="list-group-item">No lottery numbers yet.</li>
            @endforelse
        </ul>

        @auth
            <div class="card">
                <div class="card-body">
                    <h5>Add New Lottery Number</h5>
                    <form method="POST" action="{{ route('lottery.store') }}">
                        @csrf
                        <div class="mb-3">
                            <input type="text" name="number" class="form-control" placeholder="Enter lottery number" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Add</button>
                    </form>
                </div>
            </div>
        @else
            <p><a href="{{ route('login') }}">Login</a> to add new lottery numbers.</p>
        @endauth
    </div>
@endsection

@section('scripts')
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            // success toast
            var successToastEl = document.getElementById('successToast');
            if (successToastEl) {
                var successToast = new bootstrap.Toast(successToastEl, { delay: 5000 });
                successToast.show();
            }

            // error toast
            var errorToastEl = document.getElementById('errorToast');
            if (errorToastEl) {
                var errorToast = new bootstrap.Toast(errorToastEl, { delay: 5000 });
                errorToast.show();
            }
        });
    </script>
@endsection
