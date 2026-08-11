Especificação de Requisitos de Software (ERS / DRS)
Sistema de Gestão Integrada para Fábrica de Chinelos Personalizados
	
Sistema	SGI-Chinelos
Versão do documento	1.0
Situação	Aguardando validação dos stakeholders
Base de origem	Documento de Projeto de Software (ABNT – Técnico)
Sumário
Visão Geral e Introdução
Descrição Geral do Sistema
Requisitos Funcionais (RF)
Regras de Negócio (RN)
Requisitos Não Funcionais (RNF)
Requisitos de Interface Externa
Anexos e Rastreabilidade
1. Visão Geral e Introdução
1.1 Propósito

Este documento especifica, de forma completa e verificável, os requisitos funcionais, não funcionais e as regras de negócio do Sistema de Gestão Integrada para Fábrica de Chinelos Personalizados (SGI-Chinelos). Seu propósito é servir de referência única e contratual entre a área de negócio e a equipe técnica, orientando as atividades de análise, projeto, desenvolvimento, teste e homologação.

O software tem por finalidade informatizar e padronizar os processos operacionais da fábrica, cobrindo o ciclo completo que vai do atendimento ao cliente até a entrega do produto final. O valor de negócio entregue compreende:

Redução de falhas humanas: eliminação de cálculos manuais de insumos e de anotações informais de pedidos personalizados.
Automação do cálculo de insumos: determinação automática de placas, metragem de tecido e papel sublimático a partir dos parâmetros do pedido.
Controle de disponibilidade de materiais: bloqueio da liberação de pedidos sem lastro de estoque, evitando paradas de produção.
Padronização dos pedidos personalizados: registro estruturado de qualidade, numeração, tiras, arte, adicionais e embalagem.
Rastreabilidade e acompanhamento: visibilidade do status produtivo de cada pedido e histórico de todas as alterações.
1.2 Escopo do Projeto
Dentro do Escopo (o que o sistema FARÁ)
Módulo de Clientes: cadastro completo com dados pessoais/comerciais e informações do evento associado ao pedido.
Módulo de Pedidos: registro detalhado do pedido, contemplando quantidade de pares, qualidade do produto (50/50 ou 70/30), distribuição por gênero e numeração, definição de tiras, seleção de arte, adicionais e tipo de embalagem.
Módulo de Cálculo de Insumos: apuração automática de placas, metragem de tecido, papel sublimático e demais materiais, conforme as regras de negócio da Seção 4.
Módulo de Estoque: cadastro de materiais, entradas, saídas, reserva, baixa automática e validação de disponibilidade antes da liberação do pedido.
Módulo de Produção: liberação de pedidos aprovados, controle e acompanhamento de status produtivo até a finalização.
Módulo de Expedição: registro da finalização e do encaminhamento do pedido para entrega.
Módulo de Segurança e Administração: autenticação, autorização por papéis (RBAC), parametrização de regras e registro de histórico de alterações (auditoria).
Módulo de Relatórios Operacionais: consumo de insumos, pedidos por período, posição de estoque e produção em andamento.
Fora do Escopo (o que o sistema NÃO FARÁ)
Emissão de documentos fiscais (NF-e, NFS-e), apuração de impostos e integração com SEFAZ.
Funcionalidades financeiras avançadas: contas a pagar/receber, conciliação bancária, fluxo de caixa e DRE.
Processamento de pagamentos online (gateway de cartão, PIX, boleto) e cobrança automatizada.
Loja virtual (e-commerce) com autoatendimento do cliente final para montagem e compra do produto.
Folha de pagamento, ponto eletrônico e gestão de recursos humanos.
Roteirização logística, cálculo de frete e rastreamento junto a transportadoras.
Automação industrial ou comunicação direta com máquinas (CLP/IoT) do parque fabril.
1.3 Público-Alvo e Leitura Sugerida
Perfil de leitor	Como utilizar este documento	Seções prioritárias
Desenvolvedores e Arquitetos	Base para a implementação técnico-estrutural, modelagem do banco de dados e definição da arquitetura.	2.3, 3, 4, 5, 6, 7.2
Testadores / QA	Base para elaboração de planos, cenários e casos de teste, com ênfase nos cálculos de insumo e na validação de estoque.	3, 4, 5, 7.1
Gerentes de Projeto	Referência para planejamento, estimativas, priorização e controle de entregas e de escopo.	1.2, 2.4, 2.5, 3
Stakeholders / Cliente (Fábrica)	Validação das regras operacionais, dos perfis de acesso e das expectativas de negócio.	1.1, 1.2, 2.2, 4
Equipe de Produção e Estoque	Conferência da aderência do fluxo do sistema à rotina real de chão de fábrica.	2.2, 3, 4, 7.2
1.4 Glossário e Abreviações
Termo / Sigla	Definição
DRS / SRS	Documento / Especificação de Requisitos de Software (Software Requirements Specification).
SGI-Chinelos	Nome do sistema objeto desta especificação: Sistema de Gestão Integrada para Fábrica de Chinelos Personalizados.
Par	Unidade de venda do produto, composta por dois chinelos (pé direito e pé esquerdo) de mesma numeração.
Placa	Chapa de matéria-prima (EVA/borracha) a partir da qual os solados são cortados. A quantidade de pares obtidos por placa varia conforme a qualidade do produto.
Qualidade Normal (50/50)	Classificação de produto de padrão convencional; rende 32 pares por placa e consome 1,5 metro de tecido.
Qualidade Premium (70/30)	Classificação de produto de padrão superior; rende 21 pares por placa e consome 1 metro de tecido.
Tira	Componente superior do chinelo que prende o pé ao solado; possui cor, material e modelo definidos no pedido.
Arte	Imagem, layout ou personalização gráfica aplicada ao solado e/ou às tiras, geralmente vinculada ao evento do cliente.
Sublimação	Processo de transferência da arte para o material por ação de calor e pressão, a partir de papel sublimático impresso.
Papel sublimático	Insumo de impressão utilizado na sublimação; consumido à razão de 1,5 unidade por par.
Adicional	Item complementar opcional agregado ao pedido (ex.: tag personalizada, laço, chaveiro, aplique).
Embalagem	Material de acondicionamento do produto final, definido em função da quantidade total de pares do pedido.
Insumo	Todo material consumido na produção: placa, tecido, papel sublimático, tira, adicional e embalagem.
Evento	Ocasião a que se destina o pedido personalizado (ex.: casamento, formatura, aniversário), com data e características próprias.
RBAC	Controle de Acesso Baseado em Papéis (Role-Based Access Control).
CRUD	Operações de Criação, Leitura, Atualização e Exclusão de dados (Create, Read, Update, Delete).
MFA	Autenticação Multifator (Multi-Factor Authentication).
API	Interface de Programação de Aplicações (Application Programming Interface).
LGPD	Lei Geral de Proteção de Dados Pessoais (Lei nº 13.709/2018).
SLA	Acordo de Nível de Serviço (Service Level Agreement).
DER	Diagrama de Entidade-Relacionamento.
BPMN	Business Process Model and Notation — notação para modelagem de processos de negócio.
RF / RN / RNF	Requisito Funcional / Regra de Negócio / Requisito Não Funcional.
2. Descrição Geral do Sistema
2.1 Perspectiva do Produto

