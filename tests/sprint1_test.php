<?php

declare(strict_types=1);



$base     = dirname(__DIR__);
$frontend = $base . '/src/frontend';

$total   = 0;
$falhas  = 0;

function grupo(string $titulo): void
{
    echo PHP_EOL . '== ' . $titulo . ' ==' . PHP_EOL;
}

function afirmar(bool $condicao, string $descricao): void
{
    global $total, $falhas;

    $total++;

    if ($condicao) {
        echo '  [OK]    ' . $descricao . PHP_EOL;
        return;
    }

    $falhas++;
    echo '  [FALHA] ' . $descricao . PHP_EOL;
}

/**
 * Renderiza a página institucional e devolve o HTML gerado.
 */
function renderizar(string $index): string
{
    ob_start();
    require $index;

    return (string) ob_get_clean();
}

// ---------------------------------------------------------------
// Preparação
// ---------------------------------------------------------------
grupo('Estrutura de arquivos');

$arquivos = [
    'index.php'              => $frontend . '/index.php',
    'pedidos.php'            => $frontend . '/pedidos.php',
    'acompanhamento.php'     => $frontend . '/acompanhamento.php',
    'css/style.css'          => $frontend . '/css/style.css',
    'js/script.js'           => $frontend . '/js/script.js',
    'includes/company.php'   => $frontend . '/includes/company.php',
    'includes/header.php'    => $frontend . '/includes/header.php',
    'includes/footer.php'    => $frontend . '/includes/footer.php',
];

foreach ($arquivos as $rotulo => $caminho) {
    afirmar(is_file($caminho), 'Arquivo existe: src/frontend/' . $rotulo);
}

if (!is_file($frontend . '/index.php')) {
    echo PHP_EOL . 'Página inicial não encontrada. Testes interrompidos.' . PHP_EOL;
    exit(1);
}

$html    = renderizar($frontend . '/index.php');
$css     = (string) file_get_contents($frontend . '/css/style.css');
$empresa = require $frontend . '/includes/company.php';
$contato = $empresa['contato'];

// ---------------------------------------------------------------
// HU01 — Visualizar apresentação institucional da empresa
// ---------------------------------------------------------------
grupo('HU01 — Apresentação institucional');

afirmar(stripos($html, '<!DOCTYPE html') === 0, 'Página inicial renderiza um documento HTML');
afirmar(strpos($html, htmlspecialchars($empresa['nome'], ENT_QUOTES, 'UTF-8')) !== false, 'O nome da empresa (' . $empresa['nome'] . ') aparece na página');
afirmar(strpos($html, 'Sobre a empresa') !== false, 'Título "Sobre a empresa" aparece');
afirmar(strpos($html, 'chinelos personalizados') !== false, 'Descrição da empresa aparece');
afirmar(strpos($html, 'id="sobre"') !== false, 'Seção Sobre está presente');
afirmar(
    (bool) preg_match('/<a[^>]+href="#sobre"[^>]*>\s*Conheça nossa empresa/u', $html),
    'Botão "Conheça nossa empresa" leva à seção Sobre na mesma página'
);
afirmar(
    mb_strlen(strip_tags($empresa['sobre']), 'UTF-8') <= 400,
    'Texto institucional é curto e objetivo'
);

// ---------------------------------------------------------------
// HU02 — Visualizar missão, visão e valores
// ---------------------------------------------------------------
grupo('HU02 — Missão, visão e valores');

afirmar(strpos($html, 'id="valores"') !== false, 'Seção Missão, Visão e Valores está presente');
afirmar(strpos($html, '>Missão<') !== false, 'Missão aparece');
afirmar(strpos($html, '>Visão<') !== false, 'Visão aparece');
afirmar(strpos($html, 'Nossos valores') !== false, 'Valores aparecem');
afirmar(
    strpos($html, htmlspecialchars($empresa['missao'], ENT_QUOTES, 'UTF-8')) !== false,
    'Texto da missão é exibido'
);
afirmar(
    strpos($html, htmlspecialchars($empresa['visao'], ENT_QUOTES, 'UTF-8')) !== false,
    'Texto da visão é exibido'
);

preg_match_all('/<li class="valor[^"]*"/', $html, $cards);
afirmar(count($cards[0]) === count($empresa['valores']), 'Todos os cards de valores são renderizados');

foreach ($empresa['valores'] as $valor) {
    afirmar(
        strpos($html, '>' . $valor['titulo'] . '<') !== false,
        'Card do valor "' . $valor['titulo'] . '" é exibido'
    );
}

