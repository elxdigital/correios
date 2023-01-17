# Correios SDK

[![Maintainer](http://img.shields.io/badge/maintainer-@elxdigital-blue.svg?style=flat-square)](https://twitter.com/elxdigital)
[![Source Code](http://img.shields.io/badge/source-elxdigital/correios-blue.svg?style=flat-square)](https://github.com/elxdigital/correios)
[![PHP from Packagist](https://img.shields.io/packagist/php-v/elxdigital/correios.svg?style=flat-square)](https://packagist.org/packages/elxdigital/correios)
[![Latest Version](https://img.shields.io/github/release/elxdigital/correios.svg?style=flat-square)](https://github.com/elxdigital/correios/releases)
[![Software License](https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square)](LICENSE)
[![Build](https://img.shields.io/scrutinizer/build/g/elxdigital/correios.svg?style=flat-square)](https://scrutinizer-ci.com/g/elxdigital/correios)
[![Quality Score](https://img.shields.io/scrutinizer/g/elxdigital/correios.svg?style=flat-square)](https://scrutinizer-ci.com/g/elxdigital/correios)
[![Total Downloads](https://img.shields.io/packagist/dt/elxdigital/correios.svg?style=flat-square)](https://packagist.org/packages/celxdigital/correios)

###### A simple and fast integration with the system of Deadlines and Prices of the couriers developed in PHP using the SOAP protocol provided by the Correios System.

Uma simples e rápida integração com o sistema de Prazos e Preços do correios desenvolvida em PHP usando o protocólogo SOAP disponibilizada pelo Sistema do Correios.

Você pode saber mais **[clicando aqui](http://www.webdesignemfoco.com/img/files/original/Manual-Correios.pdf)**.

### Highlights

- Simple installation (Instalação simples)
- Simple and fast use (Uso simples e rápido)
- Composer ready and PSR-2 compliant (Pronto para o composer e compatível com PSR-2)

## Installation

Uploader is available via Composer:

```bash
"elxdigital/correios": "^1.0"
```

or run

```bash
composer require elxdigital/correios
```

## Documentation

###### For details on how to use, see a sample folder in the component directory. In it you will have an example of use for each class. It works like this:

Para mais detalhes sobre como usar, veja uma pasta de exemplo no diretório do componente. Nela terá um exemplo de uso para cada classe. Ele funciona assim:

#### User endpoint:

```php
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
```

## Contributing

Please see [CONTRIBUTING](https://github.com/elxdigital/uploader/blob/master/CONTRIBUTING.md) for details.

## Support

###### Security: If you discover any security related issues, please email desenvolvimento@ellox.com.br instead of using the issue tracker.

Se você descobrir algum problema relacionado à segurança, envie um e-mail para desenvolvimento@ellox.com.br em vez de usar o rastreador de problemas.

Thank you

## Credits

- [Ellox Digital](https://github.com/elxdigital) (Team)
- [All Contributors](https://github.com/elxdigital/correios/contributors) (This Rock)

## License

The MIT License (MIT). Please see [License File](https://github.com/elxdigital/correios/blob/master/LICENSE) for more information.