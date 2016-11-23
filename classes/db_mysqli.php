<?php

/**
 * DB MySQLi
 *
 * @author Wong Keen Nang
 * @copyright 2015-2016 Wong Keen Nang
 * @version 1.3, 2016-11-04
 */
class DB_MySQLi
{
    private $mysqli;
    public $result;
    private $stmt;

    // Initiate database handler
    public function __construct($host, $user, $pass, $name)
    {
        // Initiate MySQLi
        if (!$this->mysqli = mysqli_init()) {
            exit();
        }
        // Establish connection to MySQL server
        if (!$this->mysqli->real_connect($host, $user, $pass, $name)) {
            exit();
        }
    }

    // Select database for query operation
    public function select_db($name)
    {
        if (!$this->mysqli->select_db($name)) {
            exit();
        }
    }

    // Perform query on database and return result
    public function query($sql)
    {
        $this->mysqli->query("/*!40101 set names 'utf8' */");
        $this->result = $this->mysqli->query($sql);
        if (!$this->result) {
            $err_msg = print_r($this->mysqli->error, true) . ".<br><span style='color:#666;'>[{$sql}]</span>";
            die("Query failed with error. {$err_msg}");
        }
        return $this->result;
    }

    public function prepare($sql)
    {
        $this->stmt = $this->mysqli->prepare($sql);

        if ($this->stmt === false) {
            die('prepare() failed: ' . htmlspecialchars($this->mysqli->error));
        }
    }

    public function bind_param()
    {
        $count = func_num_args();
        $args = func_get_args();

        $format = $args[0];

        for ($i = 1; $i < $count; $i++) {
            $data[] = $args[$i];
        }

        array_unshift($data, $format);

        $refs = array();
        foreach ($data as $k => $v) {
            $refs[$k] = &$data[$k];
        }

        call_user_func_array(array($this->stmt, 'bind_param'), $refs);
    }

    public function execute()
    {
        $this->stmt->execute();
    }

    // Fetch single row result into associative array
    public function fetch()
    {
        $row = array();
        if ($this->stmt) {
            $this->stmt->execute();
            $result = $this->stmt->get_result();
            $row = $result->fetch_array(MYSQLI_ASSOC);
            $this->stmt->close();
        }
		if ($this->result) {
            $row = $this->result->fetch_array(MYSQLI_ASSOC);
            $this->free_result();
        }
        return $row;
    }

    // Fetch multiple row result into associative array
    public function fetch_array()
    {
        $data = array();
        if ($this->stmt) {
            $this->stmt->execute();
            $result = $this->stmt->get_result();
            while ($row = $result->fetch_array(MYSQLI_ASSOC)) {
                $data[] = $row;
            }
            $this->stmt->close();
        }
		if ($this->result) {
			while ($row = $this->result->fetch_array(MYSQLI_ASSOC)) {
				$data[] = $row;
			}
			$this->free_result();
		}

        return $data;
    }

    // Get number of rows in result
    public function num_rows()
    {
        if ($this->stmt) {
			$this->stmt->execute();
            $this->stmt->store_result();
            $num_rows = $this->stmt->num_rows;
            $this->free_result();
        } else {
            $num_rows = $this->result->num_rows;
        }

        return $num_rows;
    }

    // Get number of affected rows in previous operation
    public function affected_rows()
    {
        return ($this->stmt) ? $this->stmt->affected_rows : $this->mysqli->affected_rows;
    }

    // Get ID generated from previous INSERT operation
    public function insert_id()
    {
        return ($this->stmt) ? $this->stmt->insert_id : $this->mysqli->insert_id;
    }

    // Frees memory associated with result
    public function free_result()
    {
        if ($this->stmt) {
            $this->stmt->free_result();
        } else {
            $this->result->free();
        }
    }

    // Close connection
    public function close()
    {
        $this->mysqli->close();
    }
}