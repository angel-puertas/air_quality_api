<?php
require_once('system/AppCore.class.php');

$db = AppCore::getDB();

if (!$db) 
{
    echo "<h2>Database connection failed.</h2>";
    exit;
}

try 
{
    $db->installDatabase();
    echo "<h2>Database tables created (or already exist).</h2>";
} 
catch (Exception $e) 
{
    echo "<h2>Error creating tables:</h2>";
    echo "<pre>" . $e->getMessage() . "</pre>";
}
?>
