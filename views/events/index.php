<?php include 'views/includes/header.php'; ?>

<div class="d-flex justify-content-between align-items-center mb-3">
    <h2>Senarai Acara / Program Kampus</h2>
    <a href="index.php?action=create" class="btn btn-primary">+ Tambah Acara Baharu</a>
</div>

<?php if (isset($_GET['status'])): ?>
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <?php
            if ($_GET['status'] == 'created') echo "Acara berjaya ditambah!";
            elseif ($_GET['status'] == 'updated') echo "Acara berjaya dikemaskini!";
            elseif ($_GET['status'] == 'deleted') echo "Acara berjaya dipadam!";
        ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
<?php endif; ?>

<div class="card shadow-sm">
    <div class="card-body">
        <table class="table table-bordered table-striped align-middle mb-0">
            <thead class="table-dark">
                <tr>
                    <th>#</th>
                    <th>Nama Acara</th>
                    <th>Tarikh</th>
                    <th>Lokasi</th>
                    <th>Sasaran</th>
                    <th>Bajet (RM)</th>
                    <th>Status</th>
                    <th>Tindakan</th>
                    <th>CSV</th>
                </tr>
            </thead>
            <tbody>
                <?php if (empty($events)): ?>
                    <tr><td colspan="9" class="text-center">Tiada rekod acara ditemui.</td></tr>
                <?php else: ?>
                    <?php foreach ($events as $index => $row): ?>
                        <tr>
                            <td><?= $index + 1; ?></td>
                            <td><strong><?= htmlspecialchars($row['event_name']); ?></strong></td>
                            <td><?= htmlspecialchars($row['event_date']); ?></td>
                            <td><?= htmlspecialchars($row['venue']); ?></td>
                            <td><?= htmlspecialchars($row['target_audience']); ?></td>
                            <td><?= number_format($row['budget'], 2); ?></td>
                            <td>
                                <span class="badge bg-<?= $row['status'] == 'Approved' ? 'success' : ($row['status'] == 'Rejected' ? 'danger' : 'warning'); ?>">
                                    <?= htmlspecialchars($row['status']); ?>
                                </span>
                            </td>
                            <td>
                                <a href="index.php?action=edit&id=<?= $row['id']; ?>" class="btn btn-sm btn-warning">Edit</a>
                                <a href="index.php?action=delete&id=<?= $row['id']; ?>" 
                                   class="btn btn-sm btn-danger" 
                                   onclick="return confirm('Adakah anda pasti mahu memadam acara \'<?= htmlspecialchars($row['event_name']); ?>\'?');">
                                    Padam
                                </a>
                            </td>
                            <td>
                                <a href="index.php?action=upload_participants&event_id=<?= $row['id']; ?>" class="btn btn-sm btn-info text-white">Peserta (CSV)</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<?php include 'views/includes/footer.php'; ?>