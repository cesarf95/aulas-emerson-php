<?php
session_start();

if (!isset($_SESSION['nome'])) {
    header('Location: index.php?status=erro&msg=Acesso Negado');
    exit();
}

$nome = $_SESSION['nome'];

echo "<script>alert('Bem-vindo, $nome');</script>"; //Recurso novo adicionado para exibir uma mensagem de boas-vindas ao usuário após o login bem-sucedido.
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <title>Sistema PHP</title>

    <style>
    body {
        background-color: antiquewhite;
    }

    .header {
        position: absolute;
        top: 10px;
        right: 10px;
    }
    </style>
</head>

<body>

    <!-- HEADER -->
    <div class="container-fluid text-center position-relative" style="background:#fffff1;">
        <img src="Imagens/gemini 2.png">

        <div class="header">
            <b><?= htmlspecialchars($nome) ?></b> |
            <a href="sair.php" style="text-decoration:none;font-weight:bold;">SAIR</a>
        </div>
    </div>

    <hr>

    <!-- BOTÃO -->
    <div class="text-center my-3">
        <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#modalCadastrar">
            CADASTRAR PESSOAS
        </button>
    </div>

    <!-- LISTA -->
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">

                <div class="card">
                    <div class="card-header"><b>PESSOAS CADASTRADAS</b></div>

                    <div class="card-body">

                        <?php
include 'conecta.php';

$sql = "SELECT * FROM pessoas ORDER BY nome";
$dados = $pdo->query($sql)->fetchAll(PDO::FETCH_ASSOC);

if (count($dados) > 0) {

echo "<table class='table table-hover'>";
echo "<thead>
<tr>
<th>ID</th>
<th>NOME</th>
<th>CPF</th>
<th>CELULAR</th>
<th>AÇÕES</th>
</tr>
</thead><tbody>";

foreach ($dados as $item) {

$id = $item['id'];

echo "<tr>
<td>{$item['id']}</td>
<td>{$item['nome']}</td>
<td>{$item['cpf']}</td>
<td>{$item['celular']}</td>
<td>
<a href='#' data-bs-toggle='modal' data-bs-target='#modalEditar' data-id='$id'><svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-pencil-fill' viewBox='0 0 16 16'>
<path d='M12.854.146a.5.5 0 0 0-.707 0L10.5 1.793 14.207 5.5l1.647-1.646a.5.5 0 0 0 0-.708zm.646 6.061L9.793 2.5 3.293 9H3.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.207zm-7.468 7.468A.5.5 0 0 1 6 13.5V13h-.5a.5.5 0 0 1-.5-.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.5-.5V10h-.5a.5.5 0 0 1-.175-.032l-.179.178a.5.5 0 0 0-.11.168l-2 5a.5.5 0 0 0 .65.65l5-2a.5.5 0 0 0 .168-.11z'/>
</svg></a> |
<a href='excluir.php?id=$id'> <svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='Red' class='bi bi-recycle' viewBox='0 0 16 16'>
<path d='M9.302 1.256a1.5 1.5 0 0 0-2.604 0l-1.704 2.98a.5.5 0 0 0 .869.497l1.703-2.981a.5.5 0 0 1 .868 0l2.54 4.444-1.256-.337a.5.5 0 1 0-.26.966l2.415.647a.5.5 0 0 0 .613-.353l.647-2.415a.5.5 0 1 0-.966-.259l-.333 1.242zM2.973 7.773l-1.255.337a.5.5 0 1 1-.26-.966l2.416-.647a.5.5 0 0 1 .612.353l.647 2.415a.5.5 0 0 1-.966.259l-.333-1.242-2.545 4.454a.5.5 0 0 0 .434.748H5a.5.5 0 0 1 0 1H1.723A1.5 1.5 0 0 1 .421 12.24zm10.89 1.463a.5.5 0 1 0-.868.496l1.716 3.004a.5.5 0 0 1-.434.748h-5.57l.647-.646a.5.5 0 1 0-.708-.707l-1.5 1.5a.5.5 0 0 0 0 .707l1.5 1.5a.5.5 0 1 0 .708-.707l-.647-.647h5.57a1.5 1.5 0 0 0 1.302-2.244z'/>
</svg></a>
</td>
</tr>";
}

echo "</tbody></table>";

} else {
echo "<p class='text-danger'>NÃO EXISTEM REGISTROS</p>";
}
?>

                    </div>
                </div>

            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
    <div class="modal fade" id="modalCadastrar">
        <div class="modal-dialog">
            <div class="modal-content">

                <div class="modal-header">
                    <h5>CADASTRAR PESSOA</h5>
                    <button class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body">

                    <form action="cadastro_pessoa.php" method="POST">

                        <input class="form-control mb-2" name="nome" placeholder="Nome" required>
                        <input class="form-control mb-2" name="cpf" placeholder="CPF" required>
                        <input class="form-control mb-2" name="celular" placeholder="Celular" required>

                        <button class="btn btn-success">CADASTRAR</button>

                    </form>

                </div>

            </div>
        </div>
    </div>
    <div class="modal fade" id="modalEditar">
        <div class="modal-dialog">
            <div class="modal-content">

                <div class="modal-header">
                    <h5>EDITAR PESSOA</h5>
                    <button class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body">

                    <form action="editar_pessoa.php" method="POST">

                        <input type="hidden" name="id" id="edit_id">

                        <label>NOME</label>
                        <input type="text" name="nome" id="edit_nome" class="form-control">
                        <br>

                        <label>CPF</label>
                        <input type="text" name="cpf" id="edit_cpf" class="form-control">
                        <br>

                        <label>CELULAR</label>
                        <input type="text" name="celular" id="edit_celular" class="form-control">
                        <br>

                        <button class="btn btn-primary">SALVAR</button>

                    </form>

                </div>

            </div>
        </div>
    </div>
    <script>
    document.getElementById('modalEditar').addEventListener('show.bs.modal', function(event) {

        let id = event.relatedTarget.getAttribute('data-id');

        fetch('buscar_pessoa.php?id=' + id)
            .then(res => res.json())
            .then(data => {

                document.getElementById('edit_id').value = data.id;
                document.getElementById('edit_nome').value = data.nome;
                document.getElementById('edit_cpf').value = data.cpf;
                document.getElementById('edit_celular').value = data.celular;

            });

    });
    </script>

</body>

</html>