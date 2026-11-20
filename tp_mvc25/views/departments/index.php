<div class="d-flex justify-content-between align-items-center mb-3">
    <h1 class="h3">Data Departemen</h1>
    <a class="btn btn-primary" href="index.php?page=departments&action=create">Tambah Departemen</a>
</div>
<div class="table-responsive">
    <table class="table table-striped align-middle">
        <thead><tr><th>Nama Departemen</th><th>Fakultas</th><th>Jumlah Dosen</th><th>Aksi</th></tr></thead>
        <tbody>
        <?php foreach ($departments as $department): ?>
            <tr>
                <td><?= e($department['department_name']) ?></td>
                <td><?= e($department['faculty']) ?></td>
                <td><?= e($department['lecturer_count']) ?></td>
                <td class="text-nowrap">
                    <a class="btn btn-sm btn-warning" href="index.php?page=departments&action=edit&id=<?= e($department['id']) ?>">Edit</a>
                    <form class="d-inline" method="post" action="index.php?page=departments&action=delete" onsubmit="return confirm('Hapus departemen ini? Dosen terkait akan menjadi tanpa departemen.')">
                        <input type="hidden" name="id" value="<?= e($department['id']) ?>">
                        <button class="btn btn-sm btn-danger" type="submit">Hapus</button>
                    </form>
                </td>
            </tr>
        <?php endforeach; ?>
        <?php if (!$departments): ?><tr><td colspan="4" class="text-center">Belum ada data departemen.</td></tr><?php endif; ?>
        </tbody>
    </table>
</div>
