<?php $this->load->view('layouts/header'); ?>

<div class="container mt-4">
    <div class="page-heading d-flex justify-content-between align-items-center mb-3">
        <h3>Persetujuan Peminjaman</h3>
    </div>

    <div class="card shadow-sm border-0">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover table-striped">
                    <thead class="table-light">
                        <tr>
                            <th>No</th>
                            <th>nama</th>
                            <th>NIB</th>
                            <th>NPWP</th>
                            <th>Pendapatan Bulanan</th>
                            <th>Tenor</th>
                            <th>Total</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (empty($recommended_financing_applications) && empty($under_review_financing_applications)): ?>
                            <tr>
                                <td colspan="9" class="text-center">Data masih kosong.</td>
                            </tr>
                        <?php else: ?>
                            <?php $no = 1;
                            foreach (array_merge($recommended_financing_applications, $under_review_financing_applications) as $row): ?>
                                <tr>
                                    <td><?= $no++ ?></td>
                                    <td><?= $row->name ?></td>
                                    <td><?= $row->nib ?></td>
                                    <td><?= $row->npwp ?></td>
                                    <td><?= $row->monthly_income ?></td>
                                    <td><?= $row->months ?> Bulan</td>
                                    <td><?= $row->amount ?></td>
                                    <td>
                                        <?php
                                        if ($row->status === 'under_review') {
                                            echo '<span class="badge bg-secondary">Dibawah Rata-rata</span>';
                                        } elseif ($row->status === 'recommended') {
                                            echo '<span class="badge bg-info">Direkomendasikan</span>';
                                        }
                                        ?>
                                    </td>
                                    <td>
                                        <button type="button" class="btn btn-sm btn-danger" data-bs-toggle="modal"
                                            data-bs-target="#modalManager<?= $row->financing_application_id ?>">Tolak</button>
                                        <a href="<?= site_url('approval/edit/' . $row->financing_application_id . '/approved') ?>"
                                            class="btn btn-sm btn-primary">Terima</a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>

        <?php foreach (array_merge($recommended_financing_applications, $under_review_financing_applications) as $row): ?>
            <div id="modalManager<?= $row->financing_application_id ?>" class="modal fade" tabindex="-1">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Alasan Penolakan Peminjaman
                            </h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <form method="POST"
                            action="<?= site_url('approval/edit/' . $row->financing_application_id . '/rejected_by_manager') ?>">
                            <div class="modal-body">
                                <div class="mb-3">
                                    <label for="floatingTextarea">Alasan Penolakan</label>
                                    <textarea class="form-control" name="rejected_reason"
                                        placeholder="Tuliskan alasan disini!" required></textarea>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-danger">Tolak</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>

<?php $this->load->view('layouts/footer'); ?>