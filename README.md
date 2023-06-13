# Finance API

## Descrição

A **Finance API** é uma API em Laravel para um aplicativo de controle financeiro. Essa API disponibiliza rotas para que os usuários possam criar sua conta e controlar virtualmente suas contas bancárias, cadastrar despesas e ganhos, verificar seu balanço a qualquer momento e separar suas transações em categorias.

É preocupante que, atualmente, muitas pessoas não recebam uma educação financeira adequada desde a infância. A falta de conhecimento sobre finanças pessoais pode levar a más decisões financeiras, dívidas e instabilidade financeira. É essencial ter um controle financeiro eficiente para garantir uma vida segura e estável.

## Instalação

Siga as instruções abaixo para clonar o repositório e executar o projeto Laravel:

1. Clone o repositório:
   ```shell
   git clone https://github.com/MrWillian/finance-api.git
   cd finance-api
   ```

2. Instale as dependências do projeto via Composer:
   ```shell
   composer install
   ```

3. Configure o arquivo `.env` com as informações do banco de dados PostgreSQL e outras configurações necessárias.

4. Execute as migrações do banco de dados:
   ```shell
   php artisan migrate
   ```

5. Gere uma chave de criptografia do aplicativo:
   ```shell
   php artisan key:generate
   ```

6. Execute o servidor de desenvolvimento do Laravel:
   ```shell
   php artisan serve
   ```

7. Acesse a API em `http://localhost:8000`.

## Testes

Para executar os Testes Automatizados, utilize o seguinte comando:
```shell
php artisan test
```

## Detalhes Técnicos

A **Finance API** foi desenvolvida seguindo boas práticas e padrões de projeto. Alguns aspectos técnicos importantes incluem:

- **Padrão MVC**: A API segue o padrão arquitetural Model-View-Controller (MVC), que separa a lógica de negócio, a apresentação e a manipulação de dados em componentes independentes. Isso facilita a manutenção e a escalabilidade do código.

- **Repository Pattern**: O Repository Pattern é utilizado para isolar a lógica de acesso a dados do restante do código. Ele fornece uma abstração para a camada de persistência, permitindo que a API trabalhe com diferentes fontes de dados sem alterar sua lógica principal.

- **Service Pattern**: O Service Pattern é utilizado para separar a lógica de negócio da interação direta com os modelos e os controladores. Os serviços são responsáveis por executar as operações de negócio, enquanto os controladores lidam com a interação com o cliente.

- **Observers**: Observers são utilizados para adicionar comportamentos aos modelos em determinados eventos. 

A **Finance API** utiliza o banco de dados PostgreSQL para armazenar as informações das contas bancárias, transações, categorias e demais dados relevantes. É importante ressaltar que todas as descrições e valores das transações são criptografados no banco de dados, garantindo a segurança dos dados dos usuários. A maior medida que os usuários precisam tomar é garantir que sua senha não seja compartilhada com ninguém que não desejem.

---

Se tiver alguma dúvida ou sugestão, sinta-se à vontade para entrar em contato.
