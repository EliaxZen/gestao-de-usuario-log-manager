
# Sistema de Gestão de Usuários - Log Manager

## Descrição
Este é um sistema de gestão de usuários desenvolvido em Laravel para uso interno em empresas. Ele oferece um CRUD de usuários e um dashboard administrativo completo para criação, edição, exclusão e redefinição de senhas. Apenas o administrador tem permissão para gerenciar usuários; vendedores e transportadoras têm permissões limitadas.

## Funcionalidades
- CRUD completo de usuários
- Funções diferenciadas (`administrador`, `vendedor`, `transportadora`)
- Painel administrativo exclusivo para criação e gerenciamento de usuários
- Sistema de login e autenticação com Laravel Breeze
- Controle de permissões: apenas o administrador pode registrar usuários
- Vendedores e transportadoras visualizam uma tela de boas-vindas após o login

## Tecnologias Utilizadas
- **Laravel 8+**: Framework PHP
- **Laravel Breeze**: Sistema de autenticação pronto
- **Tailwind CSS**: Framework CSS para estilização
- **MySQL**: Banco de dados
- **Node.js/NPM**: Para gerenciamento de dependências e build front-end

## Requisitos
- PHP 8.5.22
- Composer
- MySQL
- Node.js e NPM

## Instalação

1. Clone o repositório:
   ```bash
   git clone https://github.com/EliaxZen/gestao-de-usuario-log-manager.git
   ```

2. Instale as dependências do Laravel:
   ```bash
   composer install
   ```

3. Instale as dependências do front-end:
   ```bash
   npm install
   ```

4. Crie o arquivo `.env`:
   ```bash
   cp .env.example .env
   ```

5. Configure as credenciais do banco de dados no arquivo `.env`.

6. Gere a chave da aplicação:
   ```bash
   php artisan key:generate
   ```

7. Execute as migrações para criar as tabelas do banco de dados:
   ```bash
   php artisan migrate
   ```

8. Rode a **seed** para criar o usuário administrador padrão:
   ```bash
   php artisan db:seed --class=UserSeeder
   ```

   Isso criará um usuário administrador com o e-mail `admin@gmail.com` e a senha `password`.

9. Inicie o servidor local:
   ```bash
   php artisan serve
   ```

10. Para monitorar mudanças em arquivos front-end, execute:
    ```bash
    npm run watch
    ```

## Estrutura do Banco de Dados
A tabela `users` inclui os seguintes campos:
- **name**: Nome do usuário
- **email**: E-mail único
- **telefone**: Número de telefone (opcional)
- **password**: Senha
- **tipo**: Define o tipo de usuário (`administrador`, `vendedor`, `transportadora`)
- **sexo**: Gênero do usuário (`Masculino`, `Feminino`)

## Uso
1. **Administrador**: Pode criar, editar e excluir usuários, além de redefinir senhas.
2. **Vendedores e Transportadoras**: Após o login, visualizam uma tela de boas-vindas, sem acesso ao gerenciamento de outros usuários.

## Contribuição
Sinta-se à vontade para abrir issues ou enviar pull requests com melhorias ou correções.

