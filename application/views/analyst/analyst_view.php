<?php $this->load->view('layouts/header'); ?>

<div class="container mt-4">
    <div class="page-heading d-flex justify-content-between align-items-center mb-3">
        <h3>Analisis Peminjaman</h3>
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
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (empty($submitted_loan)): ?>
                            <tr>
                                <td colspan="8" class="text-center">Data masih kosong.</td>
                            </tr>
                        <?php else: ?>
                            <?php $no = 1;
                            foreach ($submitted_loan as $row): ?>
                                <tr>
                                    <td><?= $no++ ?></td>
                                    <td><?= $row->name ?></td>
                                    <td><?= $row->nib ?></td>
                                    <td><?= $row->npwp ?></td>
                                    <td><?= $row->monthly_income ?></td>
                                    <td>
                                        <?= $row->months ?> Bulan
                                    </td>
                                    <td><?= $row->amount ?></td>
                                    <td>
                                        <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal"
                                            data-bs-target="#modalAnalyst<?= $row->loan_id ?>">Analis</button>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <?php if (!empty($submitted_loan)): ?>
        <?php foreach ($submitted_loan as $row): ?>
            <div id="modalAnalyst<?= $row->loan_id ?>" class="modal fade" tabindex="-1">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Analisis Peminjaman - <?= $row->name ?></h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <form method="POST" action="<?= site_url('analyst/edit/' . $row->loan_id) ?>">
                            <div class="modal-body">
                                <div>
                                    <label class="form-label">Rating Kelayakan</label>
                                    <input type="number" class="form-control" name="rate" required>
                                </div>
                                <div class="form-text mb-3">
                                    <p>1-25 Tolak | 25-50 Dibawah rata-rata | 65-100 Rekomendasi</p>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Rekomendasi Limit</label>
                                    <input type="number" class="form-control" name="rekomen_limit" required>
                                </div>
                                <div class="mb-3">
                                    <label for="floatingTextarea">Catatan Analis</label>
                                    <textarea class="form-control" name="note" placeholder="Tuliskan catatan disini!"
                                        required></textarea>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Kirim</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    <?php endif; ?>

</div>

<?php $this->load->view('layouts/footer'); ?>