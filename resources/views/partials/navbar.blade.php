 <style>
/* ============================================================================ */
/* ENHANCED STYLING - CSS BERSIH */
/* ============================================================================ */

/* Import Google Font */
@import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap');

body {
    display: flex;
    height: 100vh;
    margin: 0;
    flex-direction: column;
    font-family: 'Inter', sans-serif;
    background: linear-gradient(135deg, #f1f5f9 0%, #e2e8f0 100%);
}

.wrapper {
    display: flex;
    flex: 1;
}

/* ============================================================================ */
/* ENHANCED SIDEBAR */
/* ============================================================================ */
.sidebar {
    width: 250px;
    background: linear-gradient(180deg, #1e40af 0%, #1e3a8a 50%, #1e293b 100%);
    color: rgb(255, 255, 255);
    padding: 20px;
    height: 100%;
    border-top: 3px solid rgba(59, 130, 246, 0.3);
    border-right: 3px solid rgba(59, 130, 246, 0.2);
    box-shadow: 4px 0 15px rgba(0, 0, 0, 0.1);
    position: relative;
    overflow-y: auto;
}

.sidebar::before {
    content: '';
    position: absolute;
    top: 0;
    right: 0;
    width: 1px;
    height: 100%;
    background: linear-gradient(180deg, transparent, rgba(255, 255, 255, 0.1), transparent);
}

.sidebar .nav-link {
    color: rgba(255, 255, 255, 0.9);
    padding: 12px 15px;
    text-decoration: none;
    border-radius: 8px;
    margin: 2px 0;
    transition: all 0.3s ease;
    display: flex;
    align-items: center;
    gap: 10px;
    font-weight: 500;
    position: relative;
    overflow: hidden;
}

.sidebar .nav-link::before {
    content: '';
    position: absolute;
    left: 0;
    top: 0;
    width: 3px;
    height: 100%;
    background: linear-gradient(135deg, #60a5fa, #06b6d4);
    transform: scaleY(0);
    transition: transform 0.3s ease;
}

.sidebar .nav-link:hover {
    background: rgba(59, 130, 246, 0.2);
    color: #bfdbfe;
    transform: translateX(5px);
    box-shadow: 0 4px 12px rgba(59, 130, 246, 0.3);
}

.sidebar .nav-link:hover::before {
    transform: scaleY(1);
}

.sidebar .nav-item {
    margin-bottom: 8px;
}

.sidebar .nav-item .nav-link.active {
    background: linear-gradient(135deg, rgba(59, 130, 246, 0.3), rgba(6, 182, 212, 0.2));
    color: #bfdbfe;
    transform: translateX(5px);
    box-shadow: 0 4px 12px rgba(59, 130, 246, 0.4);
}

.sidebar .nav-item .nav-link.active::before {
    transform: scaleY(1);
}

/* ============================================================================ */
/* ENHANCED TOP NAVIGATION */
/* ============================================================================ */
.top-nav {
    background: linear-gradient(135deg, #1e40af 0%, #3b82f6 50%, #06b6d4 100%);
    padding: 12px 0;
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
    border-bottom: 1px solid rgba(255, 255, 255, 0.1);
}

.top-nav .navbar-nav .nav-link {
    color: rgba(255, 255, 255, 0.95);
    font-weight: 500;
    transition: all 0.3s ease;
}

.top-nav .navbar-nav .nav-link:hover {
    color: #fbbf24;
    transform: translateY(-1px);
}

/* ============================================================================ */
/* ENHANCED LOGO STYLING - LEBIH TERLIHAT */
/* ============================================================================ */
.top-nav img {
    width: 70px !important;
    height: 70px !important;
    object-fit: cover !important;
    border-radius: 15px !important;
    border: 4px solid rgba(255, 255, 255, 0.4) !important;
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.4) !important;
    transition: all 0.3s ease !important;
    margin-bottom: 0 !important;
    margin-right: 15px !important;
}

.top-nav img:hover {
    transform: scale(1.08) rotate(3deg);
    box-shadow: 0 15px 40px rgba(0, 0, 0, 0.5) !important;
    border-color: rgba(255, 255, 255, 0.6) !important;
}

/* ============================================================================ */
/* ENHANCED USER SECTION */
/* ============================================================================ */
.navbar-text {
    color: rgba(255, 255, 255, 0.95) !important;
    font-weight: 500 !important;
    font-size: 0.95rem !important;
}

.dropdown-menu {
    background: white !important;
    border: none !important;
    border-radius: 12px !important;
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.15) !important;
    margin-top: 8px !important;
}

.dropdown-item {
    padding: 0.75rem 1.25rem !important;
    color: #374151 !important;
    transition: all 0.3s ease !important;
    border-radius: 8px !important;
    margin: 2px 8px !important;
}

.dropdown-item:hover {
    background: #f3f4f6 !important;
    color: #1f2937 !important;
    transform: translateX(5px);
}

.dropdown-item.text-danger:hover {
    background: #fef2f2 !important;
    color: #dc2626 !important;
}

/* ============================================================================ */
/* ENHANCED MAIN CONTENT */
/* ============================================================================ */
.main-content {
    flex-grow: 1;
    padding: 25px;
    background: linear-gradient(135deg, #f8fafc 0%, #e2e8f0 100%);
    min-height: calc(100vh - 80px);
}

/* ============================================================================ */
/* ENHANCED SIDEBAR TITLES */
/* ============================================================================ */
.bold-text {
    font-weight: 700;
    color: rgba(255, 255, 255, 0.8);
    font-size: 0.75rem;
    text-transform: uppercase;
    letter-spacing: 1px;
    margin-bottom: 1rem;
    margin-top: 1.5rem;
    padding-left: 10px;
    border-left: 3px solid rgba(59, 130, 246, 0.5);
}

.bold-text:first-child {
    margin-top: 0;
}

/* ============================================================================ */
/* ENHANCED CARDS & COMPONENTS */
/* ============================================================================ */
.card {
    text-align: center;
    margin-bottom: 20px;
    padding: 25px;
    background: white;
    border-radius: 12px;
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.08);
    border: 1px solid rgba(255, 255, 255, 0.2);
    transition: all 0.3s ease;
}

.card:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 25px rgba(0, 0, 0, 0.12);
}

.card-header {
    font-size: 1.25rem;
    font-weight: 600;
    color: #1f2937;
}

.antrean-status {
    font-size: 2rem;
    font-weight: 700;
    color: #1e40af;
}

.btn-next {
    margin-top: 20px;
    font-weight: 600;
    border-radius: 8px;
    padding: 10px 20px;
    transition: all 0.3s ease;
}

.btn-next:hover {
    transform: translateY(-1px);
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
}

.badge {
    font-size: 0.85rem;
    padding: 0.35em 0.65em;
    border-radius: 6px;
    font-weight: 500;
}

.badge-primary {
    background: linear-gradient(135deg, #3b82f6, #1e40af);
}

.badge-success {
    background: linear-gradient(135deg, #10b981, #059669);
}

.badge-danger {
    background: linear-gradient(135deg, #ef4444, #dc2626);
}

/* ============================================================================ */
/* ENHANCED LAYOUT */
/* ============================================================================ */
.row {
    display: flex;
    justify-content: space-between;
    gap: 20px;
}

.col-md-6 {
    flex: 0 0 calc(50% - 10px);
}

.readonly-input {
    background-color: #f3f4f6;
    cursor: not-allowed;
    color: #6b7280;
    border: 1px solid #d1d5db;
    border-radius: 8px;
    transition: all 0.3s ease;
}

.readonly-input:focus {
    box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
}

/* ============================================================================ */
/* RESPONSIVE ENHANCEMENTS */
/* ============================================================================ */
@media (max-width: 768px) {
    .sidebar {
        width: 220px;
    }
    
    .top-nav img {
        width: 50px !important;
        height: 50px !important;
    }
    
    .main-content {
        padding: 15px;
    }
    
    .navbar-text {
        display: none;
    }
}

/* ============================================================================ */
/* SMOOTH SCROLLBAR */
/* ============================================================================ */
.sidebar::-webkit-scrollbar {
    width: 6px;
}

.sidebar::-webkit-scrollbar-track {
    background: rgba(255, 255, 255, 0.1);
}

.sidebar::-webkit-scrollbar-thumb {
    background: rgba(255, 255, 255, 0.2);
    border-radius: 3px;
}

.sidebar::-webkit-scrollbar-thumb:hover {
    background: rgba(255, 255, 255, 0.3);
}

/* ============================================================================ */
/* LOADING ANIMATIONS */
/* ============================================================================ */
@keyframes slideInLeft {
    from {
        opacity: 0;
        transform: translateX(-20px);
    }
    to {
        opacity: 1;
        transform: translateX(0);
    }
}

.sidebar .nav-link {
    animation: slideInLeft 0.4s ease forwards;
}

.sidebar .nav-item:nth-child(1) .nav-link { animation-delay: 0.1s; }
.sidebar .nav-item:nth-child(2) .nav-link { animation-delay: 0.2s; }
.sidebar .nav-item:nth-child(3) .nav-link { animation-delay: 0.3s; }
.sidebar .nav-item:nth-child(4) .nav-link { animation-delay: 0.4s; }
</style>
<body>

   <!-- Top Navigation Bar -->
<nav class="top-nav navbar navbar-expand-lg navbar-dark">
    <div class="container-fluid">
        <img src="{{ asset('assets/img/logo/logoklinikpratama.png') }}" alt="Logo" class="img-fluid" style="width: 100px; height: 50px; object-fit: cover; border-radius: 50%; margin-bottom: 20px;">
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <!-- navbar item di kanan -->
        <ul class="navbar-nav ms-auto ms-md-0 me-3 me-lg-4">
            <li class="nav-item">
                <!-- profil di kanan -->
                <span class="navbar-text text-white ms-3">Selamat datang, {{ Auth::user()->name }}</span>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="bi bi-person-circle"></i>
                </a>
                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                    <li><a class="dropdown-item" href="/editprofile">Edit Profile</a></li>
                    <li><hr class="dropdown-divider" /></li>
                    <li><a class="dropdown-item text-danger" href="{{ route('login') }}" 
                        onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        Logout
                        </a></li>
                </ul>
            </li>
        </ul>
    </div>
</nav>


<!-- Logout Form -->
<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
    @csrf
</form>


    <div class="wrapper">
        <!-- Sidebar -->
        <div class="sidebar">
            <!-- Home Section -->
            <h7 class="bold-text">HOME</h7>
            <ul class="nav flex-column">
                <li class="nav-item">
                    <a class="nav-link " href="/dashboard">
                        <i class="fas fa-tachometer-alt"></i> Dashboard
                    </a>
                </li>
            </ul>
            <h7 class="bold-text">MENU</h7>
            <ul class="nav flex-column">
                <li class="nav-item">
                    <a class="nav-link" href="/antrian">
                        <i class="fas fa-cogs"></i> Buat Kunjungan
                    </a>
                <li class="nav-item">
                    <a class="nav-link" href="/riwayatkunjungan" style="font-size: 15px; color: #fff;">
                        <i class="fas fa-address-book"></i> Riwayat Kunjungan
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/jadwaldokter">
                        <i class="fas fa-calendar-alt"></i> Jadwal Dokter
                    </a>
                </li>
            </ul>
        </div>