O SGI-Chinelos é uma aplicação corporativa nova, integrada a um banco de dados relacional, concebida para operar de forma centralizada e substituir os controles manuais e planilhas eletrônicas hoje utilizados na fábrica. Não se trata de um módulo complementar a um ERP existente, mas de um produto independente e autocontido no domínio operacional.

Posicionamento no ecossistema da empresa:

Sistema independente: concentra clientes, pedidos, insumos, estoque e produção em uma única base de dados, garantindo integridade referencial e fonte única da verdade.
Substituição de controles legados: substitui as planilhas de pedidos, os cadernos de anotação de numeração e os cálculos manuais de consumo de material.
Fronteira com sistemas de terceiros: a emissão fiscal e a gestão financeira permanecem em ferramentas externas; o sistema apenas disponibiliza a exportação de dados de pedidos para alimentá-las, sem integração automatizada na versão 1.0.

O sistema opera com acesso controlado por perfis de usuário, de modo que cada área (comercial, produção e estoque) atue exclusivamente sobre as informações de sua competência, sobre a mesma base compartilhada.

2.2 Perfis de Usuários e Permissões (Personas / Papéis)

O sistema implementa controle de acesso baseado em papéis (RBAC). Todo usuário deve estar vinculado a, no mínimo, um perfil, e o perfil determina de forma restritiva as funcionalidades acessíveis.

Papel / Perfil	Descrição	Nível de Acesso
Administrador	Gestor total do sistema; responsável pela configuração geral e pela parametrização das regras de negócio.	Acesso irrestrito a todas as funcionalidades. Exclusivo para: gestão de usuários e perfis, parametrização de regras de cálculo (pares por placa, metragem, consumo de papel), faixas de embalagem, cadastro de materiais e consulta integral do log de auditoria.
Comercial / Atendimento	Responsável pelo relacionamento com o cliente, pelo cadastro e pelo detalhamento técnico do pedido.	CRUD de clientes e eventos; criação e edição de pedidos até a liberação para produção; seleção de arte, adicionais e embalagem; consulta ao status produtivo e à disponibilidade de insumos (somente leitura sobre o estoque).
Produção	Responsável pela execução e pelo acompanhamento dos pedidos liberados no chão de fábrica.	Leitura de pedidos liberados e de suas fichas técnicas; atualização do status produtivo; registro de finalização e de eventuais perdas/refugos. Não cria nem edita pedidos, clientes ou preços.
Estoque	Responsável pela gestão de insumos, materiais e embalagens.	CRUD de movimentações de estoque (entradas, saídas e ajustes); consulta a materiais e a reservas vinculadas a pedidos; emissão de relatórios de posição e de consumo. Sem acesso à edição de pedidos.

Observação: o cliente final não é usuário do sistema na versão 1.0; sua interação ocorre por intermédio do perfil Comercial/Atendimento.

