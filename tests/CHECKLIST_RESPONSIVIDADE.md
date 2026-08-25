# Checklist de testes manuais — Sprint 1

Os testes automatizados (`php tests/sprint1_test.php`) verificam conteúdo, estrutura e
escopo. A verificação visual abaixo deve ser feita no navegador, usando as ferramentas
de desenvolvedor (modo dispositivo).

## Larguras de referência

| Dispositivo | Largura | Comportamento esperado |
|---|---|---|
| Celular pequeno | 320 px | Uma coluna, menu recolhido, cards empilhados, botões em largura total |
| Celular | 390 px | Uma coluna, ilustração abaixo do texto do hero |
| Tablet retrato | 768 px | Missão e visão lado a lado, cards de contato em duas colunas |
| Tablet paisagem | 1024 px | Menu horizontal, hero em duas colunas, três cards de valores por linha |
| Notebook | 1366 px | Conteúdo centralizado com largura máxima |
| Desktop grande | 1920 px | Sem textos espalhados; largura máxima preservada |

## Verificar em cada largura

- [ ] Não há scroll horizontal.
- [ ] Nenhum elemento cortado ou fora da tela.
- [ ] Textos não se sobrepõem e permanecem legíveis.
- [ ] Botões continuam clicáveis e com área adequada para toque.
- [ ] Ilustrações não ficam deformadas.
- [ ] Espaçamentos entre seções permanecem equilibrados.

## Navegação

- [ ] Cada item do menu leva à seção correspondente na mesma página.
- [ ] O deslocamento acontece com scroll suave.
- [ ] Nenhum link abre outra página.
- [ ] O botão "Conheça nossa empresa" leva à seção Sobre a empresa.
- [ ] No celular, o menu abre e fecha pelo botão e fecha ao escolher um item.

## Acessibilidade

- [ ] Navegação completa pelo teclado (Tab / Shift+Tab / Enter).
- [ ] Foco sempre visível.
- [ ] O link "Ir para o conteúdo principal" aparece ao primeiro Tab.
- [ ] Contraste adequado entre texto e fundo.
- [ ] Ilustrações possuem descrição textual.
- [ ] Com `prefers-reduced-motion` ativo, as animações não ocorrem.