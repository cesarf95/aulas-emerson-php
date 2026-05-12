<?php
include 'conecta.php';

$id= $_GET['id'];
$sql = "SELECT * FROM Pessoas WHERE id= :id";
$stmt = $pdo->prepare($sql);
$stmt -> bindParam(':id', $id, PDO::PARAM_INT);
$stmt->execute();
$pessoa = $stmt->fetch(PDO::FETCH_ASSOC);
//Usado para retornar um valor em json chamando $pessoa
echo json_encode($pessoa);
?>