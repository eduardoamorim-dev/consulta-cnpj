<?php

// Função para buscar informações do CNPJ usando cURL
function buscarCNPJ($cnpj)
{
    $url = "https://brasilapi.com.br/api/cnpj/v1/$cnpj";

    // Inicia o cURL
    $ch = curl_init();

    // Configurações do cURL
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPGET, true);

    // Executa a requisição e captura a resposta
    $response = curl_exec($ch);

    // Verifica se houve erro na requisição
    if (curl_errno($ch)) {
        return ['error' => 'Erro ao buscar informações do CNPJ.'];
    }

    // Fecha a conexão cURL
    curl_close($ch);

    // Retorna os dados decodificados
    return json_decode($response, true);
}