afirmar(
    mb_strlen($empresa['missao'], 'UTF-8') <= 200 && mb_strlen($empresa['visao'], 'UTF-8') <= 200,
    'Missão e visão possuem textos enxutos'
);

// ---------------------------------------------------------------
// HU03 — Acessar canais de contato
// ---------------------------------------------------------------
grupo('HU03 — Fale Conosco');

afirmar(strpos($html, 'id="contato"') !== false, 'Seção Fale Conosco está presente');
afirmar(strpos($html, 'Fale Conosco') !== false, 'Título "Fale Conosco" aparece');
afirmar(strpos($html, '>WhatsApp<') !== false, 'Card de WhatsApp aparece');
afirmar(strpos($html, '>E-mail<') !== false, 'Card de e-mail aparece');
afirmar(strpos($html, '>Endereço<') !== false, 'Card de endereço aparece');
afirmar(
    strpos($html, htmlspecialchars($contato['email'], ENT_QUOTES, 'UTF-8')) !== false,
    'E-mail configurado é exibido'
);
afirmar(
    strpos($html, 'mailto:' . htmlspecialchars($contato['email'], ENT_QUOTES, 'UTF-8')) !== false,
    'E-mail possui link de ação'
);
afirmar(
    strpos($html, htmlspecialchars($contato['endereco'], ENT_QUOTES, 'UTF-8')) !== false,
    'Endereço configurado é exibido'
);
afirmar(strpos($html, 'Conversar no WhatsApp') !== false, 'Botão/link do WhatsApp está presente');

require_once $frontend . '/includes/helpers.php';

if (whatsapp_configurado($contato['whatsapp'])) {
    afirmar(strpos($html, 'https://wa.me/') !== false, 'Link do WhatsApp usa o número configurado');
} else {
    afirmar(
        strpos($html, 'Número a definir') !== false,
        'Sem número oficial, a página exibe o placeholder configurável'
    );
}

// ---------------------------------------------------------------
// Seção de acessos (base das HU04 e HU05)
// ---------------------------------------------------------------
grupo('Seção de acessos');

afirmar(strpos($html, 'class="acessos"') !== false, 'Seção de acessos está presente na página inicial');
afirmar(strpos($html, 'O que você deseja fazer?') !== false, 'Seção de acessos possui título orientativo');
afirmar(substr_count($html, 'class="acesso-card revelar"') === 2, 'Existem exatamente dois cards de acesso');
afirmar(strpos($css, '.acesso-card') !== false, 'Cards de acesso possuem estilo próprio no CSS existente');
afirmar(strpos($html, 'acesso-card__icone') === false, 'Cards de acesso não utilizam ícone');
afirmar(strpos($html, 'acesso-card__texto') === false, 'Cards de acesso não possuem texto descritivo');
afirmar(strpos($html, 'Inicie seu pedido') === false, 'Texto descritivo de Pedidos foi removido');
afirmar(strpos($html, 'Consulte a situação') === false, 'Texto descritivo de Acompanhamento foi removido');
afirmar(strpos($css, '.pagina-interna__cartao') !== false, 'Páginas internas possuem estilo de cartão informativo');
afirmar(
    (bool) preg_match('/@media \(min-width: 640px\)\s*\{\s*\.acessos\s*\{\s*grid-template-columns/u', $css),
    'Os acessos ficam lado a lado a partir de tablet'
);
afirmar(
    (bool) preg_match('/<section class="secao secao--acessos".*?<section class="secao secao--sobre"/su', $html),
    'A seção de acessos aparece antes da seção Sobre (área de destaque no topo)'
);

// ---------------------------------------------------------------
// HU04 — Acessar a página de pedidos a partir da página inicial
// ---------------------------------------------------------------
grupo('HU04 — Acesso à página de pedidos');

afirmar(is_file($frontend . '/pedidos.php'), 'Página de pedidos existe');
afirmar(
    (bool) preg_match('/<a[^>]+class="[^"]*\bbotao\b[^"]*"[^>]+href="pedidos\.php"/u', $html),
    'Botão de pedidos usa o padrão visual .botao já existente'
);
afirmar(
    (bool) preg_match('/<a[^>]+href="pedidos\.php"[^>]*>\s*Novo pedido/u', $html),
    'Botão de pedidos possui o texto "Novo pedido" (terminologia do RF005)'
);
afirmar(
    (bool) preg_match('/<main>.*href="pedidos\.php".*<\/main>/su', $html),
    'Botão de pedidos está visível no conteúdo principal da página inicial'
);

$htmlPedidos = renderizar($frontend . '/pedidos.php');

