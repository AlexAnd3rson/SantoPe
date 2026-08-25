<?php

declare(strict_types=1);

/** Dados da empresa */

return [
    'nome'      => 'Folgados-Pés',
    'slogan'    => 'Chinelos Personalizados',
    'sistema'   => 'Sistema de Gestão Integrada para Fábrica de Chinelos Personalizados',

    'hero' => [
        'titulo'    => 'Personalizando momentos que ficam para sempre.',
        'subtitulo' => 'Chinelos personalizados para tornar seus eventos ainda mais especiais.',
        'botao'     => 'Conheça nossa empresa',
    ],

    'sobre' => 'Somos uma fábrica de chinelos personalizados para eventos e ocasiões '
        . 'especiais. Produzimos sob encomenda, oferecendo personalização de artes, '
        . 'cores, tiras e embalagens para transformar cada pedido em uma lembrança única.',

    'missao' => 'Oferecer chinelos personalizados com qualidade e criatividade, '
        . 'transformando momentos especiais em produtos únicos.',

    'visao' => 'Ser referência em qualidade e personalização na produção de chinelos '
        . 'para eventos e celebrações.',

    'valores' => [
        [
            'icone'     => 'qualidade',
            'titulo'    => 'Qualidade',
            'descricao' => 'Cuidado em cada etapa da produção.',
        ],
        [
            'icone'     => 'personalizacao',
            'titulo'    => 'Personalização',
            'descricao' => 'Produtos pensados para cada ocasião.',
        ],
        [
            'icone'     => 'criatividade',
            'titulo'    => 'Criatividade',
            'descricao' => 'Soluções que tornam cada pedido único.',
        ],
        [
            'icone'     => 'compromisso',
            'titulo'    => 'Compromisso',
            'descricao' => 'Atenção às necessidades de cada cliente.',
        ],
        [
            'icone'     => 'organizacao',
            'titulo'    => 'Organização',
            'descricao' => 'Processos padronizados e eficientes.',
        ],
    ],

    'contato' => [
        'chamada' => 'Tem alguma dúvida ou deseja conhecer nossas opções? '
            . 'Entre em contato conosco.',

        
        'whatsapp' => [
            'numero'   => '6182883744',
            'exibicao' => 'Estamos prontos para atender você.',
            'mensagem' => 'Olá! Gostaria de saber mais sobre os chinelos personalizados.',
        ],

     
        'email' => 'folgados.pes@gmail.com',

        'endereco' => 'CSB 3 lote 8 galeria ave branca lojas 7/8 Taguatinga sul',
    ],

    'menu' => [
        ['rotulo' => 'Início',                  'ancora' => '#inicio'],
        ['rotulo' => 'Sobre nós',               'ancora' => '#sobre'],
        ['rotulo' => 'Missão, Visão e Valores', 'ancora' => '#valores'],
        ['rotulo' => 'Fale Conosco',            'ancora' => '#contato'],
    ],
];