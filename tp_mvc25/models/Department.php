<?php
class Department extends DB
{
    public function all()
    {
        return $this->fetchAll(
            'SELECT departments.*,
                    COUNT(DISTINCT lecturers.id) AS lecturer_count
             FROM departments
             LEFT JOIN lecturers ON lecturers.department_id = departments.id
             GROUP BY departments.id, departments.department_name, departments.faculty
             ORDER BY departments.department_name'
        );
    }

    public function find($id)
    {
        return $this->fetchOne('SELECT * FROM departments WHERE id = ?', [$id]);
    }

    public function create($data)
    {
        return $this->execute(
            'INSERT INTO departments (department_name, faculty) VALUES (?, ?)',
            [$data['department_name'], $data['faculty']]
        );
    }

    public function update($id, $data)
    {
        return $this->execute(
            'UPDATE departments SET department_name = ?, faculty = ? WHERE id = ?',
            [$data['department_name'], $data['faculty'], $id]
        );
    }

    public function delete($id)
    {
        return $this->execute('DELETE FROM departments WHERE id = ?', [$id]);
    }
}
