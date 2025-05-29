@extends('layouts.auth')

@section('title', 'Register')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <img src="{{ asset('assets/img/logo/logoklinikpratama.png') }}" alt="Logo" class="img-fluid" style="width: 170px; height: 120px; object-fit: cover; border-radius: 50%1; margin-left: 240px;"> 
            <p class="text-center text-muted mb-4">Silakan isi formulir di bawah untuk membuat akun.</p>

            {{-- Pesan Error Validasi --}}
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <main class="bg-white p-4 rounded shadow-sm">
                <form action="/register" method="POST">
                    @csrf
                    <div class="row g-3">
                        <div class="col-12">
                            <label for="name" class="form-label fw-semibold">Nama Lengkap</label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" id="name" placeholder="Masukkan nama lengkap" value="{{ old('name') }}" required>
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-12">
                            <label for="nomor_ktp" class="form-label fw-semibold">Nomor KTP</label>
                            <input type="text" class="form-control @error('nomor_ktp') is-invalid @enderror" name="nomor_ktp" id="nomor_ktp" value="{{ old('nomor_ktp') }}" required>
                            @error('nomor_ktp')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-12">
                            <label for="email" class="form-label fw-semibold">Email Address</label>
                            <input type="email" class="form-control @error('email') is-invalid @enderror" name="email" id="email" placeholder="name@example.com" value="{{ old('email') }}" required>
                            @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label for="password" class="form-label fw-semibold">Password</label>
                            <input type="password" class="form-control @error('password') is-invalid @enderror" name="password" id="password" placeholder="Masukkan password" required>
                            @error('password')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label for="password_confirmation" class="form-label fw-semibold">Konfirmasi Password</label>
                            <input type="password" class="form-control" name="password_confirmation" id="password_confirmation" placeholder="Ulangi password" required>
                        </div>
                        <div class="col-12">
                            <label for="phone" class="form-label fw-semibold">Nomor HP</label>
                            <input type="text" class="form-control @error('phone') is-invalid @enderror" name="phone" id="phone" placeholder="08xxxxxxxxxx" value="{{ old('phone') }}" required>
                            @error('phone')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label for="birth_date" class="form-label fw-semibold">Tanggal Lahir</label>
                            <input type="date" class="form-control" name="birth_date" id="birth_date" max="{{ date('Y-m-d', strtotime('-1 day')) }}" value="{{ old('birth_date') }}">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Jenis Kelamin</label>
                            <div class="d-flex gap-3">
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="gender" id="male" value="Laki-laki" {{ old('gender') == 'Laki-laki' ? 'checked' : '' }}>
                                    <label class="form-check-label" for="male">Laki-laki</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="gender" id="female" value="Perempuan" {{ old('gender') == 'Perempuan' ? 'checked' : '' }}>
                                    <label class="form-check-label" for="female">Perempuan</label>
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <label for="address" class="form-label fw-semibold">Alamat Lengkap (Opsional)</label>
                            <textarea class="form-control" name="address" id="address" rows="2" placeholder="Masukkan alamat lengkap">{{ old('address') }}</textarea>
                        </div>
                        <div class="col-12">
                            <button class="btn btn-primary w-100 mt-3" type="submit">Daftar</button>
                        </div>
                        <div class="col-12 text-center mt-2">
                            <p class="text-muted">Sudah punya akun? <a href="/login" class="text-decoration-none">Login di sini</a></p>
                        </div>
                    </div>
                </form>
            </main>
        </div>
    </div>
</div>
@endsection
