<?php

if (!defined('IN_SITE')) {
    die('The Request Not Found');
}



require_once(__DIR__ . '/config.php');
include_once(__DIR__ . '/../vendor/autoload.php');
session_start();
// session_regenerate_id(true);
date_default_timezone_set('Asia/Ho_Chi_Minh');
use WebSocket\Client;

class DB
{
    private $hostname = DB_HOST,
        $username = USERNAME,
        $password = PASSWORD,
        $dbname = DATABASE;

    private $ketnoi;


    public function connect()
    {
        if (!$this->ketnoi) {
            $this->ketnoi = mysqli_connect($this->hostname, $this->username, $this->password, $this->dbname) or die('Error => DATABASE');
            mysqli_query($this->ketnoi, "set names 'utf8'");
        }
    }
    public function dis_connect()
    {
        if ($this->ketnoi) {
            mysqli_close($this->ketnoi);
        }
    }
    private function prepareStatementSql($conn, $sql, $parameters = null)
    {
        if (empty($parameters)) $parameters = [];
        $types = "";
        foreach ($parameters as $param) {
            if (is_int($param)) {
                $types .= "i";
            } elseif (is_double($param)) {
                $types .= "d";
            } else {
                $types .= "s";
            }
        }
        $stmt = mysqli_prepare($conn, $sql);
        if (!empty($parameters)) mysqli_stmt_bind_param($stmt, $types, ...$parameters);
        return $stmt;
    }
    // private function prepareStatementSql($conn, $sql, $parameters = null)
    // {
    //     if (!empty($parameters)) {
    //         $types = "";
    //         foreach ($parameters as $param) {
    //             if (is_int($param)) {
    //                 $types .= "i";
    //             } elseif (is_double($param)) {
    //                 $types .= "d";
    //             } else {
    //                 $types .= "s";
    //             }
    //         }

    //         $stmt = mysqli_prepare($conn, $sql);
    //         if ($stmt === false) {
    //             die("Error preparing statement: " . mysqli_error($conn));
    //         }

    //         $bindResult = mysqli_stmt_bind_param($stmt, $types, ...$parameters);
    //         if (!$bindResult) {
    //             die("Error binding parameters: " . mysqli_stmt_error($stmt));
    //         }

    //         return $stmt;
    //     } else {
    //         return mysqli_prepare($conn, $sql);
    //     }
    // }

    private function executePrepareStatementSql($conn, $sql, $parameters = null)
    {
        $stmt = $this->prepareStatementSql($conn, $sql, $parameters);
        if ($stmt->execute()) {
            $result = $stmt->get_result();
            $affected_rows = $stmt->affected_rows;
            $stmt->close();
            return (object)[
                'result' => $result,
                'affected_rows' => $affected_rows
            ];
        } else {
            die("Error executing query: " . $stmt->error);
        }
    }

    public function insertins($table, $data)
    {
        $this->connect();
        $field_list = '';
        $value_list = '';
        foreach ($data as $key => $value) {
            $field_list .= ",$key";
            $value_list .= ",'".mysqli_real_escape_string($this->ketnoi, $value)."'";
        }
        $sql = 'INSERT INTO '.$table. '('.trim($field_list, ',').') VALUES ('.trim($value_list, ',').')';

        return mysqli_query($this->ketnoi, $sql);
    }

    public function site($data)
    {
        $this->connect();
        $sql = "SELECT * FROM `settings` WHERE `name` = ?";
        $stmt = $this->executePrepareStatementSql($this->ketnoi, $sql, [$data]);
        $row = $stmt->result->fetch_array();
        return $row['value'];
    }

    public function query($sql)
    {
        $this->connect();
        $stmt = $this->executePrepareStatementSql($this->ketnoi, $sql, []);
        $row = $stmt->result;
        return $row;
    }

