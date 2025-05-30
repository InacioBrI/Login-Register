<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <title>Editar Simulação</title>
  <style>
    body {
      background-color: #1c0033;
      color: #fff;
      font-family: "Segoe UI", sans-serif;
      padding: 2rem;
    }

    h1 {
      margin-bottom: 2rem;
    }

    form {
      background-color: #f5f5f5;
      color: #1c0033;
      padding: 2rem;
      border-radius: 10px;
      max-width: 600px;
      margin: auto;
    }

    label {
      display: block;
      margin-top: 1rem;
      font-weight: bold;
    }

    input {
      width: 100%;
      padding: 0.8rem;
      margin-top: 0.5rem;
      border: 1px solid #ccc;
      border-radius: 5px;
    }

    button {
      margin-top: 2rem;
      padding: 1rem 2rem;
      background-color: #00a000;
      color: white;
      border: none;
      border-radius: 10px;
      font-size: 1rem;
      cursor: pointer;
    }

    button:hover {
      background-color: #008000;
    }

    a {
      display: inline-block;
      margin-top: 1rem;
      color: #ccc;
      text-decoration: none;
    }
  </style>
</head>
<body>

  <h1>Editar Simulação</h1>

  <form action="{{ route('simulacao.update', $simulacao->id) }}" method="POST">
    @csrf
    @method('PUT')

    <label for="tipo">Tipo de Renda:</label>
    <input type="text" name="tipo" id="tipo" value="{{ $simulacao->renda->tipo ?? '' }}" required>

    <label for="valor">Valor Recebido:</label>
    <input type="number" step="0.01" name="valor" id="valor" value="{{ $simulacao->renda->valor ?? 0 }}" required>

    <label for="valor_final">Valor Final:</label>
    <input type="number" step="0.01" name="valor_final" id="valor_final" value="{{ $simulacao->valor_final ?? 0 }}" required>

    <button type="submit">Salvar Alterações</button>
    <a href="{{ route('dashboard') }}">← Voltar</a>
  </form>

</body>
</html>
