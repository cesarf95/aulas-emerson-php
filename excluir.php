<?php

    // =========================================
    // IMPORTA A CONEXÃO COM O BANCO
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



    // se eu pegar o ID e (redundante, para deixar o sistema mais seguro)
    // não estiver vazio, ele vai fazer o seguinte
    //
    // isset() verifica se a variável existe
    //
    // empty() verifica se está vazia
    //
    // $_GET pega valor vindo pela URL
    //
    // Exemplo:
    // excluir.php?id=5
    //
    if (isset($_GET['id']) && !empty($_GET['id'])){



            // esse filtro diz pra buscar apenas o parâmetro ID,
            // pra não buscar muitos dados,
            // buscar diretamente o id
            //
            // filter_input() pega e filtra dados externos
            //
            // INPUT_GET = dados vindos da URL
            //
            // FILTER_SANITIZE_NUMBER_INT =
            // mantém apenas números inteiros
            //
            // Segurança extra
            //
        $id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);



        // =========================================
        // TRY CATCH
        // =========================================
        //
        // try = tenta executar código
        //
        // catch = captura erros caso aconteçam
        //
        try{



            // =========================================
            // SQL DELETE
            // =========================================
            //
            // DELETE FROM = apagar registro
            //
            // WHERE define QUAL registro será apagado
            //
            // MUITO IMPORTANTE:
            // sem WHERE apagaria TODOS os registros
            //
            $sql = "DELETE FROM pessoas WHERE id=:id";



            // =========================================
            // PREPARA O SQL
            // =========================================
            //
            // prepare() prepara comando SQL
            //
            // Segurança contra SQL Injection
            //
            $stmt = $pdo->prepare($sql);



            // =========================================
            // BIND DO PARÂMETRO
            // =========================================
            //
            // :id recebe valor da variável $id
            //
            // PDO::PARAM_INT define que o parâmetro é inteiro
            //
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);



            // =========================================
            // EXECUTA DELETE
            // =========================================
            //
            // execute() executa SQL no banco
            //
            if ($stmt->execute()){



                // =========================================
                // ALERTA JAVASCRIPT
                // =========================================
                //
                // alert() mostra popup
                //
                // window.location.href redireciona página
                //
                echo "<script>alert('Pessoa excluída com sucesso'); window.location.href='aula_admin.php';</script>";



                // Encerra execução do PHP
                //
                exit;
            }



            // =========================================
            // CASO NÃO CONSIGA APAGAR
            // =========================================
            //
            else{



                // Redireciona para página principal
                // enviando mensagem pela URL
                //
                // ?msg=
                // é parâmetro GET
                //
                header("Location: aula_admin.php?msg=Não consegui apagar");



                // Finaliza execução
                //
                exit;
            }
        }



        // =========================================
        // CASO OCORRA ERRO PDO
        // =========================================
        //
        // PDOException captura erros do banco
        //
        catch(PDOException $e){



            // die() encerra execução do PHP
            //
            // getMessage() mostra erro real
            //
            die("Erro:".$e->getMessage());
        }
    }



    // =========================================
    // CASO ID NÃO EXISTA
    // =========================================
    //
    else{



        // Redireciona para página principal
        //
        header("Location: aula_admin.php");



        // Finaliza execução
        //
        exit;
    }

?>