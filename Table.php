<?php 

    class Table {
		
		public $db;
		protected $table;
		
		public function __construct($table) {
			$pdo = new PDO('mysql:host=localhost;dbname=alloders', 'soults', '19962728');
			$pdo->query('set names utf8');
			$this->db = $pdo;
			$this->table = $table;
		}
		
		public function select($where = null, $limit = null, $row = false) {
			$query = 'SELECT * FROM `' . $this->table . '`';
			if($where != null) $query .= ' WHERE ' . $where;
			if($limit != null) $query .= ' LIMIT ' . $limit;
			try {
				$stmt = $this->db->query($query);
				if($row == false) {
					$d = $stmt->fetchAll(PDO::FETCH_OBJ);
				} else {
					$d = $stmt->fetch(PDO::FETCH_OBJ);
				}
			} catch (PDOException $e) {
				echo $e->getMessage();
				echo var_dump($stmt->errorInfo());
			}
			return $d;
		}
		
		public function __destruct() {
			$this->db = null;
		}
		
	}

?>
