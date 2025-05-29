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
                            {{-- Nama Lengkap --}}
                            <div class="col-md-6 mb-3">
                                <label for="name" class="form-label">Nama Lengkap</label>
                                <input type="text" 
                                       class="form-control @error('name') is-invalid @enderror" 
                                       id="name" 
                                       name="name" 
                                       value="{{ old('name', Auth::user()->name) }}" 
                                       required>
                                @error('name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            {{-- Nomor HP --}}
                            <div class="col-md-6 mb-3">
                                <label for="phone" class="form-label">Nomor HP</label>
                                <input type="text" 
                                       class="form-control @error('phone') is-invalid @enderror" 
                                       id="phone" 
                                       name="phone" 
                                       value="{{ old('phone', Auth::user()->phone) }}" 
                                       required>
                                @error('phone')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="row">
                            {{-- Jenis Kelamin --}}
                            <div class="col-md-6 mb-3">
                                <label for="gender" class="form-label">Jenis Kelamin</label>
                                <select class="form-select @error('gender') is-invalid @enderror" 
                                        id="gender" 
                                        name="gender" 
                                        required>
                                    <option value="">-- Pilih Jenis Kelamin --</option>
                                    <option value="Laki-laki" 
                                            {{ old('gender', Auth::user()->gender) == 'Laki-laki' ? 'selected' : '' }}>
                                        Laki-laki
                                    </option>
                                    <option value="Perempuan" 
                                            {{ old('gender', Auth::user()->gender) == 'Perempuan' ? 'selected' : '' }}>
                                        Perempuan
                                    </option>
                                </select>
                                @error('gender')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            {{-- Poli --}}
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
                            {{-- Dokter --}}
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

                            {{-- Tanggal Antrian --}}
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

{{-- JavaScript sederhana --}}
<script>
document.addEventListener('DOMContentLoaded', function() {
    const doctorSelect = document.getElementById('doctor_id');
    const form = document.getElementById('antrianForm');
    const submitBtn = document.getElementById('submitBtn');

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
});
</script>
@endsection