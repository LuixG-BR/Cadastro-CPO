# 📋 Cadastro CPO

Sistema web desenvolvido para cadastro e gerenciamento de registros (CPO Curso Preparatorio de Obreiros), permitindo operações completas de CRUD (Create, Read, Update, Delete).

---

## 🧠 Sobre o Projeto

O sistema tem como objetivo permitir o controle de registros através de uma interface web simples, utilizando PHP no back-end e MySQL como banco de dados.

---

## ⚙️ Funcionalidades

### ➕ Cadastro de Registros
- Inserção de novos dados no sistema
- Formulário HTML integrado com PHP

### 📋 Visualização
- Listagem completa dos registros cadastrados
- Exibição em formato de tabela

### ✏️ Atualização
- Edição de registros existentes
- Atualização de dados no banco

### ❌ Exclusão
- Remoção de registros por ID

---

## 🏗️ Tecnologias Utilizadas

- Front-end:
  - HTML5
  - CSS3
  - JavaScript

- Back-end:
  - PHP

- Banco de Dados:
  - MySQL (mysqli)

---

## 📁 Estrutura do Projeto

```txt
Cadastro-CPO/
│
├── css/
│   └── style.css
│
├── img/
│   └── imagens do sistema
│
├── js/
│   └── script.js
│
├── cadastrar.html
├── cadastrar.php
├── visualizar.php
├── atualizar.html
├── atualizar.php
├── deletar.html
├── deletar.php
├── conexao.php
└── principal.html
```

---

## 🚀 Como Executar

### Pré-requisitos

- PHP 7+
- MySQL
- Servidor local (XAMPP, WAMP ou Laragon)

---

### Passo a passo

1. Clone o repositório:

```bash
git clone https://github.com/LuixG-BR/Cadastro-CPO.git
```

2. Coloque na pasta do servidor:

- XAMPP: `htdocs`
- Laragon: `www`

3. Configure o banco de dados:

- Crie um banco (ex: `cadastro_cpo`)
- Configure o arquivo:

```
conexao.php
```

4. Inicie Apache e MySQL

5. Acesse:

```
http://localhost/Cadastro-CPO/principal.html
```

---

## 🔄 Fluxo do Sistema

1. O usuário acessa a página principal
2. Realiza cadastro de dados
3. Visualiza registros existentes
4. Pode editar ou excluir registros

---


## 🚧 Melhorias Futuras

- Implementação de autenticação de usuários
- Uso de prepared statements (segurança)
- Refatoração para arquitetura MVC
- Validação de dados no backend
- Interface mais moderna (Bootstrap)

---
