# AGENTS.md — Diretrizes para agentes de IA

## 1. Contexto do projeto

Este repositório contém um projeto acadêmico de **Linguagem de Programação 2**, desenvolvido em aula na Fatec Bauru.

É um e-commerce básico, implementado em **PHP procedural, HTML, MySQL/MariaDB e XAMPP**, dividido em áreas de comprador (`comp/`) e vendedor (`vend/`). A interface e a organização do código seguem o conteúdo ensinado pelo professor.

**Objetivo central: acrescentar somente as funcionalidades de categorias solicitadas, sem descaracterizar o projeto.**

Consulte o `README.md` e leia os arquivos relevantes antes de propor alterações. O README descreve a versão existente; funcionalidades previstas não devem ser tratadas como implementadas.

## 2. Regras inegociáveis

1. **Preservar o projeto original.** Nunca modificar, reescrever, fazer merge ou enviar commits para a branch `main`. Ela é a referência da versão original.
2. **Trabalhar apenas na branch autorizada `feat/categorias`**, verificando a branch ativa antes de alterar arquivos. Não executar `git push --force`, `git reset --hard`, `git clean -fd` nem operações destrutivas sem autorização expressa.
3. **Não alterar a aparência do sistema.** Preservar cores, fontes, imagens, cabeçalho, rodapé, menus, tabelas, textos, disposição dos elementos e navegação. Permitir apenas a inclusão discreta dos campos, seletores e links estritamente necessários à nova funcionalidade, seguindo o padrão visual existente.
4. **Preservar a simplicidade acadêmica.** Utilizar PHP procedural, MySQLi e HTML de acordo com o estilo já empregado. Não introduzir frameworks, bibliotecas, gerenciadores de dependências, camadas de arquitetura ou padrões complexos sem autorização.
5. **Não refatorar o código existente fora do escopo.** Não renomear pastas, reformatar arquivos inteiros, reescrever autenticação/sessões/carrinho ou fazer modernizações não solicitadas.
6. **Não alterar o banco de dados original diretamente.** Antes de mudanças de esquema ou dados, confirmar qual banco de testes será usado, o backup existente e a estratégia de migração.
7. **Nunca publicar dados sensíveis.** Não versionar dumps com contas, hashes de senhas, credenciais, cookies, dados pessoais ou configurações locais. Não copiar o backup privado `sistema.sql` para o repositório.
8. **Nenhuma implementação sem aprovação.** Primeiro analisar e apresentar o plano; esperar autorização explícita do responsável pelo projeto antes de editar código ou banco.

Estas regras valem igualmente para o orquestrador, agentes de frontend, backend, banco de dados, teste e quaisquer subagentes. O orquestrador deve repassá-las a todos e conferir seu cumprimento.

## 3. Escopo funcional autorizado para planejamento

O requisito novo, **ainda não implementado**, consiste em:

- Criar cadastro, listagem, edição e exclusão de **categorias** na área do vendedor.
- Associar cada produto a uma categoria por meio de **chave estrangeira** na tabela de produtos.
- Permitir escolher a categoria ao cadastrar e alterar um produto.
- Permitir pesquisa do comprador por **nome do produto**, **categoria** ou **ambos simultaneamente**.
- Manter o funcionamento atual de login, sessão, listagem, CRUD de produtos e carrinho.

A regra de exclusão de categorias com produtos associados e o tratamento de produtos preexistentes deverão ser propostos e aprovados **antes** da implementação. Não pressupor decisões de negócio não fornecidas.

## 4. Procedimento obrigatório: análise antes de código

**Fase A — Somente leitura**

1. Examinar a árvore do projeto e ler os PHP relevantes.
2. Identificar os fluxos existentes de comprador, vendedor, autenticação, produtos, pesquisa e carrinho.
3. Examinar a estrutura real do banco `sistema` em uma cópia de esquema disponibilizada pelo responsável. Não presumir colunas, tipos, constraints ou registros.
4. Apresentar um relatório sucinto com: estado atual, arquivos impactados, arquivos novos necessários, proposta de relacionamento de categorias, compatibilidade com produtos existentes, riscos e testes previstos.
5. Aguardar aprovação explícita.

