<?php

namespace App\Exceptions;

use Exception;

class FileOperationException extends Exception
{
    public function __construct(string $message = 'Terjadi kesalahan saat mengakses file data.')
    {
        parent::__construct($message);
    }
}
