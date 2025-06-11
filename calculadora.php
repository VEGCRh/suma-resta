<?php
session_start(); // Iniciar sesión para guardar el historial
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Calculadora en PHP con Historial</title>
    <style>
        body {
            font-family: 'Segoe UI', sans-serif;
            background: linear-gradient(135deg, #74ebd5, #ACB6E5);
            height: 100vh;
            margin: 0;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .calculator {
            background: white;
            padding: 30px 40px;
            border-radius: 20px;
            box-shadow: 0 15px 25px rgba(0,0,0,0.2);
            width: 400px;
            text-align: center;
        }

        h2 {
            margin-bottom: 20px;
            color: #333;
        }

        input[type="number"] {
            width: 80%;
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid #ccc;
            border-radius: 10px;
            font-size: 16px;
        }

        input[type="submit"] {
            width: 45%;
            padding: 10px;
            margin: 5px;
            border: none;
            border-radius: 10px;
            font-size: 16px;
            color: white;
            background-color: #007BFF;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        input[type="submit"]:hover {
            background-color: #0056b3;
        }

        .resultado {
            margin-top: 20px;
            font-size: 18px;
            color: #333;
            background: #f0f0f0;
            padding: 10px;
            border-radius: 10px;
        }

        .historial {
            margin-top: 30px;
            text-align: left;
            background: #f9f9f9;
            padding: 15px;
            border-radius: 10px;
            max-height: 200px;
            overflow-y: auto;
        }

        .historial h3 {
            margin-top: 0;
        }

        .clear-button {
            background: #dc3545;
            color: white;
            border: none;
            padding: 8px 15px;
            border-radius: 8px;
            cursor: pointer;
            margin-top: 10px;
        }

        .clear-button:hover {
            background: #b52a37;
        }
    </style>
</head>
<body>
    <div class="calculator">
        <h2>Calculadora PHP</h2>

        <form method="post" action="">
            <input type="number" name="num1" placeholder="Número 1" required><br>
            <input type="number" name="num2" placeholder="Número 2" required><br>

            <input type="submit" name="operacion" value="Sumar">
            <input type="submit" name="operacion" value="Restar">
        </form>

        <?php
        // Limpiar historial
        if (isset($_POST["limpiar"])) {
            $_SESSION['historial'] = [];
        }

        // Solo procesar si es una operación matemática
        if (isset($_POST["operacion"])) {
            $num1 = $_POST["num1"];
            $num2 = $_POST["num2"];
            $operacion = $_POST["operacion"];
            $resultado = 0;

            if ($operacion == "Sumar") {
                $resultado = $num1 + $num2;
                $texto = "$num1 + $num2 = $resultado";
            } elseif ($operacion == "Restar") {
                $resultado = $num1 - $num2;
                $texto = "$num1 - $num2 = $resultado";
            }

            echo "<div class='resultado'><strong>Resultado:</strong> $texto</div>";

            // Guardar en historial
            $_SESSION['historial'][] = $texto;
        }

        // Mostrar historial
        if (!empty($_SESSION['historial'])) {
            echo "<div class='historial'><h3>Historial:</h3><ul>";
            foreach ($_SESSION['historial'] as $item) {
                echo "<li>$item</li>";
            }
            echo "</ul>
                <form method='post'><button class='clear-button' name='limpiar'>Limpiar historial</button></form>
            </div>";
        }
        ?>
    </div>
</body>
</html>
