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
                            <th>Tgl Antrian</th>
                            <th>Opsi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>{{ $antrianTerbaru->no_antrian }}</td>
                            <td>{{ $antrianTerbaru->name ?? '-' }}</td>
                            <td>{{ $antrianTerbaru->user->address ?? '-' }}</td>
                            <td>{{ $antrianTerbaru->gender ?? '-' }}</td>
                            <td>{{ $antrianTerbaru->phone ?? '-' }}</td>
                            <td>{{ $antrianTerbaru->user->nomor_ktp ?? '-' }}</td>
                            <td>{{ $antrianTerbaru->poli }}</td>
                            <td>{{ $antrianTerbaru->formatted_tanggal }}</td>
                            <td>
                                <!-- Tombol Aksi: Edit, Hapus, Cetak -->
                                @if($antrianTerbaru->canEdit())
                                    <a href="{{ route('antrian.edit', $antrianTerbaru->id) }}" class="btn btn-warning btn-sm">✏️</a>
                                @endif
                                
                                @if($antrianTerbaru->canCancel())
                                    <form action="{{ route('antrian.destroy', $antrianTerbaru->id) }}" 
                                          method="POST" 
                                          style="display: inline;"
                                          onsubmit="return confirm('Yakin ingin membatalkan antrian?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm">🗑️</button>
                                    </form>
                                @endif
                                
                                <a href="{{ route('antrian.print', $antrianTerbaru->id) }}" 
                                   class="btn btn-success btn-sm" target="_blank">🖨️</a>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    @else
        <div class="alert alert-info">Anda belum mengambil antrian.</div>
    @endif

    


@endsection