<?php

namespace App\Domain;

class Mahasiswa extends Person
{
    private string $nim;
    private string $jurusan;
    private float $ipk;
    private string $email;
    private string $noHp;

    public function __construct(string $nim, string $nama, string $jurusan, float $ipk, string $email, string $noHp)
    {
        parent::__construct($nama);
        $this->nim = $nim;
        $this->jurusan = $jurusan;
        $this->ipk = $ipk;
        $this->email = $email;
        $this->noHp = $noHp;
    }

    public function getNim(): string
    {
        return $this->nim;
    }

    public function setNim(string $nim): void
    {
        $this->nim = $nim;
    }

    public function getJurusan(): string
    {
        return $this->jurusan;
    }

    public function setJurusan(string $jurusan): void
    {
        $this->jurusan = $jurusan;
    }

    public function getIpk(): float
    {
        return $this->ipk;
    }

    public function setIpk(float $ipk): void
    {
        $this->ipk = $ipk;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function setEmail(string $email): void
    {
        $this->email = $email;
    }

    public function getNoHp(): string
    {
        return $this->noHp;
    }

    public function setNoHp(string $noHp): void
    {
        $this->noHp = $noHp;
    }

    public function toArray(): array
    {
        return [
            'nim' => $this->nim,
            'nama' => $this->getNama(),
            'jurusan' => $this->jurusan,
            'ipk' => $this->ipk,
            'email' => $this->email,
            'no_hp' => $this->noHp,
        ];
    }
}
