# AGENTS.md — Diretrizes para agentes de IA

## 1. Contexto e estado do projeto

Este repositório contém um e-commerce acadêmico desenvolvido na disciplina de **Linguagem de Programação 2**, na Fatec Bauru, usando **PHP procedural, HTML, MySQLi, MySQL/MariaDB e XAMPP**.

O sistema possui área do comprador (`comp/`) e área do vendedor (`vend/`), com autenticação do vendedor, CRUD de produtos, carrinho e pesquisa.

**A implementação das categorias foi concluída na cópia de trabalho da branch `feat/categorias`**, incluindo:
- CRUD de categorias em `vend/categoria/`;
- associação opcional de categoria aos produtos no cadastro e na edição;
- nome da categoria nas listagens de produtos usando `LEFT JOIN`;
- pesquisa do comprador por nome, categoria ou ambos;
- correção visual das colunas da listagem administrativa.

A integração dessa implementação à `main` é uma **operação de versionamento separada**, sujeita à confirmação de que todos os arquivos locais foram commitados e enviados ao repositório remoto. Não confundir documentação atualizada com código PHP já publicado no GitHub.

Consulte o `README.md`, `banco/sistema_estrutura.sql` e os arquivos PHP relevantes antes de trabalhar. Em caso de divergência entre documentação e código, verifique o estado real do checkout e informe a inconsistência.

## 2. Princípios obrigatórios

1. **Prioridade às orientações do professor.** Preservar a organização original e aplicar os requisitos acadêmicos; quando houver várias soluções possíveis, preferir a mais simples compatível com as orientações recebidas.
2. **Não modificar a aparência sem necessidade.** Manter imagens, fontes, cores, cabeçalho, rodapé, tabelas, textos e navegação, exceto alterações expressamente autorizadas e indispensáveis ao objetivo.
3. **Manter a simplicidade do código.** Utilizar PHP procedural, HTML e MySQLi. Não introduzir frameworks, novas dependências, camadas arquiteturais ou refatorações amplas por iniciativa própria.
4. **Respeitar o escopo autorizado.** Identificar o objetivo, localizar os arquivos necessários e atuar somente nos arquivos e operações pertinentes. Não modificar autenticação, sessões ou carrinho sem pedido específico.
5. **Preservar dados e segredos.** Não publicar senhas, hashes, cookies, tokens, informações pessoais, configurações privadas ou dumps com dados. O backup privado `sistema.sql` não pode ser enviado ao repositório.
6. **Isolar testes que alterem dados.** Não executar `INSERT`, `UPDATE`, `DELETE`, migrações ou exclusões no banco principal `sistema` sem autorização explícita. Confirmar a conexão com o banco de testes e manter backup.
7. **Verificar antes de alterar.** Conferir `git status`, branch ativa e trabalho local não commitado. Não descartar modificações anteriores nem utilizar `git push --force`, `git reset --hard` ou `git clean -fd` sem autorização específica.
8. **Preservar autonomia com supervisão.** O agente pode escolher arquivos, skills e técnicas adequadas ao objetivo autorizado; deve solicitar esclarecimento para decisões de negócio não definidas e aprovação antes de ações destrutivas ou fora do escopo.

As regras aplicam-se ao OpenClaw, Adaptive AI Orchestrator, agentes especializados e qualquer trabalhador delegado.

## 3. Política de branches e publicação

- O commit inicial `03e3a8242bf018e514dea207e6f2a53cec188b00` identifica a versão original, recuperável pelo histórico Git; preservar essa referência e, na integração autorizada, registrar uma tag para facilitar sua recuperação.
- A implementação das categorias foi desenvolvida em `feat/categorias`. Até a integração, manter novas alterações dessa entrega nessa branch, sem sobrescrever a `main`.
- O responsável **autorizou preparar a integração da implementação concluída à `main`**, mas isso não autoriza ignorar verificações: primeiro confirmar arquivos locais, commits, sincronização com `origin/feat/categorias` e mudanças pendentes.
- Uma integração à `main` deve ser explícita e revisada, preferencialmente por merge ou Pull Request sem reescrita do histórico. Não criar merges nem publicar alterações adicionais não solicitadas.
- Depois de confirmar que a `main` contém toda a entrega e que a versão original está preservada, a branch temporária poderá ser excluída **somente mediante autorização do responsável**. Não excluir outras branches por suposição.
- Para novos desenvolvimentos, criar uma branch própria quando apropriado. Não presumir que `feat/categorias` continuará existindo depois da entrega.

