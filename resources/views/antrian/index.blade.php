@extends('layouts.main')

@section('content')
<div class="container">
    <h2>Daftar Antrian Klinik</h2>

    <!-- Tombol Ambil Antrian -->
    <button class="btn btn-primary mb-3" onclick="location.href='{{ route('antrian.create') }}'">
        📅 Ambil Antrian
    </button>

    {{-- Alert Success --}}
    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    {{-- Alert Error --}}
    @if ($errors->any())
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>Error:</strong>
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <!-- Tabel Atas: Antrian Terbaru (Berdasarkan Pengguna Login) -->
    @if ($antrianTerbaru)
        <div class="card mb-3">
            <div class="card-header bg-primary text-white">Antrian Terbaru Anda</div>
            <div class="card-body">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>No Antrian</th>
                            <th>Nama</th>
                            <th>Alamat</th>
                            <th>Jenis Kelamin</th>
                            <th>Nomor HP</th>
                            <th>Nomor KTP</th>
                            <th>Poli</th>
                            <th>Dokter</th>
                            <th>Tgl Antrian</th>
                            <th>Status</th>
                            <th>Opsi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td><span class="badge bg-primary">{{ $antrianTerbaru->no_antrian }}</span></td>
                            <td>{{ $antrianTerbaru->name ?? '-' }}</td>
                            <td>{{ $antrianTerbaru->user->address ?? '-' }}</td>
                            <td>{{ $antrianTerbaru->gender ?? '-' }}</td>
                            <td>{{ $antrianTerbaru->phone ?? '-' }}</td>
                            <td>{{ $antrianTerbaru->user->nomor_ktp ?? '-' }}</td>
                            <td>
                                <span class="badge bg-{{ $antrianTerbaru->poli == 'Umum' ? 'info' : 'success' }}">
                                    {{ $antrianTerbaru->poli }}
                                </span>
                            </td>
                            <td>{{ $antrianTerbaru->doctor->nama ?? 'Belum ditentukan' }}</td>
                            <td>{{ $antrianTerbaru->formatted_tanggal }}</td>
                            <td>
                                <span class="badge bg-{{ $antrianTerbaru->status_badge }}">
                                    {{ ucfirst($antrianTerbaru->status) }}
                                </span>
                            </td>
                            <td>
                                <!-- Tombol Aksi: Edit, Print, PDF, Hapus -->
                                <div class="btn-group" role="group">
                                    @if($antrianTerbaru->canEdit())
                                        <a href="{{ route('antrian.edit', $antrianTerbaru->id) }}" 
                                           class="btn btn-warning btn-sm" 
                                           title="Edit Antrian">
                                            ✏️
                                        </a>
                                    @endif
                                    
                                    <a href="{{ route('antrian.print', $antrianTerbaru->id) }}" 
                                       class="btn btn-info btn-sm" 
                                       target="_blank"
                                       title="Print Tiket">
                                        🖨️
                                    </a>
                                    
                                    {{-- <a href="{{ route('antrian.downloadPdf', $antrianTerbaru->id) }}" 
                                       class="btn btn-success btn-sm"
                                       title="Download PDF">
                                        📄
                                    </a> --}}
                                    
                                    @if($antrianTerbaru->canCancel())
                                        <form action="{{ route('antrian.destroy', $antrianTerbaru->id) }}" 
                                              method="POST" 
                                              style="display: inline;"
                                              onsubmit="return confirm('Yakin ingin membatalkan antrian?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" 
                                                    class="btn btn-danger btn-sm"
                                                    title="Batalkan Antrian">
                                                🗑️
                                            </button>
                                        </form>
                                    @endif
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>    
            
    @endif

{{-- Custom CSS untuk compact design --}}
<style>
    .btn-group .btn {
        margin-right: 2px;
        font-size: 14px;
        padding: 4px 8px;
    }
    
    .btn-group .btn:last-child {
        margin-right: 0;
    }
    
    .card {
        box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        transition: transform 0.2s;
    }
    
    .card:hover {
        transform: translateY(-2px);
    }
    
    .badge {
        font-size: 0.85em;
    }
    
    .table td {
        vertical-align: middle;
        font-size: 0.9em;
    }
    
    .alert-light {
        background-color: #f8f9fa;
        border-color: #dee2e6;
    }
</style>
@endsection