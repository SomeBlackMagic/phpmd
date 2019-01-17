#!/usr/bin/env bash

composer -vvv install

exec "$@"