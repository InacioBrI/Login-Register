<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Simulador</title>
    <style>
        body {
            /* background-image: url("{{ asset('images/Fundo01.png') }}"); */
            background-color: #1C0033;
            color: aliceblue;
            background-size: cover;
            background-repeat: no-repeat;
            margin: 0;
        }
        .centro {
            display: flex;
            align-self: center;
        }
        #title {
            text-align: center;
            margin: auto 60px;
            font-size: 86px;
        }
        .btn_comecar {
            color: aliceblue;
            text-decoration: none;
            border: 1px solid #D06833;
            padding: 14px;
            background-color: #D06833;
            border-radius: 20px;
            font-size: 34px;
            margin: 15px auto;
        }
        .btn_comecar:hover {
            font-weight: 900;
            padding: 16px;
        }
        hr {
            width: 10%;
            margin: 50px auto;
        }
        .principal {
            align-self: center;
            margin-top: 200px;
        }
    </style>
</head>
<body>
    <div class="principal">
        <div id="title">
            Bem vindo ao <br>Simulador financeiro<br>
        </div>
        <hr>
        <div class="centro">
            <a href="{{ route('simulador.contrato') }}" class="btn_comecar">Começar</a>
        </div>
    </div>
</body>
</html>
