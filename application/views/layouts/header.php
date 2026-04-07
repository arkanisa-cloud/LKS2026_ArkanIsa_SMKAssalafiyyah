<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>UMKM Kita - Title</title>
    <link
        href="<?= base_url('https://fonts.googleapis.com/css2?family=Nunito:wght@300;400;600;700;800&display=swap') ?>"
        rel="stylesheet">
    <link rel="stylesheet" href="<?= base_url('assets/css/bootstrap.css') ?>">
    <link rel="stylesheet" href="<?= base_url('assets/vendors/bootstrap-icons/bootstrap-icons.css') ?>">
    <link rel="stylesheet" href="<?= base_url('assets/css/app.css') ?>">
    <link rel="stylesheet" href="<?= base_url('assets/css/pages/auth.css') ?>">

    <style>
        .nav-link.active {
            font-weight: bold;
            border-bottom: 2px solid white;
        }
    </style>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary shadow-sm">
        <div class="container">
            <a href="<?= site_url('dashboard') ?>" class="navbar-brand fw-bold text-uppercase">Digital UMKM</a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mainNav">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="mainNav">
                <ul class="navbar-nav me-auto">
                    <?php if ($this->ion_auth->in_group('applicant')): ?>
                        <li class="nav-item">
                            <a class="nav-link <?= ($page == 'dashboard_umkm') ? 'active' : '' ?>"
                                href="<?= site_url('dashboard/dashboard_umkm') ?>">
                                Beranda
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link <?= ($page == 'umkm') ? 'active' : '' ?>"
                                href="<?= site_url('umkm_profile') ?>">
                                Profil UMKM
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link <?= ($page == 'loan') ? 'active' : '' ?>" href="<?= site_url('loan') ?>">
                                Pinjaman
                            </a>
                        </li>
                    <?php endif; ?>
                    <?php if ($this->ion_auth->in_group('verifier')): ?>
                        <li class="nav-item">
                            <a class="nav-link <?= ($page == 'dashboard_verifier') ? 'active' : '' ?>"
                                href="<?= site_url('dashboard/dashboard_verifier') ?>">
                                Beranda
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link <?= ($page == 'verifier') ? 'active' : '' ?>"
                                href="<?= site_url('verifier') ?>">
                                Verifikasi
                            </a>
                        </li>
                    <?php endif; ?>
                    <?php if ($this->ion_auth->in_group('analyst')): ?>
                        <li class="nav-item">
                            <a class="nav-link <?= ($page == 'dashboard_analyst') ? 'active' : '' ?>"
                                href="<?= site_url('dashboard/dashboard_analyst') ?>">
                                Beranda
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link <?= ($page == 'analyst') ? 'active' : '' ?>"
                                href="<?= site_url('analyst') ?>">
                                Analis
                            </a>
                        </li>
                    <?php endif; ?>
                    <?php if ($this->ion_auth->in_group('manager')): ?>
                        <li class="nav-item">
                            <a class="nav-link <?= ($page == 'dashboard_manager') ? 'active' : '' ?>"
                                href="<?= site_url('dashboard/dashboard_manager') ?>">
                                Beranda
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link <?= ($page == 'manager') ? 'active' : '' ?>"
                                href="<?= site_url('manager') ?>">
                                Manager
                            </a>
                        </li>
                    <?php endif; ?>
                </ul>
                <div class="d-flex align-items-center">
                    <a href="<?= site_url('auth/logout') ?>" class="btn btn-light-info btn-sm text-danger fw-bold">
                        <i class="bi bi-box-arrow-right"></i> Keluar
                    </a>
                </div>
            </div>
        </div>
    </nav>
    <main class="container mt-4">