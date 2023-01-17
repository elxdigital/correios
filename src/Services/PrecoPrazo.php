<?php

namespace ElxDigital\Correios\Services;
use \ElxDigital\Correios\Correios;

class PrecoPrazo extends Correios
{
    private $configs;
    private $user;
    private $items = [];

    /**
     * Get the value of configs
     */
    public function getConfigs()
    {
        return $this->configs;
    }

    /**
     * Set the value of configs
     */
    public function setConfigs(\ElxDigital\Correios\Data\Configs $configs): self
    {
        $this->configs = $configs;
        return $this;
    }

    /**
     * Get the value of user
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * Set the value of user
     */
    public function setUser(\ElxDigital\Correios\Data\User $user): self
    {
        $this->user = $user;
        return $this;
    }

    /**
     * Get the value of items
     */
    public function getItems()
    {
        return $this->items;
    }

    /**
     * Set the value of items
     */
    public function setItems(\ElxDigital\Correios\Data\Item $item): self
    {
        $this->items[] = $item;
        return $this;
    }

    // Soma os pesos dos itens
    private function weight() 
    {
        if(empty($this->items)) {
            return 0.100;        
        }

        $accomulator = 0.00;
        foreach ($this->items as $item) {
            $itemWeight = $item->getWeight();
            $itemQuantity = $item->getQuantity() ?? 1;

            $accomulator += !empty($itemWeight) ? ($itemWeight * $itemQuantity) : (0.100 * $itemQuantity);
        }

        return $accomulator;
    }

    // Busca pelo maior item em comprimento
    private function length() 
    {
        if(empty($this->items)) {
            return 16;        
        }

        $bigSize = 0;
        foreach ($this->items as $item) {
            $itemLength = $item->getLength();
            $bigSize = $itemLength > $bigSize ? $itemLength : $bigSize;
        }

        return $bigSize;
    }

    // Busca pelo maior item em largura
    private function width() 
    {
        if(empty($this->items)) {
            return 11;        
        }

        $bigWidth = 0;
        foreach ($this->items as $item) {
            $itemWidth = $item->getWidth();
            $bigWidth = $itemWidth > $bigWidth ? $itemWidth : $bigWidth;
        }

        return $bigWidth;
    }

    // Soma as alturas dos produtos 
    public function height () 
    {
        if(empty($this->items)) {
            return 2;        
        }

        $accomulator = 0.00;
        foreach ($this->items as $item) {
            $itemHeight = $item->getHeight();
            $itemQuantity = $item->getQuantity() ?? 1;

            $accomulator += !empty($itemHeight) ? ($itemHeight * $itemQuantity) : (2 * $itemQuantity);
        }

        return $accomulator;
    }

    public function send()
    {
        if(empty($this->configs)) {
            throw new \Error("Você precisa definir as configurações de envio!");
        }

        if(empty($this->items)) {
            throw new \Error("Você precisa informar ao menos um item!");
        }

        $configService = $this->configs->getService();
        $configCepOrigin = $this->configs->getCepOrigin();
        $configCepDestiny = $this->configs->getCepDestiny();
        $configFormat = $this->configs->getFormat();   
        $configOwnHand = $this->configs->getOwnHand();
        $configNotice = $this->configs->getNotice();

        if(
            empty($configService) ||
            empty($configCepOrigin) ||
            empty($configCepDestiny) ||
            empty($configFormat) ||
            empty($configOwnHand) ||
            empty($configNotice)
        ) {
            throw new \Error("Preencha todos os valores da configuração");
        }

        $sendWeight = ($this->weight() < 0.100 ? 0.100 : ($this->weight() > 1.000 ? 1.000 : $this->weight()));
        $sendLength = ($this->length() < 16 ? 16 : ($this->length() > 105 ? 105 : $this->length()));
        $sendHeight = ($this->height() < 2 ? 2 : ($this->height() > 105 ? 105 : $this->height()));
        $sendWidth = ($this->width() < 11 ? 11 : ($this->width() > 60 ? 60 : $this->width()));
        $sendDiameter = 0;
        $sendValue = 0.00;

        $correiosLogin = !empty($this->user) ? $this->user->getLogin() : "";
        $correiosPassword = !empty($this->user) ? $this->user->getPassword() : "";

        $requestData = [
            'nCdEmpresa' => $correiosLogin,
            'sDsSenha' => $correiosPassword,
            'nCdServico' => $configService,
            'sCepOrigem' => $configCepOrigin,
            'sCepDestino' => $configCepDestiny,
            'nVlPeso' => $sendWeight,
            'nCdFormato' => $configFormat,
            'nVlComprimento' => $sendLength,
            'nVlAltura' => $sendHeight,
            'nVlLargura' => $sendWidth,
            'nVlDiametro' => $sendDiameter,
            'sCdMaoPropria' => $configOwnHand,
            'nVlValorDeclarado' => $sendValue,
            'sCdAvisoRecebimento' => $configNotice
        ];

        $this->setEndPoint("/calculador/CalcPrecoPrazo.asmx?WSDL");
        $this->setParams($requestData);
        $this->setFunc("CalcPrecoPrazo");

        $this->soap();

        return $this->getCallback();
    }    
}