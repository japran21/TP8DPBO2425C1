<?php ob_start(); ?>
    <?php if ($course): ?><input type="hidden" name="id" value="<?= e($course['id']) ?>"><?php endif; ?>
    <div class="mb-3"><label class="form-label" for="course_code">Kode Mata Kuliah</label><input class="form-control" id="course_code" name="course_code" required value="<?= e($course['course_code'] ?? '') ?>"></div>
    <div class="mb-3"><label class="form-label" for="course_name">Nama Mata Kuliah</label><input class="form-control" id="course_name" name="course_name" required value="<?= e($course['course_name'] ?? '') ?>"></div>
    <div class="mb-3"><label class="form-label" for="credits">SKS</label><input class="form-control" id="credits" name="credits" type="number" min="1" required value="<?= e($course['credits'] ?? '') ?>"></div>
    <div class="mb-3">
        <label class="form-label" for="lecturer_id">Dosen</label>
        <select class="form-select" id="lecturer_id" name="lecturer_id">
            <option value="">Tidak ada dosen</option>
            <?php foreach ($lecturers as $lecturer): ?>
                <option value="<?= e($lecturer['id']) ?>" <?= isset($course['lecturer_id']) && (int) $course['lecturer_id'] === (int) $lecturer['id'] ? 'selected' : '' ?>>
                    <?= e($lecturer['name']) ?> (<?= e($lecturer['nidn']) ?>)
                </option>
            <?php endforeach; ?>
        </select>
    </div>
<?php
$fields = ob_get_clean();
echo render_form_template(
    $heading,
    'index.php?page=courses&action=' . $action,
    $fields,
    'index.php?page=courses'
);
?>
