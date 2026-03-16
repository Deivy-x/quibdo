<?php
// registro.php
require 'config/db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombre = trim($_POST['nombre']);
    $email  = trim($_POST['email']);
    $pass   = password_hash($_POST['password'], PASSWORD_BCRYPT); // encriptado

    $stmt = $pdo->prepare("INSERT INTO usuarios (nombre, email, password) VALUES (?, ?, ?)");
    
    try {
        $stmt->execute([$nombre, $email, $pass]);
        header('Location: login.php');
    } catch (PDOException $e) {
        $error = "Ese email ya está registrado.";
    }
}
?>
<!DOCTYPE html>
<html>
<body>
  <?php if (isset($error)) echo "<p style='color:red'>$error</p>"; ?>
  <form method="POST">
    <input type="text"     name="nombre"   placeholder="Tu nombre"  required><br>
    <input type="email"    name="email"    placeholder="Email"       required><br>
    <input type="password" name="password" placeholder="Contraseña"  required><br>
    <button type="submit">Registrarse</button>
  </form>
</body>
</html>