<?php
class Lecturer extends DB
{
    public function all()
    {
        return $this->fetchAll(
            'SELECT lecturers.*, departments.department_name
             FROM lecturers
             LEFT JOIN departments ON lecturers.department_id = departments.id
             ORDER BY lecturers.name'
        );
    }

    public function find($id)
    {
        return $this->fetchOne('SELECT * FROM lecturers WHERE id = ?', [$id]);
    }

    public function departments()
    {
        return $this->fetchAll(
            'SELECT id, department_name, faculty FROM departments ORDER BY department_name'
        );
    }

    public function create($data)
    {
        return $this->execute(
            'INSERT INTO lecturers (name, nidn, email, phone, join_date, department_id) VALUES (?, ?, ?, ?, ?, ?)',
            [$data['name'], $data['nidn'], $data['email'], $data['phone'], $data['join_date'], $data['department_id']]
        );
    }

    public function update($id, $data)
    {
        return $this->execute(
            'UPDATE lecturers SET name = ?, nidn = ?, email = ?, phone = ?, join_date = ?, department_id = ? WHERE id = ?',
            [$data['name'], $data['nidn'], $data['email'], $data['phone'], $data['join_date'], $data['department_id'], $id]
        );
    }

    public function delete($id)
    {
        return $this->execute('DELETE FROM lecturers WHERE id = ?', [$id]);
    }
}
