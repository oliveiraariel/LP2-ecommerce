# LP2 — Sistema de E-commerce

Projeto acadêmico desenvolvido na disciplina **Linguagem de Programação 2**, na Fatec Bauru.

O objetivo é estudar a construção de uma aplicação web simples de comércio eletrônico, utilizando **PHP procedural**, **HTML** e **MySQL/MariaDB**, com execução local no **XAMPP**.

## Funcionalidades existentes

### Área do comprador (`comp/`)
- Listagem dos produtos cadastrados.
- Pesquisa de produtos pelo nome.
- Carrinho de compras com adição e remoção de produtos, armazenado em cookie.

### Área do vendedor (`vend/`)
- Tela de login.
- Validação de usuário e controle de sessão.
- Logout.
- Listagem, cadastro, edição e exclusão de produtos.

## Tecnologias

- PHP procedural, com extensão MySQLi.
- HTML e JavaScript básico.
- MySQL/MariaDB.
- Apache (ambiente local XAMPP).

O projeto não utiliza frameworks de aplicação.

## Organização dos arquivos

```text
sistema/
├── comp/
│   ├── carrinho.php       # Carrinho do comprador
│   ├── config.inc.php     # Identificação visual da área do comprador
│   └── index.php          # Lista e pesquisa de produtos
├── layout/
│   ├── header.php         # Cabeçalho compartilhado
│   ├── footer.php         # Rodapé compartilhado
│   └── ...                # Imagens da interface
├── vend/
│   ├── config.inc.php     # Identificação visual da área do vendedor
│   ├── index.php          # Página inicial do vendedor
│   ├── login.php          # Formulário de login
│   ├── logout.php         # Encerramento da sessão
│   ├── menu.php           # Menu do vendedor
│   ├── session.php        # Autenticação e controle da sessão
│   └── prod/
│       ├── index.php      # Lista de produtos
│       ├── add.php        # Cadastro de produto
│       ├── upd.php        # Edição de produto
│       └── del.php        # Exclusão de produto
└── index.php              # Redirecionamento para a área do comprador
```

## Banco de dados

A aplicação utiliza o banco **`sistema`**, que, na versão inicial, contém:

| Tabela | Campos | Finalidade |
| --- | --- | --- |
| `account` | `id`, `username`, `password` | Contas para autenticação do vendedor |
| `prod` | `id`, `nome`, `preco` | Cadastro de produtos |

Nesta versão, não há uma tabela de categorias nem relacionamento por chave estrangeira entre produtos e categorias.

**Atenção:** o backup completo do banco, com eventuais contas e senhas armazenadas em hash, deve ser mantido fora deste repositório. O arquivo SQL do banco não está incluído aqui.

## Execução local

1. Tenha o XAMPP instalado com Apache e MySQL/MariaDB.
2. Disponibilize o código no caminho `htdocs/sistema` ou configure um link simbólico equivalente que seja acessível pelo Apache.
3. Crie o banco de dados `sistema` e restaure sua estrutura e os dados necessários a partir de uma cópia local apropriada.
4. Verifique as configurações de conexão ao MySQL nos arquivos PHP, de acordo com seu ambiente local.
5. Inicie o Apache e o banco de dados.
6. Acesse `http://localhost/sistema/` no navegador.

Os caminhos de navegação e das imagens presentes no código pressupõem que a aplicação seja servida em `/sistema/`.

## Desenvolvimento previsto: categorias

**As funcionalidades abaixo ainda não estão implementadas.**

- Cadastrar, listar, editar e excluir categorias.
- Criar o relacionamento de uma categoria para vários produtos, com chave estrangeira em `prod`.
- Selecionar uma categoria ao cadastrar um produto.
- Alterar a categoria ao editar um produto.
- Permitir que o comprador pesquise por nome do produto, por categoria ou pelos dois critérios.

A implementação deve preservar os produtos já cadastrados e definir como tratar a exclusão de categorias que possuam produtos vinculados.

## Preservação do projeto acadêmico

As futuras alterações devem respeitar a organização das pastas, a aparência das telas e a simplicidade do código desenvolvido em aula. Não há intenção de redesenhar a interface, trocar a tecnologia ou reestruturar a aplicação sem necessidade.

A branch `main` é a referência da versão inicial. A branch `feat/categorias` é destinada ao desenvolvimento das funcionalidades adicionais.

Instruções específicas para agentes de IA serão mantidas separadamente em `AGENTS.md`.
