# eStracta

Executar o script:

```
$ docker run --rm --interactive --tty --volume $PWD:/app --user $(id -u):$(id -g) composer install

$ docker run -it --rm -v "$PWD":/app -w /app php:7.3-cli php output.php
```
