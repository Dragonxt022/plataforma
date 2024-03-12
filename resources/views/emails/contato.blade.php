<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>E-mail de Contato</title>
    <style>
        /* Estilos de e-mail podem ser adicionados aqui */
        body {
            background-color: #f5f5f5;
            font-family: 'Roboto', sans-serif;
            color: #333;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 600px;
            margin: 20px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0px 0px 20px rgba(0, 0, 0, 0.1);
        }

        h2 {
            color: #00bcd4;
            margin-bottom: 20px;
            text-align: center;
        }

        p {
            margin-bottom: 10px;
        }

        strong {
            font-weight: bold;
        }

        hr {
            border: none;
            border-top: 1px solid #ccc;
            margin: 20px 0;
        }

        .footer {
            text-align: center;
            color: #666;
            font-size: 12px;
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>E-mail de Contato</h2>
        <p><strong>Nome:</strong> {{ $nome }}</p>
        <p><strong>Telefone:</strong> {{ $telefone }}</p>
        <p><strong>E-mail:</strong> {{ $email }}</p>
        <p><strong>Tipo de Direito:</strong> {{ $tipo_direito }}</p>
        <p><strong>Mensagem:</strong><br>{{ $mensagem }}</p>
        <hr>
        <p class="footer">Este e-mail foi enviado automaticamente pelo sistema de contato do site.</p>
    </div>
</body>
</html>
