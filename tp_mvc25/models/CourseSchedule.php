<?php
class CourseSchedule extends DB
{
    public function all()
    {
        return $this->fetchAll(
            "SELECT course_schedules.*, courses.course_code, courses.course_name
             FROM course_schedules
             INNER JOIN courses ON course_schedules.course_id = courses.id
             ORDER BY FIELD(course_schedules.day, 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu', 'Minggu'),
                      course_schedules.start_time"
        );
    }

    public function find($id)
    {
        return $this->fetchOne('SELECT * FROM course_schedules WHERE id = ?', [$id]);
    }

    public function courses()
    {
        return $this->fetchAll('SELECT id, course_code, course_name FROM courses ORDER BY course_code');
    }

    public function create($data)
    {
        return $this->execute(
            'INSERT INTO course_schedules (course_id, day, start_time, end_time, classroom) VALUES (?, ?, ?, ?, ?)',
            [$data['course_id'], $data['day'], $data['start_time'], $data['end_time'], $data['classroom']]
        );
    }

    public function update($id, $data)
    {
        return $this->execute(
            'UPDATE course_schedules
             SET course_id = ?, day = ?, start_time = ?, end_time = ?, classroom = ?
             WHERE id = ?',
            [$data['course_id'], $data['day'], $data['start_time'], $data['end_time'], $data['classroom'], $id]
        );
    }

    public function delete($id)
    {
        return $this->execute('DELETE FROM course_schedules WHERE id = ?', [$id]);
    }
}
