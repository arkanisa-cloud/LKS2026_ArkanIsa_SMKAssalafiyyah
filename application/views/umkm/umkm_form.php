<?php
$this->load->view('layouts/header');
?>

<div class="container-fluid mt-4">
    <div class="row justify-content-center">

        <div class="col-md-8">
            <div class="card shadow-sm border-0">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0"></h5>
                    <?= isset($profile) ? 'Edit Profil Usaha' : 'Tambahkan Profil Usaha' ?>
                </div>

                <div class="card-body">

                    <form action="<?= site_url('umkm_profile/save') ?>" method="POST">
                        <div class="mb-3 mt-3">
                            <label class="form-label">Nama Usaha</label>
                            <input type="text" class="form-control" name="name"
                                value="<?= isset($profile) ? htmlspecialchars($profile->name) : '' ?>" required>
                        </div>
                        <div>
                            <label class="form-label">Alamat</label>
                            <input type="text" class="form-control" name="address"
                                value="<?= isset($profile) ? htmlspecialchars($profile->address) : '' ?>" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">NIB</label>
                            <input type="number" class="form-control" name="nib"
                                value="<?= isset($profile) ? htmlspecialchars($profile->nib) : '' ?>" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">NPWP</label>
                            <input type="number" class="form-control" name="npwp"
                                value="<?= isset($profile) ? htmlspecialchars($profile->npwp) : '' ?>" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Pendapatan Bulanan</label>
                            <input type="number" class="form-control" name="monthly_income"
                                value="<?= isset($profile) ? htmlspecialchars($profile->monthly_income) : '' ?>"
                                required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Jumlah Karyawan</label>
                            <input type="number" class="form-control" name="worker"
                                value="<?= isset($profile) ? htmlspecialchars($profile->worker) : '' ?>" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Sejak Berdiri</label>
                            <input type="date" class="form-control" name="long_time"
                                value="<?= isset($profile) ? htmlspecialchars($profile->long_time) : '' ?>" required>
                        </div>

                        <button type="submit" class="btn btn-primary w-100">Submit</button>
                    </form>

                </div>
            </div>

        </div>

    </div>
</div>

<?php $this->load->view('layouts/footer'); ?>