2.3 Ambiente Operacional
Plataformas: aplicação Web responsiva, executada nos navegadores Google Chrome, Mozilla Firefox, Microsoft Edge e Safari (duas últimas versões estáveis). O acesso por tablets é previsto para o chão de fábrica (consulta de ficha técnica e atualização de status); não há aplicativo nativo iOS/Android na versão 1.0.
Infraestrutura: hospedagem em nuvem (AWS, GCP ou Azure) em modelo IaaS/PaaS, com servidor de aplicação e servidor de banco de dados relacional (PostgreSQL ou MySQL) segregados. Alternativa on-premises admitida caso a conectividade da fábrica se mostre instável, mantendo-se a mesma arquitetura lógica.
Requisitos mínimos de hardware (estações administrativas): processador dual-core 2.0 GHz, 4 GB de memória RAM, resolução mínima de 1366 × 768 e conexão de internet de 10 Mbps.
Requisitos mínimos (terminais de produção): tablet com tela de 10 polegadas, 3 GB de RAM e navegador atualizado, conectado à rede local sem fio da fábrica.
Periféricos: impressora a laser ou térmica para emissão da ficha técnica e das etiquetas de pedido; leitor de código de barras/QR Code para apontamento de produção (opcional).
2.4 Premissas e Dependências
Premissas
A fábrica fornecerá a base de materiais e insumos previamente higienizada (descrição, unidade de medida e saldo inicial) para a carga inicial do sistema.
Os índices técnicos de consumo (pares por placa, metragem de tecido e papel sublimático por par) são estáveis e validados pela área de produção, mas serão parametrizáveis para absorver variações futuras.
As artes serão fornecidas pelo cliente ou produzidas internamente em formato digital, e apenas o arquivo aprovado será vinculado ao pedido.
A fábrica disporá de rede local e de internet estável nas áreas administrativa e produtiva durante o horário de operação.
Os usuários serão treinados nos processos do sistema antes da entrada em produção.
O processo produtivo permanece organizado por pedido (produção sob encomenda), sem produção para estoque de produto acabado.
Dependências
Disponibilidade do provedor de nuvem e do serviço de banco de dados gerenciado contratado.
Serviço transacional de e-mail (ex.: AWS SES, SendGrid) para notificações de status de pedido e recuperação de senha.
API pública de consulta de CEP (ex.: ViaCEP) para preenchimento assistido de endereços — funcionalidade não bloqueante em caso de indisponibilidade.
Serviço de armazenamento de arquivos (ex.: Amazon S3 ou equivalente) para guarda dos arquivos de arte vinculados aos pedidos.
Disponibilização, pela fábrica, de um responsável técnico de negócio para validação das regras durante a homologação.
2.5 Restrições Gerais
Tecnológicas: obrigatoriedade de banco de dados relacional com suporte a transações ACID e integridade referencial declarativa, requisito indispensável para a consistência do controle de estoque e da validação de disponibilidade.
Arquiteturais: a aplicação deve ser Web e centralizada; não são admitidas instalações desktop com bases locais independentes, sob pena de divergência de saldos de estoque.
Legais e regulatórias: conformidade com a LGPD no tratamento dos dados pessoais de clientes e convidados, incluindo base legal de tratamento, política de retenção e atendimento aos direitos do titular.
Orçamentárias e temporais: o projeto deve ser entregue com equipe reduzida e prazo limitado, o que impõe a priorização dos requisitos de prioridade Alta na primeira versão (MVP) e o adiamento dos de prioridade Baixa.
Operacionais: a interface deve ser utilizável por operadores de chão de fábrica com pouca familiaridade com sistemas informatizados, o que restringe o uso de fluxos complexos e telas densas.
Idioma e localização: interface, mensagens e relatórios em português do Brasil, com formatos de data (dd/mm/aaaa), moeda (R$) e unidades métricas nacionais.
3. Requisitos Funcionais (RF)

Os requisitos funcionais descrevem o que o sistema deve fazer. Cada requisito possui identificador único, nome, descrição e prioridade (Alta = indispensável ao MVP; Média = importante, mas postergável; Baixa = desejável).

Tabela Resumo de Requisitos Funcionais
Código	Nome do Requisito	Descrição Resumida	Prioridade
RF001	Autenticação de Usuário	Permitir login por e-mail e senha, com suporte a MFA para o perfil Administrador.	Alta
RF002	Gestão de Usuários e Perfis	Cadastrar usuários e vincular papéis (Administrador, Comercial, Produção, Estoque) segundo o modelo RBAC.	Alta
RF003	Cadastro de Clientes	Manter o cadastro completo de clientes, com dados pessoais, contato, endereço e documento válido.	Alta
RF004	Cadastro de Evento	Registrar as informações do evento vinculado ao pedido (tipo, data, local e observações).	Alta
RF005	Registro de Pedido	Criar o pedido vinculado ao cliente e ao evento, com quantidade total de pares e prazo de entrega.	Alta
RF006	Definição de Qualidade do Produto	Classificar o pedido como Normal (50/50) ou Premium (70/30), determinando os índices de consumo aplicáveis.	Alta
RF007	Distribuição por Gênero e Numeração	Registrar a grade do pedido, distribuindo os pares por gênero (masculino, feminino, infantil) e por numeração.	Alta
RF008	Definição de Tiras	Especificar modelo, material e cor das tiras por item ou por grade do pedido.	Alta
RF009	Seleção e Vinculação de Arte	Selecionar a arte do catálogo ou anexar arquivo, registrando versão e situação de aprovação.	Alta
RF010	Registro de Adicionais	Incluir itens adicionais opcionais no pedido, com quantidade e vínculo ao respectivo insumo.	Média
RF011	Seleção de Embalagem	Sugerir e registrar o tipo de embalagem em função da quantidade total de pares do pedido.	Alta
RF012	Cálculo Automático de Insumos	Calcular automaticamente placas, metragem de tecido, papel sublimático, tiras, adicionais e embalagens necessários.	Alta
RF013	Validação Automática de Estoque	Confrontar a necessidade calculada com o saldo disponível e impedir a liberação em caso de insuficiência.	Alta
RF014	Reserva e Baixa de Insumos	Reservar os insumos na liberação do pedido e efetuar a baixa definitiva conforme o avanço da produção.	Alta
RF015	Liberação do Pedido para Produção	Alterar a situação do pedido para liberado após aprovação da arte e validação de estoque bem-sucedida.	Alta
RF016	Acompanhamento do Status Produtivo	Registrar e consultar a evolução do pedido pelas etapas de produção até a finalização.	Alta
RF017	Emissão da Ficha Técnica de Produção	Gerar documento imprimível com grade, tiras, arte, adicionais, embalagem e insumos calculados.	Alta
RF018	Gestão de Materiais e Insumos	Manter o cadastro de materiais com unidade de medida, saldo e estoque mínimo.	Alta
RF019	Movimentação de Estoque	Registrar entradas, saídas e ajustes de inventário, com motivo e responsável.	Alta
RF020	Alerta de Estoque Mínimo	Sinalizar materiais cujo saldo disponível esteja igual ou inferior ao ponto de ressuprimento.	Média
RF021	Registro de Expedição e Entrega	Registrar a finalização, a conferência e o encaminhamento do pedido para entrega.	Média
RF022	Consulta e Filtro de Pedidos	Pesquisar pedidos por cliente, período, situação, evento ou número, com filtros combinados.	Média
RF023	Histórico de Alterações (Auditoria)	Registrar automaticamente autor, data/hora, campo alterado e valores anterior e posterior.	Alta
RF024	Relatórios Operacionais	Emitir relatórios de consumo de insumos, produção por período e posição de estoque em PDF e XLSX.	Baixa
RF025	Notificação de Mudança de Status	Enviar e-mail ao responsável comercial quando o pedido mudar de situação.	Baixa
Detalhamento por Caso de Uso / História de Usuário
[RF001] Autenticação de Usuário
Descrição: o sistema deve permitir que usuários registrados acessem a aplicação mediante credenciais válidas, direcionando-os às funcionalidades correspondentes ao seu perfil.
Ator principal: todos os perfis de usuário (Administrador, Comercial/Atendimento, Produção e Estoque).
Pré-condições: usuário cadastrado, ativo e com perfil vinculado no banco de dados.

