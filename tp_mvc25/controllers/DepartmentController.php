<?php
class DepartmentController
{
    private $model;

    public function __construct()
    {
        $this->model = new Department();
    }

    public function dispatch($action)
    {
        switch ($action) {
            case 'index':
                render_page(
                    'departments/index.php',
                    ['departments' => $this->model->all()],
                    'Departemen'
                );
                return;
            case 'create':
                $this->form(null, 'store', 'Tambah Departemen');
                return;
            case 'store':
                $this->model->create($this->input());
                $this->redirect();
                return;
            case 'edit':
                $this->form($this->find($this->requestId()), 'update', 'Edit Departemen');
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
                exit('Aksi departemen tidak ditemukan.');
        }
    }

    private function input()
    {
        return [
            'department_name' => trim($_POST['department_name'] ?? ''),
            'faculty' => trim($_POST['faculty'] ?? ''),
        ];
    }

    private function form($department, $action, $heading)
    {
        render_page(
            'departments/form.php',
            compact('department', 'action', 'heading'),
            $heading
        );
    }

    private function find($id)
    {
        $department = $this->model->find($id);
        if (!$department) {
            http_response_code(404);
            exit('Departemen tidak ditemukan.');
        }
        return $department;
    }

    private function requestId($fromPost = false)
    {
        $source = $fromPost ? $_POST : $_GET;
        $id = $source['id'] ?? '';
        if (!ctype_digit((string) $id) || (int) $id < 1) {
            http_response_code(400);
            exit('ID departemen tidak valid.');
        }
        return (int) $id;
    }

    private function redirect()
    {
        header('Location: index.php?page=departments');
        exit;
    }
}
