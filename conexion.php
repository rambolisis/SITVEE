<?php
$mysqli = new mysqli('localhost', 'id6607651_sitvee', '12345', 'id6607651_sitvee');
if ($mysqli->connect_errno) :
    echo "Error al conectarse con MySQL debido al error " . $mysqli->connect_error;
endif;
?>