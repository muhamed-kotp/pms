@extends('dachboard.layouts.app')

@section('title')
    Edit Quality
@endsection

@section('content')
    <div class="container">
        <form class="edit_quality main_form" method="POST" action="{{ route('qualities.update', $quality->id) }}"
            enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="mb-3 w-100">
                <label for="qualityNameEn" class="form-label">English Quality Name</label>
                <input type="text" class="form-control" id="qualityNameEn" name="name_en"
                    value="{{ old('name_en', $quality->name_en) }}">
                <span class="error-message text-danger" id="qualityNameEnError" style="display:none;">English Name is
                    required.</span>
            </div>
            <div class="mb-3 w-100">
                <label for="qualityNameAr" class="form-label">Arabic Quality Name</label>
                <input type="text" class="form-control" id="qualityNameAr" name="name_ar"
                    value="{{ old('name_ar', $quality->name_ar) }}">
                <span class="error-message text-danger" id="qualityNameArError" style="display:none;">Arabic Name is
                    required.</span>
            </div>

            <div class="d-flex justify-content-center">
                <button type="submit" class="btn btn-outline-success">Update</button>
            </div>
        </form>
    </div>
@endsection

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const form = document.querySelector('.edit_quality');
            const nameEn = document.querySelector('#qualityNameEn');
            const nameAr = document.querySelector('#qualityNameAr');

            const nameEnError = document.getElementById('qualityNameEnError');
            const nameArError = document.getElementById('qualityNameArError');

            form.addEventListener('submit', function(e) {
                let valid = true;

                // Validate English Name
                if (nameEn.value.trim() === '') {
                    nameEnError.style.display = 'block';
                    valid = false;
                } else {
                    nameEnError.style.display = 'none';
                }

                // Validate Arabic Name
                if (nameAr.value.trim() === '') {
                    nameArError.style.display = 'block';
                    valid = false;
                } else {
                    nameArError.style.display = 'none';
                }

                // Prevent form subquality if validation fails
                if (!valid) {
                    e.preventDefault();
                }
            });

            // Hide error message when user starts typing
            nameEn.addEventListener('input', function() {
                if (nameEn.value.trim() !== '') {
                    nameEnError.style.display = 'none';
                }
            });

            nameAr.addEventListener('input', function() {
                if (nameAr.value.trim() !== '') {
                    nameArError.style.display = 'none';
                }
            });

        });
    </script>
@endpush
