# TickX PHP Test

<br>

## Getting Started

You'll need `php-cli` and [Composer](https://getcomposer.org/) to get started.

<br>

## Run project
To start the project, you need to be in the project root folder

```shell
$ composer install
```

<br>

## Run commands
To run the commands, you must use: 
```shell
$ ./command _command_name_ _subcommand_ _parameters_
```
The default `help` command that comes with minicli (`app/Command/Help/DefaultController.php`) auto-generates a tree of available commands:
```shell
$ ./command help
```
_or_
```shell
$ ./command character --help
```

<br>

## Deciding on the architecture used
The architecture used was based on the [minicli] library (https://github.com/minicli/minicli), because it facilitates the development of command line scripts in php.

Client: a client using the Guzzle library for HTTP calls;
Command: directory where the commands to be used with minicli are stored;
Helpers: some additional helpers for the code

## TO-DO
- I didn't have time to do the unit tests and integration tests between the commands
- Create a more organized interface for command responses

Translated with www.DeepL.com/Translator (free version)

<br>

## Author
- Lucas de Melo Aguirre
- lucasdemeloaguirre@gmail.com
- https://www.linkedin.com/in/lucas-de-melo-aguirre/
