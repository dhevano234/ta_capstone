@extends('layouts.main')

@section('title', 'Buat Antrian')

@section('content')
<div class="container py-4">
    <h2 class="text-center mb-4">Buat Antrian</h2>

    <form action="{{ route('antrian.store') }}" method="POST">
        @csrf
        <div class="row">
            <!-- Name -->
            <div class="col-md-6 mb-3">
                <label for="name" class="form-label">Nama Lengkap</label>
                <input type="text" class="form-control readonly-input" id="name" name="name" value="{{ $user->name }}" readonly>
            </div>

            <!-- Phone Number -->
            <div class="col-md-6 mb-3">
                <label for="phone" class="form-label">Nomor HP</label>
                <input type="text" class="form-control readonly-input" id="phone" name="phone" value="{{ $user->phone }}" readonly>
            </div>

            <!-- Gender -->
            <div class="col-md-6 mb-3">
                <label for="gender" class="form-label">Jenis Kelamin</label>
                <input type="text" class="form-control readonly-input" id="gender" name="gender" value="{{ $user->gender }}" readonly>
            </div>

            <!-- Poli (Dropdown) -->
            <div class="col-md-6 mb-3">
                <label for="poli" class="form-label">Poli</label>
            <select class="form-select" id="poli" name="poli" required>
                <option value="">-- Pilih Poli --</option>
                @foreach($poli as $poli)
                    <option value="{{ $poli->poli_id }}">{{ $poli->nama }}</option>
                @endforeach
            </select>

            </div>

            <!-- Dokter (Dropdown) -->
            <div class="col-md-6 mb-3">
                <label for="dokter" class="form-label">Dokter</label>
                <select class="form-select" id="dokter" name="dokter" required>
                    <option value="">-- Pilih Dokter --</option>
                    @foreach($doctors as $doctor)
                        <option value="{{ $doctor->id }}">{{ $doctor->nama }}</option>
                    @endforeach
                </select>
            </div>

            <!-- Tanggal -->
            <div class="col-md-6 mb-3">
                <label for="tanggal" class="form-label">Tanggal Antrian</label>
                <input type="date" class="form-control" id="tanggal" name="tanggal" required>
            </div>

            <!-- Submit Button -->
            <div class="col-12">
                <button type="submit" class="btn btn-primary w-100">Buat Antrian</button>
            </div>
        </div>
    </form>
</div>
@endsection
