<?php
class CourseScheduleController
{
    private $model;

    public function __construct()
    {
        $this->model = new CourseSchedule();
    }

    public function dispatch($action)
    {
        switch ($action) {
            case 'index':
                render_page('schedules/index.php', ['schedules' => $this->model->all()], 'Jadwal Mata Kuliah');
                return;
            case 'create':
                $this->form(null, 'store', 'Tambah Jadwal');
                return;
            case 'store':
                $this->model->create($this->input());
                $this->redirect();
                return;
            case 'edit':
                $this->form($this->find($this->requestId()), 'update', 'Edit Jadwal');
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
                exit('Aksi jadwal tidak ditemukan.');
        }
    }

    private function input()
    {
        return [
            'course_id' => (int) ($_POST['course_id'] ?? 0),
            'day' => trim($_POST['day'] ?? ''),
            'start_time' => trim($_POST['start_time'] ?? ''),
            'end_time' => trim($_POST['end_time'] ?? ''),
            'classroom' => trim($_POST['classroom'] ?? ''),
        ];
    }

    private function form($schedule, $action, $heading)
    {
        $courses = $this->model->courses();
        render_page('schedules/form.php', compact('schedule', 'courses', 'action', 'heading'), $heading);
    }

    private function find($id)
    {
        $schedule = $this->model->find($id);
        if (!$schedule) {
            http_response_code(404);
            exit('Jadwal tidak ditemukan.');
        }
        return $schedule;
    }

    private function requestId($fromPost = false)
    {
        $source = $fromPost ? $_POST : $_GET;
        $id = $source['id'] ?? '';
        if (!ctype_digit((string) $id) || (int) $id < 1) {
            http_response_code(400);
            exit('ID jadwal tidak valid.');
        }
        return (int) $id;
    }

    private function redirect()
    {
        header('Location: index.php?page=schedules');
        exit;
    }
}
