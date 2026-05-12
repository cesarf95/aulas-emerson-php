<?php

// =========================================
// IMPORTA CONEXÃO COM O BANCO
// =========================================
//
// include executa outro arquivo PHP
//
// Aqui estamos trazendo:
// conecta.php
//
// Esse arquivo contém:
// $pdo = new PDO(...)
//
include 'conecta.php';



// =========================================
// RECEBE DADOS DO FORMULÁRIO
// =========================================
//
// $_POST pega valores enviados pelo form
//
// Esses valores vieram do modal de edição
//

// ID do usuário que será atualizado
$id = $_POST['id'];

// Novo nome digitado
$nome = $_POST['nome'];

// Novo CPF digitado
$cpf = $_POST['cpf'];

// Novo celular digitado
$celular = $_POST['celular'];



// =========================================
// COMANDO SQL UPDATE
// =========================================
//
// UPDATE = atualizar registro existente
//
// SET = define novos valores
//
// WHERE = define QUAL registro atualizar
//
// MUITO IMPORTANTE:
// sem WHERE atualizaria TODOS os registros
//
$sql = "UPDATE pessoas 
        SET nome = :nome, 
            cpf = :cpf, 
            celular = :celular 
        WHERE id = :id";



// =========================================
// PREPARA O SQL
// =========================================
//
// prepare() prepara o comando SQL
//
// Segurança contra SQL Injection
//
// Parecido com SqlCommand no C#
//
$stmt = $pdo->prepare($sql);



// =========================================
// BIND DOS PARÂMETROS
// =========================================
//
// bindParam() liga variável PHP
// ao placeholder SQL
//
// :id recebe $id
//
$stmt->bindParam(':id', $id);



// :nome recebe $nome
//
$stmt->bindParam(':nome', $nome);



// :cpf recebe $cpf
//
$stmt->bindParam(':cpf', $cpf);



// :celular recebe $celular
//
$stmt->bindParam(':celular', $celular);



// =========================================
// EXECUTA O UPDATE
// =========================================
//
// execute() executa o SQL no banco
//
$stmt->execute();



// =========================================
// REDIRECIONA PARA OUTRA PÁGINA
// =========================================
//
// Após atualizar:
// volta para aula_admin.php
//
header('Location: aula_admin.php');



// =========================================
// FINALIZA EXECUÇÃO DO PHP
// =========================================
//
// Boa prática após usar header()
//
exit;

?>