@extends('layouts.main')

@section('content')
<div class="container py-5">
    <h2 class="text-center mb-5 fw-bold">Jadwal Dokter</h2>

    <div class="row g-4">
        @forelse ($doctors as $doctor)
            <div class="col-md-6 col-lg-4">
                <div class="card shadow-sm border-0 h-100 doctor-card" style="cursor: pointer; transition: transform 0.3s ease;">
                    <div class="d-flex align-items-center p-3">
                        <!-- Foto Dokter -->
                        <img src="{{ $doctor->foto ? asset($doctor->foto) : asset('assets/img/default-doctor.png') }}"
                            alt="{{ $doctor->nama }}"
                            class="rounded-circle me-3"
                            style="width: 100px; height: 100px; object-fit: cover;">

                        <!-- Info Dokter -->
                        <div>
                            <h5 class="card-title fw-semibold mb-1">{{ $doctor->nama }}</h5>
                            <span class="badge bg-primary mb-2">{{ $doctor->spesialisasi }}</span>
                            <p class="mb-0 small text-muted">
                                <strong>Jadwal Praktek:</strong><br>
                                {{ $doctor->hari ?? 'Hari belum tersedia' }}<br>
                                {{ \Carbon\Carbon::parse($doctor->mulai_praktek)->format('H:i') }} - {{ \Carbon\Carbon::parse($doctor->selesai_praktek)->format('H:i') }} WIB
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12">
                <div class="alert alert-info text-center">
                    Tidak ada data dokter tersedia saat ini.
                </div>
            </div>
        @endforelse
    </div>
</div>

<style>
    .doctor-card:hover {
        transform: translateY(-8px);
        box-shadow: 0 8px 20px rgba(0, 0, 0, 0.12);
    }
</style>
@endsection
