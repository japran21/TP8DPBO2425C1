<div class="d-flex justify-content-between align-items-center mb-3">
    <h1 class="h3">Data Mata Kuliah</h1>
    <a class="btn btn-primary" href="index.php?page=courses&action=create">Tambah Mata Kuliah</a>
</div>
<div class="table-responsive">
    <table class="table table-striped align-middle">
        <thead><tr><th>Kode</th><th>Nama Mata Kuliah</th><th>SKS</th><th>Dosen</th><th>Aksi</th></tr></thead>
        <tbody>
        <?php foreach ($courses as $course): ?>
            <tr>
                <td><?= e($course['course_code']) ?></td><td><?= e($course['course_name']) ?></td>
                <td><?= e($course['credits']) ?></td><td><?= e($course['lecturer_name'] ?? '-') ?></td>
                <td class="text-nowrap">
                    <a class="btn btn-sm btn-warning" href="index.php?page=courses&action=edit&id=<?= e($course['id']) ?>">Edit</a>
                    <form class="d-inline" method="post" action="index.php?page=courses&action=delete" onsubmit="return confirm('Hapus mata kuliah ini? Jadwalnya juga akan dihapus.')">
                        <input type="hidden" name="id" value="<?= e($course['id']) ?>">
                        <button class="btn btn-sm btn-danger" type="submit">Hapus</button>
                    </form>
                </td>
            </tr>
        <?php endforeach; ?>
        <?php if (!$courses): ?><tr><td colspan="5" class="text-center">Belum ada mata kuliah.</td></tr><?php endif; ?>
        </tbody>
    </table>
</div>
