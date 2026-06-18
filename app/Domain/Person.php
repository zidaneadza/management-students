<?php

namespace App\Domain;

abstract class Person
{
    protected string $nama;

    public function __construct(string $nama)
    {
        $this->nama = $nama;
    }

    public function getNama(): string
    {
        return $this->nama;
    }

    public function setNama(string $nama): void
    {
        $this->nama = $nama;
    }
}