Fluxo principal:

O usuário acessa a tela de login.
O usuário informa o e-mail e a senha cadastrados.
O usuário aciona o comando "Entrar".
O sistema valida as credenciais e, para o perfil Administrador, solicita o segundo fator de autenticação.
O sistema cria a sessão e redireciona o usuário ao painel inicial correspondente ao seu perfil.

Fluxos alternativos / exceções:

FA01 – Credenciais incorretas: o sistema exibe a mensagem "Credenciais inválidas", sem indicar qual campo está incorreto, e permite nova tentativa.
FA02 – Conta bloqueada: após 5 tentativas incorretas consecutivas, o sistema bloqueia temporariamente a conta por 15 minutos e registra o evento no log de auditoria.
FA03 – Usuário inativo: o sistema informa que o acesso está suspenso e orienta o contato com o Administrador.
FA04 – Senha expirada (Administrador): o sistema conduz obrigatoriamente à tela de redefinição de senha antes de liberar o acesso, conforme RN013.
Pós-condições: sessão do usuário criada, token de autenticação gerado e evento de acesso registrado no histórico.
[RF005] Registro de Pedido
Descrição: o sistema deve permitir o registro detalhado do pedido personalizado, reunindo cliente, evento, quantidade de pares, qualidade, grade de numeração, tiras, arte, adicionais e embalagem.
Ator principal: Comercial / Atendimento.
Pré-condições: usuário autenticado com perfil Comercial ou Administrador; cliente previamente cadastrado (RF003); materiais e artes cadastrados no sistema.

Fluxo principal:

O usuário aciona a opção "Novo Pedido" e seleciona o cliente.
O usuário informa ou seleciona o evento vinculado (tipo, data e local) e o prazo de entrega desejado.
O usuário informa a quantidade total de pares e seleciona a qualidade do produto: Normal (50/50) ou Premium (70/30).
O usuário distribui os pares por gênero e por numeração, compondo a grade do pedido.
O sistema valida se o somatório da grade é igual à quantidade total informada (RN008).
O usuário define modelo, material e cor das tiras.
O usuário seleciona a arte no catálogo ou anexa o arquivo correspondente.
O usuário inclui os adicionais desejados e informa suas quantidades.
O sistema sugere o tipo de embalagem em função da quantidade total de pares (RN005); o usuário confirma ou altera a sugestão.
O sistema calcula automaticamente os insumos necessários (RF012) e apresenta o resumo técnico do pedido.
O usuário confirma o registro e o sistema grava o pedido na situação "Aguardando validação".

Fluxos alternativos / exceções:

FA01 – Grade divergente: se o somatório por numeração não coincidir com o total de pares, o sistema impede a gravação e destaca a diferença apurada.
FA02 – Cliente não cadastrado: o sistema oferece o desvio para o cadastro de cliente (RF003) e retorna ao pedido ao final.
FA03 – Arte pendente: o pedido pode ser gravado com a arte em situação "Em aprovação", mas não poderá ser liberado para produção enquanto não for aprovada (RN012).
FA04 – Cancelamento pelo usuário: o sistema descarta os dados não gravados após confirmação explícita.
Pós-condições: pedido registrado com número sequencial único, situação "Aguardando validação", insumos calculados e registro de criação gravado no histórico de alterações.
[RF012] Cálculo Automático de Insumos
Descrição: o sistema deve calcular automaticamente a necessidade de insumos de cada pedido a partir da quantidade de pares, da qualidade do produto e dos demais parâmetros técnicos, dispensando o cálculo manual.
Ator principal: sistema (processo automático), acionado pelo Comercial / Atendimento.
Pré-condições: pedido com quantidade de pares, qualidade, tiras, adicionais e embalagem informados; parâmetros de consumo cadastrados e vigentes.

