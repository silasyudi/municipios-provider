# Provider de Municípios

[![Test Coverage](https://api.codeclimate.com/v1/badges/eb2561d54f704d6c0b0d/test_coverage)](https://codeclimate.com/github/silasyudi/municipios-provider/test_coverage)

[![Maintainability](https://api.codeclimate.com/v1/badges/eb2561d54f704d6c0b0d/maintainability)](https://codeclimate.com/github/silasyudi/municipios-provider/maintainability)

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

Para visualizar a cobertura de código, deve-se configurar algum um plugin externo,
como o XDEBUG, por exemplo. A visualização da cobertura de código será exibida no 
console e também criada em HTML no diretório `.phpunit`.

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
