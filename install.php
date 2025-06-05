<?php
require_once('system/config.inc.php');

$mysqli = new mysqli($dbHost, $dbUser, $dbPassword);
if ($mysqli->connect_error) 
{
    die("<h2>MySQL connection failed: " . $mysqli->connect_error . "</h2>");
}

if (!$mysqli->query("CREATE DATABASE IF NOT EXISTS `$dbName`")) 
{
    die("<h2>Database creation failed: " . $mysqli->error . "</h2>");
}
$mysqli->close();

require_once('system/AppCore.class.php');
$app = new AppCore(false);
$db = AppCore::getDB();

// if (!$db) 
// {
//     echo "<h2>Database connection failed.</h2>";
//     exit;
// }

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
