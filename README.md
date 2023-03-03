# Provider de Municípios

Projeto experimental para prover uma API de busca de municípios do Brasil por UF.

## Dependências

| Dependência | Versão |
|-------------|--------|
| PHP         | 8.1+   |
| Composer    | 2+   |
| Laravel     | 10+     |
| guzzlehttp  | 7+     |

## Instalação e Execução

```shell
composer install
php artisan serve
```

O server executará em `localhost` na porta 8000. 

## Swagger

A documentação da API pode ser encontrada [aqui](docs/api.yaml).

## Testes

### Executar toda a pipeline de testes

Executar o comando abaixo na raiz do projeto:

```shell 
composer pipeline
```

Este comando executará uma pipeline contendo testes unitários 
e de integração (PHPUnit), de detecção de código sujo/complexo (Mess Detector)
e de code style no padrão PSR-12 (PHPCS).

### Executar cada step separadamente

Para executar individualmente cada step, você pode utilizar os seguintes comandos:

#### Para executar os testes unitários (PHPUnit):

```shell 
composer phpunit
```

#### Para executar os testes de detecção de código sujo/complexo (Mess Detector):

```shell 
composer phpmd
```

#### Para executar os testes de code style no padrão PSR-12 (PHPCS):

```shell 
composer phpcs
```