Fluxo principal:

O sistema identifica a qualidade do pedido e recupera os índices aplicáveis (RN001 e RN002).
O sistema calcula a quantidade de placas necessárias arredondando para cima a divisão do total de pares pelo rendimento por placa (RN003).
O sistema calcula a metragem de tecido multiplicando a quantidade de placas pelo consumo unitário da qualidade correspondente (RN004).
O sistema calcula o consumo de papel sublimático multiplicando o total de pares por 1,5 (RN006).
O sistema apura a quantidade de tiras, de adicionais e de embalagens conforme a grade e as opções selecionadas (RN007).
O sistema apresenta a memória de cálculo detalhada por insumo e a persiste vinculada ao pedido.

Fluxos alternativos / exceções:

FA01 – Parâmetro não cadastrado: o sistema interrompe o cálculo, identifica o índice ausente e orienta o acionamento do Administrador.
FA02 – Alteração posterior do pedido: qualquer alteração de quantidade, qualidade ou composição dispara o recálculo integral e a atualização da reserva de insumos.
FA03 – Revisão dos parâmetros: a alteração dos índices pelo Administrador não afeta retroativamente pedidos já liberados para produção, que preservam a memória de cálculo original.
Pós-condições: necessidade de insumos calculada, gravada e disponível para a validação de estoque (RF013) e para a ficha técnica de produção (RF017).
[RF013] Validação Automática de Estoque
Descrição: o sistema deve confrontar automaticamente a necessidade de insumos calculada com o saldo disponível em estoque antes de permitir a liberação do pedido para produção.
Ator principal: sistema (processo automático); atores interessados: Comercial / Atendimento e Estoque.
Pré-condições: pedido na situação "Aguardando validação" com insumos calculados (RF012); saldos de estoque atualizados.

Fluxo principal:

O usuário aciona a validação do pedido ou o sistema a executa automaticamente ao final do registro.
O sistema apura, para cada insumo, o saldo disponível (saldo físico menos reservas de outros pedidos).
O sistema compara a necessidade com o saldo disponível, item a item.
Havendo suficiência para todos os itens, o sistema marca o pedido como "Validado" e o habilita à liberação para produção.
O sistema registra o resultado da validação, com data, hora e responsável, no histórico do pedido.

Fluxos alternativos / exceções:

FA01 – Insuficiência de insumo: o sistema mantém o pedido na situação "Pendente de insumo", impede a liberação (RN009) e apresenta a relação dos itens em falta, com a quantidade faltante de cada um.
FA02 – Notificação ao Estoque: identificada a falta, o sistema sinaliza a demanda ao perfil Estoque para providências de ressuprimento.
FA03 – Concorrência entre pedidos: a validação e a reserva ocorrem em transação única com bloqueio do registro do material, de modo que dois pedidos simultâneos não possam consumir o mesmo saldo (RNF-CON-01).
FA04 – Revalidação: reposto o insumo, o usuário pode reexecutar a validação sem necessidade de recriar o pedido.
Pós-condições: pedido validado e apto à liberação, com insumos reservados; ou pedido pendente, com a relação de faltas registrada e comunicada.
[RF016] Acompanhamento do Status Produtivo
Descrição: o sistema deve registrar e disponibilizar a evolução de cada pedido ao longo das etapas produtivas, desde a liberação até a finalização e a expedição.
Ator principal: Produção; atores interessados: Comercial / Atendimento e Administrador.
Pré-condições: pedido liberado para produção (RF015).

Fluxo principal:

O usuário do perfil Produção acessa a lista de pedidos liberados, ordenada por prazo de entrega.
O usuário seleciona o pedido e consulta a ficha técnica correspondente (RF017).
O usuário registra o avanço para a etapa seguinte: Impressão da arte, Sublimação, Corte, Montagem, Acabamento, Embalagem e Finalizado.
O sistema grava a etapa, o responsável e o instante do apontamento, e efetua a baixa dos insumos correspondentes (RF014).
Concluída a última etapa, o sistema altera a situação do pedido para "Finalizado" e o encaminha à expedição (RF021).

Fluxos alternativos / exceções:

FA01 – Tentativa de salto de etapa: o sistema impede o registro de etapa fora da sequência definida (RN011) e exibe a etapa esperada.
FA02 – Registro de perda ou refugo: o usuário informa a quantidade perdida e o motivo; o sistema baixa o insumo adicional e sinaliza a necessidade de reposição do saldo reservado.
FA03 – Retorno de etapa: o retrocesso de etapa é admitido exclusivamente aos perfis Produção com justificativa obrigatória, ficando registrado na auditoria.
Pós-condições: situação do pedido atualizada, insumos baixados, histórico de etapas disponível para consulta e rastreabilidade preservada.
4. Regras de Negócio (RN)

As regras de negócio definem políticas, restrições e cálculos operacionais da fábrica que o sistema deve impor obrigatoriamente, independentemente da interface utilizada.

