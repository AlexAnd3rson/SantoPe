<?php

declare(strict_types=1);

// Mesmo contrato do cabeçalho: páginas internas definem $ancoraBase = 'index.php'
// para que as âncoras das seções institucionais continuem resolvendo.
$ancoraBase = isset($ancoraBase) ? (string) $ancoraBase : '';

?>
<footer class="rodape">
    <div class="container rodape__interno">
        <div class="rodape__marca">
            <span class="rodape__simbolo"><?= icone('marca', 'icone') ?></span>
            <div>
                <p class="rodape__nome"><?= e($empresa['nome']) ?></p>
                <p class="rodape__sistema"><?= e($empresa['sistema']) ?></p>
            </div>
        </div>

        <nav class="rodape__navegacao" aria-label="Navegação do rodapé">
            <ul class="rodape__lista">
                <?php foreach ($empresa['menu'] as $item): ?>
                    <li>
                        <a class="rodape__link" href="<?= e($ancoraBase . $item['ancora']) ?>">
                            <?= e($item['rotulo']) ?>
                        </a>
                    </li>
                <?php endforeach; ?>
            </ul>
        </nav>
    </div>

    <div class="container">
        <p class="rodape__copyright">
            &copy; <?= date('Y') ?> <?= e($empresa['nome']) ?>. Todos os direitos reservados.
        </p>
    </div>
</footer>