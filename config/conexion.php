<?php
$mysqli = new mysqli("localhost", "root", "Itca123!", "bdtecnicascontables");

/* comprobar conexión */
if (mysqli_connect_errno()) {
    printf("Conexión fallida: %s\n", mysqli_connect_error());
    exit();
}

if ($mysqli->ping()) {
    printf("¡La conexión está bien!\n");
} else {
    printf("Error: %s\n", $mysqli->error);
}

$mysqli->close();
