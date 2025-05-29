@extends('layouts.main')

@section('content')
    <!-- Main Content -->
    <div class="main-content">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Antrean Pasien</h2>

        <!-- Row for two cards on top and one below -->
        <div class="row">
            <!-- First Card -->
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        Antrean Kebidanan
                    </div>
                    <div class="card-body">
                        <span class="badge badge-primary">1A</span>
                        <p class="antrean-status">Antrean Terakhir : 1A</p>
                    </div>
                </div>
            </div>

            <!-- Second Card -->
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        Antrean Umum
                    </div>
                    <div class="card-body">
                        <span class="badge badge-success">1A</span>
                        <p class="antrean-status">Antrean Terakhir : 1A</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
