#!/bin/bash

function help() {

    echo
    echo Available commands;
    echo -e "./analyzer.sh maintenance -- executing code style fixer and running unit tests"

}

if [[ "$1" == "maintenance" ]]; then
    php-cs-fixer fix app/
    php-cs-fixer fix tests/
    php-cs-fixer fix routes/
    phpunit
    exit
fi

help
