<!DOCTYPE HTML>
<html lang="pt-br">
<head>
    <title>Calculadora</title>
    <meta charset="UTF-8">
    <style>
        /* Estilos para a calculadora */
        body {
            font-family: 'Open Sans', 'Helvetica Neue', sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            background-color: #5f7161; /* Cor de fundo */
        }
        .container {
            max-width: 400px;
            margin: 30px left;
            padding: 10px;
            background-color: #E5E4CC;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .containerhistorico{
            max-width: 400px;
            margin: 30px right;
            padding: 10px;
            background-color: #0056b3;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
       }
        .calculator {
            width: 300px;
            padding: 20px;
            border: 1px solid #ccc; /* Borda */
            background-color: #fff; /* Cor de fundo interna */
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1); /* Sombra */
            text-align: center; /* Centraliza o conteúdo */
        }
        button[type="submit"]{
            width: 100%;
            height: 40px;
            background-color: #007bff;
            color: #fff;
            padding: 10px;
            border: 5px;
            border-radius: 10px;
            cursor: pointer;
            font-size: 18px;
            margin-bottom: 10px;
        }
        form {
            margin-bottom: 20px;
        }
        input[type="text"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
        }
        input[type="submit"] {
            background-color: #007bff;
            color: #fff;
            border: none;
            padding: 10px 20px;
            cursor: pointer;
        }
        input[type="submit"]:hover {
            background-color: #0056b3;
        }
        ul {
            list-style: none;
            padding: 0;
        }
        li {
            margin-bottom: 5px;
        }
    </style>
</head>
<body>
    <div class="calculator">
        <form action="calculadora.php" method="post">
            Primeiro Número: <input name="num1" type="text"><br>
            Segundo Número: <input name="num2" type="text"><br>
            <input type="submit" name="operacao" value="+">
            <input type="submit" name="operacao" value="-">
            <input type="submit" name="operacao" value="*">
            <input type="submit" name="operacao" value="/">
            <input type="submit" name="salvar" value="Salvar Histórico">
            <input type="submit" name="apagar" value="Apagar Histórico">
        </form>

        <!-- Exibe o histórico -->
        <h2>Histórico de Operações:</h2>
        <ul>
            <?php
            session_start(); // Inicia a sessão para armazenar o histórico

            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                $a = $_POST['num1'];
                $b = $_POST['num2'];
                $op = $_POST['operacao'];

                if (!empty($op)) {
                    switch ($op) {
                        case '+':
                            $c = $a + $b;
                            break;
                        case '-':
                            $c = $a - $b;
                            break;
                        case '*':
                            $c = $a * $b;
                            break;
                        case '/':
                            $c = $a / $b;
                            break;
                        default:
                            $c = "Operação inválida";
                    }

                    // Adiciona a operação ao histórico
                    $historico = $_SESSION['historico'] ?? [];
                    $historico[] = "$a $op $b = $c";
                    $_SESSION['historico'] = $historico;
                }
            }

            foreach ($_SESSION['historico'] ?? [] as $operacao) {
                echo "<li>$operacao</li>";
            }
            ?>
        </ul>
    </div>
</body>
</html>
