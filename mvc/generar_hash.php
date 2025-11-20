<?php
// Archivo temporal para generar hash
$password = "hola";
$hash = password_hash($password, PASSWORD_DEFAULT);

echo "<h2>Hash Generado:</h2>";
echo "<p><strong>Contraseña:</strong> $password</p>";
echo "<p><strong>Hash:</strong></p>";
echo "<textarea style='width:100%; height:100px;'>$hash</textarea>";
echo "<hr>";
echo "<h3>SQL para actualizar:</h3>";
echo "<textarea style='width:100%; height:80px;'>UPDATE usuarios SET password = '$hash' WHERE username = 'admin';</textarea>";
echo "<hr>";
echo "<p style='color:red;'><strong>¡ELIMINA ESTE ARCHIVO después de usarlo!</strong></p>";
?>