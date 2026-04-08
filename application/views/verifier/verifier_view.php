<?php $this->load->view('layouts/header'); ?>

<div class="container mt-4">
    <div class="page-heading d-flex justify-content-between align-items-center mb-3">
        <h3>Verifikasi UMKM</h3>
    </div>

    <div class="card shadow-sm border-0">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover table-striped">
                    <thead class="table-light">
                        <tr>
                            <th>No</th>
                            <th>Nama UMKM</th>
                            <th>NIB</th>
                            <th>NPWP</th>
                            <th>Pendapatan Bulanan</th>
                            <th>Jumlah Karyawan</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (empty($bussiness_submitted)): ?>
                            <tr>
                                <td colspan="8" class="text-center">Data masih kosong.</td>
                            </tr>
                        <?php else: ?>
                            <?php $no = 1;
                            foreach ($bussiness_submitted as $row): ?>
                                <tr>
                                    <td><?= $no++ ?></td>
                                    <td><?= $row->name ?></td>
                                    <td><?= $row->nib ?></td>
                                    <td><?= $row->npwp ?></td>
                                    <td><?= $row->monthly_income ?></td>
                                    <td>
                                        <?= $row->worker ?>
                                    </td>
                                    <td>
                                        <span class="badge bg-info"><?= strtoupper($row->status) ?></span>
                                    </td>
                                    <td>
                                        <a href="<?= site_url('verifier/edit/' . $row->business_verification_id . '/verified') ?>"
                                            class="btn btn-success btn-sm"
                                            onclick="return confirm('Yakin untuk menyetujui UMKM ini?')">Setujui</a>
                                        <button type="button" class="btn btn-sm btn-danger" data-bs-toggle="modal"
                                            data-bs-target="#modalVerifier<?= $row->business_verification_id ?>">Tolak</button>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <?php if (!empty($bussiness_submitted)): ?>
        <?php foreach ($bussiness_submitted as $row): ?>
            <div id="modalVerifier<?= $row->business_verification_id ?>" class="modal fade" tabindex="-1">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Berikan Alasan Penolakan -
                                <?= $row->name ?>
                            </h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <form method="POST"
                            action="<?= site_url('verifier/edit/' . $row->business_verification_id . '/rejected') ?>">
                            <div class="modal-body">

                                <div class="mb-3">
                                    <label for="floatingTextarea">Alasan Penolakan</label>
                                    <textarea class="form-control" name="rejected_reason" placeholder="Tuliskan catatan disini!"
                                        required></textarea>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-danger"
                                    onclick="return confirm('Yakin untuk menolak UMKM ini?')">Tolak</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    <?php endif; ?>
</div>

<?php $this->load->view('layouts/footer'); ?>