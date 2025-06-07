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

try {
    $db->installDatabase();
    echo "<h2>Database tables created (or already exist).</h2>";

    // Insert initial stations (for now it's enough to have just a few)
    // in future I will add all stations from the api 
    $stations = 
    [
        307 => "Dubrovnik",
        308 => "Karepovac",
        295 => "Kopacki rit",
        161 => "Kutina",
        269 => "Plitvicka jezera",
        168 => "Split-1",
        127 => "Umag",
        121 => "Velika gorica",
        155 => "Zagreb-1"
    ];
    foreach ($stations as $id => $name) 
    {
        $nameEscaped = $db->escape($name);
        $db->sendQuery("INSERT IGNORE INTO stations (id, name) VALUES ($id, '$nameEscaped')");
    }

    // Insert initial pollutants
    $pollutants = 
    [
        1 => "H₂S Sumporovodik",
        2 => "NH₃ Amonijak",
        3 => "NO₂ Dušikov dioksid",
        4 => "PM₁₀ Lebdeće čestice",
        5 => "PM₂.₅ Lebdeće čestice",
    ];
    foreach ($pollutants as $id => $name) 
    {
        $nameEscaped = $db->escape($name);
        $db->sendQuery("INSERT IGNORE INTO pollutants (id, name) VALUES ($id, '$nameEscaped')");
    }

    echo "<h2>Initial data inserted.</h2>";
} 
catch (Exception $e) 
{
    echo "<h2>Error creating tables or inserting data:</h2>";
    echo "<pre>" . $e->getMessage() . "</pre>";
}
?>