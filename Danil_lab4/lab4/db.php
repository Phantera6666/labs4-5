<?php

function db(): PDO
{
    return new PDO(
        "pgsql:host=db;port=5432;dbname=cli_crud",
        "postgres",
        "pass",
        [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]
    );
}
