<?php

declare(strict_types=1);

require_once __DIR__ . '/includes/helpers.php';
require_once __DIR__ . '/includes/icons.php';

$empresa  = require __DIR__ . '/includes/company.php';
$contato  = $empresa['contato'];
$whatsapp = $contato['whatsapp'];
$waLink   = whatsapp_link($whatsapp);

// Prefixo usado pelo cabeçalho para que as âncoras da página inicial continuem válidas.
$ancoraBase = 'index.php';

?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Acompanhar pedido | <?= e($empresa['nome']) ?></title>
    <meta name="description" content="Ponto de acesso ao acompanhamento da situação de pedidos da <?= e($empresa['nome']) ?>.">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="stylesheet"
          href="https://fonts.googleapis.com/css2?family=Fraunces:opsz,wght@9..144,500;9..144,600&family=Manrope:wght@400;500;600;700&display=swap">
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

<?php require __DIR__ . '/includes/header.php'; ?>

<main>

    <section class="pagina-interna" id="inicio">
        <div class="container">
            <p class="etiqueta">Acompanhamento</p>
            <h1 class="pagina-interna__titulo">Acompanhar pedido</h1>
            <p class="pagina-interna__texto">
                A consulta da situação do pedido será liberada em uma próxima sprint do sistema.
                Até lá, nossa equipe informa o andamento da produção pelos canais de atendimento.
            </p>

            <div class="pagina-interna__cartao">
                <h2 class="pagina-interna__cartao-titulo">O que ter em mãos</h2>
                <ul class="pagina-interna__itens">
                    <li class="pagina-interna__item">Número do pedido informado na confirmação.</li>
                    <li class="pagina-interna__item">Nome do cliente ou do evento vinculado.</li>
                </ul>
            </div>

            <div class="pagina-interna__acoes">
                <?php if ($waLink !== ''): ?>
                    <a class="botao botao--principal" href="<?= e($waLink) ?>" target="_blank" rel="noopener">
                        Conversar no WhatsApp
                    </a>
                <?php else: ?>
                    <a class="botao botao--principal" href="mailto:<?= e($contato['email']) ?>">
                        Enviar e-mail
                    </a>
                <?php endif; ?>

                <a class="botao botao--contorno" href="index.php#inicio">
                    Voltar à página inicial
                </a>
            </div>
        </div>
    </section>

</main>

<?php require __DIR__ . '/includes/footer.php'; ?>

<script src="js/script.js" defer></script>
</body>
</html>