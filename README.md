# SGI-Chinelos

**Sistema de Gestão Integrada para Fábrica de Chinelos Personalizados**

Sistema web para gerenciamento do ciclo completo de produção sob encomenda de chinelos personalizados — do atendimento ao cliente até a expedição do pedido —, com cálculo automático de insumos, validação de estoque e acompanhamento do status produtivo.

![status](https://img.shields.io/badge/status-em%20especifica%C3%A7%C3%A3o-yellow)
![versão](https://img.shields.io/badge/vers%C3%A3o-1.0-blue)
![licença](https://img.shields.io/badge/licen%C3%A7a-a%20definir-lightgrey)

---

## Sumário

- [O problema](#o-problema)
- [A solução](#a-solução)
- [Funcionalidades](#funcionalidades)
- [Regras de negócio](#regras-de-negócio)
- [Perfis de usuário](#perfis-de-usuário)
- [Fluxo operacional](#fluxo-operacional)
- [Modelo de dados](#modelo-de-dados)
- [Arquitetura e tecnologias](#arquitetura-e-tecnologias)
- [Estrutura do repositório](#estrutura-do-repositório)
- [Como executar](#como-executar)
- [Documentação](#documentação)
- [Roadmap](#roadmap)
- [Fora do escopo](#fora-do-escopo)
- [Autores](#autores)

---

## O problema

Fábricas de produtos personalizados operam com alta variabilidade: cada pedido tem quantidade, qualidade, grade de numeração, arte e adicionais próprios. Quando esse controle é feito em planilhas e anotações manuais, surgem três problemas recorrentes:

1. **Erro de cálculo de insumo.** A conversão de "pares" em placas, metros de tecido e folhas de papel sublimático é feita à mão, pedido a pedido.
2. **Produção sem lastro de material.** O pedido entra em produção e só no chão de fábrica se descobre que falta insumo, gerando parada e atraso.
3. **Perda de rastreabilidade.** Não se sabe em que etapa cada pedido está, quem alterou o quê nem quanto de material foi efetivamente consumido.

## A solução

O SGI-Chinelos centraliza clientes, pedidos, insumos, estoque e produção em uma única base relacional, com acesso segmentado por perfil. O sistema calcula os insumos automaticamente a partir dos parâmetros do pedido, **bloqueia a liberação para produção quando não há estoque suficiente** e mantém histórico completo de alterações.

**Ganhos esperados:** redução de falhas humanas, automação do cálculo de insumos, controle de disponibilidade de materiais, padronização dos pedidos personalizados e visibilidade do status produtivo.

---

## Funcionalidades

### Comercial e pedidos

- Cadastro completo de clientes, com validação de CPF/CNPJ e dados do evento (tipo, data, local)
- Registro de pedido em assistente por etapas, com número sequencial único
- Classificação de qualidade: **Normal (50/50)** ou **Premium (70/30)**
- Grade de numeração por gênero, com validação do somatório contra o total de pares
- Definição de tiras (modelo, material e cor)
- Seleção de arte do catálogo ou upload de arquivo, com controle de versão e aprovação
- Registro de adicionais (tag, laço, chaveiro, aplique)
- Sugestão automática de embalagem conforme o volume do pedido

### Cálculo e estoque

- **Cálculo automático de insumos**: placas, metragem de tecido, papel sublimático, tiras, adicionais e embalagens
- Memória de cálculo detalhada e persistida por pedido
- **Validação automática de disponibilidade** antes da liberação para produção
- Reserva de insumos na liberação e baixa progressiva conforme o avanço das etapas
- Movimentação de estoque (entradas, saídas e ajustes) com motivo e responsável
- Alerta de estoque mínimo para ressuprimento

### Produção e expedição

- Liberação de pedidos validados e com arte aprovada
- Painel de produção ordenado por prazo de entrega, otimizado para tablet
- Apontamento de etapas: Impressão → Sublimação → Corte → Montagem → Acabamento → Embalagem → Finalizado
- Registro de perdas e refugos
- Ficha técnica de produção imprimível
- Registro de conferência e encaminhamento para entrega

### Administração

- Autenticação com MFA para o perfil Administrador
- Controle de acesso baseado em papéis (RBAC)
- Parametrização das regras de cálculo sem alteração de código
- Log de auditoria com autor, data/hora, campo alterado e valores anterior e posterior
- Relatórios operacionais em PDF e XLSX

---

## Regras de negócio

As regras de cálculo são o núcleo do sistema. Todos os índices são **parametrizáveis** pelo Administrador, e não fixos em código.

| Código | Regra | Fórmula |
|---|---|---|
| RN001 | Rendimento — Normal (50/50) | 32 pares por placa · 1,5 m de tecido por placa |
| RN002 | Rendimento — Premium (70/30) | 21 pares por placa · 1 m de tecido por placa |
| RN003 | Quantidade de placas | `placas = teto(total_de_pares ÷ pares_por_placa)` |
| RN004 | Metragem de tecido | `tecido = placas × consumo_unitário_da_qualidade` |
| RN005 | Seleção de embalagem | Definida pela faixa de quantidade total de pares |
| RN006 | Papel sublimático | `papel = total_de_pares × 1,5` |
| RN008 | Consistência da grade | Somatório da grade deve ser igual ao total de pares |
| RN009 | Bloqueio por indisponibilidade | Sem estoque integral, não há liberação para produção |
| RN011 | Sequência de etapas | Registrado → Validado → Liberado → Em produção → Finalizado → Expedido |
| RN012 | Aprovação prévia da arte | Arte "Em aprovação" impede a liberação |

**Exemplo prático** — pedido de 100 pares, qualidade Normal:

```
placas  = teto(100 ÷ 32)  = 4 placas
tecido  = 4 × 1,5 m       = 6 metros
papel   = 100 × 1,5       = 150 unidades
```

> ⚠️ **Ponto em aberto:** a base de aplicação do consumo de tecido (por placa ou por par) deve ser confirmada formalmente com a área de produção antes da implementação. A especificação adota **por placa**.

O conjunto completo das 18 regras está na Seção 4 da ERS.

---

## Perfis de usuário

| Perfil | Responsabilidade | Acesso |
|---|---|---|
| **Administrador** | Configuração geral e parametrização | Irrestrito, incluindo usuários, regras de cálculo e auditoria |
| **Comercial / Atendimento** | Clientes e pedidos | CRUD de clientes e pedidos até a liberação; estoque somente leitura |
| **Produção** | Execução no chão de fábrica | Leitura de pedidos liberados e atualização de status |
| **Estoque** | Insumos e embalagens | Movimentações, consultas e relatórios de estoque |

O cliente final não é usuário do sistema na versão 1.0.

---

## Fluxo operacional

```
Cadastro do cliente e do evento
            ↓
    Registro do pedido
 (pares, qualidade, grade, tiras,
   arte, adicionais, embalagem)
            ↓
 Cálculo automático de insumos
            ↓
   Validação de estoque ──── insuficiente ──→ Pendente de insumo
            │                                        │
        suficiente                              ressuprimento
            ↓                                        │
  Liberação para produção  ←──── revalidação ────────┘
   (reserva de insumos)
            ↓
  Etapas produtivas + baixa
            ↓
  Finalização e expedição
```

---

## Modelo de dados

Entidades principais do modelo relacional:

`Cliente` · `Evento` · `Pedido` · `Item de Pedido / Distribuição de Numeração` · `Produto / Qualidade` · `Tira` · `Arte` · `Adicional` · `Embalagem` · `Material` · `Estoque` · `Movimentação de Estoque` · `Usuário` · `Perfil` · `Histórico de Alterações`

O DER completo, com cardinalidades e dicionário de dados, está referenciado no Anexo C da ERS.

---

## Arquitetura e tecnologias

> A pilha abaixo é a **proposta** definida na especificação. As restrições obrigatórias são: aplicação web centralizada e banco relacional com transações ACID e integridade referencial declarativa — requisitos indispensáveis para a consistência do controle de estoque.

| Camada | Tecnologia sugerida |
|---|---|
| Frontend | Aplicação web responsiva (SPA) |
| Backend | API REST em arquitetura modular e desacoplada |
| Banco de dados | PostgreSQL ou MySQL |
| Armazenamento de artes | Object storage com URL assinada |
| Autenticação | Credenciais locais com hashing Argon2id ou bcrypt · MFA para Administrador |
| Infraestrutura | Nuvem (AWS, GCP ou Azure), com alternativa on-premises |

**Requisitos não funcionais em destaque:** resposta de consulta em até 2 s · 50 usuários simultâneos · HTTPS/TLS 1.3 · conformidade com a LGPD · acessibilidade WCAG 2.1 AA · uptime de 99,5% · backup diário com retenção de 30 dias · cobertura de testes de 80%, sendo **100% obrigatórios nas rotinas de cálculo de insumos e validação de estoque**.

---

## Estrutura do repositório

```
.
├── docs/
│   ├── ERS_Fabrica_Chinelos_Personalizados.md    # Especificação de Requisitos
│   ├── ERS_Fabrica_Chinelos_Personalizados.docx
│   ├── Documento_Projeto_Software_ABNT.pdf       # Documento de projeto (base)
│   └── diagramas/                                # Casos de uso, DER, BPMN, estados
├── src/
│   ├── backend/
│   └── frontend/
├── tests/
├── database/
│   ├── migrations/
│   └── seeds/
└── README.md
```

---

## Como executar

> O projeto encontra-se em fase de especificação. As instruções abaixo serão detalhadas quando a implementação for iniciada.

```bash
# clonar o repositório
git clone <url-do-repositorio>
cd sgi-chinelos

# configurar variáveis de ambiente
cp .env.example .env

# subir o ambiente de desenvolvimento
docker compose up -d

# executar as migrações e a carga inicial
# (comandos a definir conforme a pilha adotada)
```

**Pré-requisitos previstos:** Docker e Docker Compose, ou instalação local do runtime do backend e do banco relacional.

---

## Documentação

| Documento | Conteúdo |
|---|---|
| **Especificação de Requisitos de Software (ERS/DRS)** | 25 requisitos funcionais, 18 regras de negócio, requisitos não funcionais, interfaces externas e matriz de rastreabilidade |
| **Documento de Projeto de Software (ABNT)** | Base técnica e conceitual que originou a especificação |
| **Diagramas** | Casos de uso (UML), DER, fluxograma BPMN e diagrama de estados do pedido |

Os casos de uso detalhados — RF001 Autenticação, RF005 Registro de Pedido, RF012 Cálculo de Insumos, RF013 Validação de Estoque e RF016 Acompanhamento Produtivo — incluem fluxo principal, fluxos alternativos e pós-condições.

---

## Roadmap

**Versão 1.0 — MVP** (requisitos de prioridade Alta)

- [ ] Autenticação, RBAC e gestão de usuários
- [ ] Cadastro de clientes e eventos
- [ ] Registro completo de pedidos com grade de numeração
- [ ] Cálculo automático de insumos
- [ ] Validação de estoque com reserva e baixa
- [ ] Liberação e acompanhamento produtivo
- [ ] Ficha técnica de produção
- [ ] Log de auditoria

**Versão 1.1** (prioridade Média)

- [ ] Adicionais no pedido e alerta de estoque mínimo
- [ ] Registro de expedição e entrega
- [ ] Consulta avançada de pedidos com filtros combinados

**Versão 1.2** (prioridade Baixa)

- [ ] Relatórios operacionais em PDF e XLSX
- [ ] Notificação por e-mail na mudança de status
- [ ] Etiquetas com código de barras e apontamento por leitor

---

## Fora do escopo

O sistema **não** contempla, nesta versão:

- Emissão de documentos fiscais e integração com SEFAZ
- Funcionalidades financeiras avançadas (contas a pagar/receber, fluxo de caixa, DRE)
- Processamento de pagamentos online
- Loja virtual com autoatendimento do cliente final
- Folha de pagamento e ponto eletrônico
- Roteirização logística e cálculo de frete
- Automação industrial ou comunicação direta com máquinas (CLP/IoT)

---

## Autores

Projeto acadêmico/técnico desenvolvido com base no Documento de Projeto de Software da fábrica de chinelos personalizados.

| Papel | Responsável |
|---|---|
| Análise e especificação | *a preencher* |
| Desenvolvimento | *a preencher* |
| Validação de negócio | *a preencher* |

---

<sub>Versão do documento: 1.0 · Situação: aguardando validação dos stakeholders</sub>
