<?php
require_once __DIR__ . '/../config.php';

class DB
{
    private $connection;

    public function __construct()
    {
        mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
        $this->connection = new mysqli(
            Config::$db_host,
            Config::$db_user,
            Config::$db_pass,
            Config::$db_name
        );
        $this->connection->set_charset('utf8mb4');
    }

    protected function fetchAll($sql, $params = [])
    {
        $result = $this->run($sql, $params);
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    protected function fetchOne($sql, $params = [])
    {
        $result = $this->run($sql, $params);
        $row = $result->fetch_assoc();
        return $row === null ? null : $row;
    }

    protected function execute($sql, $params = [])
    {
        return $this->run($sql, $params);
    }

    private function run($sql, $params)
    {
        $statement = $this->connection->prepare($sql);

        if ($params) {
            $types = '';
            foreach ($params as $value) {
                $types .= is_int($value) ? 'i' : (is_float($value) ? 'd' : 's');
            }

            $bindings = [$types];
            foreach ($params as $key => &$value) {
                $bindings[] = &$value;
            }
            call_user_func_array([$statement, 'bind_param'], $bindings);
            unset($value);
        }

        $statement->execute();
        $result = $statement->get_result();
        return $result === false ? $statement->affected_rows : $result;
    }
}
