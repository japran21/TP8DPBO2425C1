<?php
class LecturerController
{
    private $model;

    public function __construct()
    {
        $this->model = new Lecturer();
    }

    public function dispatch($action)
    {
        switch ($action) {
            case 'index':
                render_page('lecturers/index.php', ['lecturers' => $this->model->all()], 'Data Dosen');
                return;
            case 'create':
                $this->form(null, 'store', 'Tambah Dosen');
                return;
            case 'store':
                $this->model->create($this->input());
                $this->redirect();
                return;
            case 'edit':
                $this->form($this->find($this->requestId()), 'update', 'Edit Dosen');
                return;
            case 'update':
                $this->model->update($this->requestId(true), $this->input());
                $this->redirect();
                return;
            case 'delete':
                $this->model->delete($this->requestId(true));
                $this->redirect();
                return;
            default:
                http_response_code(404);
                exit('Aksi dosen tidak ditemukan.');
        }
    }

    private function input()
    {
        $departmentId = (int) ($_POST['department_id'] ?? 0);
        return [
            'name' => trim($_POST['name'] ?? ''),
            'nidn' => trim($_POST['nidn'] ?? ''),
            'email' => trim($_POST['email'] ?? ''),
            'phone' => trim($_POST['phone'] ?? ''),
            'join_date' => trim($_POST['join_date'] ?? ''),
            'department_id' => $departmentId > 0 ? $departmentId : null,
        ];
    }

    private function form($lecturer, $action, $heading)
    {
        $departments = $this->model->departments();
        render_page(
            'lecturers/form.php',
            compact('lecturer', 'departments', 'action', 'heading'),
            $heading
        );
    }

    private function find($id)
    {
        $lecturer = $this->model->find($id);
        if (!$lecturer) {
            http_response_code(404);
            exit('Dosen tidak ditemukan.');
        }
        return $lecturer;
    }

    private function requestId($fromPost = false)
    {
        $source = $fromPost ? $_POST : $_GET;
        $id = $source['id'] ?? '';
        if (!ctype_digit((string) $id) || (int) $id < 1) {
            http_response_code(400);
            exit('ID dosen tidak valid.');
        }
        return (int) $id;
    }

    private function redirect()
    {
        header('Location: index.php?page=lecturers');
        exit;
    }
}
