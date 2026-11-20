<?php
class Course extends DB
{
    public function all()
    {
        return $this->fetchAll(
            'SELECT courses.*, lecturers.name AS lecturer_name
             FROM courses LEFT JOIN lecturers ON courses.lecturer_id = lecturers.id
             ORDER BY courses.course_code'
        );
    }

    public function find($id)
    {
        return $this->fetchOne('SELECT * FROM courses WHERE id = ?', [$id]);
    }

    public function lecturers()
    {
        return $this->fetchAll('SELECT id, name, nidn FROM lecturers ORDER BY name');
    }

    public function create($data)
    {
        $lecturerId = (int) $data['lecturer_id'];
        return $this->execute(
            'INSERT INTO courses (course_code, course_name, credits, lecturer_id) VALUES (?, ?, ?, ?)',
            [$data['course_code'], $data['course_name'], $data['credits'], $lecturerId > 0 ? $lecturerId : null]
        );
    }

    public function update($id, $data)
    {
        $lecturerId = (int) $data['lecturer_id'];
        return $this->execute(
            'UPDATE courses SET course_code = ?, course_name = ?, credits = ?, lecturer_id = ? WHERE id = ?',
            [$data['course_code'], $data['course_name'], $data['credits'], $lecturerId > 0 ? $lecturerId : null, $id]
        );
    }

    public function delete($id)
    {
        return $this->execute('DELETE FROM courses WHERE id = ?', [$id]);
    }
}
