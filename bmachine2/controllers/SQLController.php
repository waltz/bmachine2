<?php
//This class gives SQL-based DB controllers CRUD operations

//Include parent class
require_once($baseDir . 'controllers/DatabaseController.php');

abstract class SQLController extends DatabaseController
{
	// $data is an associative array of table column names and values
	function create($table, $data) {
		$columns = array();
		$values = array();
		foreach($data as $column=>$value) {
			if (!is_int($column))
				{array_push($columns, $column);}
			array_push($values, $value);
		}
		//Build query
		if ($columns === array()) {
			$query = "Insert into $table values (";
		} else {
			$query = "Insert into $table (";
			foreach ($columns as $x) {
				$query .= $x.", ";
			}
			$query = rtrim($query, ", ").") values (";
		}

		foreach ($values as $y) {
			$query .= '"'.$y.'"'.", ";
		}
		$query = rtrim($query, ", ").");";
		$this->query($query);
		return true;
	}
	
	//Reads from a database table
	//Returns an associative array of data
	function read($table, $condition) {
		if ($condition == 'all') {
			$query = "select * from $table;";
		} else {
			$query = "select * from $table where $condition;";
		}
		$result = $this->query($query);

		return $this->getArray($result);
	}

	function update($table, $data, $condition) {
		$query = "update $table set ";	
		foreach ($data as $column=>$value) {
			$query .= "$column = ".'"'.$value.'", ';
		}
		$query =  rtrim($query, ", ")." where $condition;";
		$this->query($query);
		return true;
	}

	function delete($table, $condition) {
		$this->query("delete from $table where $condition;");
		return true;
	}
}

?>
