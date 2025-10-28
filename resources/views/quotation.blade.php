@extends('layouts.app')

@section('title', 'Get a Quote')

@push('styles')
    {{-- We can add minimal styles here if needed, but we'll rely on Bootstrap for now --}}
@endpush

@section('content')
<div class="container my-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-sm">
                <div class="card-header">
                    <h2 class="mb-0">Get Your Free Quote</h2>
                </div>
                <div class="card-body">
                    <form id="quoteForm" enctype="multipart/form-data">
                        @csrf
                        {{-- Name and Email Fields --}}
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="name" class="form-label">Your Name</label>
                                <input type="text" class="form-control" id="name" name="name" required>
                            </div>
                            <div class="col-md-6">
                                <label for="email" class="form-label">Your Email</label>
                                <input type="email" class="form-control" id="email" name="email" required>
                            </div>
                        </div>

                        {{-- File Upload Field --}}
                        <div class="mb-3">
                            <label for="document" class="form-label">Upload Your Document</label>
                            <input class="form-control" type="file" id="document" name="file" required>
                            <div id="file-error" class="text-danger mt-1 small"></div>
                        </div>
                        
                        {{-- Message Field --}}
                        <div class="mb-3">
                            <label for="message" class="form-label">Additional Message (Optional)</label>
                            <textarea class="form-control" id="message" name="message" rows="3"></textarea>
                        </div>
                        
                        {{-- Progress Bar and Status Messages --}}
                        <div id="upload-status" class="mt-3"></div>
                        <div class="progress mt-2" style="display: none;">
                            <div id="progress-bar" class="progress-bar" role="progressbar" style="width: 0%;" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100">0%</div>
                        </div>
                        
                        <hr class="my-4">

                        <button type="submit" id="submit-button" class="btn btn-primary w-100">Submit Quote Request</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
    <script type="module" src="{{ asset('js/quotation.js') }}" defer></script>
@endpush