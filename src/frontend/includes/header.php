<?php

declare(strict_types=1);

// As âncoras do menu apontam para as seções da página inicial. Páginas internas
// (pedidos, acompanhamento) definem $ancoraBase = 'index.php' antes deste include
// para que os mesmos links continuem funcionando fora da página inicial.
$ancoraBase = isset($ancoraBase) ? (string) $ancoraBase : '';

?>
<a class="pular-conteudo" href="#inicio">Ir para o conteúdo principal</a>

<header class="cabecalho" id="cabecalho">
    <div class="container cabecalho__interno">
        <a class="marca" href="<?= e($ancoraBase . '#inicio') ?>">
            <span class="marca__simbolo"><?= icone('marca', 'icone marca__icone') ?></span>
            <span class="marca__texto">
                <strong class="marca__nome"><?= e($empresa['nome']) ?></strong>
                <span class="marca__slogan"><?= e($empresa['slogan']) ?></span>
            </span>
        </a>

        <button class="menu-botao" type="button" id="menu-botao"
                aria-expanded="false" aria-controls="menu-principal">
            <span class="menu-botao__abrir"><?= icone('menu', 'icone') ?></span>
            <span class="menu-botao__fechar"><?= icone('fechar', 'icone') ?></span>
            <span class="menu-botao__rotulo">Menu</span>
        </button>

        <nav class="navegacao" id="menu-principal" aria-label="Navegação principal">
            <ul class="navegacao__lista">
                <?php foreach ($empresa['menu'] as $item): ?>
                    <li class="navegacao__item">
                        <a class="navegacao__link" href="<?= e($ancoraBase . $item['ancora']) ?>">
                            <?= e($item['rotulo']) ?>
                        </a>
                    </li>
                <?php endforeach; ?>
            </ul>
        </nav>
    </div>
</header>