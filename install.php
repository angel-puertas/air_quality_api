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
    $stations = [
        14 => "Zajci",
        20 => "Čambarelići",
        37 => "Zoljan",
        38 => "Vrhovec",
        40 => "Koromačno",
        41 => "Ksaverska cesta",
        101 => "Đorđićeva ulica (Stanica za hitnu pomoć)",
        102 => "Pešćenica",
        121 => "Velika Gorica",
        127 => "Umag",
        155 => "ZAGREB-1",
        156 => "ZAGREB-2",
        157 => "ZAGREB-3",
        159 => "RIJEKA-2",
        160 => "OSIJEK-1",
        161 => "KUTINA-1",
        162 => "SISAK-1",
        165 => "SLAVONSKI BROD-1",
        168 => "Split-1",
        173 => "AMS1 Kaštel Sućurac",
        179 => "AMS2 Sveti Kajo",
        180 => "Ripenda",
        189 => "Sv. Katarina",
        191 => "Klavar",
        215 => "Kostrena - Martinšćica",
        221 => "Urinj",
        224 => "Paveki",
        232 => "Viškovo - Marišćina",
        235 => "Viškovo - Viševac",
        241 => "Opatija - Gorovo",
        243 => "Krasica",
        245 => "Krešimirova ul.",
        246 => "Vrh Martinšćice",
        255 => "KOPAČKI RIT",
        256 => "DESINIĆ",
        257 => "PLITVIČKA JEZERA",
        258 => "PARG",
        259 => "VIŠNJAN",
        260 => "VELA STRAŽA (Dugi otok)",
        261 => "POLAČA (Ravni kotari)",
        262 => "HUM (otok Vis)",
        263 => "OPUZEN (Delta Neretve)",
        269 => "Plitvička jezera",
        274 => "Jakuševec",
        275 => "SLAVONSKI BROD-2",
        276 => "Mlaka",
        277 => "VARAŽDIN-1",
        278 => "KARLOVAC-1",
        279 => "Međunarodna zračna luka Zagreb",
        280 => "Mirogojska cesta",
        284 => "Zračna luka Dubrovnik",
        285 => "AMP Kaštijun",
        286 => "PULA FIŽELA",
        295 => "Kopacki rit",
        300 => "OSIJEK - PPI PM2,5",
        307 => "Dubrovnik",
        308 => "Karepovac"
    ];
    
    foreach ($stations as $id => $name) 
    {
        $nameEscaped = $db->escape($name);
        $db->sendQuery("INSERT IGNORE INTO stations (id, name) VALUES ($id, '$nameEscaped')");
    }

    // Insert initial pollutants
    // there are literally hundreds of pollutants, but for now we will just insert a few common ones
    // in future I will add all pollutants from the api
    $pollutants = 
    [
        1 => "NO₂ - dušikov dioksid",
        2 => "SO₂ - sumporov dioksid",
        3 => "CO - ugljikov monoksid",
        4 => "H₂S - sumporovodik",
        5 => "PM₁₀ - lebdeće čestice",
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