Código	Nome da Regra	Descrição / Fórmula de Aplicação
RN001	Rendimento – Qualidade Normal (50/50)	Pedidos classificados como qualidade Normal (50/50) consideram o rendimento de 32 pares por placa e o consumo de 1,5 metro de tecido por placa.
RN002	Rendimento – Qualidade Premium (70/30)	Pedidos classificados como qualidade Premium (70/30) consideram o rendimento de 21 pares por placa e o consumo de 1 metro de tecido por placa.
RN003	Cálculo da quantidade de placas	Quantidade de placas = arredondamento para cima (total de pares ÷ pares por placa). Exemplo: 100 pares na qualidade Normal → teto(100 ÷ 32) = 4 placas.
RN004	Cálculo da metragem de tecido	Metragem de tecido = quantidade de placas × consumo unitário da qualidade (1,5 m para Normal; 1 m para Premium). Exemplo: 4 placas Normal → 6 metros.
RN005	Seleção de embalagem por volume	O tipo de embalagem é determinado pela quantidade total de pares do pedido, conforme as faixas parametrizadas pelo Administrador. A validação de disponibilidade da embalagem em estoque é obrigatória.
RN006	Consumo de papel sublimático	Papel sublimático = total de pares × 1,5 unidade. Exemplo: 100 pares → 150 unidades.
RN007	Consumo de tiras e adicionais	A necessidade de tiras corresponde ao total de pares do respectivo modelo/cor; a de adicionais corresponde à quantidade informada por item no pedido.
RN008	Consistência da grade de numeração	O somatório dos pares distribuídos por gênero e numeração deve ser exatamente igual à quantidade total de pares do pedido; divergências impedem a gravação.
RN009	Bloqueio por indisponibilidade de insumo	Nenhum pedido pode ser liberado para produção sem que a validação automática de estoque confirme a disponibilidade integral dos insumos calculados.
RN010	Reserva e baixa de insumos	Na liberação, os insumos são reservados (indisponibilizados a outros pedidos); a baixa definitiva do saldo ocorre conforme o avanço das etapas produtivas.
RN011	Sequência obrigatória de etapas	A situação do pedido evolui exclusivamente na sequência: Registrado → Validado → Liberado → Em produção → Finalizado → Expedido. Saltos de etapa são vedados.
RN012	Aprovação prévia da arte	Pedidos cuja arte esteja na situação "Em aprovação" não podem ser liberados para produção; a aprovação deve ser registrada com data e responsável.
RN013	Expiração de senha	A senha dos usuários com perfil Administrador deve ser obrigatoriamente alterada a cada 90 dias.
RN014	Alteração de pedido	O pedido é editável apenas até a liberação para produção. Após a liberação, alterações exigem autorização do Administrador e geram registro de justificativa na auditoria.
RN015	Validação de documento do cliente	Todo cadastro de cliente pessoa física ou jurídica deve conter CPF ou CNPJ válido, com verificação dos dígitos verificadores e sem duplicidade na base.
RN016	Vedação à exclusão física de registros	Pedidos, clientes e movimentações de estoque não são excluídos fisicamente; a inativação lógica preserva a rastreabilidade histórica.
RN017	Estoque mínimo	Materiais cujo saldo disponível atinja ou fique abaixo do estoque mínimo cadastrado são sinalizados ao perfil Estoque para ressuprimento.
RN018	Numeração do pedido	Cada pedido recebe número sequencial único, gerado automaticamente pelo sistema e imutável ao longo de todo o ciclo de vida.

Nota técnica: os índices das regras RN001 a RN006 devem ser mantidos como parâmetros configuráveis pelo Administrador, e não como valores fixos em código, de modo a absorver alterações de processo sem necessidade de nova versão do software. Recomenda-se que o consumo de tecido (RN001 e RN002) seja formalmente confirmado com a área de produção quanto à sua base de aplicação — por placa, conforme aqui adotado —, registrando-se a validação em ata de homologação.

5. Requisitos Não Funcionais (RNF)

Os requisitos não funcionais definem as qualidades, o desempenho e as características estruturais do sistema.