    public function cong($table, $data, $sotien, $where, $whereParameters)
    {
        if (empty($whereParameters)) $whereParameters = [];
        $this->connect();
        $sql = "UPDATE `$table` SET `$data` = `$data` + ? WHERE $where";
        $stmt = $this->executePrepareStatementSql($this->ketnoi, $sql, array_merge(array($sotien), $whereParameters));
        $row = $stmt->result;
        // return $row;
        if ($stmt->affected_rows > 0) {
            return true;
        } else {
            return false;
        }
    }
    public function tru($table, $data, $sotien, $where, $whereParameters)
    {
        if (empty($whereParameters)) $whereParameters = [];
        $this->connect();
        $sql = "UPDATE `$table` SET `$data` = `$data` - ? WHERE $where";
        $stmt = $this->executePrepareStatementSql($this->ketnoi, $sql, array_merge(array($sotien), $whereParameters));
        $row = $stmt->result;
        // return $row;
        if ($stmt->affected_rows > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function insert($table, $data)
    {
        $this->connect();
        $keysArray = [];
        $valuesArray = [];
        $hiddenArray = [];
        foreach ($data as $key => $value) {
            $keysArray[] = $key;
            $valuesArray[] = $value;
            $hiddenArray[] = "?";
        }
        $column = join(", ", $keysArray);
        $values = join(", ", $hiddenArray);
        $sql = "INSERT INTO  `$table` ($column) VALUES ($values)";
        $stmt = $this->executePrepareStatementSql($this->ketnoi, $sql, $valuesArray);
        $result = $stmt->result;
        return true;
    }

    public function update($table, $data, $where, $whereParameters = null)
    {
        if (empty($whereParameters)) $whereParameters = [];
        $this->connect();
        $keysArray = [];
        $valuesArray = [];
        foreach ($data as $key => $value) {
            $keysArray[] .= "$key = ?";
            $valuesArray[] = $value;
        }
        $column = join(", ", $keysArray);
        $sql = "UPDATE  $table SET $column WHERE $where";
        $stmtParameters = array_merge($valuesArray, $whereParameters);
        $stmt = $this->executePrepareStatementSql($this->ketnoi, $sql, $stmtParameters);
        $result = $stmt->result;
        
        // return $result;
        if ($stmt->affected_rows > 0) {
            return true;
        } else {
            return false;
        }

    }

    public function remove($table, $where, $parameters  = null)
    {
        $this->connect();
        $sql = "DELETE FROM $table WHERE $where";
        $stmt = $this->executePrepareStatementSql($this->ketnoi, $sql, $parameters);
        $result = $stmt->result;
        
        if ($stmt->affected_rows > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function get_list($sql, $parameters = null)
    {

        $this->connect();
        $stmt = $this->executePrepareStatementSql($this->ketnoi, $sql, $parameters);
        $result = $stmt->result;
        if (!$result) {
            die('Câu truy vấn bị sai');
        }
        $return = array();
        while ($row = mysqli_fetch_assoc($result)) {
            $return[] = $row;
        }
        mysqli_free_result($result);
        return $return;
    }

    public function get_row($sql, $parameters = null)
    {
        $this->connect();
        $stmt = $this->executePrepareStatementSql($this->ketnoi, $sql, $parameters);
        $result = $stmt->result;
        if (!$result) {
            die('Câu truy vấn bị sai');
        }
        $row = mysqli_fetch_assoc($result);
        mysqli_free_result($result);
        if ($row) {
            return $row;
        }
        return false;
    }

    public function num_rows($sql, $parameters = null)
    {
        $this->connect();
        $stmt = $this->executePrepareStatementSql($this->ketnoi, $sql, $parameters);
        $result = $stmt->result;
        if (!$result) {
            die('Câu truy vấn bị sai');
        }
        $row = mysqli_num_rows($result);
        mysqli_free_result($result);
        if ($row) {
            return $row;
        }
        return false;
    }

    public function WebSocket($channel = null, $data_array = null, $messon = 0, $lever = null)
    {
        $urli = $this->site('websoket');
        $pusher = new Client($urli);
        $payload = array(
            'type' => $channel,
            'data' => $data_array,
            'key' => SECRET_KEY,
            'lever' => $lever,
            'messon' => $messon
        );
        $data = json_encode($payload);
        return $pusher->send($data);

    }


    public function pusher($data_array = null)
    {
        if ($this->num_rows("SELECT * FROM `tb_pusher` ")) {
            $options = array(
                'cluster' => 'ap1',
                'useTLS' => true
            );
            $pusher = new Pusher\Pusher(
                '0b90137f8c66fdbf2416', //key 
                '3cb3563b4770a7d42cbb', //secret 
                '1556320',
                $options
            );
            return $pusher->trigger('my-channel', 'my-event', $data_array);
        }
        return false;
    }
}