afirmar(stripos($htmlPedidos, '<!DOCTYPE html') === 0, 'Página de pedidos renderiza um documento HTML');
afirmar(strpos($htmlPedidos, 'Novo pedido') !== false, 'Página de pedidos identifica seu propósito');
afirmar(strpos($htmlPedidos, 'css/style.css') !== false, 'Página de pedidos reutiliza o CSS do projeto');
afirmar(strpos($htmlPedidos, 'href="index.php#inicio"') !== false, 'Página de pedidos permite retorno à página inicial');
afirmar(strpos($htmlPedidos, '<form') === false, 'Página de pedidos não antecipa o formulário de pedido');

// ---------------------------------------------------------------
// HU05 — Acessar o acompanhamento de pedido a partir da página inicial
// ---------------------------------------------------------------
grupo('HU05 — Acesso ao acompanhamento de pedido');

afirmar(is_file($frontend . '/acompanhamento.php'), 'Página de acompanhamento existe');
afirmar(
    (bool) preg_match('/<a[^>]+class="[^"]*\bbotao\b[^"]*"[^>]+href="acompanhamento\.php"/u', $html),
    'Botão de acompanhamento usa o padrão visual .botao já existente'
);
afirmar(
    (bool) preg_match('/<a[^>]+href="acompanhamento\.php"[^>]*>\s*Acompanhar pedido/u', $html),
    'Botão de acompanhamento possui o texto "Acompanhar pedido"'
);
afirmar(
    (bool) preg_match('/<main>.*href="acompanhamento\.php".*<\/main>/su', $html),
    'Botão de acompanhamento está visível no conteúdo principal da página inicial'
);

$htmlAcompanhamento = renderizar($frontend . '/acompanhamento.php');

afirmar(stripos($htmlAcompanhamento, '<!DOCTYPE html') === 0, 'Página de acompanhamento renderiza um documento HTML');
afirmar(strpos($htmlAcompanhamento, 'Acompanhar pedido') !== false, 'Página de acompanhamento identifica seu propósito');
afirmar(strpos($htmlAcompanhamento, 'css/style.css') !== false, 'Página de acompanhamento reutiliza o CSS do projeto');
afirmar(strpos($htmlAcompanhamento, 'href="index.php#inicio"') !== false, 'Página de acompanhamento permite retorno à página inicial');
afirmar(strpos($htmlAcompanhamento, '<form') === false, 'Página de acompanhamento não antecipa consulta real de status');

$emojisPaginas = '/[\x{1F000}-\x{1FAFF}\x{2600}-\x{27BF}\x{2B00}-\x{2BFF}\x{FE0F}]/u';

foreach (['pedidos.php', 'acompanhamento.php'] as $paginaInterna) {
    $htmlInterno = $paginaInterna === 'pedidos.php' ? $htmlPedidos : $htmlAcompanhamento;

    afirmar(
        strpos($htmlInterno, 'name="viewport"') !== false,
        'Página ' . $paginaInterna . ' declara meta viewport'
    );
    afirmar(
        strpos($htmlInterno, 'href="index.php#sobre"') !== false,
        'Menu continua funcional em ' . $paginaInterna . ' (âncoras apontam para a página inicial)'
    );
    afirmar(
        substr_count($htmlInterno, 'href="index.php#') >= 2 * count($empresa['menu']),
        'Cabeçalho e rodapé de ' . $paginaInterna . ' prefixam todas as âncoras do menu'
    );

    foreach (['#sobre', '#valores', '#contato'] as $ancoraOrfa) {
        afirmar(
            strpos($htmlInterno, 'href="' . $ancoraOrfa . '"') === false,
            'Página ' . $paginaInterna . ' não possui âncora órfã ' . $ancoraOrfa
        );
    }
    afirmar(
        !preg_match($emojisPaginas, $htmlInterno),
        'Página ' . $paginaInterna . ' não utiliza emojis'
    );
    afirmar(
        strpos($htmlInterno, 'pagina-interna__cartao') !== false,
        'Página ' . $paginaInterna . ' apresenta o cartão de orientação'
    );
    afirmar(
        substr_count($htmlInterno, 'class="pagina-interna__item"') >= 2,
        'Cartão de ' . $paginaInterna . ' lista os dados necessários'
    );
}

// ---------------------------------------------------------------
// Página única, responsividade e acessibilidade
// ---------------------------------------------------------------
grupo('Página única e navegação interna');

foreach (['#inicio', '#sobre', '#valores', '#contato'] as $ancora) {
    afirmar(strpos($html, 'href="' . $ancora . '"') !== false, 'Menu usa a âncora interna ' . $ancora);
}

