<?php

namespace Models;
use PDO;

interface Crud {
    public function selectAll();
    public function select();
    public function insert();
    public function update();
    public function delete();
    
}