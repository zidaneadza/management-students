<?php

namespace App\Exceptions;

use Exception;

class MahasiswaNotFoundException extends Exception
{
    public function __construct(string $nim)
    {
        parent::__construct("Data mahasiswa dengan NIM {$nim} tidak ditemukan.");
    }
}
