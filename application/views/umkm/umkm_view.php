<?php
$this->load->view('layouts/header');
?>


<div class="container mt-4">
    <div class="row justify-content-center">
        <div class="col-md-8">

            <div class="card shadow-sm border-0">
                <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                    <h5 class="mb-0 text-light">Informasi Profil UMKM</h5>
                    <a href="<?= site_url('umkm_profile/edit') ?>" class="btn btn-sm btn-light">Edit Profil</a>
                </div>

                <div class="card-body">
                    <?php if ($this->session->flashdata('message')): ?>
                        <div class="alert alert-success">
                            <?= $this->session->flashdata('message') ?>
                        </div>
                    <?php endif; ?>

                    <div class="row mb-3 mt-3">
                        <div class="col-md-4 text-muted fw-bold">Nama Usaha</div>
                        <div class="col-md-8 fs-5"><?= htmlspecialchars($profile->name) ?></div>
                    </div>
                    <hr>
                    <div class="row mb-3">
                        <div class="col-md-4 text-muted fw-bold">Alamat</div>
                        <div class="col-md-8"><?= nl2br(htmlspecialchars($profile->address)) ?>
                        </div>
                    </div>
                    <hr>
                    <div class="row mb-3">
                        <div class="col-md-4 text-muted fw-bold">NIB</div>
                        <div class="col-md-8"><?= htmlspecialchars($profile->nib) ?>
                        </div>
                    </div>
                    <hr>
                    <div class="row mb-3">
                        <div class="col-md-4 text-muted fw-bold">NPWP</div>
                        <div class="col-md-8"><?= htmlspecialchars($profile->npwp) ?>
                        </div>
                    </div>
                    <hr>

                    <div class="row mb-3">
                        <div class="col-md-4 text-muted fw-bold">Pendapatan Bulanan</div>
                        <div class="col-md-8">
                            <span class="badge bg-success" style="font-size: 16px;">
                                Rp <?= number_format($profile->monthly_income, 0, ',', '.') ?>
                            </span>
                        </div>
                    </div>
                    <hr>
                    <div class="row mb-3">
                        <div class="col-md-4 text-muted fw-bold">Jumlah Karyawan</div>
                        <div class="col-md-8"><?= htmlspecialchars($profile->worker) ?>
                        </div>
                    </div>
                    <hr>
                    <div class="row mb-3">
                        <div class="col-md-4 text-muted fw-bold">Berdiri Sejak</div>
                        <div class="col-md-8"><?= date('D-M-Y', strtotime($profile->long_time)) ?>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

<?php $this->load->view('layouts/footer'); ?>