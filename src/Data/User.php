<?php

namespace ElxDigital\Correios\Data;

class User
{
    private $login;
    private $password;

    /**
     * Get the value of login
     */
    public function getLogin()
    {
        return $this->login;
    }

    /**
     * Set the value of login
     * 
     * @docs: Seu código administrativo junto à ECT. O código está
     * disponível no corpo do contrato firmado com os
     * Correios.
     * 
     * @required: Não, mas o parâmetro tem que ser passado mesmo vazio.
     */
    public function setLogin(string $login): self
    {
        $this->login = $login;
        return $this;
    }

    /**
     * Get the value of password
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * Set the value of password
     * 
     * @docs: Senha para acesso ao serviço, associada ao seu
     * código administrativo. A senha inicial corresponde aos
     * 8 primeiros dígitos do CNPJ informado no contrato. A
     * qualquer momento, é possível alterar a senha no
     * endereço (http://www.corporativo.correios.com.br/encomendas/servicosonline/recuperaSenha)
     * 
     * @required: Não, mas o parâmetro tem que ser passado mesmo vazio.
     */
    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }
}