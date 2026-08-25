<?php

declare(strict_types=1);

require_once __DIR__ . '/includes/helpers.php';
require_once __DIR__ . '/includes/icons.php';

$empresa  = require __DIR__ . '/includes/company.php';
$contato  = $empresa['contato'];
$whatsapp = $contato['whatsapp'];
$waLink   = whatsapp_link($whatsapp);

?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= e($empresa['nome']) ?> | <?= e($empresa['slogan']) ?></title>
    <meta name="description" content="<?= e($empresa['sobre']) ?>">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="stylesheet"
          href="https://fonts.googleapis.com/css2?family=Fraunces:opsz,wght@9..144,500;9..144,600&family=Manrope:wght@400;500;600;700&display=swap">
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

<?php require __DIR__ . '/includes/header.php'; ?>

<main>

    <!-- HERO -->
    <section class="hero" id="inicio">
        <div class="container hero__interno">
            <div class="hero__conteudo revelar">
                <p class="etiqueta">Produção sob encomenda</p>
                <h1 class="hero__titulo"><?= e($empresa['hero']['titulo']) ?></h1>
                <p class="hero__subtitulo"><?= e($empresa['hero']['subtitulo']) ?></p>
                <a class="botao botao--principal" href="#sobre">
                    <?= e($empresa['hero']['botao']) ?>
                    <?= icone('seta', 'icone botao__icone') ?>
                </a>
            </div>
            <div class="hero__ilustracao revelar">
                <?= ilustracao_chinelos() ?>
            </div>
        </div>
    </section>

    <!-- ACESSOS RÁPIDOS (HU04 e HU05) -->
    <section class="secao secao--acessos" aria-labelledby="titulo-acessos">
        <div class="container">
            <div class="secao__cabecalho">
                <p class="etiqueta">Acessos</p>
                <h2 class="secao__titulo" id="titulo-acessos">O que você deseja fazer?</h2>
            </div>

            <div class="acessos">

                <article class="acesso-card revelar">
                    <h3 class="acesso-card__titulo">Pedidos</h3>
                    <a class="botao botao--principal acesso-card__acao" href="pedidos.php">
                        Novo pedido
                        <?= icone('seta', 'icone botao__icone') ?>
                    </a>
                </article>

                <article class="acesso-card revelar">
                    <h3 class="acesso-card__titulo">Acompanhamento</h3>
                    <a class="botao botao--contorno acesso-card__acao" href="acompanhamento.php">
                        Acompanhar pedido
                        <?= icone('seta', 'icone botao__icone') ?>
                    </a>
                </article>

            </div>
        </div>
    </section>

    <!-- SOBRE A EMPRESA -->
    <section class="secao secao--sobre" id="sobre">
        <div class="container sobre__interno">
            <div class="sobre__texto revelar">
                <p class="etiqueta">Sobre nós</p>
                <h2 class="secao__titulo">Sobre a empresa</h2>
                <p class="sobre__descricao"><?= e($empresa['sobre']) ?></p>
            </div>
            <div class="sobre__ilustracao revelar">
                <?= ilustracao_personalizacao() ?>
            </div>
        </div>
    </section>

    <!-- MISSÃO, VISÃO E VALORES -->
    <section class="secao secao--essencia" id="valores">
        <div class="container">
            <div class="secao__cabecalho">
                <p class="etiqueta">Missão, visão e valores</p>
                <h2 class="secao__titulo">Nossa essência</h2>
            </div>

            <div class="essencia">
                <article class="essencia__bloco revelar">
                    <h3 class="essencia__titulo">Missão</h3>
                    <p class="essencia__texto"><?= e($empresa['missao']) ?></p>
                </article>
                <article class="essencia__bloco revelar">
                    <h3 class="essencia__titulo">Visão</h3>
                    <p class="essencia__texto"><?= e($empresa['visao']) ?></p>
                </article>
            </div>

            <h3 class="subtitulo-valores" id="titulo-valores">Nossos valores</h3>
            <ul class="valores" aria-labelledby="titulo-valores">
                <?php foreach ($empresa['valores'] as $valor): ?>
                    <li class="valor revelar">
                        <span class="valor__icone"><?= icone($valor['icone'], 'icone') ?></span>
                        <h4 class="valor__titulo"><?= e($valor['titulo']) ?></h4>
                        <p class="valor__descricao"><?= e($valor['descricao']) ?></p>
                    </li>
                <?php endforeach; ?>
            </ul>
        </div>
    </section>

    <!-- FALE CONOSCO -->
    <section class="secao secao--contato" id="contato">
        <div class="container">
            <div class="secao__cabecalho">
                <p class="etiqueta">Contato</p>
                <h2 class="secao__titulo">Fale Conosco</h2>
                <p class="secao__chamada"><?= e($contato['chamada']) ?></p>
            </div>

            <div class="contatos">

                <article class="contato-card revelar">
                    <span class="contato-card__icone"><?= icone('whatsapp', 'icone') ?></span>
                    <h3 class="contato-card__titulo">WhatsApp</h3>
                    <p class="contato-card__texto">Fale conosco pelo WhatsApp.</p>
                    <p class="contato-card__dado"><?= e(whatsapp_exibicao($whatsapp)) ?></p>

                    <?php if ($waLink !== ''): ?>
                        <a class="botao botao--principal contato-card__acao"
                           href="<?= e($waLink) ?>" target="_blank" rel="noopener">
                            Conversar no WhatsApp
                        </a>
                    <?php else: ?>
                        <p class="contato-card__aviso" id="whatsapp-aviso">
                            O número oficial será disponibilizado em breve.
                        </p>
                        <button class="botao botao--principal contato-card__acao" type="button"
                                disabled aria-describedby="whatsapp-aviso">
                            Conversar no WhatsApp
                        </button>
                    <?php endif; ?>
                </article>

                <article class="contato-card revelar">
                    <span class="contato-card__icone"><?= icone('email', 'icone') ?></span>
                    <h3 class="contato-card__titulo">E-mail</h3>
                    <p class="contato-card__texto">Entre em contato por e-mail.</p>
                    <p class="contato-card__dado"><?= e($contato['email']) ?></p>
                    <a class="botao botao--contorno contato-card__acao"
                       href="mailto:<?= e($contato['email']) ?>">
                        Enviar e-mail
                    </a>
                </article>

                <article class="contato-card revelar">
                    <span class="contato-card__icone"><?= icone('endereco', 'icone') ?></span>
                    <h3 class="contato-card__titulo">Endereço</h3>
                    <p class="contato-card__texto">Endereço da fábrica</p>
                    <p class="contato-card__dado"><?= e($contato['endereco']) ?></p>
                </article>

            </div>
        </div>
    </section>

</main>

<?php require __DIR__ . '/includes/footer.php'; ?>

<script src="js/script.js" defer></script>
</body>
</html>