**Fase B — Implementação incremental, somente após aprovação**

1. Trabalhar em mudanças pequenas e rastreáveis, respeitando o escopo aprovado.
2. Planejar primeiro a alteração do esquema em **banco de testes**, sem substituir o banco original.
3. Implementar categorias na área do vendedor com os mesmos padrões simples dos formulários e menus existentes.
4. Integrar a categoria às operações de produtos.
5. Acrescentar os filtros de busca na área do comprador.
6. Testar cada etapa antes de continuar. Não introduzir mudanças visuais ou estruturais não aprovadas.
7. Antes de cada commit, apresentar resumo dos arquivos alterados, diferenças principais e testes realizados. Não realizar commits ou pushes sem autorização quando o responsável não os tiver solicitado.

## 5. Pontos de atenção técnicos

- Os nomes de tabelas no Linux podem diferenciar maiúsculas e minúsculas; no sistema atual há referências às tabelas `account` e `prod`.
- Os caminhos existentes da aplicação pressupõem acesso por `/sistema/`. Preservar seu funcionamento no XAMPP.
- A aplicação usa PHP procedural e consultas com MySQLi. Em qualquer SQL novo ou alterado, validar entradas e evitar injeção SQL com parâmetros preparados onde aplicável, **sem transformar isso em uma refatoração global**.
- O carrinho utiliza cookies. Mudanças em categorias e filtros não devem interferir no comportamento atual do carrinho.
- Não alterar a autenticação e o formato de hash existente como parte da implementação de categorias sem decisão específica do responsável.
- Manter o idioma português nas telas e a nomenclatura compatível com o restante do projeto.

## 6. Testes e critérios de aceitação

Ao final das alterações aprovadas, verificar no ambiente de testes:

- Login, sessão e logout do vendedor continuam funcionando.
- Cadastro, listagem, edição e exclusão de produtos continuam funcionando.
- Categorias podem ser cadastradas, listadas, editadas e excluídas conforme a regra aprovada.
- Produto pode ser associado a uma categoria e ter sua categoria alterada.
- Pesquisa por nome, por categoria e por ambos retorna os resultados corretos.
- Produtos anteriores à alteração continuam acessíveis após a migração definida.
- Carrinho continua adicionando, exibindo e removendo produtos.
- As telas mantêm visual e navegação equivalentes aos originais, com apenas os novos controles previstos.

Executar `php -l` nos PHP modificados, quando o ambiente permitir, e inspecionar `git diff` e `git diff --check`. Informar claramente quais testes foram efetivamente executados e quais permanecem pendentes. **Não declarar sucesso sem verificar.**

## 7. Colaboração multiagente

- O **orquestrador** coordena a leitura, distribui tarefas delimitadas e centraliza propostas, dúvidas e resultados. Deve impedir alterações concorrentes nos mesmos arquivos.
- O **agente de banco de dados** propõe o esquema e a migração, sem executar no banco original.
- O **agente de backend PHP** mantém funções e fluxos existentes e altera apenas os pontos aprovados.
- O **agente de frontend** apenas acrescenta os controles indispensáveis e não redesenha telas.
- O **agente de testes/revisão** verifica regressões, escopo, diferença de arquivos e conformidade com este documento.

Na dúvida, **não implementar por suposição**: apresentar a decisão pendente e pedir orientação.

## 8. Resultado esperado de cada etapa

Ao reportar uma etapa, indicar:

- O que foi analisado ou alterado.
- Quais arquivos estão envolvidos.
- Por que cada alteração é necessária.
- Quais testes foram feitos e seus resultados.
- Quais riscos, dúvidas ou pendências continuam abertos.

**Princípio final:** acrescentar categorias ao e-commerce do professor, sem transformá-lo em outro sistema.
