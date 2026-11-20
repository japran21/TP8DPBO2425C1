<?php ob_start(); ?>
    <?php if ($schedule): ?><input type="hidden" name="id" value="<?= e($schedule['id']) ?>"><?php endif; ?>
    <div class="mb-3">
        <label class="form-label" for="course_id">Mata Kuliah</label>
        <select class="form-select" id="course_id" name="course_id" required>
            <option value="">Pilih mata kuliah</option>
            <?php foreach ($courses as $course): ?>
                <option value="<?= e($course['id']) ?>" <?= isset($schedule['course_id']) && (int) $schedule['course_id'] === (int) $course['id'] ? 'selected' : '' ?>>
                    <?= e($course['course_code']) ?> - <?= e($course['course_name']) ?>
                </option>
            <?php endforeach; ?>
        </select>
    </div>
    <div class="mb-3">
        <label class="form-label" for="day">Hari</label>
        <select class="form-select" id="day" name="day" required>
            <option value="">Pilih hari</option>
            <?php foreach (['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu', 'Minggu'] as $day): ?>
                <option value="<?= e($day) ?>" <?= isset($schedule['day']) && $schedule['day'] === $day ? 'selected' : '' ?>><?= e($day) ?></option>
            <?php endforeach; ?>
        </select>
    </div>
    <div class="row">
        <div class="col-md-6 mb-3"><label class="form-label" for="start_time">Jam Mulai</label><input class="form-control" id="start_time" name="start_time" type="time" required value="<?= e(isset($schedule['start_time']) ? substr($schedule['start_time'], 0, 5) : '') ?>"></div>
        <div class="col-md-6 mb-3"><label class="form-label" for="end_time">Jam Selesai</label><input class="form-control" id="end_time" name="end_time" type="time" required value="<?= e(isset($schedule['end_time']) ? substr($schedule['end_time'], 0, 5) : '') ?>"></div>
    </div>
    <div class="mb-3"><label class="form-label" for="classroom">Ruangan</label><input class="form-control" id="classroom" name="classroom" required value="<?= e($schedule['classroom'] ?? '') ?>"></div>
<?php
$fields = ob_get_clean();
echo render_form_template(
    $heading,
    'index.php?page=schedules&action=' . $action,
    $fields,
    'index.php?page=schedules'
);
?>
