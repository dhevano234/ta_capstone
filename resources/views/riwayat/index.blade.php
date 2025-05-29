@extends('layouts.main')

@section('content')
    <!-- Main Content -->
    <div class="main-content">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight mb-4">Riwayat Kunjungan Pasien</h2>

        <!-- Dropdown Sorting -->
        <select class="form-select mb-3" onchange="sortRiwayat(this.value)">
            <option value="all">Sortir Berdasarkan Poli</option>
            <option value="Umum" {{ request('poli') == 'Umum' ? 'selected' : '' }}>Umum</option>
            <option value="Kebidanan" {{ request('poli') == 'Kebidanan' ? 'selected' : '' }}>Kebidanan</option>
        </select>

        <!-- Tabel Riwayat Antrian dengan Scroll -->
        <div class="card">
            <div class="card-header bg-secondary text-white d-flex justify-content-between align-items-center">
                <h5 class="mb-0">Riwayat Kunjungan Pasien</h5>
                <small>{{ $riwayatAntrian->total() ?? 0 }} Total Riwayat</small>
            </div>
            <div class="card-body p-0">
                @if(isset($riwayatAntrian) && $riwayatAntrian->count() > 0)
                
                {{-- 🔧 SCROLLABLE TABLE CONTAINER --}}
                <div class="table-scroll-container">
                    <table class="table table-striped table-hover mb-0">
                        <thead class="table-dark sticky-top">
                            <tr>
                                <th class="text-center" style="min-width: 60px;">No</th>
                                <th class="text-center" style="min-width: 130px;">No Antrian</th>
                                <th class="text-center" style="min-width: 150px;">Nama</th>
                                <th class="text-center" style="min-width: 120px;">Alamat</th>
                                <th class="text-center" style="min-width: 100px;">Gender</th>
                                <th class="text-center" style="min-width: 130px;">Nomor HP</th>
                                <th class="text-center" style="min-width: 100px;">Poli</th>
                                <th class="text-center" style="min-width: 110px;">Tgl Antrian</th>
                                <th class="text-center" style="min-width: 100px;">Status</th>
                                <th class="text-center" style="min-width: 130px;">Dokter</th>
                                <th class="text-center" style="min-width: 120px;">Tgl Dibuat</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($riwayatAntrian as $key => $antrian)
                                <tr>
                                    <td class="text-center">
                                        <span class="badge bg-light text-dark">{{ $riwayatAntrian->firstItem() + $key }}</span>
                                    </td>
                                    <td class="text-center">
                                        <span class="badge bg-info text-white">{{ $antrian->no_antrian }}</span>
                                    </td>
                                    <td>
                                        <div class="name-cell" title="{{ $antrian->name ?? '-' }}">
                                            {{ $antrian->name ?? '-' }}
                                        </div>
                                    </td>
                                    <td>
                                        <div class="address-cell" title="{{ $antrian->user->address ?? '-' }}">
                                            {{ $antrian->user->address ?? '-' }}
                                        </div>
                                    </td>
                                    <td class="text-center">
                                        <small class="fw-bold">{{ $antrian->gender ?? '-' }}</small>
                                    </td>
                                    <td>
                                        <small class="text-muted">{{ $antrian->phone ?? '-' }}</small>
                                    </td>
                                    <td class="text-center">
                                        <span class="badge bg-{{ $antrian->poli == 'Umum' ? 'primary' : 'success' }}">
                                            {{ $antrian->poli }}
                                        </span>
                                    </td>
                                    <td class="text-center">
                                        <small class="fw-bold">{{ $antrian->formatted_tanggal }}</small>
                                    </td>
                                    <td class="text-center">
                                        <span class="badge bg-{{ $antrian->status_badge }}">
                                            {{ ucfirst($antrian->status) }}
                                        </span>
                                    </td>
                                    <td>
                                        <div class="doctor-cell" title="{{ $antrian->doctor->nama ?? '-' }}">
                                            <small>{{ $antrian->doctor->nama ?? '-' }}</small>
                                        </div>
                                    </td>
                                    <td class="text-center">
                                        <div class="date-cell">
                                            <small class="fw-bold d-block">{{ $antrian->created_at->format('d/m/Y') }}</small>
                                            <small class="text-muted">{{ $antrian->created_at->format('H:i') }}</small>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                {{-- Pagination --}}
                <div class="card-footer">
                    <div class="d-flex justify-content-between align-items-center">
                        <small class="text-muted">
                            Menampilkan {{ $riwayatAntrian->firstItem() }}-{{ $riwayatAntrian->lastItem() }} 
                            dari {{ $riwayatAntrian->total() }} data
                        </small>
                        {{ $riwayatAntrian->appends(request()->query())->links() }}
                    </div>
                </div>

                @else
                <div class="text-center py-5">
                    <i class="fas fa-history fa-4x text-muted mb-3"></i>
                    <h5 class="text-muted">Belum Ada Riwayat Kunjungan</h5>
                    <p class="text-muted">Riwayat kunjungan Anda akan muncul di sini setelah Anda mengambil antrian.</p>
                    <a href="{{ route('antrian.index') }}" class="btn btn-primary mt-2">
                        <i class="fas fa-plus"></i> Ambil Antrian Sekarang
                    </a>
                </div>
                @endif
            </div>
        </div>

        

