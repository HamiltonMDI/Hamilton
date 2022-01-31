<?php
require "vendor/autoload.php";
require "conexao.php";
use App\Files\CSV;

$arquivo = $_FILES['file']['tmp_name'];
$dados = CSV::lerArquivo($arquivo);

$dataHora     = 0;
$idOperacao   = 0;
$txld         = 0;
$cpfCnpj      = 0;
$valorTarifa  = 0;
$lancamento   = 0;
$valor        = 0;
$natureza     = 0;
$destinatario = 0;

for($i=0; $i<count($dados); $i++){
    
    $a = explode(",", $dados[$i][0]);

    $dataHora     = $a[0];
    $lancamento   = $a[1];
    $idOperacao   = $a[2];
    $txld         = $a[3];
    $destinatario = $a[4];
    $cpfCnpj      = $a[5];
    $valorTarifa  = $a[6];
    $valor        = $a[7];
    $natureza     = $a[8];

    echo "<pre>";
    echo $natureza;
    echo "</pre>";

    if($natureza == '"C"'){
        $query = "INSERT INTO clientes (data_hora, idOperacao,txld, destinatario, cpf_cnpj,valorTarifa, lancamento, valor, natureza, status) VALUES('$dataHora', '$idOperacao', '$txld','$destinatario', '$cpfCnpj', '$valorTarifa', '$lancamento', '$valor', '$natureza', 'ativo')";
        if($con->query($query) === TRUE){
            continue;
        }else{
            echo "Error: " . $query . "<br>" . $con->error;
        }
    }
    else if($natureza != '"C"'){
        $query ="INSERT INTO clientes (data_hora, idOperacao,txld, destinatario, cpf_cnpj,valorTarifa, lancamento, valor, natureza, status) VALUES('$dataHora', '$idOperacao', '$txld','$destinatario', '$cpfCnpj', '$valorTarifa', '$lancamento', '$valor', '$natureza', 'destivado')";
        if($con->query($query) === TRUE){
            echo "asdasda";
            continue;
        }else{
            echo "Error: " . $query . "<br>" . $con->error;
        }
        // $query = $con->prepare("INSERT INTO clientes (data/hora, idOperacao,txld, cpf/cnpj,valorTarifa, lancamento, valor, natureza, status) VALUES(?, ?, ?, ?, ?, ?, ?, ?, 'desativado')");
        // $query->bind_param('sssddsds',$dataHora, $idOperacao, $txld, $cpfCnpj, $valorTarifa, $lancamento, $valor, $natureza);
        // $query->execute();
    }
}

