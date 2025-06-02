<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Simulador</title>
        <link rel="stylesheet" href="/ProjetoDevWeb/CSS/EstiloConclusao.css">

        <style>
            body{
            color: aliceblue;
            background-color: #1E0034;
            background-size: cover;
            background-repeat: no-repeat;
            margin: 0;
            }

            .centro{
                display: flex;
                align-self: center;
            }

            .bt-don{
                max-width: 100%;
                display: flex;
                align-self: center;
            }

            .bt-don a{  
                display: flex;
                align-self: center;
            }

            .bt-home{
                display: flex;
                align-self: center;
            }

            #title{
                text-align: center;
                margin: auto 0px;
                align-items: center;
                font-size: 42px;
                color: #D06833;

            }

            .btn_comecar{
                color: aliceblue;
                text-decoration: none;
                border: 1px solid #D06833;
                padding: 8px;
                background-color: #D06833;
                font-size: 24px;
                margin: 15px auto auto auto;
                border-radius: 5px;
            }

            .btn-home{
                color: aliceblue;
                text-decoration: none;
                padding: 8px;
                background-color: #633bbc;
                font-size: 24px;
                margin: 15px auto auto auto;
                border-radius: 5px;
            }

            hr{
                width: 10%;
                color: #D06833;
                margin-bottom: 50px;
            }
            .principal{
                align-self: center;
                margin-top: 160px;
            }

            .frase{
                margin: auto;
                width: 60%;
                text-align: center;
                margin-bottom: 30px;
            }
            p{
                margin: 0px;
            }
        </style>

    </head>
    <body style="background-image: url(/ProjetoDevWeb/Resources/Fundo01.png);">
        <div class="principal">
            <div id="title">
                    <p>PARABÉNS POR CONCLUIR <br>
                        SEU SIMULADOR FINANCEIRO!</p>
                    <hr>  
            </div>
            
            <div class="frase">
                <p>Agradecemos por utilizar nossa ferramenta para entender melhor sua saúde financeira. Esperamos que as informções e sugestões apresentadas ajudem você a tomar decisôes mais conscientes sobres seus gastos. <br><br>
                    Lembre-se o controle financeiro é um passo importante para alcançar seus objetivos e garantir um futuro mais tranquilo.</p>
            </div>

            <div class="bt-don">
                <a href="{{ route('dashboard') }}" class="btn_comecar">Home</a>
            </div>
        </div>


    <!--    <p>Cores usadas no projeto: <br>
            #1E0034 <br>
            #D06833 <br>
            #633BBC <br>
        </p>
    -->

    </body>
</html>