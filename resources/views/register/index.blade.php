<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - {{ config('app.name') }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            background-color: #ffffff;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }

        .register-container {
            width: 100%;
            max-width: 450px;
            background: white;
            border-radius: 16px;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .register-container:hover {
            transform: translateY(-5px);
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.15);
        }

        .logo-section {
            text-align: center;
            padding: 1.5rem 1rem 1rem;
            background: white;
        }

        .logo-image {
            width: 80px;
            height: 80px;
            object-fit: cover;
            border-radius: 50%;
            margin-bottom: 0.5rem;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease;
        }

        .logo-image:hover {
            transform: scale(1.05);
        }

        .register-header {
            text-align: center;
            padding: 0.5rem 1.5rem 0;
            background: white;
        }

        .register-header h2 {
            font-size: 1.6rem;
            font-weight: 600;
            color: #2c3e50;
            margin: 0;
        }

        .register-body {
            padding: 1rem 1.5rem 1.5rem;
            background: white;
        }

        .form-label {
            font-weight: 600;
            color: #2c3e50;
            margin-bottom: 0.3rem;
            font-size: 0.9rem;
        }

        .form-control {
            border: 2px solid #e9ecef;
            border-radius: 12px;
            padding: 0.7rem 1rem;
            font-size: 0.95rem;
            transition: all 0.3s ease;
            background-color: #f8f9fa;
            margin-bottom: 0.8rem;
        }

        .form-control:focus {
            border-color: #007bff;
            box-shadow: 0 0 0 0.2rem rgba(0, 123, 255, 0.15);
            background-color: white;
            transform: translateY(-1px);
        }

        .form-control::placeholder {
            color: #6c757d;
            opacity: 0.8;
        }

        .row-compact {
            display: flex;
            gap: 0.8rem;
        }

        .row-compact .form-group {
            flex: 1;
        }

        .gender-options {
            display: flex;
            gap: 1rem;
            margin-top: 0.3rem;
            margin-bottom: 0.8rem;
        }

        .form-check {
            flex: 1;
        }

        .form-check-input:checked {
            background-color: #007bff;
            border-color: #007bff;
        }

        .form-check-label {
            font-weight: 500;
            color: #495057;
            cursor: pointer;
            font-size: 0.9rem;
        }

        .btn-primary {
            background: linear-gradient(135deg, #007bff 0%, #0056b3 100%);
            border: none;
            border-radius: 12px;
            padding: 0.8rem 1.5rem;
            font-size: 1rem;
            font-weight: 600;
            width: 100%;
            transition: all 0.3s ease;
            margin-top: 0.5rem;
        }

        .btn-primary:hover {
            background: linear-gradient(135deg, #0056b3 0%, #004085 100%);
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(0, 123, 255, 0.3);
        }

        .alert {
            border: none;
            border-radius: 12px;
            padding: 0.8rem 1rem;
            margin-bottom: 1rem;
            font-size: 0.9rem;
        }

        .alert-danger {
            background-color: #f8d7da;
            color: #721c24;
            border-left: 4px solid #dc3545;
        }

        .invalid-feedback {
            font-size: 0.8rem;
            margin-top: 0.3rem;
        }

        .auth-links {
            text-align: center;
            margin-top: 1rem;
            padding-top: 1rem;
            border-top: 1px solid #e9ecef;
        }

        .auth-links p {
            color: #6c757d;
            font-size: 0.9rem;
            margin: 0;
        }

        .auth-links a {
            color: #007bff;
            text-decoration: none;
            font-weight: 600;
            transition: color 0.3s ease;
        }

        .auth-links a:hover {
            color: #0056b3;
            text-decoration: underline;
        }

        /* Loading state */
        .btn-loading {
            position: relative;
            color: transparent;
        }

        .btn-loading::after {
            content: '';
            position: absolute;
            width: 16px;
            height: 16px;
            top: 50%;
            left: 50%;
            margin-left: -8px;
            margin-top: -8px;
            border: 2px solid transparent;
            border-top: 2px solid white;
            border-radius: 50%;
            animation: spin 1s linear infinite;
        }

        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }

        /* Responsive */
        @media (max-width: 576px) {
            body {
                padding: 15px;
            }
            
            .register-container {
                max-width: 100%;
            }
            
            .register-body {
                padding: 1rem;
            }

            .row-compact {
                flex-direction: column;
                gap: 0;
            }

            .gender-options {
                flex-direction: column;
                gap: 0.5rem;
            }
        }

        /* Animation */
        .register-container {
            animation: slideUp 0.6s ease-out;
        }

        @keyframes slideUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
    </style>
</head>
<body>

<div class="register-container">
    <!-- Logo Section -->
    <div class="logo-section">
        <img src="{{ asset('assets/img/logo/logoklinikpratama.png') }}" alt="Logo Klinik Pratama" class="logo-image">
    </div>

    <!-- Register Header -->
    <div class="register-header">
        <h2>Register</h2>
    </div>

    <!-- Register Body -->
    <div class="register-body">
        <!-- Error Alert -->
        @if ($errors->any())
            <div class="alert alert-danger d-flex align-items-center">
                <i class="fas fa-exclamation-circle me-2"></i>
                <div>
                    @foreach ($errors->all() as $error)
                        {{ $error }}<br>
                    @endforeach
                </div>
            </div>
        @endif

        <!-- Register Form -->
        <form method="POST" action="{{ route('register') }}" id="registerForm">
            @csrf

            <!-- Nama Lengkap -->
            <div class="form-group">
                <label for="name" class="form-label">Nama Lengkap</label>
                <input 
                    type="text" 
                    class="form-control @error('name') is-invalid @enderror" 
                    name="name" 
                    id="name" 
                    placeholder="Masukkan nama lengkap" 
                    value="{{ old('name') }}" 
                    required
                    autofocus
                >
                @error('name')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <!-- KTP & Email Row -->
            <div class="row-compact">
                <div class="form-group">
                    <label for="nomor_ktp" class="form-label">Nomor KTP</label>
                    <input 
                        type="text" 
                        class="form-control @error('nomor_ktp') is-invalid @enderror" 
                        name="nomor_ktp" 
                        id="nomor_ktp" 
                        placeholder="16 digit KTP" 
                        value="{{ old('nomor_ktp') }}" 
                        required
                    >
                    @error('nomor_ktp')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                
                <div class="form-group">
                    <label for="email" class="form-label">Email</label>
                    <input 
                        type="email" 
                        class="form-control @error('email') is-invalid @enderror" 
                        name="email" 
                        id="email" 
                        placeholder="name@example.com" 
                        value="{{ old('email') }}" 
                        required
                    >
                    @error('email')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <!-- Password Row -->
            <div class="row-compact">
                <div class="form-group">
                    <label for="password" class="form-label">Password</label>
                    <input 
                        type="password" 
                        class="form-control @error('password') is-invalid @enderror" 
                        name="password" 
                        id="password" 
                        placeholder="Masukkan password" 
                        required
                    >
                    @error('password')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="password_confirmation" class="form-label">Konfirmasi Password</label>
                    <input 
                        type="password" 
                        class="form-control" 
                        name="password_confirmation" 
                        id="password_confirmation" 
                        placeholder="Ulangi password" 
                        required
                    >
                </div>
            </div>

            <!-- Phone & Birth Date Row -->
            <div class="row-compact">
                <div class="form-group">
                    <label for="phone" class="form-label">Nomor HP</label>
                    <input 
                        type="text" 
                        class="form-control @error('phone') is-invalid @enderror" 
                        name="phone" 
                        id="phone" 
                        placeholder="08xxxxxxxxxx" 
                        value="{{ old('phone') }}" 
                        required
                    >
                    @error('phone')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="birth_date" class="form-label">Tanggal Lahir</label>
                    <input 
                        type="date" 
                        class="form-control" 
                        name="birth_date" 
                        id="birth_date" 
                        value="{{ old('birth_date') }}"
                    >
                </div>
            </div>

            <!-- Jenis Kelamin -->
            <div class="form-group">
                <label class="form-label">Jenis Kelamin</label>
                <div class="gender-options">
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

            <!-- Alamat -->
            <div class="form-group">
                <label for="address" class="form-label">Alamat Lengkap (Opsional)</label>
                <textarea 
                    class="form-control" 
                    name="address" 
                    id="address" 
                    rows="2" 
                    placeholder="Masukkan alamat lengkap"
                >{{ old('address') }}</textarea>
            </div>

            <button type="submit" class="btn btn-primary" id="registerBtn">
                <i class="fas fa-user-plus me-2"></i>
                Register
            </button>
        </form>

        <!-- Auth Links -->
        <div class="auth-links">
            <p>Sudah punya akun? <a href="{{ route('login') }}">Login</a></p>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
    // Form submission loading
    document.getElementById('registerForm').addEventListener('submit', function() {
        const registerBtn = document.getElementById('registerBtn');
        registerBtn.classList.add('btn-loading');
        registerBtn.disabled = true;
    });

    // Auto-hide alerts
    document.addEventListener('DOMContentLoaded', function() {
        const alerts = document.querySelectorAll('.alert');
        alerts.forEach(alert => {
            setTimeout(() => {
                alert.style.opacity = '0';
                setTimeout(() => alert.remove(), 500);
            }, 5000);
        });
    });
</script>

</body>
</html>