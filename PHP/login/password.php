<?php
// La contraseña original que usaste para generar el hash
$password = 'j3f3e7s6n';

// El hash que obtuviste de la base de datos
/* $hash = '$2y$10$uLHsRVT1ps4.V4JTO8CQSu.wpm9/i4KlLAUziToZiqpybqxfPA8qa'; // Reemplaza con el hash almacenado */
$hash = '$2y$10$0jsStR.Y45FT5WnyJT6ppujgNWxDGCwukAcIpI/sTpY68fBuiiWKa'; // Reemplaza con el hash almacenado


// Verifica la contraseña contra el hash
if (password_verify($password, $hash)) {
    echo 'La contraseña es válida Jefferson.';
} else {
    echo 'La contraseña no es válida.';
}
?>
