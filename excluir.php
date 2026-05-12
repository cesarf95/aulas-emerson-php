<?php
    include 'conecta.php';
    // se eu pegar o ID e (redundante, para deixar o sistema mais seguro) não estiver vazio, ele vai fazer o seguinte
    if (isset($_GET['id']) && !empty($_GET['id'])){
            // esse filtro diz pra buscar apenas o parâmetro ID, pra não buscar muitos dados, buscar diretamente o id
        $id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);
        try{
            $sql = "DELETE FROM pessoas WHERE id=:id";
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            if ($stmt->execute()){
                echo "<script>alert('Pessoa excluída com sucesso'); window.location.href='aula_admin.php';</script>";
                exit;
            }
            else{
                header("Location: aula_admin.php?msg=Não consegui apagar");
                exit;
            }
        }
        catch(PDOException $e){
            die("Erro:".$e->getMessage());
        }
    }
    else{
        header("Location: aula_admin.php");
        exit;
    }
?>