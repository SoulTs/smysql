<?php

class Table {

    public $db;
    public $table;

    public function __construct($table) {
        $this->db = new PDO('mysql:host=localhost;dbname=dbname', 'mysqluser', 'mysqlpass');
        $this->db->query('SET NAMES utf8');
        $this->table = $table;
    }
    
    /**
     * Функция для получения одной строки из базы данных
     * Если не указан параметр WHERE в строке query, то выбирается
     * первая запись из таблицы
     * 
     * @param string $query
     * @return array
     */

    public function getRow($query) {
        $args = func_get_args();
        array_shift($args);
        try {
            $st = $this->db->prepare($query);
            $st->execute($args);
            $d = $st->fetch();
            if (!$d) {
                print_r("Не найдено ни одной записи!");
            }
            return $d;
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }
    
    /**
     * Функция для полученя всех строк из базы данных
     * Параметры выборки можно перечислить через запятую, после
     * указания строки query.
     * 
     * Например: $this->getAllRows("SELECT * FROM `table` WHERE `param` = ? AND `param_two` = ?", $param1, $param2);
     * 
     * @param string $query
     * @return array
     */

    public function getAllRows($query) {
        $args = func_get_args();
        array_shift($args);
        try {
            $st = $this->db->prepare($query);
            $st->execute($args);
            $d = $st->fetchAll();
            if (!$d) {
                print_r("Не найдено ни одной записи!");
            }
            return $d;
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }
    
    public function __destruct() {
    	$this->db = null;
    }

}