5.1 Desempenho e Performance (RNF-DES)
RNF-DES-01: o tempo de resposta das requisições de consulta não deve ultrapassar 2 segundos sob carga normal de operação.
RNF-DES-02: o sistema deve suportar no mínimo 50 usuários simultâneos — dimensionamento compatível com o porte da fábrica — sem degradação perceptível, com arquitetura preparada para ampliação.
RNF-DES-03: o cálculo automático de insumos e a validação de estoque de um pedido devem ser concluídos em até 3 segundos.
RNF-DES-04: a emissão da ficha técnica de produção em PDF não deve exceder 5 segundos.
5.2 Segurança e Privacidade (RNF-SEG)
RNF-SEG-01: todas as comunicações de dados devem ser criptografadas por HTTPS/TLS 1.3.
RNF-SEG-02: as senhas devem ser armazenadas com algoritmo de hashing seguro (Argon2id ou bcrypt), jamais em texto claro ou com criptografia reversível.
RNF-SEG-03: o sistema deve observar integralmente a LGPD, permitindo a exportação e a exclusão dos dados pessoais a pedido do titular, respeitados os prazos legais de guarda.
RNF-SEG-04: o controle de acesso deve ser baseado em papéis (RBAC), com verificação de autorização também no servidor, e não apenas na ocultação de elementos da interface.
RNF-SEG-05: o perfil Administrador deve dispor de autenticação multifator (MFA).
RNF-SEG-06: a sessão inativa deve ser encerrada automaticamente após 30 minutos.
RNF-SEG-07: as tentativas de acesso, alterações de permissão e operações sobre pedidos e estoque devem ser registradas em log de auditoria inviolável pelos usuários finais.
5.3 Usabilidade e Acessibilidade (RNF-USA)
RNF-USA-01: a interface deve observar as diretrizes de acessibilidade WCAG 2.1 nível AA (contraste de cores, navegação por teclado e compatibilidade com leitores de tela).
RNF-USA-02: o design deve ser integralmente responsivo, adaptando-se a smartphones, tablets e desktops.
RNF-USA-03: o registro completo de um pedido por usuário treinado não deve exceder 5 minutos.
RNF-USA-04: as mensagens de erro devem ser redigidas em linguagem clara, indicando a causa e a ação corretiva — em especial nas faltas de insumo, com identificação do material e da quantidade faltante.
RNF-USA-05: as telas destinadas ao chão de fábrica devem privilegiar elementos de toque amplos e leitura à distância.
5.4 Disponibilidade e Confiabilidade (RNF-DIS)
RNF-DIS-01: o sistema deve apresentar disponibilidade (uptime) mínima de 99,5% no horário de operação da fábrica, admitidas janelas de manutenção programada e previamente comunicadas.
RNF-DIS-02: devem ser realizados backups automáticos diários do banco de dados, com retenção mínima de 30 dias e teste de restauração periódico.
RNF-DIS-03: o objetivo de tempo de recuperação (RTO) é de 4 horas e o de ponto de recuperação (RPO) é de 24 horas.
5.5 Integridade e Controle de Concorrência (RNF-CON)
RNF-CON-01: o banco de dados deve assegurar integridade referencial declarativa entre todas as entidades relacionadas, impedindo registros órfãos.
RNF-CON-02: as operações de validação, reserva e baixa de estoque devem ser executadas em transações atômicas com bloqueio adequado, de modo a impedir consumo duplicado do mesmo saldo por pedidos concorrentes.
RNF-CON-03: a edição simultânea de um mesmo pedido por dois usuários deve ser tratada por controle de concorrência otimista, alertando o segundo usuário sobre a alteração ocorrida.
RNF-CON-04: todas as alterações relevantes devem gerar registro de histórico com autor, data/hora, campo alterado e valores anterior e posterior.
5.6 Escalabilidade e Manutenibilidade (RNF-MAN)
RNF-MAN-01: o código-fonte deve possuir cobertura de testes automatizados unitários e de integração de, no mínimo, 80%, com cobertura obrigatória de 100% das rotinas de cálculo de insumos e de validação de estoque.
RNF-MAN-02: a arquitetura deve ser modular e desacoplada, permitindo escalabilidade horizontal e a evolução independente dos módulos de pedido, estoque e produção.
RNF-MAN-03: as regras de cálculo devem residir em camada de domínio parametrizável, sem valores fixos em código.
RNF-MAN-04: o sistema deve manter documentação técnica atualizada da API interna e do modelo de dados.
6. Requisitos de Interface Externa
6.1 Interface de Usuário (UI / UX)
Protótipos de baixa e alta fidelidade das telas de login, painel inicial por perfil, cadastro de cliente, registro de pedido (assistente em etapas), validação de estoque, painel de produção e movimentação de estoque, a serem disponibilizados em Figma ou Penpot e anexados a este documento.
Design System próprio, com paleta de cores institucional da fábrica, tipografia legível de no mínimo 14 px no corpo do texto e iconografia consistente.
Padrão de navegação: menu lateral fixo com os módulos permitidos ao perfil autenticado e trilha de navegação (breadcrumb) nas telas internas.
Assistente (wizard) para o registro de pedido, segmentado nas etapas: Cliente e Evento → Produto e Grade → Personalização → Adicionais e Embalagem → Resumo e Validação.
Sinalização visual padronizada das situações do pedido por cor e rótulo textual, sem depender exclusivamente da cor, em atendimento ao RNF-USA-01.
Painel de produção em modo lista, otimizado para visualização em tablet, ordenado por prazo de entrega.
6.2 Interfaces de Software e APIs Externas
Interface	Finalidade	Característica técnica
Serviço de e-mail transacional	Notificação de mudança de status do pedido e recuperação de senha.	Integração REST com provedor como AWS SES ou SendGrid; falha na entrega não bloqueia a operação.
API de consulta de CEP	Preenchimento assistido do endereço no cadastro de clientes.	Consumo REST (ex.: ViaCEP); indisponibilidade permite preenchimento manual.
Serviço de armazenamento de arquivos	Guarda dos arquivos de arte vinculados aos pedidos.	Armazenamento de objetos com URL assinada e tempo de expiração.
Exportação de dados	Disponibilização de pedidos e consumos para sistemas fiscais e contábeis externos.	Geração de arquivos em CSV, XLSX e PDF; sem integração automatizada na versão 1.0.
Gateway de pagamento	Não aplicável.	Fora do escopo (Seção 1.2).
Autenticação social (SSO)	Não aplicável na versão 1.0.	Autenticação exclusivamente local, com credenciais mantidas pelo Administrador.
6.3 Interfaces de Hardware / Periféricos
Impressora a laser ou jato de tinta (rede local): emissão da ficha técnica de produção e dos relatórios operacionais em formato A4.
Impressora térmica de etiquetas: identificação de pedidos, volumes e embalagens com número do pedido e código de barras/QR Code — funcionalidade opcional.
Leitor de código de barras / QR Code: apontamento ágil de etapas produtivas por leitura da etiqueta do pedido — funcionalidade opcional, com alternativa integral de digitação manual.
Tablets de chão de fábrica: terminais de consulta da ficha técnica e de registro de status, conectados à rede local sem fio.
Não há comunicação direta com máquinas do parque fabril (impressora sublimática, prensa térmica ou máquina de corte); a interação ocorre por meio dos arquivos e documentos gerados pelo sistema.
7. Anexos e Rastreabilidade
7.1 Matriz de Rastreabilidade de Requisitos

