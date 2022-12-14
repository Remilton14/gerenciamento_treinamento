<?php
session_start();
date_default_timezone_set('America/Sao_Paulo');
include_once 'Class.Conection.php';

if(!empty($_POST["nome_sala_de_evento"]) && !empty($_POST["lotacao_sala_evento"])){

    $data_atual = date('Y-m-d H:i:s');
    $id_sala             = filter_input(INPUT_POST,'id_sala',FILTER_SANITIZE_NUMBER_INT);
    $nome_sala           = filter_input(INPUT_POST,'nome_sala_de_evento',FILTER_SANITIZE_STRING);
    $lotacao_sala_evento = filter_input(INPUT_POST,'lotacao_sala_evento',FILTER_SANITIZE_STRING);

    $sql = "UPDATE `sala_evento` SET `nome_sala`='$nome_sala',`lotacao_sala`='$lotacao_sala_evento',`datemodified`='$data_atual' WHERE `id_sala` = $id_sala";
    var_dump($sql);
    $sql_query = mysqli_query($conn, $sql);

    $num_linha_afetada = mysqli_affected_rows($conn);

    if($num_linha_afetada === 1){

        mysqli_close($conn);
        $_SESSION['msg_success'] = "<p id='msg' style='background-color: #3b9d6f;color:#fff;padding: 10px;width: 40%;position: absolute;bottom: 40px;right: 0;box-shadow: 0 .5rem 1rem rgba(0,0,0,.15)!important;'>Sucesso na edição</p>";
        header('Location: ../sala-de-eventos');
    }else{
        mysqli_close($conn);
        $_SESSION['msg_error'] = "<p id='msg' style='background-color: #d75656;color:#fff;padding:10px;width: 40%;position: absolute;bottom: 40px;right: 0;box-shadow: 0 .5rem 1rem rgba(0,0,0,.15)!important;'>Não foi possível editar</p>";
        header('Location: ../sala-de-eventos');
    }

}else{
    header('Location: ../sala-de-eventos');
}