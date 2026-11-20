<div class="d-flex justify-content-between align-items-center mb-3">
    <h1 class="h3">Data Dosen</h1>
    <a class="btn btn-primary" href="index.php?page=lecturers&action=create">Tambah Dosen</a>
</div>
<div class="table-responsive">
    <table class="table table-striped align-middle">
        <thead><tr><th>Nama</th><th>NIDN</th><th>Departemen</th><th>Email</th><th>Telepon</th><th>Tanggal Bergabung</th><th>Aksi</th></tr></thead>
        <tbody>
        <?php foreach ($lecturers as $lecturer): ?>
            <tr>
                <td><?= e($lecturer['name']) ?></td>
                <td><?= e($lecturer['nidn']) ?></td>
                <td><?= e($lecturer['department_name'] ?? '-') ?></td>
                <td><?= e($lecturer['email']) ?></td>
                <td><?= e($lecturer['phone']) ?></td>
                <td><?= e($lecturer['join_date']) ?></td>
                <td class="text-nowrap">
                    <a class="btn btn-sm btn-warning" href="index.php?page=lecturers&action=edit&id=<?= e($lecturer['id']) ?>">Edit</a>
                    <form class="d-inline" method="post" action="index.php?page=lecturers&action=delete" onsubmit="return confirm('Hapus dosen ini?')">
                        <input type="hidden" name="id" value="<?= e($lecturer['id']) ?>">
                        <button class="btn btn-sm btn-danger" type="submit">Hapus</button>
                    </form>
                </td>
            </tr>
        <?php endforeach; ?>
        <?php if (!$lecturers): ?><tr><td colspan="7" class="text-center">Belum ada data dosen.</td></tr><?php endif; ?>
        </tbody>
    </table>
</div>
