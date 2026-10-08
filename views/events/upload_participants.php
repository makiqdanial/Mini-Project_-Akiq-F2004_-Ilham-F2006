<?php require_once 'views/includes/header.php'; ?>

<div class="container mt-4">
    <h2>Bulk Participant Registration (CSV Upload)</h2>
    <a href="index.php" class="btn btn-secondary mb-3">Kembali ke Senarai Acara</a>

    <?php if (isset($_GET['error'])): ?>
        <div class="alert alert-danger"><?= htmlspecialchars($_GET['error']) ?></div>
    <?php endif; ?>
    <?php if (isset($_GET['success'])): ?>
        <div class="alert alert-success">Peserta dari CSV berjaya dimuat naik!</div>
    <?php endif; ?>

    <div class="card mb-4 shadow-sm">
        <div class="card-body">
            <form action="index.php?action=process_upload" method="POST" enctype="multipart/form-data">
                <input type="hidden" name="event_id" value="<?= htmlspecialchars($_GET['event_id'] ?? $event_id ?? '') ?>">
                <div class="mb-3">
                    <label for="csv_file" class="form-label font-weight-bold">Pilih Fail CSV Peserta (Dataset Airline)</label>
                    <input type="file" name="csv_file" id="csv_file" class="form-control" accept=".csv" required>
                </div>
                <button type="submit" name="upload" class="btn btn-primary">Muat Naik & Proses</button>
            </form>
        </div>
    </div>

    <h4 class="mt-4">Senarai Peserta Terdaftar (Output Dataset)</h4>
    <table class="table table-bordered table-striped mt-3 align-middle">
        <thead class="table-dark">
            <tr>
                <th>#</th>
                <th>Passenger ID</th>
                <th>Nama Peserta</th>
                <th>Kewarganegaraan / Info</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($participants)): ?>
                <?php $no = 1; foreach ($participants as $p): ?>
                    <tr>
                        <td><?= $no++ ?></td>
                        <td><?= htmlspecialchars($p['student_id'] ?? '') ?></td>
                        <td><?= htmlspecialchars($p['name'] ?? '') ?></td>
                        <td><?= htmlspecialchars($p['email'] ?? '') ?></td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="4" class="text-center text-muted">Tiada peserta mendaftar lagi. Sila muat naik fail CSV di atas.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>

<?php require_once 'views/includes/footer.php'; ?>