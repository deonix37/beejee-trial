<?php

abstract class BaseModel {
    protected PDO $db;
    protected string $table;

    public function __construct() {
        $this->db = $GLOBALS['db'];
    }
}
