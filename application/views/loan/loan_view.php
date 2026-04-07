<?php $this->load->view('layouts/header'); ?>


<div class="container mt-4">
    <div class="row justify-content-center">
        <div class="col-md-4">
            <div class="card shadow-sm border-0">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0 text-light">Pengajuan Pinjaman</h5>
                </div>
                <div class="card-body">
                    <form action="<?= site_url('loan/save') ?>" method="POST">

                        <div class="mt-3">
                            <label class="form-label">Nominal Pinjaman</label>
                            <input type="number" class="form-control" name="amount" required max="<? $max_amount ?>">
                        </div>
                        <div class="form-text mb-3">
                            Batas maksimal nominal: <?= number_format($max_amount, '0', ',', '.') ?>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-bold">Pilih Tenor (bulan)</label>
                            <select name="months" class="form-select">
                                <option value="" selected disabled>Pilih Tenor...</option>
                                <option value="3">3 Bulan</option>
                                <option value="6">6 Bulan</option>
                                <option value="12">12 Bulan</option>
                                <option value="24">24 Bulan</option>
                            </select>
                        </div>

                        <button type="submit" class="btn btn-primary w-100">Ajukan</button>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-md-8">
            <div class="card shadow-sm border-0">
                <div class="card-header bg-primary">
                    <h5 class="fw-semibold text-light">Riwayat Pinjaman</h5>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover table-striped">
                            <thead class="table-light">
                                <tr>
                                    <th>No</th>
                                    <th>Tanggal</th>
                                    <th>Nominal</th>
                                    <th>Tenor</th>
                                    <th>Status</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (empty($loans)): ?>
                                    <tr>
                                        <td colspan="5" class="text-center">Data masih kosong.</td>
                                    </tr>
                                <?php else: ?>
                                    <?php $no = 1;
                                    foreach ($loans as $row): ?>
                                        <tr>
                                            <td><?= $no++ ?></td>
                                            <td><?= date('D-M-Y', strtotime($row->created_at)); ?></td>
                                            <td><?= number_format($row->amount, '0', ',', '.') ?></td>
                                            <td><?= $row->months ?> Bulan</td>
                                            <td>
                                                <?php $badge = 'bg-secondary';
                                                if ($row->status == 'submitted')
                                                    $badge = 'bg-warning text-dark';
                                                if ($row->status == 'draft')
                                                    $badge = 'bg-info text-dark';
                                                if ($row->status == 'approved')
                                                    $badge = 'bg-success';
                                                if ($row->status == 'rejected')
                                                    $badge = 'bg-danger'; ?>
                                                <span class="badge bg-info"><?= strtoupper($row->status) ?></span>
                                            </td>
                                            <td>
                                                <a href="<?= site_url('installment/edit/' . $row->loan_id) ?>"
                                                    class="btn btn-warning btn-sm">Cicilan</a>
                                                <a href="<?= site_url('loan/delete/' . $row->loan_id) ?>"
                                                    class="btn btn-danger btn-sm"
                                                    onclick="return confirm('Apakah Anda yakin ingin menghapus pinjaman ini?')">Hapus</a>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <?php $this->load->view('layouts/footer'); ?>