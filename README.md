# LP2 — Sistema de E-commerce

Projeto acadêmico desenvolvido na disciplina de **Linguagem de Programação 2**, na Fatec Bauru.

Aplicação web simples de comércio eletrônico feita com **PHP procedural, HTML, MySQLi e MySQL/MariaDB**, executada localmente com o **XAMPP**. O projeto mantém a estrutura e a aparência utilizadas nas aulas, sem frameworks.

## Funcionalidades

### Área do comprador (`comp/`)

- Listagem de produtos com nome, preço e categoria.
- Pesquisa por **nome do produto**, por **categoria** ou pelos **dois critérios simultaneamente**.
- Opção de visualizar todos os produtos quando nenhum filtro é informado.
- Exibição de produtos sem categoria como **Sem categoria**.
- Carrinho de compras com adição e remoção de produtos, armazenado em cookie, conforme a implementação original.

### Área do vendedor (`vend/`)

- Login, validação de sessão e logout.
- Cadastro, listagem, edição e exclusão de produtos.
- Cadastro, listagem, edição e exclusão de categorias.
- Seleção opcional de categoria ao cadastrar ou editar produtos.
- Exibição da categoria associada aos produtos na listagem administrativa.

A implementação de categorias seguiu a orientação de reaproveitar o CRUD de produtos como referência, acrescentar os controles indispensáveis e utilizar `JOIN` nas consultas que apresentam dados relacionados.

## Organização dos arquivos

```text
sistema/
├── AGENTS.md                  # Regras e orientações para agentes de IA
├── README.md                  # Documentação do projeto
├── banco/
│   └── sistema_estrutura.sql # Estrutura das tabelas, sem dados de contas
├── comp/
│   ├── carrinho.php           # Carrinho de compras
│   ├── config.inc.php
│   └── index.php              # Produtos e pesquisa por nome/categoria
├── layout/
│   ├── header.php
│   ├── footer.php
│   └── ...                    # Imagens existentes da interface
├── vend/
│   ├── categoria/
│   │   ├── index.php          # Listagem de categorias
│   │   ├── add.php            # Cadastro
│   │   ├── upd.php            # Edição
│   │   └── del.php            # Exclusão com confirmação
│   ├── prod/
│   │   ├── index.php          # Produtos e suas categorias
│   │   ├── add.php            # Cadastro com categoria opcional
│   │   ├── upd.php            # Edição com categoria opcional
│   │   └── del.php            # Exclusão de produtos
│   ├── config.inc.php
│   ├── index.php
│   ├── login.php
│   ├── logout.php
│   ├── menu.php               # Links de Produtos e Categorias
│   └── session.php
└── index.php
```

## Banco de dados

A estrutura está documentada em [`banco/sistema_estrutura.sql`](banco/sistema_estrutura.sql). Esse arquivo contém **somente a estrutura** do banco `sistema`, sem dados de usuários, senhas ou produtos.

| Tabela | Campos principais | Finalidade |
| --- | --- | --- |
| `account` | `id`, `username`, `password` | Autenticação do vendedor |
| `categoria` | `categoria_id`, `categoria` | Categorias de produtos |
| `prod` | `id`, `nome`, `preco`, `categoria_id` | Produtos cadastrados |

### Relacionamento

- `prod.categoria_id` é uma chave estrangeira para `categoria.categoria_id`.
- A categoria é **opcional**: `prod.categoria_id` aceita `NULL`.
- A exclusão de uma categoria utiliza **`ON DELETE SET NULL`**: os produtos associados não são excluídos; passam a ficar sem categoria.
- As listagens utilizam `LEFT JOIN` quando é necessário mostrar o nome da categoria sem ocultar produtos sem classificação.
- Na pesquisa do comprador, os critérios informados são combinados na cláusula `WHERE` com `AND`.

Não foi introduzida regra de unicidade para os nomes das categorias, pois ela não fazia parte dos requisitos estabelecidos.

**Atenção:** backups completos do banco, credenciais e outros dados locais devem permanecer fora do repositório. Não versionar o arquivo privado de backup `sistema.sql`.

## Execução local

1. Instale ou inicie o XAMPP com Apache e MySQL/MariaDB.
2. Disponibilize o projeto em `htdocs/sistema` ou em um link simbólico equivalente acessível pelo Apache.
3. Prepare o banco `sistema` com as três tabelas indicadas na estrutura SQL e os dados locais necessários ao login.
4. Confira os parâmetros de conexão MySQLi nos arquivos PHP conforme seu ambiente. A aplicação acadêmica usa o nome de banco `sistema` diretamente nas conexões.
5. Abra **http://localhost/sistema/**.

Os links da aplicação e as imagens pressupõem o caminho `/sistema/`.

### Testes sem alterar o banco principal

Para testes que cadastram, editam ou excluem dados, utilize uma **cópia isolada** do banco (por exemplo, `sistema_teste`) e uma cópia da aplicação configurada para apontar para esse banco. A simples criação de `sistema_teste` não redireciona o código, pois as conexões contêm o nome do banco.

Antes de executar testes destrutivos, confirme a base de dados efetivamente utilizada. Não substitua o banco original sem backup e autorização.

## Implementação das categorias

As modificações foram realizadas de forma incremental:

1. **Preparação do esquema:** tabela `categoria`, coluna opcional `prod.categoria_id` e chave estrangeira com `ON DELETE SET NULL`.
2. **CRUD de categorias:** criação de `vend/categoria/` e inclusão do link no menu do vendedor.
3. **Vínculo dos produtos:** seleção da categoria no cadastro e na edição; exibição na listagem com `LEFT JOIN`.
4. **Pesquisa do comprador:** busca por nome, categoria ou ambos e exibição da categoria dos produtos.
5. **Correção visual:** ajuste da ordem de exibição das células de preço e categoria na tabela administrativa.

A implementação preservou o estilo procedural e os fluxos preexistentes de autenticação e carrinho.

## Validação e limites

Durante o desenvolvimento, foram relatadas as seguintes verificações:

- `php -l` executado nos nove arquivos PHP criados ou modificados, sem erro de sintaxe.
- `git diff --check` sem problemas de whitespace nos arquivos rastreados.
- Testes manuais no navegador e correção de um problema observado na ordenação visual das colunas da listagem administrativa.

Essas verificações não substituem uma suíte automatizada de integração. Para novas mudanças, repetir os testes de cadastro/edição/exclusão de categorias, produtos com e sem categoria, busca combinada, login e carrinho em ambiente isolado.

## Versionamento e preservação

A versão inicial do projeto é identificada pelo commit `03e3a8242bf018e514dea207e6f2a53cec188b00`.

As funcionalidades de categorias foram desenvolvidas na branch `feat/categorias`. A integração à `main` deve ocorrer somente após revisão e autorização do responsável, mantendo a versão original recuperável por commit ou tag. A exclusão da branch de desenvolvimento, quando autorizada, deve ocorrer apenas depois da confirmação do merge e da atualização local.

As regras para trabalhos posteriores e para agentes de IA estão em [`AGENTS.md`](AGENTS.md).
