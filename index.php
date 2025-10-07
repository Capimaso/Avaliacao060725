<?php
require("conexao.php");

$query = "SELECT nome, local, organizador, data FROM eventos ORDER BY data DESC"; // Ordena por data mais recente
$stmt = $pdo->prepare($query);
$stmt->execute();
$eventos = $stmt->fetchAll(PDO::FETCH_ASSOC); // Busca todos os registros como array associativo
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>A1 - Tiago Duarte</title>
    
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&display=swap" rel="stylesheet">
    
    <style>
        /* Reset básico e estilos globais */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: 'Roboto', sans-serif;
            background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%); /* Gradiente sutil no fundo */
            color: #333;
            line-height: 1.6;
            padding: 20px;
            min-height: 100vh;
        }
        
        .container {
            max-width: 1200px;
            margin: 0 auto;
            background: white;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1); /* Sombra suave para "card" effect */
            padding: 30px;
            overflow: hidden; /* Para bordas arredondadas */
        }
        
        h1 {
            text-align: center;
            color: #2c3e50; /* Azul escuro */
            font-size: 2.5em;
            margin-bottom: 30px;
            text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.1);
            font-weight: 300;
        }
        
        /* Estilos para Formulários */
        form {
            background: #f8f9fa;
            padding: 20px;
            border-radius: 10px;
            margin-bottom: 30px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
            border: 1px solid #e9ecef;
        }
        
        label {
            display: block;
            margin-bottom: 5px;
            font-weight: 500;
            color: #495057;
            font-size: 1.1em;
        }
        
        input[type="text"],
        input[type="date"] {
            width: 100%;
            padding: 12px;
            border: 2px solid #dee2e6;
            border-radius: 8px;
            font-size: 1em;
            transition: border-color 0.3s ease, box-shadow 0.3s ease;
            background: white;
        }
        
        input[type="text"]:focus,
        input[type="date"]:focus {
            outline: none;
            border-color: #007bff; /* Azul no foco */
            box-shadow: 0 0 0 3px rgba(0, 123, 255, 0.1);
        }
        
        button {
            background: linear-gradient(135deg, #007bff 0%, #0056b3 100%); /* Gradiente azul */
            color: white;
            padding: 12px 25px;
            border: none;
            border-radius: 8px;
            font-size: 1.1em;
            font-weight: 500;
            cursor: pointer;
            transition: transform 0.2s ease, box-shadow 0.2s ease;
            margin-top: 10px;
            width: 100%; /* Botão full-width para mobile */
        }
        
        button:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(0, 123, 255, 0.3);
        }
        
        button:active {
            transform: translateY(0);
        }
        
        /* Estilos para a Tabela */
        table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
            background: white;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
        }
        
        thead {
            background: linear-gradient(135deg, #007bff 0%, #0056b3 100%);
            color: white;
        }
        
        th {
            padding: 15px;
            text-align: left;
            font-weight: 500;
            font-size: 1.1em;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }
        
        tbody tr {
            transition: background-color 0.3s ease;
        }
        
        tbody tr:nth-child(even) {
            background: #f8f9fa; /* Linhas alternadas para legibilidade */
        }
        
        tbody tr:hover {
            background: #e3f2fd; /* Azul claro no hover */
            transform: scale(1.01); /* Leve zoom no hover */
        }
        
        td {
            padding: 15px;
            border-bottom: 1px solid #dee2e6;
            font-size: 1em;
        }
        
        td[colspan="4"] {
            text-align: center;
            font-style: italic;
            color: #6c757d;
            padding: 20px;
        }
        
        /* Mensagem de "Nenhum evento" */
        .no-events {
            text-align: center;
            padding: 40px;
            color: #6c757d;
            font-size: 1.2em;
        }
        
        /* Estilo para o contador de eventos (novo) */
        .total-eventos {
            text-align: center;
            font-size: 1.3em;
            color: #007bff;
            font-weight: 500;
            margin: 20px 0;
            padding: 10px;
            background: #f8f9fa;
            border-radius: 8px;
            border-left: 4px solid #007bff;
        }
        
        /* Responsivo para Mobile */
        @media (max-width: 768px) {
            .container {
                padding: 15px;
                margin: 10px;
            }
            
            h1 {
                font-size: 2em;
            }
            
            table {
                font-size: 0.9em;
            }
            
            th, td {
                padding: 10px 8px;
            }
            
            /* Tabela rola horizontalmente em telas muito pequenas */
            table {
                overflow-x: auto;
                display: block;
                white-space: nowrap;
            }
            
            form {
                padding: 15px;
            }
            
            input, button {
                font-size: 16px; /* Evita zoom no iOS */
            }
            
            .total-eventos {
                font-size: 1.1em;
            }
        }
        
        /* Ajustes para telas maiores */
        @media (min-width: 1200px) {
            .container {
                padding: 40px;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Tiago Duarte da Cunha</h1>

        <form action="manipular_db.php" method="POST">
            <label for="nome">Nome do Evento:</label>
            <input type="text" name="nome" id="nome" required><br><br>
            
            <label for="local">Local do Evento:</label>
            <input type="text" name="local" id="local" required><br><br>
            
            <label for="organizador">Organizador do Evento:</label>
            <input type="text" name="organizador" id="organizador" required><br><br>
            
            <label for="data">Data do Evento:</label>
            <input type="date" name="data" id="data" required><br><br>

            <button type="submit">Enviar Dados</button>
        </form>

        <table>
            <thead>
                <tr>
                    <th>Nome</th>
                    <th>Local</th>
                    <th>Organizador</th>
                    <th>Data</th>
                </tr>
            </thead>
            <tbody>
                <?php if (empty($eventos)): ?>
                    <tr>
                        <td colspan="4">Nenhum evento cadastrado.</td>
                    </tr>
                <?php else: ?>
                    <?php foreach ($eventos as $evento): ?> 
                        <tr>
                            <td><?= htmlspecialchars($evento['nome']) ?></td>       
                            <td><?= htmlspecialchars($evento['local']) ?></td>
                            <td><?= htmlspecialchars($evento['organizador']) ?></td>
                            <td><?= date('d/m/Y', strtotime($evento['data'])) ?></td> <!-- Formatei a data para DD/MM/YYYY (mais legível) -->
                        </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>

        <div class="total-eventos">
            Total de eventos cadastrados: <?= count($eventos) ?>
        </div>

        <br>

        <form action="excluir_db.php" method="POST">
            <label for="nome_excluir">Nome do Evento para excluir:</label>
            <input type="text" name="nome" id="nome_excluir" required><br><br>

            <button type="submit" style="background: linear-gradient(135deg, #dc3545 0%, #a71e2a 100%);">Excluir</button> <!-- Botão vermelho para exclusão -->
        </form>
    </div>
</body>
</html>