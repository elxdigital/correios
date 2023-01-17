<?php

require __DIR__ . "/../vendor/autoload.php";

// Nova Instancia da Classe Responsável por fazer o cálculo 
$correiosCalcPrecoPrazo = new \ElxDigital\Correios\Services\PrecoPrazo();

// Agora criamos uma instancia do objeto resposável pelas configurações do Frete (CONFIGURAÇÃO OBRIGATÓRIA)
$correiosConfigs = new \ElxDigital\Correios\Data\Configs();
$correiosConfigs->setService("40010");                      // [REQUIRED] 40010 SEDEX Varejo | 40045 SEDEX a Cobrar Varejo | 40215 SEDEX 10 Varejo | 40290 SEDEX Hoje Varejo | 41106 PAC Varejo (OBS: Você pode informar mais de um separando por vírgula)
$correiosConfigs->setCepOrigin("59122-410");                // [REQUIRED] CEP de Origem
$correiosConfigs->setCepDestiny("71615-730");               // [REQUIRED] CEP de Destino
$correiosConfigs->setFormat(1);                             // [REQUIRED] 1 – Formato caixa/pacote | 2 – Formato rolo/prisma | 3 - Envelope
$correiosConfigs->setOwnHand(false);                        // [REQUIRED] É mão própria?
$correiosConfigs->setNotice(false);                         // [REQUIRED] Notificar recebimento
$correiosCalcPrecoPrazo->setConfigs($correiosConfigs);      // [REQUIRED] Informa a intancia responsável as configurações

// Agora criamos uma instancia do usúario do correios (ESTA CONFIGURAÇÃO É TOTALMENTE OPCIONAL E PODE SER IGNORADA)
$correiosUser = new \ElxDigital\Correios\Data\User();
$correiosUser->setLogin("");                                // Login do Correios
$correiosUser->setPassword("");                             // Senha do Correios
$correiosCalcPrecoPrazo->setUser($correiosUser);            // Informa a instancia resposavel a conta do Correios

// Agora criamos uma instancia de um Item a ser calculado (NECESSÁRIO AO MENOS 1 ITEM)
$item = new \ElxDigital\Correios\Data\Item();   
$item->setWeight(0.12);                                     // [REQUIRED] Peso do Item
$item->setLength(6.00);                                     // [REQUIRED] Comprimento do Item
$item->setHeight(10.00);                                    // [REQUIRED] Altura do Item
$item->setWidth(6.00);                                      // [REQUIRED] Largura do Item
$item->setDiameter(0);                                      // Diâmetro do Item
$item->setPrice(10.00);                                     // Valor do Item
$item->setQuantity(1);                                      // [REQUIRED] Quantidade do Item
$correiosCalcPrecoPrazo->setItems($item);                   // Informa a instancia resposável nosso primeiro Item

// Irei informar mais um item apenas para demonstração, porém é totalmente opcional
$item = new \ElxDigital\Correios\Data\Item();   
$item->setWeight(0.3);                                     
$item->setLength(10.00);                                     
$item->setHeight(12.00);                                    
$item->setWidth(8.00);                                      
$item->setDiameter(0);                                      
$item->setPrice(19.00);                                     
$item->setQuantity(1);                                      
$correiosCalcPrecoPrazo->setItems($item);                   

// Por fim iremos enviar essas informações para a API do Correios processar e nos devolver nossas informações!
$response = $correiosCalcPrecoPrazo->send();

// Se tudo ocorrer bem agora você terá um objeto $response com os dados devolvidos pelos correios!
var_dump($response->CalcPrecoPrazoResult->Servicos);