<?php
include 'conecta.php';

$id = $_POST['id'];
$nome = $_POST['nome'];
$cpf = $_POST['cpf'];
$celular = $_POST['celular'];

$sql = "UPDATE pessoas 
        SET nome = :nome, 
            cpf = :cpf, 
            celular = :celular 
        WHERE id = :id";

$stmt = $pdo->prepare($sql);

$stmt->bindParam(':id', $id);
$stmt->bindParam(':nome', $nome);
$stmt->bindParam(':cpf', $cpf);
$stmt->bindParam(':celular', $celular);

$stmt->execute();

header('Location: aula_admin.php');
exit;
?>