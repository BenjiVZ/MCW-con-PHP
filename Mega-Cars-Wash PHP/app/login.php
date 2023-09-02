<!DOCTYPE html>
<html>

<head>
    <title>Iniciar Sesión</title>
    <link rel="stylesheet" href="../css/main.css">
</head>

<body>
    <header>
        <?php
        if (isset($_POST['login-submit'])) {
            $email = $_POST['login-email'];
            $password = $_POST['login-password'];

            // Conexión a la base de datos
            $servername = "localhost";
            $username = "root";
            $password_db = "";
            $dbname = "mcw";

            $conn = new mysqli($servername, $username, $password_db, $dbname);

            if ($conn->connect_error) {
                die("Conexión fallida: " . $conn->connect_error);
            }

            $sql = "SELECT contrasena FROM users WHERE email = '$email'";
            $result = $conn->query($sql);

            if ($result->num_rows == 1) {
                $row = $result->fetch_assoc();
                $storedPassword = $row['contrasena'];

                // Comparar la contraseña ingresada con la contraseña almacenada encriptada
                if (password_verify($password, $storedPassword)) {
                    echo "<p>Inicio de sesión exitoso.</p>";
                } else {
                    echo "<p>Contraseña incorrecta.</p>";
                }
            } else {
                echo "<p>Usuario no encontrado.</p>";
            }

            $conn->close();
        }
        ?>
    </header><br>

    <main>
        <a href="../index.html">inicio de sesión</a>
    </main>
</body>

</html>