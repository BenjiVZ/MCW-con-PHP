<!DOCTYPE html>
<html>

<head>
    <title>Registro de Usuario</title>
    <link rel="stylesheet" href="../css/main.css">
</head>

<body>
    <header>
        <?php
        if (isset($_POST['signup-submit'])) {
            $email = $_POST['signup-email'];
            $password = $_POST['signup-password'];

            // Conexión a la base de datos
            $servername = "localhost";
            $username = "root";
            $password_db = "";
            $dbname = "mcw";

            $conn = new mysqli($servername, $username, $password_db, $dbname);

            if ($conn->connect_error) {
                die("Conexión fallida: " . $conn->connect_error);
            }

            // Verificar si el correo electrónico ya está registrado
            $checkEmailQuery = "SELECT * FROM users WHERE email = '$email'";
            $result = $conn->query($checkEmailQuery);

            if ($result->num_rows > 0) {
                echo "<p>El correo electrónico ya está registrado.</p>";
            } else {
                // Encriptar la contraseña antes de almacenarla en la base de datos
                $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

                $insertQuery = "INSERT INTO users (email, contrasena) VALUES ('$email', '$hashedPassword')";

                if ($conn->query($insertQuery) === TRUE) {
                    echo "<p>Registro exitoso.</p>";
                } else {
                    echo "<p>Error en el registro: " . $conn->error . "</p>";
                }
            }

            $conn->close();
        }
        ?>
    </header><br>

    <main>
        <a href="../pages/index.html">Inicia sesión</a>
    </main>
</body>

</html>