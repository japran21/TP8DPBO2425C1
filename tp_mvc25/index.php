<?php
require_once __DIR__ . '/models/DB.php';
require_once __DIR__ . '/models/Lecturer.php';
require_once __DIR__ . '/models/Course.php';
require_once __DIR__ . '/models/CourseSchedule.php';
require_once __DIR__ . '/models/Department.php';
require_once __DIR__ . '/views/render.php';
require_once __DIR__ . '/controllers/LecturerController.php';
require_once __DIR__ . '/controllers/CourseController.php';
require_once __DIR__ . '/controllers/CourseScheduleController.php';
require_once __DIR__ . '/controllers/DepartmentController.php';

$page = $_GET['page'] ?? 'lecturers';
$action = $_GET['action'] ?? 'index';

$controllers = [
    'lecturers' => new LecturerController(),
    'courses' => new CourseController(),
    'schedules' => new CourseScheduleController(),
    'departments' => new DepartmentController(),
];

if (!isset($controllers[$page])) {
    http_response_code(404);
    exit('Halaman tidak ditemukan.');
}

$controllers[$page]->dispatch($action);
