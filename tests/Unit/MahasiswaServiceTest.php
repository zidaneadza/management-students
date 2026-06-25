<?php

namespace Tests\Unit;

use App\Domain\Mahasiswa;
use App\Services\FileStorageService;
use App\Services\MahasiswaService;
use PHPUnit\Framework\TestCase;

class MahasiswaServiceTest extends TestCase
{
    private function createTempFilePath(string $name): string
    {
        return __DIR__ . '/../temp/' . $name;
    }

    public function test_it_can_store_and_list_mahasiswa(): void
    {
        $filePath = $this->createTempFilePath('mahasiswa_test.json');
        if (file_exists($filePath)) {
            unlink($filePath);
        }

        $storageService = new FileStorageService($filePath);
        $service = new MahasiswaService($storageService);

        $initialCount = count($service->getAll());

        $mahasiswa = new Mahasiswa('20231001', 'Budi Santoso', 'Teknik Informatika', 3.75, 'budi@example.com', '081234567890');
        $service->store($mahasiswa);

        $students = $service->getAll();

        $this->assertCount($initialCount + 1, $students);
        $this->assertSame('Budi Santoso', end($students)->getNama());
        $this->assertSame('20231001', end($students)->getNim());
    }

    public function test_it_can_search_mahasiswa_by_nim(): void
    {
        $filePath = $this->createTempFilePath('mahasiswa_search_test.json');
        if (file_exists($filePath)) {
            unlink($filePath);
        }

        $storageService = new FileStorageService($filePath);
        $service = new MahasiswaService($storageService);

        $service->store(new Mahasiswa('20231001', 'Budi Santoso', 'Teknik Informatika', 3.75, 'budi@example.com', '081234567890'));
        $service->store(new Mahasiswa('20231002', 'Ani Rahma', 'Sistem Informasi', 3.90, 'ani@example.com', '081111111111'));

        $result = $service->searchByNim('20231002');

        $this->assertNotNull($result);
        $this->assertSame('Ani Rahma', $result->getNama());
    }
}