afirmar(
    !preg_match('/href="\/?(sobre|missao|visao|valores|contato)(\.php)?"/i', $html),
    'Não existem páginas ou rotas separadas para as seções'
);
afirmar(strpos($css, 'scroll-behavior: smooth') !== false, 'Scroll suave está configurado');

grupo('Layout global (header + main + footer)');

afirmar(
    (bool) preg_match('/body \{[^}]*flex-direction: column;/s', $css),
    'O documento usa Flexbox em coluna para header, main e footer'
);
afirmar(
    (bool) preg_match('/body \{[^}]*min-height: 100vh;/s', $css),
    'A página ocupa no mínimo a altura da viewport'
);
afirmar(
    (bool) preg_match('/main \{\s*flex: 1 0 auto;\s*\}/s', $css),
    'O conteúdo principal cresce e mantém o rodapé no final da tela'
);
afirmar(
    strpos($css, 'position: fixed') === false,
    'O rodapé não é posicionado com position: fixed'
);
afirmar(
    (bool) preg_match('/\.rodape \{[^}]*background-color: var\(--cor-roxo-escuro\);/s', $css),
    'O design do rodapé permanece inalterado'
);

grupo('Responsividade');

afirmar(strpos($html, 'name="viewport"') !== false, 'Meta viewport está presente');
afirmar(substr_count($css, '@media') >= 4, 'Existem breakpoints para celular, tablet e desktop');
afirmar(strpos($css, 'grid-template-columns') !== false, 'CSS Grid é utilizado no layout');
afirmar(strpos($css, 'flex-wrap') !== false, 'Flexbox é utilizado no layout');
afirmar(strpos($css, 'overflow-x: hidden') !== false, 'Prevenção de scroll horizontal está aplicada');
afirmar(strpos($css, 'max-width: var(--largura-maxima)') !== false, 'Largura máxima do conteúdo definida');

grupo('Acessibilidade');

afirmar(strpos($html, 'lang="pt-BR"') !== false, 'Idioma da página está declarado');
afirmar(strpos($html, 'pular-conteudo') !== false, 'Link para pular ao conteúdo principal está presente');
afirmar(strpos($html, '<main>') !== false, 'Estrutura semântica utiliza main');
afirmar(strpos($html, 'aria-label="Navegação principal"') !== false, 'Navegação possui rótulo acessível');
afirmar(strpos($html, 'aria-expanded') !== false, 'Botão do menu informa seu estado');
afirmar(
    substr_count($html, 'role="img"') === substr_count($html, 'aria-label="Ilustração'),
    'Ilustrações possuem descrição textual'
);
afirmar(strpos($css, ':focus-visible') !== false, 'Foco visível está estilizado');
afirmar(strpos($css, 'prefers-reduced-motion') !== false, 'Preferência por menos movimento é respeitada');

grupo('Escopo da Sprint 1');

$emojis = '/[\x{1F000}-\x{1FAFF}\x{2600}-\x{27BF}\x{2B00}-\x{2BFF}\x{FE0F}]/u';
afirmar(!preg_match($emojis, $html), 'Nenhum emoji é utilizado na interface');

$frameworks = ['react', 'vue.js', 'angular', 'bootstrap', 'tailwind', 'jquery', 'laravel', 'symfony'];
$htmlMinusculo = mb_strtolower($html, 'UTF-8');
foreach ($frameworks as $framework) {
    afirmar(strpos($htmlMinusculo, $framework) === false, 'Nenhum uso de ' . $framework);
}

afirmar(strpos($html, '<form') === false, 'Nenhum formulário de cadastro/pedido foi implementado');
foreach (['login', 'carrinho', 'checkout', 'orçamento'] as $termo) {
    afirmar(
        mb_strpos($htmlMinusculo, mb_strtolower($termo, 'UTF-8')) === false,
        'Funcionalidade fora do escopo ausente: ' . $termo
    );
}

afirmar(
    trim((string) $contato['whatsapp']['numero']) === ''
        || preg_match('/^\d{10,15}$/', preg_replace('/\D/', '', (string) $contato['whatsapp']['numero'])) === 1,
    'Número de WhatsApp permanece configurável (sem dado fictício)'
);

// ---------------------------------------------------------------
// Resultado
// ---------------------------------------------------------------
echo PHP_EOL . str_repeat('-', 52) . PHP_EOL;
echo 'Total de verificações: ' . $total . PHP_EOL;
echo 'Falhas: ' . $falhas . PHP_EOL;
echo str_repeat('-', 52) . PHP_EOL;

exit($falhas === 0 ? 0 : 1);