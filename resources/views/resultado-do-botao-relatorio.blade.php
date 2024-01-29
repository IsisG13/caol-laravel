<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Resultado Relatorio</title>
</head>
<body>
    @foreach($resultados as $resultado)
    <ul>
        <li>
            <p> <h4>Usuario: {{ $resultado->no_usuario }}</p>

            <p> <h5>Sistema: {{ $resultado->co_sistema }}</p>

            <p> <h5>Ativo: {{ $resultado->in_ativo }}</p>

            <p> <h5>Tipo Usuario: {{ $resultado->co_tipo_usuario }}</p>

            <p> <h5>Receita: {{ $resultado->receita_liquida }}</p>

            <p> <h5>Custo: {{ $resultado->custo_fixo }}</p>

            <p> <h5>Comissão: {{ $resultado->comissao }}</p>

            <p> <h5>Lucro: {{ $resultado->lucro }}</p>
        </li>
    </ul>
    @endforeach
    
</body>
</html>
