<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Rendas</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <style>
        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background-color: #1d002b;
            color: white;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            text-align: center;
        }
        .centro {
            padding: 40px 20px;
        }
        h1 {
            color: #f17a3d;
            margin-bottom: 20px;
        }
        .frase {
            font-weight: bold;
            margin-bottom: 40px;
            max-width: 600px;
            margin: 0 auto 40px;
            line-height: 1.5;
        }
        .option {
            display: flex;
            justify-content: center;
            gap: 40px;
            margin-bottom: 30px;
            flex-wrap: wrap;
        }
        .input-box {
            border: 2px solid #f17a3d;
            padding: 25px 20px;
            width: 250px;
            border-radius: 10px;
            background-color: rgba(255, 255, 255, 0.05);
            transition: transform 0.2s;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
        }
        .input-box:hover {
            transform: scale(1.03);
        }
        .input-box h2 {
            color: #f17a3d;
            margin-bottom: 10px;
            font-size: 18px;
        }
        .input-box input {
            width: 100%;
            padding: 10px;
            font-size: 16px;
            border: none;
            border-radius: 5px;
            background-color: #fff;
            color: #1d002b;
        }
        button {
            background-color: #8d5cf1;
            color: white;
            border: none;
            padding: 12px 25px;
            font-weight: bold;
            border-radius: 6px;
            cursor: pointer;
            font-size: 16px;
            transition: background-color 0.3s ease;
        }
        button:hover {
            background-color: #a183f3;
        }
    </style>
</head>
<body>
    <div class="centro">
        <h1>RENDAS</h1>
        <p class="frase">
            Informe o valor do seu salário bruto que o simulador calculará o desconto no
            INSS (caso seja aplicável).<br />
            Outras rendas, como freelancers, bicos, comissão etc (caso haja).
        </p>
        <div class="option">
            <div class="input-box">
                <h2>Salário Bruto</h2>
                <input type="text" id="salario" placeholder="R$" />
            </div>
            <div class="input-box">
                <h2>Outras Rendas</h2>
                <input type="text" id="outras" placeholder="R$" />
            </div>
        </div>
        <button onclick="salvarRenda()">CONTINUAR</button>
    </div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/imask/6.4.2/imask.min.js"></script>

<script>
    
    function salvarRenda() {
    const salario = document.getElementById('salario').value.replace(/\D/g, '') / 100;
    const outras = document.getElementById('outras').value.replace(/\D/g, '') / 100;

    const formData = new FormData();
    formData.append('salario', salario);
    formData.append('outras', outras);

    fetch("/simulador/renda", {
        method: "POST",
        headers: {
            "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').content,
        },
        body: formData
    })
    .then(async response => {
        if (response.redirected) {
            window.location.href = response.url;
        } else {
            const errorText = await response.text();
            console.error("Erro na resposta:", errorText);
            alert("Erro ao salvar dados. Verifique o console.");
        }
    })
    .catch(error => {
        console.error("Erro na requisição:", error);
        alert("Erro ao conectar com o servidor.");
    });
}


    // Máscaras de input
    const salarioInput = document.getElementById('salario');
    const outrasInput = document.getElementById('outras');

    IMask(salarioInput, {
        mask: 'R$ num',
        blocks: {
            num: {
                mask: Number,
                thousandsSeparator: '.',
                radix: ',',
                mapToRadix: ['.']
            }
        }
    });

    IMask(outrasInput, {
        mask: 'R$ num',
        blocks: {
            num: {
                mask: Number,
                thousandsSeparator: '.',
                radix: ',',
                mapToRadix: ['.']
            }
        }
    });

</script>

</body>
</html>
