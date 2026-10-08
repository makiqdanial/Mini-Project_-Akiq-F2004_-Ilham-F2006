<?php include 'views/includes/header.php'; ?>

<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card shadow-sm">
            <div class="card-header bg-primary text-white">
                <h4 class="mb-0">Daftar Acara / Program Baharu</h4>
            </div>
            <div class="card-body">
                <form action="index.php?action=create" method="POST">
                    <div class="mb-3">
                        <label class="form-label">Nama Acara *</label>
                        <input type="text" name="event_name" class="form-control" required placeholder="">
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Tarikh Acara *</label>
                            <input type="date" name="event_date" class="form-control" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Lokasi / Tempat *</label>
                            <input type="text" name="venue" class="form-control" required placeholder="">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Sasaran Peserta *</label>
                            <input type="text" name="target_audience" class="form-control" required placeholder="">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Anggaran Bajet (RM)</label>
                            <input type="number" step="0.01" name="budget" class="form-control" placeholder="0.00" value="0.00">
                        </div>
                    </div>
                    <div class="d-flex justify-content-between">
                        <a href="index.php" class="btn btn-secondary">Batal</a>
                        <button type="submit" class="btn btn-success">Simpan Acara</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<?php include 'views/includes/footer.php'; ?>