<?php

namespace ElxDigital\Correios\Data;

class Item
{
    private $weight;
    private $length;
    private $height;
    private $width;
    private $diameter;
    private $price;
    private $quantity;

    /**
     * Get the value of weight
     */
    public function getWeight()
    {
        return $this->weight;
    }

    /**
     * Set the value of weight
     * 
     * @docs: Peso da encomenda, incluindo sua embalagem. O
     * peso deve ser informado em quilogramas. Se o
     * formato for Envelope, o valor máximo permitido será 1
     * kg
     * 
     * @required: Sim
     */
    public function setWeight(string $weight): self
    {
        $this->weight = $weight;
        return $this;
    }

    /**
     * Get the value of length
     */
    public function getLength()
    {
        return $this->length;
    }

    /**
     * Set the value of length
     * 
     * @docs: Comprimento da encomenda (incluindo embalagem), em centímetros.
     * @required: Sim
     */
    public function setLength(float $length): self
    {
        $this->length = $length;
        return $this;
    }

    /**
     * Get the value of height
     */
    public function getHeight()
    {
        return $this->height;
    }

    /**
     * Set the value of height
     * 
     * @docs: Altura da encomenda (incluindo embalagem), em
     * centímetros. Se o formato for envelope, informar zero (0).
     * 
     * @required: Sim.
     */
    public function setHeight(float $height): self
    {
        $this->height = $height;
        return $this;
    }

    /**
     * Get the value of width
     */
    public function getWidth()
    {
        return $this->width;
    }

    /**
     * Set the value of width
     * 
     * @docs: Largura da encomenda (incluindo embalagem), em centímetros.
     * @required: Sim
     */
    public function setWidth($width): self
    {
        $this->width = $width;
        return $this;
    }

    /**
     * Get the value of diameter
     */
    public function getDiameter()
    {
        return $this->diameter;
    }

    /**
     * Set the value of diameter
     * 
     * @docs: Diâmetro da encomenda (incluindo embalagem), em centímetros.
     * @required: Sim
     */
    public function setDiameter(float $diameter): self
    {
        $this->diameter = $diameter;
        return $this;
    }

    /**
     * Get the value of price
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * Set the value of price
     * 
     * @docs: Indica se a encomenda será entregue com o serviço
     * dicional valor declarado. Neste campo deve ser
     * apresentado o valor declarado desejado, em Reais.
     * 
     * @required: Sim. Se não optar pelo serviço informar zero.
     */
    public function setPrice(float $price): self
    {
        $this->price = $price;
        return $this;
    }

    /**
     * Get the value of quantity
     */
    public function getQuantity()
    {
        return $this->quantity;
    }

    /**
     * Set the value of quantity
     */
    public function setQuantity(int $quantity): self
    {
        $this->quantity = $quantity;
        return $this;
    }
}