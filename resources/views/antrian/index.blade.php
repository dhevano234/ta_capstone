@extends('layouts.main')

@section('content')
<div class="container">
    <h2>Daftar Antrian Klinik</h2>

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

    <!-- Tombol Ambil Antrian -->
    <button class="btn btn-primary mb-3" onclick="location.href='{{ route('antrian.create') }}'">
        📅 Ambil Antrian
    </button>

    <!-- Dropdown Sorting -->
    <select class="form-select mb-3" onchange="sortAntrian(this.value)">
        <option value="all">Sortir Berdasarkan Poli</option>
        <option value="Umum" {{ request('poli') == 'Umum' ? 'selected' : '' }}>Umum</option>
        <option value="Kebidanan" {{ request('poli') == 'Kebidanan' ? 'selected' : '' }}>Kebidanan</option>
    </select>

    <!-- Tabel Bawah: Daftar Antrian (Semua) -->
    <div class="card">
        <div class="card-header bg-secondary text-white">Antrean</div>
        <div class="card-body">
            @if($daftarAntrian->count() > 0)
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>No Antrian</th>
                        <th>Nama</th>
                        <th>Alamat</th>
                        <th>Jenis Kelamin</th>
                        <th>Nomor HP</th>
                        <th>Nomor KTP</th>
                        <th>Poli</th>
                        <th>Tgl Antrian</th>
                        <th>Status</th>
                        <th>Dokter</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($daftarAntrian as $key => $antrian)
                        <tr>
                            <td>{{ $key + 1 }}</td>
                            <td>{{ $antrian->no_antrian }}</td>
                            <td>{{ $antrian->name ?? '-' }}</td>
                            <td>{{ $antrian->user->address ?? '-' }}</td>
                            <td>{{ $antrian->gender ?? '-' }}</td>
                            <td>{{ $antrian->phone ?? '-' }}</td>
                            <td>{{ $antrian->user->nomor_ktp ?? '-' }}</td>
                            <td>{{ $antrian->poli }}</td>
                            <td>{{ $antrian->formatted_tanggal }}</td>
                            <td>
                                <span class="badge bg-{{ $antrian->status_badge }}">
                                    {{ ucfirst($antrian->status) }}
                                </span>
                            </td>
                            <td>{{ $antrian->doctor->nama ?? '-' }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            {{-- Pagination --}}
            <div class="d-flex justify-content-center">
                {{ $daftarAntrian->links() }}
            </div>
            @else
            <div class="text-center py-4">
                <p class="text-muted">Belum ada antrian.</p>
                <a href="{{ route('antrian.create') }}" class="btn btn-primary">
                    📅 Ambil Antrian Pertama
                </a>
            </div>
            @endif
        </div>
    </div>
</div>

<script>
    function sortAntrian(poli) {
        // Logika sorting sesuai poli
        let url = '{{ route('antrian.index') }}';
        if (poli !== 'all') {
            url += '?poli=' + poli;
        }
        window.location.href = url;
    }
</script>
@endsection