# Catálogo de Produtos

Aplicação web em Laravel para manter um catálogo simples de produtos. A interface permite cadastrar, consultar, editar e excluir itens. O projeto também inclui um service para centralizar validação e persistência, e testes para as regras de criação e atualização.

## Regras do catálogo

- `nome`: obrigatório, texto de até 255 caracteres.
- `descricao`: opcional.
- `preco`: obrigatório, numérico, maior que zero e com até duas casas decimais.
- `estoque`: obrigatório, inteiro e igual ou maior que zero.

Essas validações são aplicadas em `App\Services\ProductService`, tanto ao criar quanto ao atualizar. Uma falha de validação impede a gravação e retorna erros para a tela.

## Requisitos

- PHP compatível com a versão declarada em `composer.json`.
- Composer.

O projeto usa SQLite por padrão.

## Instalação e execução

Na pasta do projeto:

```bash
composer install
cp .env.example .env
php artisan key:generate
touch database/database.sqlite
php artisan migrate
php artisan db:seed
php artisan serve --host=127.0.0.1 --port=8001
```

Acesse [http://127.0.0.1:8001](http://127.0.0.1:8001). A rota `/` redireciona para `/products`. Se a porta `8001` estiver ocupada, escolha outra porta no comando `serve` e acesse essa porta no navegador.

O comando `php artisan db:seed` cadastra os oito produtos de demonstração da imagem no SQLite. O seeder usa `updateOrCreate`, então pode ser executado novamente sem duplicar esses itens. Ele também é chamado por `DatabaseSeeder`, portanto funciona igualmente com `php artisan db:seed` após uma instalação limpa.

## Como funciona o CRUD

A tela inicial lista os produtos em cartões com nome, descrição, preço e quantidade em estoque. Use **Adicionar produto** para abrir o formulário. A tela de detalhes mostra todas as informações do item e oferece ações para editar ou excluir. A listagem é paginada.

| Operação | Método e rota | Resultado |
| --- | --- | --- |
| Listar | `GET /products` | Exibe o catálogo |
| Abrir formulário de cadastro | `GET /products/create` | Exibe o formulário vazio |
| Cadastrar | `POST /products` | Valida e salva o produto |
| Consultar detalhes | `GET /products/{product}` | Exibe as informações do produto |
| Abrir formulário de edição | `GET /products/{product}/edit` | Exibe os dados atuais para edição |
| Atualizar | `PUT` ou `PATCH /products/{product}` | Valida e salva os campos alterados |
| Excluir | `DELETE /products/{product}` | Remove o produto e retorna à listagem |

Os formulários web usam proteção CSRF do Laravel. Os identificadores `{product}` são resolvidos pelo model binding. O controller delega criação e atualização ao `ProductService`; a listagem, consulta e exclusão usam o model `Product`.

## Service

`App\Services\ProductService` contém:

- `create(array $attributes): Product`: valida todos os campos e persiste o produto apenas se preço e estoque respeitarem as regras.
- `update(Product $product, array $attributes): Product`: valida os campos enviados, aplica somente os atributos recebidos e retorna o model atualizado. Se a validação falhar, o produto permanece sem alterações.

## Testes e verificações

Execute a suíte completa:

```bash
php artisan test --compact
```

Os testes incluem:

1. O service rejeita o cadastro com preço igual a zero e não grava o produto.
2. O service atualiza corretamente os dados de um produto válido.
3. O service rejeita preço negativo na atualização e mantém os dados originais.
4. Um teste de feature percorre o CRUD pela web e confirma que as informações aparecem na tela.

Verificações de estilo, rotas e templates usadas durante o desenvolvimento:

```bash
vendor/bin/pint --format agent
php artisan route:list --except-vendor
php artisan view:cache
php artisan optimize:clear
```

Para verificar se a página responde localmente:

```bash
curl -sS -o /dev/null -w '%{http_code}\n' http://127.0.0.1:8001/products
```

Resposta esperada: `200`.

## Comandos usados para criar a estrutura do projeto

Os comandos abaixo registram as etapas usadas para gerar o Laravel e os arquivos-base do catálogo. O `ProductService` foi escrito diretamente em `app/Services/ProductService.php`.

```bash
composer create-project laravel/laravel catalogo-produtos
cd catalogo-produtos
composer require laravel/boost --dev
php artisan boost:install --no-interaction
php artisan make:model Product --migration --factory --no-interaction
php artisan make:controller ProductController --resource --no-interaction
php artisan make:test --unit ProductServiceTest --phpunit --no-interaction
php artisan make:test --phpunit ProductCatalogTest --no-interaction
```

O último comando foi usado para gerar o arquivo-base do teste de feature, que foi preenchido como `ProductCatalogTest` para verificar o fluxo web. O comando `make:test` unitário também gerou o esqueleto dos testes de `ProductServiceTest`.
