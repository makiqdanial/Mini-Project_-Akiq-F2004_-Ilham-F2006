<?php include 'views/includes/header.php'; ?>

<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card shadow-sm">
            <div class="card-header bg-warning text-dark">
                <h4 class="mb-0">Kemaskini Maklumat Acara</h4>
            </div>
            <div class="card-body">
                <form action="index.php?action=edit&id=<?= $event['id']; ?>" method="POST">
                    <div class="mb-3">
                        <label class="form-label">Nama Acara</label>
                        <input type="text" name="event_name" class="form-control" value="<?= htmlspecialchars($event['event_name']); ?>" required>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Tarikh Acara</label>
                            <input type="date" name="event_date" class="form-control" value="<?= htmlspecialchars($event['event_date']); ?>" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Lokasi / Tempat</label>
                            <input type="text" name="venue" class="form-control" value="<?= htmlspecialchars($event['venue']); ?>" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Sasaran Peserta</label>
                            <input type="text" name="target_audience" class="form-control" value="<?= htmlspecialchars($event['target_audience']); ?>" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Anggaran Bajet (RM)</label>
                            <input type="number" step="0.01" name="budget" class="form-control" value="<?= htmlspecialchars($event['budget']); ?>">
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Status Kelulusan</label>
                        <select name="status" class="form-select">
                            <option value="Pending" <?= $event['status'] == 'Pending' ? 'selected' : ''; ?>>Pending</option>
                            <option value="Approved" <?= $event['status'] == 'Approved' ? 'selected' : ''; ?>>Approved</option>
                            <option value="Rejected" <?= $event['status'] == 'Rejected' ? 'selected' : ''; ?>>Rejected</option>
                        </select>
                    </div>
                    <div class="d-flex justify-content-between">
                        <a href="index.php" class="btn btn-secondary">Batal</a>
                        <button type="submit" class="btn btn-primary">Kemaskini</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<?php include 'views/includes/footer.php'; ?>