## 4. Funcionalidades e regras do domínio

- Categorias são cadastradas e mantidas na área do vendedor, reutilizando o padrão do CRUD de produtos.
- A tabela `categoria` possui `categoria_id` e `categoria`; a tabela `prod` possui `id`, `nome`, `preco` e `categoria_id`.
- `prod.categoria_id` é opcional (`NULL`) e referencia `categoria.categoria_id`.
- A chave estrangeira possui `ON DELETE SET NULL`: excluir uma categoria **não exclui** produtos associados.
- Os formulários de cadastro e edição de produtos oferecem a opção **Sem categoria**.
- As listagens de produtos podem apresentar `Sem categoria` quando não houver associação. Usar `LEFT JOIN` para preservar produtos não classificados.
- A busca do comprador admite nome, categoria ou ambos; quando os dois filtros são informados, combinar as condições em `WHERE` com `AND`.
- Não adicionar restrição de nomes únicos de categorias sem novo requisito ou decisão explícita.
- Manter intactos os fluxos originais de login e carrinho quando a tarefa não envolver essas funcionalidades.

O esquema versionado está em `banco/sistema_estrutura.sql` e **não contém os dados de produção**.

## 5. Procedimento de trabalho

1. **Entender o pedido:** ler o estado atual, instruções pertinentes e código necessário; não exigir do responsável um roteiro técnico extenso quando o projeto e as skills puderem orientar a execução.
2. **Analisar impactos:** considerar dependências, esquema do banco, preservação do visual e arquivos já modificados.
3. **Tratar autorização:** tarefas de leitura não autorizam escrita; pedidos de implementação autorizam apenas as alterações necessárias dentro do escopo informado. Solicitar aprovação separada para operações sobre dados principais, publicação e exclusões.
4. **Implementar incrementalmente:** preferir mudanças pequenas; usar consultas preparadas para entradas em SQL e `htmlspecialchars()` na saída HTML quando pertinente, sem refatorar o sistema inteiro.
5. **Validar e relatar:** verificar sintaxe, diferenças Git, regressões e testes funcionais possíveis, distinguindo testes realmente executados daqueles ainda pendentes.
6. **Não publicar automaticamente:** não executar `git commit`, `push`, `merge`, criar tag ou excluir branch sem solicitação expressa para a operação correspondente.

O Adaptive pode selecionar skills e executar em `--single-unit` ou `--multi-agent` conforme a complexidade e a autorização. Nenhum desses modos substitui as regras de escopo, segurança ou validação. Para o modo multiagente, informar explicitamente `--project-root` do projeto.

## 6. Testes e critérios de aceitação

Para mudanças funcionais, quando aplicáveis, verificar:

- Login, validação de sessão e logout do vendedor.
- Cadastro, listagem, edição e exclusão de produtos e categorias.
- Associação e alteração da categoria de um produto, inclusive **Sem categoria**.
- Exclusão de categoria mantendo os produtos e anulando o vínculo.
- Exibição de produtos com e sem categoria na área do vendedor e do comprador.
- Pesquisa sem filtros, por nome, por categoria e pelos dois critérios.
- Preservação das funcionalidades de carrinho, aparência e navegação.
- Sintaxe PHP (`php -l`) e integridade do patch (`git diff --check`), inclusive revisão de arquivos novos não rastreados.
- Estado do Git antes e depois do trabalho (`git status` e arquivos alterados).

O uso de `php -l` **não comprova** o funcionamento com MySQL ou a interface; testes de navegador e banco precisam ser registrados separadamente. Nunca afirmar que um teste foi realizado sem evidência.

## 7. Relato esperado

Ao concluir cada tarefa, apresentar objetivamente:

- Resultado entregue e arquivos envolvidos.
- Decisões técnicas relevantes e justificativas.
- Testes executados e resultados efetivamente observados.
- Alterações locais pendentes de commit ou publicação.
- Riscos, limitações e ações que dependem de aprovação.

**Princípio final:** manter o e-commerce acadêmico simples, funcional e fiel às orientações do professor, permitindo que os agentes executem o trabalho técnico sem ultrapassar a autoridade concedida.
