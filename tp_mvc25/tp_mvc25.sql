
SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

CREATE DATABASE IF NOT EXISTS `tp_mvc25`
  CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `tp_mvc25`;


CREATE TABLE `courses` (
  `id` int(11) NOT NULL,
  `course_code` varchar(20) NOT NULL,
  `course_name` varchar(100) NOT NULL,
  `credits` int(11) NOT NULL,
  `lecturer_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `courses` (`id`, `course_code`, `course_name`, `credits`, `lecturer_id`) VALUES
(1, 'IK201', 'Desain dan Pemrograman Berorientasi Objek', 3, 1),
(2, 'IK305', 'Basis Data Lanjut', 3, 2);

INSERT INTO `course_schedules` (`id`, `course_id`, `day`, `start_time`, `end_time`, `classroom`) VALUES
(1, 1, 'Senin', '08:00:00', '10:30:00', 'Lab 1'),
(2, 2, 'Rabu', '10:00:00', '12:30:00', 'Ruang 204');


CREATE TABLE `course_schedules` (
  `id` int(11) NOT NULL,
  `course_id` int(11) NOT NULL,
  `day` enum('Senin','Selasa','Rabu','Kamis','Jumat','Sabtu','Minggu') NOT NULL,
  `start_time` time NOT NULL,
  `end_time` time NOT NULL,
  `classroom` varchar(100) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `course_schedules_course_id_idx` (`course_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE `departments` (
  `id` int(11) NOT NULL,
  `department_name` varchar(100) NOT NULL,
  `faculty` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `departments` (`id`, `department_name`, `faculty`) VALUES
(1, 'Ilmu Komputer', 'FPMIPA'),
(2, 'Pendidikan Ilmu Komputer', 'FPMIPA');


CREATE TABLE `lecturers` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `nidn` varchar(20) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `email` varchar(100) NOT NULL,
  `join_date` date NOT NULL,
  `department_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `lecturers` (`id`, `name`, `nidn`, `phone`, `email`, `join_date`, `department_id`) VALUES
(1, 'Dr. Budi Santoso', '0412088501', '081234567890', 'budi@univ.ac.id', '2015-09-01', 1),
(2, 'Siti Aminah, M.Kom.', '0423049002', '081987654321', 'siti@univ.ac.id', '2018-02-15', 2),
(3, 'NABIL', '12313', '1234556', 'zhafran@student.upi.edu', '2026-11-20', NULL);

ALTER TABLE `courses`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `course_code` (`course_code`),
  ADD KEY `lecturer_id` (`lecturer_id`);

ALTER TABLE `departments`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `lecturers`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nidn` (`nidn`),
  ADD KEY `department_id` (`department_id`);

ALTER TABLE `courses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

ALTER TABLE `course_schedules`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;


ALTER TABLE `departments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

ALTER TABLE `lecturers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

ALTER TABLE `courses`
  ADD CONSTRAINT `courses_ibfk_1` FOREIGN KEY (`lecturer_id`) REFERENCES `lecturers` (`id`) ON DELETE CASCADE;

ALTER TABLE `course_schedules`
  ADD CONSTRAINT `course_schedules_course_id_fk` FOREIGN KEY (`course_id`) REFERENCES `courses` (`id`) ON DELETE CASCADE;

ALTER TABLE `lecturers`
  ADD CONSTRAINT `lecturers_ibfk_1` FOREIGN KEY (`department_id`) REFERENCES `departments` (`id`) ON DELETE SET NULL;
COMMIT;

