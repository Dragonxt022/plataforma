<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>E-mail de Contato</title>
    <style>
        /* Estilos de e-mail podem ser adicionados aqui */
    </style>
</head>
<body>
    <div style="font-family: Arial, sans-serif;">
        <h2 style="color: #333;">E-mail de Contato</h2>
        <p><strong>Nome:</strong> {{ $nome }}</p>
        <p><strong>Telefone:</strong> {{ $telefone }}</p>
        <p><strong>E-mail:</strong> {{ $email }}</p>
        <p><strong>Tipo de Direito:</strong> {{ $tipo_direito }}</p>
        <p><strong>Mensagem:</strong><br>{{ $mensagem }}</p>
        <hr>
        <p style="font-size: 12px; color: #666;">Este e-mail foi enviado automaticamente pelo sistema de contato do site.</p>
    </div>
</body>
</html>
