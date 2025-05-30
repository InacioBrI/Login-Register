<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Gastos</title>
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <style>
    body {
        background-color: #1E0034;
      color: white;
      text-align: center;
      font-family: 'Arial', sans-serif;
      background-size: cover;
      height: 1000px;
    }

    h1 {
      color: #ff914d;
      margin-top: 50px;
      margin-bottom: 50px;
    }

    .centro {
      margin-top: 100px;
      width: 100%;
      height: 100%;
    }

    .frase {
      margin: 15px;
      margin-bottom: 50px;
      font: 24px;
    }

    button {
      background-color: #8a65ff;
      border: none;
      padding: 15px 40px;
      font-size: 16px;
      color: white;
      border-radius: 10px;
      cursor: pointer;
    }

    .option {
      margin: 20px auto;
      text-align: start;
      width: 480px;
    }

    hr {
      width: 25%;
    }

    .inputs {
      margin-bottom: 15px;
      font: 24px;
    }

    .caixa {
      background-color: #1E0034;
      padding: 10px;
      border: 1px solid #ff914d;
      color: aliceblue;
      margin-bottom: 15px;
      width: 100%;
    }
  </style>
  
</head>
<body>
  <div class="centro">
    <h1>GASTOS</h1>
    <p class="frase">Insira os valores gastos nas categorias que você mais se encaixa.</p>
    <div class="option">
      <label>Essenciais: (Moradia, Alimentação,Transporte, Saúde): <input type="number" id="Moradia" class="caixa"></label><br>
      <label>Alimentação (Mercado, Padaria, Ifood):<input type="number" id="Alimento" class="caixa"></label><br>
      <label>Transporte (Ônibus, Uber, Prestação do  carro, Gasolina)<input type="number" id="Transporte" class="caixa"></label><br>
      <label>Saúde (Convênio, Exames):<input type="number" id="Saude" class="caixa"></label><br>
      <label>Assinaturas (Streaming):<input type="number" id="Assinaturas" class="caixa"></label><br>
      <label>Lazer (Academia, Roupas, Jogos):<input type="number" id="Lazer" class="caixa"></label><br>
      <label>Desenvolvimento Pessoal (Educação, Faculdade, Curso):<input type="number" id="Educacao" class="caixa"></label><br>
      <label>Investimento (Poupança, Caixinha Nu, Criptomoedas):<input type="number" id="Investimento" class="caixa"></label><br>
      <label>Outros (Pets, Família , Etc): <input type="number" id="Outros" class="caixa"></label>
    </div>
    <button onclick="salvarGastos()">CONTINUAR</button>
  </div>
  
<script>

function salvarGastos() {
    const token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

    const dados = {
        moradia: parseFloat(document.getElementById('Moradia').value) || 0,
        alimentacao: parseFloat(document.getElementById('Alimento').value) || 0,
        transporte: parseFloat(document.getElementById('Transporte').value) || 0,
        saude: parseFloat(document.getElementById('Saude').value) || 0,
        assinaturas: parseFloat(document.getElementById('Assinaturas').value) || 0,
        lazer: parseFloat(document.getElementById('Lazer').value) || 0,
        educacao: parseFloat(document.getElementById('Educacao').value) || 0,
        investimento: parseFloat(document.getElementById('Investimento').value) || 0,
        outros: parseFloat(document.getElementById('Outros').value) || 0
    };

    fetch("/simulador/gastos", {
        method: "POST",
        headers: {
            "Content-Type": "application/json",
            "X-CSRF-TOKEN": token,
            "Accept": "application/json"
        },
        body: JSON.stringify(dados)
    })
    .then(response => {
        if (!response.ok) throw new Error("Erro na requisição");
        return response.json();
    })
    .then(data => {
        if (data.success) {
            window.location.href = "/simulador/plano";
        } else {
            console.error("Erro:", data);
        }
    })
    .catch(error => {
        console.error("Erro na resposta:", error);32
    });
}

</script>

</body>
</html>
