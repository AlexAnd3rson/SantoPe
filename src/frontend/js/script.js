/* =========================================================
   SGI-Chinelos — Interações da interface (Sprint 1)
   JavaScript puro, usado apenas para comportamento de tela:
   menu responsivo, scroll suave, destaque do link ativo e
   revelação suave das seções.
   ========================================================= */

(function () {
    'use strict';

    document.documentElement.classList.add('js');

    var cabecalho = document.getElementById('cabecalho');
    var botaoMenu = document.getElementById('menu-botao');
    var menu = document.getElementById('menu-principal');
    var links = Array.prototype.slice.call(
        document.querySelectorAll('.navegacao__link, .rodape__link, a[href^="#"]')
    );
    var secoes = Array.prototype.slice.call(document.querySelectorAll('main section[id]'));
    var menosMovimento = window.matchMedia('(prefers-reduced-motion: reduce)').matches;

    /* ---------- Menu responsivo ---------- */
    function fecharMenu() {
        if (!menu || !botaoMenu) {
            return;
        }
        menu.classList.remove('navegacao--aberta');
        botaoMenu.setAttribute('aria-expanded', 'false');
    }

    function alternarMenu() {
        if (!menu || !botaoMenu) {
            return;
        }
        var aberto = menu.classList.toggle('navegacao--aberta');
        botaoMenu.setAttribute('aria-expanded', aberto ? 'true' : 'false');
    }

    if (botaoMenu) {
        botaoMenu.addEventListener('click', alternarMenu);
    }

    document.addEventListener('keydown', function (evento) {
        if (evento.key === 'Escape') {
            fecharMenu();
        }
    });

    window.addEventListener('resize', function () {
        if (window.innerWidth >= 860) {
            fecharMenu();
        }
    });

    /* ---------- Scroll suave por âncoras internas ---------- */
    links.forEach(function (link) {
        var destino = link.getAttribute('href');

        if (!destino || destino.charAt(0) !== '#' || destino.length < 2) {
            return;
        }

        link.addEventListener('click', function (evento) {
            var alvo = document.querySelector(destino);

            if (!alvo) {
                return;
            }

            evento.preventDefault();
            fecharMenu();

            alvo.scrollIntoView({
                behavior: menosMovimento ? 'auto' : 'smooth',
                block: 'start'
            });

            // Mantém o foco do teclado na seção de destino.
            alvo.setAttribute('tabindex', '-1');
            alvo.focus({ preventScroll: true });

            if (history.replaceState) {
                history.replaceState(null, '', destino);
            }
        });
    });

    /* ---------- Sombra do cabeçalho ao rolar ---------- */
    function atualizarCabecalho() {
        if (!cabecalho) {
            return;
        }
        cabecalho.classList.toggle('cabecalho--rolando', window.scrollY > 8);
    }

    atualizarCabecalho();
    window.addEventListener('scroll', atualizarCabecalho, { passive: true });

    /* ---------- Destaque do link da seção visível ---------- */
    function destacarLink(id) {
        document.querySelectorAll('.navegacao__link').forEach(function (link) {
            var ativo = link.getAttribute('href') === '#' + id;
            link.classList.toggle('navegacao__link--ativo', ativo);
        });
    }

    if ('IntersectionObserver' in window && secoes.length) {
        var observadorSecoes = new IntersectionObserver(function (entradas) {
            entradas.forEach(function (entrada) {
                if (entrada.isIntersecting) {
                    destacarLink(entrada.target.id);
                }
            });
        }, { rootMargin: '-45% 0px -50% 0px' });

        secoes.forEach(function (secao) {
            observadorSecoes.observe(secao);
        });
    }

    /* ---------- Revelação suave dos blocos ---------- */
    var blocos = Array.prototype.slice.call(document.querySelectorAll('.revelar'));

    if (!blocos.length) {
        return;
    }

    if (menosMovimento || !('IntersectionObserver' in window)) {
        blocos.forEach(function (bloco) {
            bloco.classList.add('visivel');
        });
        return;
    }

    var observadorBlocos = new IntersectionObserver(function (entradas, observador) {
        entradas.forEach(function (entrada) {
            if (entrada.isIntersecting) {
                entrada.target.classList.add('visivel');
                observador.unobserve(entrada.target);
            }
        });
    }, { threshold: 0.12 });

    blocos.forEach(function (bloco) {
        observadorBlocos.observe(bloco);
    });
})();