A matriz relaciona cada requisito funcional às regras de negócio associadas, ao módulo do sistema responsável e aos casos de teste correspondentes.

ID Requisito	Regras de Negócio	Módulo do Sistema	Caso de Teste Relacionado
RF001	RN013	Autenticação / Auth	CT-001, CT-002, CT-003
RF002	RN013	Administração / RBAC	CT-004, CT-005
RF003	RN015, RN016	Cadastro / Clientes	CT-010, CT-011
RF005	RN008, RN014, RN018	Pedidos	CT-020, CT-021, CT-022
RF006	RN001, RN002	Pedidos	CT-023
RF007	RN008	Pedidos / Grade	CT-024, CT-025
RF009	RN012	Pedidos / Arte	CT-026
RF011	RN005	Pedidos / Embalagem	CT-027
RF012	RN001, RN002, RN003, RN004, RN006, RN007	Cálculo de Insumos	CT-030, CT-031, CT-032, CT-033
RF013	RN009	Estoque / Validação	CT-040, CT-041, CT-042
RF014	RN010	Estoque / Movimentação	CT-043, CT-044
RF015	RN009, RN011, RN012	Produção / Liberação	CT-050
RF016	RN011	Produção / Acompanhamento	CT-051, CT-052
RF019	RN016	Estoque / Movimentação	CT-060, CT-061
RF020	RN017	Estoque / Alertas	CT-062
RF023	RN014, RN016	Auditoria / Histórico	CT-070, CT-071
7.2 Diagramas e Modelos Recomendados
Diagrama de Casos de Uso (UML): representação dos atores Administrador, Comercial/Atendimento, Produção e Estoque e de suas interações com os casos de uso Autenticar, Cadastrar Cliente, Registrar Pedido, Calcular Insumos, Validar Estoque, Liberar Produção, Acompanhar Produção e Movimentar Estoque.
Diagrama de Entidade-Relacionamento (DER): modelagem conceitual e lógica do banco de dados, contemplando as entidades relacionadas no quadro abaixo.
Fluxograma de Processo (BPMN): mapeamento do fluxo operacional descrito na Seção 7.3.
Diagrama de Estados do Pedido: representação das transições Registrado → Validado → Liberado → Em produção → Finalizado → Expedido, com os estados de exceção Pendente de insumo e Cancelado.

Entidades previstas no modelo conceitual de dados:

Entidade	Descrição	Principais relacionamentos
Cliente	Dados pessoais ou comerciais, contato, documento e endereço.	1:N com Pedido
Evento	Tipo, data, local e observações do evento de destino.	1:N com Pedido
Pedido	Registro central da encomenda, com número, situação, prazo e qualidade.	N:1 com Cliente e Evento; 1:N com Item de Pedido
Item de Pedido / Distribuição de Numeração	Distribuição dos pares por gênero e numeração.	N:1 com Pedido
Produto / Qualidade	Classificação Normal (50/50) ou Premium (70/30) e respectivos índices.	1:N com Pedido
Tira	Modelo, material e cor das tiras utilizadas.	N:N com Pedido; N:1 com Material
Arte	Arquivo, versão e situação de aprovação da personalização.	N:N com Pedido
Adicional	Itens complementares opcionais do pedido.	N:N com Pedido; N:1 com Material
Embalagem	Tipos de embalagem e respectivas faixas de capacidade em pares.	N:1 com Pedido; N:1 com Material
Material	Cadastro de insumos com unidade de medida e estoque mínimo.	1:N com Estoque e com Movimentação
Estoque	Saldo físico, saldo reservado e saldo disponível por material.	1:1 com Material
Movimentação de Estoque	Entradas, saídas, reservas e ajustes, com motivo e responsável.	N:1 com Material e com Pedido
Usuário / Perfil	Credenciais, papel atribuído e situação do usuário.	N:N entre Usuário e Perfil
Histórico de Alterações	Registro de auditoria de todas as operações relevantes.	N:1 com Usuário e com a entidade alterada
7.3 Fluxo Operacional do Sistema

O fluxo operacional consolidado, a ser detalhado em notação BPMN, compreende as seguintes etapas:

Cadastro do cliente e registro das informações do evento.
Formalização do pedido, com definição de quantidade de pares, qualidade, grade de numeração, tiras, arte, adicionais e embalagem.
Cálculo automático dos insumos necessários pelo sistema.
Validação automática da disponibilidade em estoque.
Havendo insuficiência, o pedido permanece pendente e a demanda de ressuprimento é sinalizada ao perfil Estoque; reposto o insumo, a validação é reexecutada.
Confirmada a disponibilidade e aprovada a arte, o pedido é liberado para produção e os insumos são reservados.
Execução e acompanhamento das etapas produtivas, com baixa progressiva dos insumos.
Finalização, conferência e encaminhamento do pedido para entrega.
7.4 Anexos
Anexo A – Documento de Projeto de Software (ABNT – Técnico), que fundamenta esta especificação.
Anexo B – Protótipos de interface (links para Figma ou Penpot).
Anexo C – Diagrama de Entidade-Relacionamento e dicionário de dados.
Anexo D – Tabela de faixas de embalagem parametrizadas por quantidade de pares.
Anexo E – Plano de testes e casos de teste referenciados na matriz de rastreabilidade (Seção 7.1).
7.5 Controle de Versões do Documento
Versão	Data	Responsável	Descrição da alteração
1.0	dd/mm/aaaa	Equipe de Análise	Versão inicial elaborada com base no Documento de Projeto de Software da fábrica de chinelos personalizados.
—	—	—	Aguardando validação dos stakeholders.
