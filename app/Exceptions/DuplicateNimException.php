<?php

namespace App\Exceptions;

use Exception;

class DuplicateNimException extends Exception
{
    public function __construct(string $nim)
    {
        parent::__construct("NIM {$nim} sudah terdaftar.");
    }
}
