<?php
class CourseController
{
    private $model;

    public function __construct()
    {
        $this->model = new Course();
    }

    public function dispatch($action)
    {
        switch ($action) {
            case 'index':
                render_page('courses/index.php', ['courses' => $this->model->all()], 'Mata Kuliah');
                return;
            case 'create':
                $this->form(null, 'store', 'Tambah Mata Kuliah');
                return;
            case 'store':
                $this->model->create($this->input());
                $this->redirect();
                return;
            case 'edit':
                $this->form($this->find($this->requestId()), 'update', 'Edit Mata Kuliah');
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
                exit('Aksi mata kuliah tidak ditemukan.');
        }
    }

    private function input()
    {
        return [
            'course_code' => trim($_POST['course_code'] ?? ''),
            'course_name' => trim($_POST['course_name'] ?? ''),
            'credits' => (int) ($_POST['credits'] ?? 0),
            'lecturer_id' => (int) ($_POST['lecturer_id'] ?? 0),
        ];
    }

    private function form($course, $action, $heading)
    {
        $lecturers = $this->model->lecturers();
        render_page('courses/form.php', compact('course', 'lecturers', 'action', 'heading'), $heading);
    }

    private function find($id)
    {
        $course = $this->model->find($id);
        if (!$course) {
            http_response_code(404);
            exit('Mata kuliah tidak ditemukan.');
        }
        return $course;
    }

    private function requestId($fromPost = false)
    {
        $source = $fromPost ? $_POST : $_GET;
        $id = $source['id'] ?? '';
        if (!ctype_digit((string) $id) || (int) $id < 1) {
            http_response_code(400);
            exit('ID mata kuliah tidak valid.');
        }
        return (int) $id;
    }

    private function redirect()
    {
        header('Location: index.php?page=courses');
        exit;
    }
}
