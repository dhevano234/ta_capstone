@extends('layouts.main')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            <div class="card shadow-lg border-0">
                <div class="card-header bg-primary text-white text-center">
                    <h4 class="mb-0">Edit Profil</h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('profile.update') }}" method="POST">
                        @csrf

                        <!-- Nama Lengkap -->
                        <div class="mb-3">
                            <label class="form-label">Nama Lengkap</label>
                            <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name', $user->name) }}" required>
                            @error('name') <small class="text-danger">{{ $message }}</small> @enderror
                        </div>

                        <!-- Email & Phone -->
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label class="form-label">Email</label>
                                <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email', $user->email) }}" required>
                                @error('email') <small class="text-danger">{{ $message }}</small> @enderror
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Nomor Telepon</label>
                                <input type="text" name="phone" class="form-control @error('phone') is-invalid @enderror" value="{{ old('phone', $user->phone) }}" required>
                                @error('phone') <small class="text-danger">{{ $message }}</small> @enderror
                            </div>
                        </div>

                        <!-- No. KTP & Tanggal Lahir -->
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label class="form-label">No. KTP</label>
                                <input type="text" name="nomor_ktp" class="form-control @error('nomor_ktp') is-invalid @enderror" value="{{ old('nomor_ktp', $user->nomor_ktp) }}" required>
                                @error('nomor_ktp') <small class="text-danger">{{ $message }}</small> @enderror
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Tanggal Lahir</label>
                                <input type="date" name="birth_date" class="form-control @error('birth_date') is-invalid @enderror" value="{{ old('birth_date', $user->birth_date) }}" required>
                                @error('birth_date') <small class="text-danger">{{ $message }}</small> @enderror
                            </div>
                        </div>

                        <!-- Alamat -->
                        <div class="mb-3">
                            <label class="form-label">Alamat</label>
                            <textarea name="address" class="form-control @error('address') is-invalid @enderror" rows="3" required>{{ old('address', $user->address) }}</textarea>
                            @error('address') <small class="text-danger">{{ $message }}</small> @enderror
                        </div>

                        <div class="text-center">
                            <button type="submit" class="btn btn-success btn-lg px-4">Simpan Perubahan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
