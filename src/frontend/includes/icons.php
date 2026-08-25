<?php

declare(strict_types=1);


if (!function_exists('icone')) {
    function icone(string $nome, string $classe = 'icone'): string
    {
        $svgs = [

            // Marca: solado com tira em V.
            'marca' => '<path d="M16 3c6.2 0 9.5 5.6 9.5 13S22.2 29 16 29 6.5 23.4 6.5 16 9.8 3 16 3z" fill="none" stroke="currentColor" stroke-width="2"/>'
                . '<path d="M16 9.5 10.5 17M16 9.5 21.5 17" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>'
                . '<circle cx="16" cy="8" r="1.6" fill="currentColor"/>',

            'menu' => '<path d="M5 9h22M5 16h22M5 23h22" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round"/>',

            'fechar' => '<path d="M9 9l14 14M23 9L9 23" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round"/>',

            'seta' => '<path d="M7 16h17M18 10l6 6-6 6" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"/>',

            'whatsapp' => '<path d="M16 5.4c-5.9 0-10.6 4.8-10.6 10.6 0 1.9.5 3.7 1.4 5.3L5.3 26.7l5.6-1.4c1.5.8 3.3 1.3 5.1 1.3 5.9 0 10.6-4.8 10.6-10.6S21.9 5.4 16 5.4z" fill="none" stroke="currentColor" stroke-width="2" stroke-linejoin="round"/>'
                . '<path d="M12.4 11.6c.3 0 .6 0 .8.5l.9 2c.1.3.1.5-.1.8l-.6.7c-.2.2-.2.4-.1.6.5 1 1.6 2.1 2.7 2.6.3.1.5.1.7-.1l.7-.8c.2-.2.4-.3.7-.2l2 .9c.4.2.5.4.5.7 0 1.3-1 2.1-2.2 2.1-3.3 0-7.3-4-7.3-7.3 0-1.2.9-2.2 2.1-2.2h.2z" fill="currentColor"/>',

            'email' => '<rect x="4.5" y="7.5" width="23" height="17" rx="3" fill="none" stroke="currentColor" stroke-width="2"/>'
                . '<path d="m5.5 10 9.3 6.7c.7.5 1.7.5 2.4 0L26.5 10" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>',

            'endereco' => '<path d="M16 4.5c-4.4 0-8 3.5-8 7.9 0 5.9 8 15.1 8 15.1s8-9.2 8-15.1c0-4.4-3.6-7.9-8-7.9z" fill="none" stroke="currentColor" stroke-width="2" stroke-linejoin="round"/>'
                . '<circle cx="16" cy="12.4" r="3.1" fill="none" stroke="currentColor" stroke-width="2"/>',

            // Valores.
            'qualidade' => '<path d="M16 5.5 18.9 12l7.1.7-5.3 4.8 1.5 7L16 21l-6.2 3.5 1.5-7L6 12.7l7.1-.7z" fill="none" stroke="currentColor" stroke-width="2" stroke-linejoin="round"/>',

            'personalizacao' => '<path d="M23.4 6.6a3.1 3.1 0 0 1 0 4.4L11.6 22.8l-5.1 1.5 1.5-5.1L19.8 7.4a3.1 3.1 0 0 1 3.6-.8z" fill="none" stroke="currentColor" stroke-width="2" stroke-linejoin="round"/>'
                . '<path d="m18.6 8.6 4.4 4.4" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>',

            'criatividade' => '<path d="M16 4.8a7.6 7.6 0 0 0-4.4 13.8c.7.5 1.1 1.3 1.1 2.1v.6h6.6v-.6c0-.8.4-1.6 1.1-2.1A7.6 7.6 0 0 0 16 4.8z" fill="none" stroke="currentColor" stroke-width="2" stroke-linejoin="round"/>'
                . '<path d="M13.4 24.6h5.2M14.2 27.3h3.6" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>',

            'compromisso' => '<path d="M16 26.5s-9.5-5.6-9.5-12A5.3 5.3 0 0 1 16 11.2a5.3 5.3 0 0 1 9.5 3.3c0 6.4-9.5 12-9.5 12z" fill="none" stroke="currentColor" stroke-width="2" stroke-linejoin="round"/>',

            'organizacao' => '<rect x="5.5" y="6.5" width="9" height="9" rx="2" fill="none" stroke="currentColor" stroke-width="2"/>'
                . '<rect x="17.5" y="6.5" width="9" height="9" rx="2" fill="none" stroke="currentColor" stroke-width="2"/>'
                . '<rect x="5.5" y="18.5" width="9" height="9" rx="2" fill="none" stroke="currentColor" stroke-width="2"/>'
                . '<path d="M18 23h8M22 19v8" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>',
        ];

        if (!isset($svgs[$nome])) {
            return '';
        }

        return '<svg class="' . htmlspecialchars($classe, ENT_QUOTES, 'UTF-8') . '" viewBox="0 0 32 32" '
            . 'xmlns="http://www.w3.org/2000/svg" aria-hidden="true" focusable="false">'
            . $svgs[$nome]
            . '</svg>';
    }
}

