<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Plano de Ação</title>
  <style>
    body {
      margin: 0;
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      background-color: #1E0034;
      background-size: cover;
      background-repeat: no-repeat;
      color: #1E0034;
      display: flex;
      justify-content: center;
      align-items: center;
      min-height: 100vh;
    }

    .centro {
      background-color: rgba(255, 255, 255, 0.92);
      padding: 40px 30px;
      border-radius: 12px;
      box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
      max-width: 500px;
      text-align: center;
    }

    h1 {
      font-size: 28px;
      color: #633BBC;
      margin-bottom: 10px;
    }

    p {
      font-size: 16px;
      color: #444;
      margin-bottom: 20px;
    }

    .resultados p {
      font-size: 18px;
      margin: 10px 0;
      display: flex;
      justify-content: space-between;
      border-bottom: 1px solid #ddd;
      padding-bottom: 5px;
    }

    .resultados span {
      font-weight: bold;
      color: #D06833;
    }

    button {
      margin-top: 25px;
      padding: 10px 25px;
      background-color: #633BBC;
      color: white;
      border: none;
      border-radius: 8px;
      font-size: 16px;
      cursor: pointer;
      transition: background-color 0.3s ease;
    }

    button:hover {
      background-color: #5129a4;
    }
  </style>
</head>
<body>
  <div class="centro">
    <h1>PLANO DE AÇÃO</h1>
    <p>Veja como estão distribuídos seus gastos com base na sua renda:</p>
    <div class="resultados">
      <p>Essenciais: <span id="valor-essenciais">{{ $percentuais['essenciais'] }}%</span></p>
      <p>Lazer: <span id="valor-lazer">{{ $percentuais['lazer'] }}%</span></p>
      <p>Investimento: <span id="valor-investimento">{{ $percentuais['investimento'] }}%</span></p>
    </div>
    <a href="{{ route('simulador.analise') }}"><button>VER ANÁLISE</button></a>
  </div>
  <script>

    window.onload = () => {
    const essenciais = document.getElementById("valor-essenciais").textContent;
    const lazer = document.getElementById("valor-lazer").textContent;
    const investimento = document.getElementById("valor-investimento").textContent;

    // Armazena no localStorage, se quiser usar depois
    localStorage.setItem("essenciais", essenciais);
    localStorage.setItem("lazer", lazer);
    localStorage.setItem("investimento", investimento);
    }

  </script>
</body>
</html>
