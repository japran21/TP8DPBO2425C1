<?php ob_start(); ?>
    <?php if ($department): ?><input type="hidden" name="id" value="<?= e($department['id']) ?>"><?php endif; ?>
    <div class="mb-3">
        <label class="form-label" for="department_name">Nama Departemen</label>
        <input class="form-control" id="department_name" name="department_name" required value="<?= e($department['department_name'] ?? '') ?>">
    </div>
    <div class="mb-3">
        <label class="form-label" for="faculty">Fakultas</label>
        <input class="form-control" id="faculty" name="faculty" required value="<?= e($department['faculty'] ?? '') ?>">
    </div>
<?php
$fields = ob_get_clean();
echo render_form_template(
    $heading,
    'index.php?page=departments&action=' . $action,
    $fields,
    'index.php?page=departments'
);
?>
