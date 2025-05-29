@extends('layouts.main')

@section('title', 'Buat Antrian')

@section('content')
<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h3 class="text-center mb-0">Buat Antrian</h3>
                </div>
                <div class="card-body">
                    {{-- Alert untuk error --}}
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <strong>Oops!</strong> Ada masalah dengan input Anda:
                            <ul class="mb-0 mt-2">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    {{-- Alert untuk success --}}
                    @if (session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif

                    <form action="{{ route('antrian.store') }}" method="POST" id="antrianForm">
                        @csrf
                        
                        <div class="row">
                            {{-- Nama Lengkap - READONLY --}}
                            <div class="col-md-6 mb-3">
                                <label for="name" class="form-label">Nama Lengkap</label>
                                <input type="text" 
                                       class="form-control readonly-input" 
                                       id="name" 
                                       name="name" 
                                       value="{{ old('name', Auth::user()->name) }}" 
                                       readonly 
                                       tabindex="-1">
                            </div>

                            {{-- Nomor HP - READONLY --}}
                            <div class="col-md-6 mb-3">
                                <label for="phone" class="form-label">Nomor HP</label>
                                <input type="text" 
                                       class="form-control readonly-input" 
                                       id="phone" 
                                       name="phone" 
                                       value="{{ old('phone', Auth::user()->phone) }}" 
                                       readonly 
                                       tabindex="-1">
                            </div>
                        </div>

                        <div class="row">
                            {{-- Jenis Kelamin - READONLY --}}
                            <div class="col-md-6 mb-3">
                                <label for="gender" class="form-label">Jenis Kelamin</label>
                                <input type="text" 
                                       class="form-control readonly-input" 
                                       id="gender" 
                                       name="gender" 
                                       value="{{ old('gender', Auth::user()->gender) }}" 
                                       readonly 
                                       tabindex="-1">
                            </div>

                            {{-- Poli - EDITABLE --}}
                            <div class="col-md-6 mb-3">
                                <label for="poli" class="form-label">Poli</label>
                                <select class="form-select @error('poli') is-invalid @enderror" 
                                        id="poli" 
                                        name="poli" 
                                        required>
                                    <option value="">-- Pilih Poli --</option>
                                    @foreach($poli as $p)
                                        <option value="{{ $p->nama }}" 
                                                {{ old('poli') == $p->nama ? 'selected' : '' }}>
                                            {{ $p->nama }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('poli')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="row">
                            {{-- Dokter - EDITABLE --}}
                            <div class="col-md-6 mb-3">
                                <label for="doctor_id" class="form-label">Dokter</label>
                                <select class="form-select @error('doctor_id') is-invalid @enderror" 
                                        id="doctor_id" 
                                        name="doctor_id" 
                                        required>
                                    <option value="">-- Pilih Dokter --</option>
                                    @foreach($doctors as $doctor)
                                        <option value="{{ $doctor->doctor_id }}" 
                                                data-specialization="{{ $doctor->spesialisasi }}"
                                                {{ old('doctor_id') == $doctor->doctor_id ? 'selected' : '' }}>
                                            {{ $doctor->nama }} - {{ $doctor->spesialisasi }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('doctor_id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            {{-- Tanggal Antrian - EDITABLE --}}
                            <div class="col-md-6 mb-3">
                                <label for="tanggal" class="form-label">Tanggal Antrian</label>
                                <input type="date" 
                                       class="form-control @error('tanggal') is-invalid @enderror" 
                                       id="tanggal" 
                                       name="tanggal" 
                                       value="{{ old('tanggal') }}" 
                                       min="{{ date('Y-m-d') }}"
                                       required>
                                @error('tanggal')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        {{-- Submit Button --}}
                        <div class="d-grid mt-4">
                            <button type="submit" class="btn btn-primary btn-lg" id="submitBtn">
                                <i class="fas fa-plus-circle me-2"></i>Buat Antrian
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- 🔧 CSS UNTUK READONLY STYLING --}}
<style>
    /* Readonly Input Styling */
    .readonly-input {
        background-color: #e9ecef !important; /* Warna gelap/abu-abu */
        color: #6c757d !important;            /* Text abu-abu */
        border-color: #ced4da !important;     /* Border abu-abu */
        cursor: not-allowed !important;       /* Cursor tidak bisa klik */
        opacity: 0.8;                         /* Sedikit transparan */
        font-weight: 500;                     /* Text agak tebal */
        box-shadow: none !important;          /* Hilangkan shadow */
        pointer-events: none;                 /* Tidak bisa diklik sama sekali */
    }


{{-- 🔧 JAVASCRIPT untuk disable interaksi readonly --}}
<script>
document.addEventListener('DOMContentLoaded', function() {
    const doctorSelect = document.getElementById('doctor_id');
    const form = document.getElementById('antrianForm');
    const submitBtn = document.getElementById('submitBtn');

    // Disable semua readonly input
    const readonlyInputs = document.querySelectorAll('.readonly-input');
    
    readonlyInputs.forEach(function(input) {
        // Disable semua event
        input.addEventListener('click', function(e) {
            e.preventDefault();
            return false;
        });
        
        input.addEventListener('focus', function(e) {
            e.preventDefault();
            this.blur();
            return false;
        });
        
        input.addEventListener('keydown', function(e) {
            e.preventDefault();
            return false;
        });
        
        input.addEventListener('mousedown', function(e) {
            e.preventDefault();
            return false;
        });
    });

    // Show doctor specialization when selected
    doctorSelect.addEventListener('change', function() {
        const selectedOption = this.options[this.selectedIndex];
        if (selectedOption.value) {
            const specialization = selectedOption.getAttribute('data-specialization');
            console.log('Dokter dipilih:', selectedOption.text, '- Spesialisasi:', specialization);
        }
    });

    // Prevent double submission
    form.addEventListener('submit', function() {
        submitBtn.disabled = true;
        submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i>Memproses...';
    });

    // Set minimum date untuk tanggal antrian
    const tanggalInput = document.getElementById('tanggal');
    if (tanggalInput) {
        const today = new Date().toISOString().split('T')[0];
        tanggalInput.setAttribute('min', today);
    }
});
</script>
@endsection