<?php
abstract class AbstractModel 
{
    protected $db;
    public function __construct() 
    {
        require_once('system/AppCore.class.php');
        $this->db = AppCore::getDB();
    }
}
?>
