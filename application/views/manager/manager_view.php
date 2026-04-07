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
                        <?php if (empty($verified_loan) && empty($recommended_loan) && empty($under_review_loan)): ?>
                            <tr>
                                <td colspan="8" class="text-center">Data masih kosong.</td>
                            </tr>
                        <?php else: ?>
                            <?php $no = 1;
                            foreach (array_merge($verified_loan, $recommended_loan, $under_review_loan) as $row): ?>
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
                                            echo '<span class="badge bg-secondary">Dalam Peninjauan</span>';
                                        } elseif ($row->status === 'recommended') {
                                            echo '<span class="badge bg-info">Direkomendasikan</span>';
                                        }
                                        ?>
                                    </td>
                                    <td>
                                        <a href="<?= site_url('verifer/edit/' . $row->loan_id . '/rejected') ?>"
                                            class="btn btn-sm btn-primary">Tolak</a>
                                        <a href="<?= site_url('verifer/edit/' . $row->loan_id . '/approved') ?>"
                                            class="btn btn-sm btn-primary">Terima</a>
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

<?php $this->load->view('layouts/footer'); ?>