<div class="d-flex justify-content-between align-items-center mb-3">
    <h1 class="h3">Jadwal Mata Kuliah</h1>
    <a class="btn btn-primary" href="index.php?page=schedules&action=create">Tambah Jadwal</a>
</div>
<div class="table-responsive">
    <table class="table table-striped align-middle">
        <thead><tr><th>Mata Kuliah</th><th>Hari</th><th>Waktu</th><th>Ruangan</th><th>Aksi</th></tr></thead>
        <tbody>
        <?php foreach ($schedules as $schedule): ?>
            <tr>
                <td><?= e($schedule['course_code']) ?> - <?= e($schedule['course_name']) ?></td>
                <td><?= e($schedule['day']) ?></td>
                <td><?= e(substr($schedule['start_time'], 0, 5)) ?>–<?= e(substr($schedule['end_time'], 0, 5)) ?></td>
                <td><?= e($schedule['classroom']) ?></td>
                <td class="text-nowrap">
                    <a class="btn btn-sm btn-warning" href="index.php?page=schedules&action=edit&id=<?= e($schedule['id']) ?>">Edit</a>
                    <form class="d-inline" method="post" action="index.php?page=schedules&action=delete" onsubmit="return confirm('Hapus jadwal ini?')">
                        <input type="hidden" name="id" value="<?= e($schedule['id']) ?>">
                        <button class="btn btn-sm btn-danger" type="submit">Hapus</button>
                    </form>
                </td>
            </tr>
        <?php endforeach; ?>
        <?php if (!$schedules): ?><tr><td colspan="5" class="text-center">Belum ada jadwal.</td></tr><?php endif; ?>
        </tbody>
    </table>
</div>
