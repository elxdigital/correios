<?php

namespace ElxDigital\Correios;

class Correios
{
    private $url;
    private $func;
    private $params;
    private $endPoint;
    private $callback;

    public function __construct()
    {
        $this->url = 'ws.correios.com.br';
    }

    /**
     * Set the value of params
     *
     * @return  self
     */
    protected function setParams($params)
    {
        $this->params = $params;
        return $this;
    }

    /**
     * Set the value of endPoint
     *
     * @return  self
     */
    protected function setEndPoint(string $endPoint)
    {
        $this->endPoint = (string) $endPoint;
        return $this;
    }

    /**
     * Set the value of func
     */
    public function setFunc($func): self
    {
        $this->func = $func;

        return $this;
    }

    /**
     * Get the value of callback
     */
    protected function getCallback()
    {
        return $this->callback;
    }

    /**
     * ########################
     * ### METODO PROTEGIDO ###
     * ########################
     */

    //Faz uma requisição do tipo GET
    protected function post()
    {
        $url = 'http://' . $this->url . $this->endPoint;

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($this->params));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
        $result = curl_exec($ch);

        if (curl_errno($ch)) {
            $this->callback = curl_error($ch);
        } else {
            $this->callback = json_decode($result, true);
        }
        curl_close($ch);
        return;
    }

    protected function soap()
    {
        $url = 'http://' . $this->url . $this->endPoint;
        $soap = new \SoapClient($url);

        try {
            ini_set('soap.wsdl_cache_enabled',0);
            ini_set('soap.wsdl_cache_ttl',0);

            $this->callback = (object) $soap->{$this->func}($this->params);
        } catch (\Throwable $error) {
            $this->callback = (object) [
                'CalcPrecoPrazoResult' => (object) [
                    'Servicos' => (object) [
                        'cServico' => (object) [
                            'Erro' => 99,
                            'MsgErro' => $error->getMessage()
                        ]
                    ]
                ]
            ];
        }
    }
}
