<?php ob_start(); ?>
    <?php if ($lecturer): ?><input type="hidden" name="id" value="<?= e($lecturer['id']) ?>"><?php endif; ?>
    <div class="mb-3"><label class="form-label" for="name">Nama</label><input class="form-control" id="name" name="name" required value="<?= e($lecturer['name'] ?? '') ?>"></div>
    <div class="mb-3"><label class="form-label" for="nidn">NIDN</label><input class="form-control" id="nidn" name="nidn" required value="<?= e($lecturer['nidn'] ?? '') ?>"></div>
    <div class="mb-3"><label class="form-label" for="email">Email</label><input class="form-control" id="email" name="email" type="email" required value="<?= e($lecturer['email'] ?? '') ?>"></div>
    <div class="mb-3"><label class="form-label" for="phone">Telepon</label><input class="form-control" id="phone" name="phone" required value="<?= e($lecturer['phone'] ?? '') ?>"></div>
    <div class="mb-3"><label class="form-label" for="join_date">Tanggal Bergabung</label><input class="form-control" id="join_date" name="join_date" type="date" required value="<?= e($lecturer['join_date'] ?? '') ?>"></div>
    <div class="mb-3">
        <label class="form-label" for="department_id">Departemen</label>
        <select class="form-select" id="department_id" name="department_id">
            <option value="">Tidak ada departemen</option>
            <?php foreach ($departments as $department): ?>
                <option value="<?= e($department['id']) ?>" <?= isset($lecturer['department_id']) && (int) $lecturer['department_id'] === (int) $department['id'] ? 'selected' : '' ?>>
                    <?= e($department['department_name']) ?> - <?= e($department['faculty']) ?>
                </option>
            <?php endforeach; ?>
        </select>
    </div>
<?php
$fields = ob_get_clean();
echo render_form_template(
    $heading,
    'index.php?page=lecturers&action=' . $action,
    $fields,
    'index.php?page=lecturers'
);
?>
