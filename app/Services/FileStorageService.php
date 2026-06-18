<?php

namespace App\Services;

use App\Domain\Mahasiswa;
use App\Exceptions\FileOperationException;

class FileStorageService
{
    private string $filePath;

    public function __construct(string $filePath)
    {
        $this->filePath = $filePath;
    }

    /**
     * Menyimpan daftar mahasiswa ke file JSON.
     */
    public function save(array $mahasiswas): void
    {
        $directory = dirname($this->filePath);
        if (!is_dir($directory)) {
            mkdir($directory, 0755, true);
        }

        $data = array_map(static fn (Mahasiswa $student) => $student->toArray(), $mahasiswas);

        $result = file_put_contents($this->filePath, json_encode($data, JSON_PRETTY_PRINT));
        if ($result === false) {
            throw new FileOperationException('Gagal menyimpan data mahasiswa ke file.');
        }
    }

    /**
     * Membaca daftar mahasiswa dari file JSON.
     *
     * @return Mahasiswa[]
     */
    public function load(): array
    {
        if (!file_exists($this->filePath)) {
            return [];
        }

        $contents = file_get_contents($this->filePath);
        if ($contents === false) {
            throw new FileOperationException('Gagal membaca data mahasiswa dari file.');
        }

        $data = json_decode($contents, true);
        if (!is_array($data)) {
            return [];
        }

        return array_map(function (array $item): Mahasiswa {
            return new Mahasiswa(
                $item['nim'],
                $item['nama'],
                $item['jurusan'],
                (float) $item['ipk'],
                $item['email'],
                $item['no_hp']
            );
        }, $data);
    }
}
