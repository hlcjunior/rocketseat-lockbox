<?php

namespace Core;

use App\Models\Usuario;

class Validacao
{

    public array $validacoes = [];

    public static function validar(array $regras, array $dados): Validacao
    {
        $validacao = new self();

        foreach ($regras as $campo => $regrasDoCampo) {
            foreach ($regrasDoCampo as $regra) {
                $valorDoCampo = $dados[$campo] ?? '';

                if ($regra == 'confirmed') {
                    $validacao->$regra($campo, $valorDoCampo, $dados["{$campo}_confirmacao"] ?? '');
                } elseif (str_contains($regra, ':')) {
                    $temp = explode(':', $regra);
                    $regraTemp = $temp[0];
                    $argTemp = $temp[1];
                    $validacao->$regraTemp($argTemp, $campo, $valorDoCampo);
                } else {
                    $validacao->$regra($campo, $valorDoCampo);
                }
            }
        }

        return $validacao;
    }

    /** @noinspection PhpUnusedPrivateMethodInspection
     * Função dinâmica para validar campos obrigatórios
     */
    private function required(string $campo, mixed $valorDoCampo): void
    {
        if (strlen($valorDoCampo) == 0) {
            $this->addErro($campo, "O campo $campo é obrigatório.");
        }
    }

    /** @noinspection PhpUnusedPrivateMethodInspection
     * Função dinâmica para validar campos de email
     */
    private function email(string $campo, mixed $valorDoCampo): void
    {
        if (!filter_var($valorDoCampo, FILTER_VALIDATE_EMAIL)) {
            $this->addErro($campo, "O campo $campo é inválido.");
        }
    }

    /** @noinspection PhpUnusedPrivateMethodInspection
     * Função dinâmica para validar campos de confirmação
     */
    private function confirmed(string $campo, mixed $valorDoCampo, mixed $valorCampoConfirmacao): void
    {
        if ($valorDoCampo != $valorCampoConfirmacao) {
            $this->addErro($campo, "Os campos $campo e  $campo confirmação não conferem.");
        }
    }

    /** @noinspection PhpUnusedPrivateMethodInspection
     * Função dinâmica para validar tamanho mínimo de campos
     */
    private function min(int $min, string $campo, mixed $valorDoCampo): void
    {
        if (strlen($valorDoCampo) < $min) {
            $this->addErro($campo, "O campo $campo deve ter no mínimo $min caracteres.");
        }
    }

    /** @noinspection PhpUnusedPrivateMethodInspection
     * Função dinâmica para validar tamanho máximo de campos
     */
    private function max(int $max, string $campo, mixed $valorDoCampo): void
    {
        if (strlen($valorDoCampo) > $max) {
            $this->addErro($campo, "O campo $campo deve ter no máximo $max caracteres.");
        }
    }

    /** @noinspection PhpUnusedPrivateMethodInspection
     * Função dinâmica para validar campos fortes
     */
    private function strong(string $campo, mixed $valorDoCampo): void
    {
        if (!strpbrk($valorDoCampo, '!@#$%&*')) {
            $this->addErro($campo, "O campo $campo deve conter pelo menos um caractere especial.");
        }
    }

    /** @noinspection PhpUnusedPrivateMethodInspection
     * Função dinâmica para validar campos únicos
     */
    private function unique(string $tabela, string $campo, $valorDoCampo): void
    {
        if (strlen($valorDoCampo) == 0) {
            return;
        }

        $db = new Database(config('database'));

        $resultado = $db->query(
            "SELECT * FROM $tabela WHERE $campo = :valor",
            Usuario::class,
            params: ['valor' => $valorDoCampo]
        )->fetch();

        if ($resultado) {
            $this->addErro($campo, "O $campo já está sendo usado.");
        }
    }

    private function addErro($campo, $erro): void
    {
        $this->validacoes[$campo][] = $erro;
    }

    public function naoPassou(?string $nomeCustomizado = null): bool
    {
        $chave = $nomeCustomizado ? "validacoes_" . $nomeCustomizado : 'validacoes';

        flash()->push($chave, $this->validacoes);

        return sizeof($this->validacoes) > 0;
    }
}