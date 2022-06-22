<?php

//Definiamo le costanti senza $
define("DB_SERVERNAME", "localhost");
define("DB_USERNAME", "root");
define("DB_PASSWORD", "root");
define("DB_PORT", 3306);
define("DB_NAME", "db_university");

//Connettiamo il tutto
$conn = new mysqli(DB_SERVERNAME, DB_USERNAME, DB_PASSWORD, DB_NAME, DB_PORT);

//Controlliamo che non ci siano errori
if ($conn && $conn->connect_error) {
  echo "Connessione col database fallita";
  die();
}