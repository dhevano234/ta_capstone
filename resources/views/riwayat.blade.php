@extends('layouts.main')

@section('content')
    <!-- Main Content -->
    <div class="main-content">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Riwayat Antrian Pasien</h2>

        <!-- Patient History Table -->
        <div class="card">
            <div class="card-header bg-secondary text-white">
                Riwayat Antrian Pasien
            </div>
            <div class="card-body">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Tanggal & Waktu Pendaftaran</th>
                            <th>Nama Dokter</th>
                            <th>Status Antrian</th>
                            <th>Nomor Antrian</th>
                            <th>Catatan / Keterangan</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- Dummy Data for Patient History -->
                        @foreach([
                            [
                                'tanggal_pendaftaran' => '2025-05-18 08:30',
                                'nama_dokter' => 'Dr. John Doe',
                                'status' => 'Selesai',
                                'nomor_antrian' => '1A',
                                'catatan' => 'Pasien selesai diperiksa.'
                            ],
                            [
                                'tanggal_pendaftaran' => '2025-05-19 09:00',
                                'nama_dokter' => 'Dr. Jane Smith',
                                'status' => 'Batal',
                                'nomor_antrian' => '2B',
                                'catatan' => 'Pasien membatalkan antrian karena alasan pribadi.'
                            ],
                            [
                                'tanggal_pendaftaran' => '2025-05-20 10:15',
                                'nama_dokter' => 'Dr. Mary Johnson',
                                'status' => 'Menunggu',
                                'nomor_antrian' => '3C',
                                'catatan' => 'Pasien masih menunggu pemeriksaan.'
                            ]
                        ] as $key => $item)
                            <tr>
                                <td>{{ $key + 1 }}</td>
                                <td>{{ $item['tanggal_pendaftaran'] }}</td>
                                <td>{{ $item['nama_dokter'] }}</td>
                                <td style="color: black; font-weight: bold;">{{ $item['status'] }}</td>  <!-- Status is now bold -->
                                <td>{{ $item['nomor_antrian'] }}</td>
                                <td>{{ $item['catatan'] }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