{{-- 🔧 CSS UNTUK SCROLLABLE TABLE --}}
<style>
    /* Scrollable Table Container */
    .table-scroll-container {
        max-height: 600px; /* Batas tinggi tabel */
        overflow-x: auto;  /* Scroll horizontal */
        overflow-y: auto;  /* Scroll vertikal */
        border: 1px solid #dee2e6;
        border-radius: 8px;
        position: relative;
    }

    /* Sticky Header */
    .table thead th {
        position: sticky;
        top: 0;
        z-index: 10;
        background-color: #343a40 !important;
        color: white !important;
        font-size: 0.85rem;
        font-weight: 600;
        padding: 12px 8px;
        border-bottom: 2px solid #495057;
        white-space: nowrap;
    }

    /* Table Body */
    .table tbody td {
        font-size: 0.85rem;
        padding: 10px 8px;
        vertical-align: middle;
        border-bottom: 1px solid #dee2e6;
    }

    /* Cell Truncation */
    .name-cell, .address-cell, .doctor-cell {
        max-width: 120px;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }

    .date-cell {
        min-width: 80px;
    }

    /* Hover Effects */
    .table-hover tbody tr:hover {
        background-color: #f8f9fa;
        transition: all 0.2s ease;
    }

    /* Badge Styling */
    .badge {
        font-size: 0.75rem;
        padding: 4px 8px;
        border-radius: 4px;
    }

    /* Scrollbar Styling */
    .table-scroll-container::-webkit-scrollbar {
        width: 8px;
        height: 8px;
    }

    .table-scroll-container::-webkit-scrollbar-track {
        background: #f1f1f1;
        border-radius: 4px;
    }

    .table-scroll-container::-webkit-scrollbar-thumb {
        background: #c1c1c1;
        border-radius: 4px;
    }

    .table-scroll-container::-webkit-scrollbar-thumb:hover {
        background: #a8a8a8;
    }

    /* Responsive Adjustments */
    @media (max-width: 768px) {
        .table-scroll-container {
            max-height: 400px;
        }
        
        .table thead th,
        .table tbody td {
            font-size: 0.75rem;
            padding: 8px 6px;
        }
        
        .name-cell, .address-cell, .doctor-cell {
            max-width: 100px;
        }
    }

    /* Loading Animation untuk Smooth Scroll */
    .table-scroll-container {
        scroll-behavior: smooth;
    }

    /* Shadow untuk menunjukkan ada konten di bawah */
    .table-scroll-container::after {
        content: '';
        position: absolute;
        bottom: 0;
        left: 0;
        right: 0;
        height: 20px;
        background: linear-gradient(transparent, rgba(0,0,0,0.05));
        pointer-events: none;
    }
</style>

<script>
    function sortRiwayat(poli) {
        let url = '{{ route('riwayat.index') }}';
        if (poli !== 'all') {
            url += '?poli=' + poli;
        }
        window.location.href = url;
    }

    // Smooth scroll ke top saat ganti halaman
    document.addEventListener('DOMContentLoaded', function() {
        const tableContainer = document.querySelector('.table-scroll-container');
        if (tableContainer) {
            tableContainer.scrollTop = 0;
        }
    });
</script>
@endsection