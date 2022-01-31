<?php

namespace App\Files;

class CSV{

    /**  
    * *Método responsável por ler um arquivo CSV
    *@param string $arquivo,
    *@param bool $cabecalho,
    *@param string $delimitador
    *@return array 
    */
    public static function lerArquivo($arquivo, $cabecalho = true, $delimitador = ','){

        // Dados das linhas do arquivo
        $dados = [];

        // Abre o arquivo
        $csv = fopen($arquivo, 'r');

        // Cabeçalhp de dados, primeira linha
        $cabecalhoDados = $cabecalho ? fgetcsv($csv, 0, $delimitador) : [];

        //Itera o arquivo, lendo todas as linhas
        while($linha = fgetcsv($csv, 0, $delimitador)){
            $dados [] = $linha;
        }

        // Retorna os dados processados
        return $dados;
    }
}