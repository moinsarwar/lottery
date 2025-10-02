{{-- ✅ Success Toast --}}
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

{{-- ✅ Error Toast --}}
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