if (!function_exists('ilustracao_chinelos')) {
    /**
     * Ilustração principal: par de chinelos personalizados (vetorial).
     */
    function ilustracao_chinelos(): string
    {
        return <<<SVG
<svg class="ilustracao-hero" viewBox="0 0 320 300" xmlns="http://www.w3.org/2000/svg"
     role="img" aria-label="Ilustração de um par de chinelos personalizados com estampa">
  <circle cx="160" cy="150" r="128" fill="var(--cor-rosa-medio)"/>
  <g transform="translate(58 44) rotate(-7 52 106)">
    <path d="M52 0c26 0 42 24 42 60 0 44-12 92-42 92S10 104 10 60C10 24 26 0 52 0z"
          fill="var(--cor-branco)" stroke="var(--cor-roxo)" stroke-width="4"/>
    <path d="M52 34c22 0 38 12 38 30S74 96 52 96 14 82 14 64s16-30 38-30z"
          fill="var(--cor-rosa-claro)"/>
    <circle cx="36" cy="66" r="6" fill="var(--cor-roxo-claro)"/>
    <circle cx="52" cy="76" r="6" fill="var(--cor-roxo-claro)"/>
    <circle cx="68" cy="66" r="6" fill="var(--cor-roxo-claro)"/>
    <path d="M52 22 22 60M52 22l30 38" fill="none" stroke="var(--cor-roxo)"
          stroke-width="9" stroke-linecap="round"/>
    <circle cx="52" cy="20" r="5" fill="var(--cor-roxo-escuro)"/>
  </g>
  <g transform="translate(160 62) rotate(9 52 106)">
    <path d="M52 0c26 0 42 24 42 60 0 44-12 92-42 92S10 104 10 60C10 24 26 0 52 0z"
          fill="var(--cor-branco)" stroke="var(--cor-roxo)" stroke-width="4"/>
    <path d="M52 34c22 0 38 12 38 30S74 96 52 96 14 82 14 64s16-30 38-30z"
          fill="var(--cor-rosa-claro)"/>
    <path d="M34 70h36M40 58h24M40 82h24" stroke="var(--cor-roxo-claro)"
          stroke-width="5" stroke-linecap="round" fill="none"/>
    <path d="M52 22 22 60M52 22l30 38" fill="none" stroke="var(--cor-roxo)"
          stroke-width="9" stroke-linecap="round"/>
    <circle cx="52" cy="20" r="5" fill="var(--cor-roxo-escuro)"/>
  </g>
</svg>
SVG;
    }
}

if (!function_exists('ilustracao_personalizacao')) {
    /**
     * Ilustração de apoio da seção Sobre: artes e cores de personalização.
     */
    function ilustracao_personalizacao(): string
    {
        return <<<SVG
<svg class="ilustracao-sobre" viewBox="0 0 260 200" xmlns="http://www.w3.org/2000/svg"
     role="img" aria-label="Ilustração de amostras de cores e artes usadas na personalização">
  <rect x="6" y="14" width="150" height="172" rx="16" fill="var(--cor-branco)"
        stroke="var(--cor-borda)" stroke-width="3"/>
  <rect x="26" y="36" width="110" height="52" rx="10" fill="var(--cor-rosa-claro)"/>
  <path d="M46 74c8-18 20-18 28 0M76 74c6-12 14-12 20 0" fill="none"
        stroke="var(--cor-roxo)" stroke-width="4" stroke-linecap="round"/>
  <rect x="26" y="104" width="110" height="10" rx="5" fill="var(--cor-rosa-medio)"/>
  <rect x="26" y="124" width="76" height="10" rx="5" fill="var(--cor-rosa-medio)"/>
  <circle cx="42" cy="160" r="12" fill="var(--cor-roxo)"/>
  <circle cx="72" cy="160" r="12" fill="var(--cor-roxo-claro)"/>
  <circle cx="102" cy="160" r="12" fill="var(--cor-rosa-medio)"/>
  <g transform="translate(150 30) rotate(8 52 80)">
    <path d="M52 0c22 0 36 20 36 50 0 36-10 76-36 76S16 86 16 50C16 20 30 0 52 0z"
          fill="var(--cor-rosa-claro)" stroke="var(--cor-roxo)" stroke-width="4"/>
    <path d="M52 20 26 52M52 20l26 32" fill="none" stroke="var(--cor-roxo)"
          stroke-width="8" stroke-linecap="round"/>
  </g>
</svg>
SVG;
    }
}