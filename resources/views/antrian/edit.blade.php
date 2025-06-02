@extends('layouts.main')

@section('title', 'Edit Antrian')

@section('content')
<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header bg-primary text-white">
                    <h3 class="text-center mb-0">Edit Antrian</h3>
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

                    <form action="{{ route('antrian.update', $antrian->id) }}" method="POST" id="editAntrianForm">
                        @csrf
                        @method('PUT')
                        
                        {{-- Nomor Antrian - READONLY --}}
                        <div class="row">
                            <div class="col-md-12 mb-3">
                                <label for="no_antrian" class="form-label">Nomor Antrian</label>
                                <input type="text" 
                                       class="form-control readonly-input" 
                                       id="no_antrian" 
                                       value="{{ $antrian->no_antrian }}" 
                                       readonly 
                                       tabindex="-1">
                            </div>
                        </div>

                        {{-- Nama Lengkap dan Nomor HP --}}
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="name" class="form-label">Nama Lengkap</label>
                                <input type="text" 
                                       class="form-control readonly-input" 
                                       id="name" 
                                       name="name" 
                                       value="{{ old('name', $antrian->name) }}" 
                                       readonly 
                                       tabindex="-1">
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="phone" class="form-label">Nomor HP</label>
                                <input type="text" 
                                       class="form-control readonly-input" 
                                       id="phone" 
                                       name="phone" 
                                       value="{{ old('phone', $antrian->phone) }}" 
                                       readonly 
                                       tabindex="-1">
                            </div>
                        </div>

                        {{-- Jenis Kelamin dan Poli --}}
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="gender" class="form-label">Jenis Kelamin</label>
                                <input type="text" 
                                       class="form-control readonly-input" 
                                       id="gender" 
                                       name="gender" 
                                       value="{{ old('gender', $antrian->gender) }}" 
                                       readonly 
                                       tabindex="-1">
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="poli" class="form-label">Poli</label>
                                <select class="form-select @error('poli') is-invalid @enderror" 
                                        id="poli" 
                                        name="poli" 
                                        required>
                                    <option value="">-- Pilih Poli --</option>
                                    @foreach($poli as $p)
                                        <option value="{{ $p->nama }}" 
                                                {{ old('poli', $antrian->poli) == $p->nama ? 'selected' : '' }}>
                                            {{ $p->nama }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('poli')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        {{-- Dokter dan Tanggal Antrian --}}
                        <div class="row">
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
                                                {{ old('doctor_id', $antrian->doctor_id) == $doctor->doctor_id ? 'selected' : '' }}>
                                            {{ $doctor->nama }} - {{ $doctor->spesialisasi }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('doctor_id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="tanggal" class="form-label">Tanggal Antrian</label>
                                <input type="date" 
                                       class="form-control @error('tanggal') is-invalid @enderror" 
                                       id="tanggal" 
                                       name="tanggal" 
                                       value="{{ old('tanggal', $antrian->tanggal->format('Y-m-d')) }}" 
                                       min="{{ date('Y-m-d') }}"
                                       required>
                                @error('tanggal')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        {{-- Button Update --}}
                        <div class="row">
                            <div class="col-md-12 d-grid">
                                <button type="submit" class="btn btn-primary btn-lg" id="updateBtn">
                                    <i class="fas fa-save me-2"></i>Update Antrian
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- JAVASCRIPT --}}
<script>
document.addEventListener('DOMContentLoaded', function() {
    const doctorSelect = document.getElementById('doctor_id');
    const form = document.getElementById('editAntrianForm');
    const updateBtn = document.getElementById('updateBtn');

    // Disable semua readonly input
    const readonlyInputs = document.querySelectorAll('.readonly-input');
    
    readonlyInputs.forEach(function(input) {
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
        updateBtn.disabled = true;
        updateBtn.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i>Memproses...';
    });

    // Set minimum date untuk tanggal antrian
    const tanggalInput = document.getElementById('tanggal');
    if (tanggalInput) {
        const today = new Date().toISOString().split('T')[0];
        tanggalInput.setAttribute('min', today);
    }
});
</script>

{{-- Custom CSS untuk styling tambahan --}}
<style>
.readonly-input {
    background-color: #f8f9fa;
    cursor: not-allowed;
}

.readonly-input:focus {
    background-color: #f8f9fa;
    border-color: #ced4da;
    box-shadow: none;
}

.form-label {
    font-weight: 500;
    margin-bottom: 0.5rem;
}

.btn-lg {
    padding: 0.75rem 1.5rem;
    font-size: 1.1rem;
}

.card {
    box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075);
    border: 1px solid rgba(0, 0, 0, 0.125);
}

.card-header {
    border-bottom: 1px solid rgba(0, 0, 0, 0.125);
}
</style>

@endsection