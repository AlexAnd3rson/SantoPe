<?php

declare(strict_types=1);


if (!function_exists('e')) {
    /**
     * Escapa texto para saída segura em HTML.
     */
    function e(?string $texto): string
    {
        return htmlspecialchars((string) $texto, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');
    }
}

if (!function_exists('whatsapp_configurado')) {
    /**
     * Indica se o número oficial de WhatsApp já foi configurado.
     */
    function whatsapp_configurado(array $whatsapp): bool
    {
        $numero = preg_replace('/\D/', '', (string) ($whatsapp['numero'] ?? ''));

        return $numero !== '' && strlen($numero) >= 10;
    }
}

if (!function_exists('whatsapp_link')) {
    /**
     * Monta o link do WhatsApp a partir do número configurado.
     * Retorna string vazia enquanto o número oficial não for informado.
     */
    function whatsapp_link(array $whatsapp): string
    {
        if (!whatsapp_configurado($whatsapp)) {
            return '';
        }

        $numero   = preg_replace('/\D/', '', (string) $whatsapp['numero']);
        $mensagem = (string) ($whatsapp['mensagem'] ?? '');

        $link = 'https://wa.me/' . $numero;

        if ($mensagem !== '') {
            $link .= '?text=' . rawurlencode($mensagem);
        }

        return $link;
    }
}

if (!function_exists('whatsapp_exibicao')) {
    /**
     * Texto exibido no card de WhatsApp.
     */
    function whatsapp_exibicao(array $whatsapp): string
    {
        if (whatsapp_configurado($whatsapp)) {
            $exibicao = trim((string) ($whatsapp['exibicao'] ?? ''));

            return $exibicao !== '' ? $exibicao : (string) $whatsapp['numero'];
        }

        return (string) ($whatsapp['exibicao'] ?? 'Número a definir');
    }
}