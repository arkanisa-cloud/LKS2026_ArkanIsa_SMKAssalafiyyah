<?php $this->load->view('layouts/header'); ?>


<div class="container mt-4">
    <div class="row justify-content-center">
        <div class="col-md-4">
            <div class="card shadow-sm border-0">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0 text-light">Pengajuan Pinjaman</h5>
                </div>
                <div class="card-body">
                    <form action="<?= site_url('financing_application/save') ?>" method="POST">

                        <div class="mt-3">
                            <label class="form-label">Nominal Pinjaman</label>
                            <input type="number" class="form-control" name="amount" required max="<?= $max_amount ?>">
                        </div>
                        <div class="form-text mb-3">
                            Batas maksimal nominal: <?= number_format($max_amount, '0', ',', '.') ?>
                        </div>

                        <div class="mt-3">
                            <label class="form-label">Tujuan Pinjaman</label>
                            <textarea name="purpose" class="form-control" rows="1" required></textarea>
                        </div>

                        <div class="mt-3">
                            <label class="form-label fw-bold">Pilih Tenor (bulan)</label>
                            <select name="months" class="form-select">
                                <option value="" selected disabled>Pilih Tenor...</option>
                                <option value="3">3 Bulan</option>
                                <option value="6">6 Bulan</option>
                                <option value="12">12 Bulan</option>
                                <option value="24">24 Bulan</option>
                            </select>
                        </div>

                        <button type="submit" class="btn btn-primary w-100 mt-3">Ajukan</button>
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
                                <tr class="text-center">
                                    <th>No</th>
                                    <th>Tanggal</th>
                                    <th>Nominal</th>
                                    <th>Tenor</th>
                                    <th>Tujuan</th>
                                    <th>Status</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (empty($financing_applications)): ?>
                                    <tr>
                                        <td colspan="7" class="text-center">Data masih kosong.</td>
                                    </tr>
                                <?php else: ?>
                                    <?php $no = 1;
                                    foreach ($financing_applications as $row): ?>
                                        <tr>
                                            <td><?= $no++ ?></td>
                                            <td><?= date('d-m-Y', strtotime($row->created_at)); ?></td>
                                            <td><?= number_format($row->amount, '0', ',', '.') ?></td>
                                            <td><?= $row->months ?> Bulan</td>
                                            <td>
                                                <?= $row->purpose ?>
                                            </td>
                                            <td>
                                                <?php $badge = 'bg-secondary';
                                                if ($row->status == 'submitted')
                                                    echo '<span class="badge bg-secondary">Diajukan</span>';
                                                if ($row->status == 'under_review')
                                                    echo '<span class="badge bg-warning">Dibawah Rata-rata</span>';
                                                if ($row->status == 'recommended')
                                                    echo '<span class="badge bg-info">Direkomendasikan</span>';
                                                if ($row->status == 'approved')
                                                    echo '<span class="badge bg-success">Disetujui</span>';
                                                if ($row->status == 'rejected_by_manager' || $row->status == 'rejected_by_analyst')
                                                    echo '<span class="badge bg-danger">Ditolak</span>'; ?>
                                            </td>
                                            <td>
                                                <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal"
                                                    data-bs-target="#modalEdit<?= $row->financing_application_id ?>">Edit</button>

                                                <a href="<?= site_url('financing_application/delete/' . $row->financing_application_id) ?>"
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

                <?php if (!empty($financing_applications)): ?>
                    <?php foreach ($financing_applications as $row): ?>
                        <div id="modalEdit<?= $row->financing_application_id ?>" class="modal fade" tabindex="-1">
                            <div class="modal-dialog">
                                <div class="modal-content p-3 pt-0">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Edit Peminjaman -
                                            <?= date('d-m-Y', strtotime($row->created_at)); ?>
                                        </h5>
                                        </h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <form
                                        action="<?= site_url('financing_application/edit/' . $row->financing_application_id) ?>"
                                        method="POST">

                                        <div class="mt-3">
                                            <label class="form-label">Nominal Pinjaman</label>
                                            <input type="number" class="form-control" name="amount" required
                                                max="<?= $max_amount ?>">
                                        </div>
                                        <div class="form-text mb-3">
                                            Batas maksimal nominal: <?= number_format($max_amount, '0', ',', '.') ?>
                                        </div>

                                        <div class="mt-3">
                                            <label class="form-label">Tujuan Pinjaman</label>
                                            <textarea name="purpose" class="form-control" rows="1" required></textarea>
                                        </div>

                                        <div class="mt-3">
                                            <label class="form-label fw-bold">Pilih Tenor (bulan)</label>
                                            <select name="months" class="form-select">
                                                <option value="" selected disabled>Pilih Tenor...</option>
                                                <option value="3">3 Bulan</option>
                                                <option value="6">6 Bulan</option>
                                                <option value="12">12 Bulan</option>
                                                <option value="24">24 Bulan</option>
                                            </select>
                                        </div>

                                        <button type="submit" class="btn btn-primary w-100 mt-3">Ajukan</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php endif; ?>

            </div>
        </div>
    </div>
    <?php $this->load->view('layouts/footer'); ?>