<?php

namespace ElxDigital\Correios\Data;

class Configs
{
    private $service;
    private $cepOrigin;
    private $cepDestiny;
    private $format;   
    private $ownHand;
    private $notice;

    /**
     * Get the value of service
     */
    public function getService()
    {
        return $this->service;
    }

    /**
     * Set the value of service
     * 
     * @docs:
     * Código do serviço:
     * - 40010 SEDEX Varejo
     * - 40045 SEDEX a Cobrar Varejo
     * - 40215 SEDEX 10 Varejo
     * - 40290 SEDEX Hoje Varejo
     * - 41106 PAC Varejo
     * 
     * @required: Sim, pode ser mais de um numa consulta separados por vírgula.
     */
    public function setService(string $service): self
    {
        $this->service = $service;
        return $this;
    }

    /**
     * Get the value of cepOrigin
     */
    public function getCepOrigin()
    {
        return $this->cepOrigin;
    }

    /**
     * Set the value of cepOrigin
     * 
     * @docs: CEP de Origin sem hífen.Exemplo: 05311900
     * @required: Sim
     */
    public function setCepOrigin(string $cepOrigin): self
    {
        $this->cepOrigin = preg_replace('/[^0-9]/', '', $cepOrigin);
        return $this;
    }

    /**
     * Get the value of cepDestiny
     */
    public function getCepDestiny()
    {
        return $this->cepDestiny;
    }

    /**
     * Set the value of cepDestiny
     * 
     * @docs: CEP de Destino sem hífen
     * @required: Sim
     */
    public function setCepDestiny(string $cepDestiny): self
    {
        $this->cepDestiny = preg_replace('/[^0-9]/', '', $cepDestiny);
        return $this;
    }

    /**
     * Get the value of format
     */
    public function getFormat()
    {
        return $this->format;
    }

    /**
     * Set the value of format
     * 
     * @docs: 
     * Formato da encomenda (incluindo embalagem).
     * Valores possíveis: 1, 2 ou 3
     * 1 – Formato caixa/pacote
     * 2 – Formato rolo/prisma
     * 3 - Envelope
     * 
     * @required: Sim
     */
    public function setFormat(int $format): self
    {
        $this->format = $format;
        return $this;
    }
        
    /**
     * Get the value of ownHand
     */
    public function getOwnHand()
    {
        return $this->ownHand;
    }

    /**
     * Set the value of ownHand
     * 
     * @docs: Indica se a encomenda será entregue com o serviço
     * adicional mão própria.
     * Valores possíveis: S ou N (S – Sim, N – Não)
     * 
     * @required: Sim.
     */
    public function setOwnHand(bool $ownHand): self
    {
        $this->ownHand = $ownHand ? "S" : "N";
        return $this;
    }

    /**
     * Get the value of notice
     */
    public function getNotice()
    {
        return $this->notice;
    }

    /**
     * Set the value of notice
     * 
     * @docs: Indica se a encomenda será entregue com o serviço
     * adicional aviso de recebimento.
     * Valores possíveis: S ou N (S – Sim, N – Não)
     * 
     * @required: Sim. Se não optar pelo serviço informar "N"
     */
    public function setNotice(bool $notice): self
    {
        $this->notice = $notice ? "S" : "N";
        return $this;
    }
}
