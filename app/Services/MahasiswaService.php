<?php

namespace App\Services;

use App\Domain\Mahasiswa;
use App\Exceptions\DuplicateNimException;
use App\Exceptions\MahasiswaNotFoundException;

class MahasiswaService
{
    private FileStorageService $storageService;
    /**
     * @var Mahasiswa[]
     */
    private array $mahasiswas = [];

    public function __construct(FileStorageService $storageService)
    {
        $this->storageService = $storageService;
        $this->mahasiswas = $this->storageService->load();

        if ($this->mahasiswas === []) {
            $this->seedSampleData();
        }
    }

    /**
     * Menyimpan mahasiswa baru dengan validasi NIM unik.
     */
    public function store(Mahasiswa $mahasiswa): void
    {
        foreach ($this->mahasiswas as $existing) {
            if ($existing->getNim() === $mahasiswa->getNim()) {
                throw new DuplicateNimException($mahasiswa->getNim());
            }
        }

        $this->mahasiswas[] = $mahasiswa;
        $this->persist();
    }

    /**
     * Mengubah data mahasiswa berdasarkan NIM.
     */
    public function update(string $nim, Mahasiswa $updatedMahasiswa): void
    {
        foreach ($this->mahasiswas as $index => $mahasiswa) {
            if ($mahasiswa->getNim() === $nim) {
                $this->mahasiswas[$index] = $updatedMahasiswa;
                $this->persist();

                return;
            }
        }

        throw new MahasiswaNotFoundException($nim);
    }

    /**
     * Menghapus mahasiswa berdasarkan NIM.
     */
    public function delete(string $nim): void
    {
        foreach ($this->mahasiswas as $index => $mahasiswa) {
            if ($mahasiswa->getNim() === $nim) {
                unset($this->mahasiswas[$index]);
                $this->mahasiswas = array_values($this->mahasiswas);
                $this->persist();

                return;
            }
        }

        throw new MahasiswaNotFoundException($nim);
    }

    /**
     * Mendapatkan seluruh data mahasiswa.
     *
     * @return Mahasiswa[]
     */
    public function getAll(): array
    {
        return $this->mahasiswas;
    }

    /**
     * Mencari mahasiswa dengan linear search berdasarkan NIM.
     */
    public function searchByNim(string $nim): ?Mahasiswa
    {
        foreach ($this->mahasiswas as $mahasiswa) {
            if ($mahasiswa->getNim() === $nim) {
                return $mahasiswa;
            }
        }

        return null;
    }

    /**
     * Mencari mahasiswa berdasarkan kata kunci di NIM, nama, jurusan, email, atau IPK.
     *
     * @return Mahasiswa[]
     */
    public function searchByKeyword(string $keyword): array
    {
        $keyword = strtolower($keyword);

        return array_values(array_filter($this->mahasiswas, function (Mahasiswa $mahasiswa) use ($keyword) {
            return str_contains(strtolower($mahasiswa->getNim()), $keyword)
                || str_contains(strtolower($mahasiswa->getNama()), $keyword)
                || str_contains(strtolower($mahasiswa->getJurusan()), $keyword)
                || str_contains(strtolower($mahasiswa->getEmail()), $keyword)
                || str_contains((string) $mahasiswa->getIpk(), $keyword);
        }));
    }

    /**
     * Mencari mahasiswa dengan binary search setelah data diurutkan.
     */
    public function binarySearchByNim(string $nim): ?Mahasiswa
    {
        $sorted = $this->sortByNim();
        $left = 0;
        $right = count($sorted) - 1;

        while ($left <= $right) {
            $mid = intdiv($left + $right, 2);
            if ($sorted[$mid]->getNim() === $nim) {
                return $sorted[$mid];
            }

            if ($sorted[$mid]->getNim() < $nim) {
                $left = $mid + 1;
            } else {
                $right = $mid - 1;
            }
        }

        return null;
    }

    /**
     * Membuat salinan data dan mengurutkannya dengan selection sort.
     */
    public function sortByNim(array $mahasiswas = null): array
    {
        $sorted = $mahasiswas ?? $this->mahasiswas;
        $n = count($sorted);

        for ($i = 0; $i < $n - 1; $i++) {
            $minIndex = $i;
            for ($j = $i + 1; $j < $n; $j++) {
                if ($sorted[$j]->getNim() < $sorted[$minIndex]->getNim()) {
                    $minIndex = $j;
                }
            }

            if ($minIndex !== $i) {
                [$sorted[$i], $sorted[$minIndex]] = [$sorted[$minIndex], $sorted[$i]];
            }
        }

        return $sorted;
    }

    /**
     * Mengurutkan daftar mahasiswa dengan bubble sort.
     */
    public function bubbleSortByNama(array $mahasiswas = null): array
    {
        $sorted = $mahasiswas ?? $this->mahasiswas;
        $n = count($sorted);

        for ($i = 0; $i < $n; $i++) {
            for ($j = 0; $j < $n - $i - 1; $j++) {
                if ($sorted[$j]->getNama() > $sorted[$j + 1]->getNama()) {
                    [$sorted[$j], $sorted[$j + 1]] = [$sorted[$j + 1], $sorted[$j]];
                }
            }
        }

        return $sorted;
    }

    public function sortByIpk(array $mahasiswas = null): array
    {
        $sorted = $mahasiswas ?? $this->mahasiswas;

        usort($sorted, function (Mahasiswa $a, Mahasiswa $b) {
            return $a->getIpk() <=> $b->getIpk();
        });

        return $sorted;
    }

    public function sortByJurusan(array $mahasiswas = null): array
    {
        $sorted = $mahasiswas ?? $this->mahasiswas;

        usort($sorted, function (Mahasiswa $a, Mahasiswa $b) {
            return strcasecmp($a->getJurusan(), $b->getJurusan());
        });

        return $sorted;
    }

    public function sortByEmail(array $mahasiswas = null): array
    {
        $sorted = $mahasiswas ?? $this->mahasiswas;

        usort($sorted, function (Mahasiswa $a, Mahasiswa $b) {
            return strcasecmp($a->getEmail(), $b->getEmail());
        });

        return $sorted;
    }

    public function importFromCsv(string $csvContent): int
    {
        $rows = array_map('str_getcsv', preg_split('/\r\n|\r|\n/', trim($csvContent)) ?: []);
        if (count($rows) < 2) {
            return 0;
        }

        $imported = 0;
        for ($i = 1; $i < count($rows); $i++) {
            if (count($rows[$i]) < 6) {
                continue;
            }

            [$nim, $nama, $jurusan, $ipk, $email, $noHp] = $rows[$i];
            $this->mahasiswas[] = new Mahasiswa($nim, $nama, $jurusan, (float) $ipk, $email, $noHp);
            $imported++;
        }

        $this->persist();

        return $imported;
    }

    /**
     * Menyimpan data ke file melalui storage service.
     */
    private function persist(): void
    {
        $this->storageService->save($this->mahasiswas);
    }

    private function seedSampleData(): void
    {
        $sampleData = [
            ['210001', 'Ayu Lestari', 'Teknik Informatika', 3.75, 'ayu@example.com', '081234567801'],
            ['210002', 'Budi Santoso', 'Sistem Informasi', 3.60, 'budi@example.com', '081234567802'],
            ['210003', 'Citra Dewi', 'Teknik Informatika', 3.85, 'citra@example.com', '081234567803'],
            ['210004', 'Doni Pratama', 'Manajemen Informatika', 3.50, 'doni@example.com', '081234567804'],
            ['210005', 'Eka Putri', 'Teknik Komputer', 3.70, 'eka@example.com', '081234567805'],
            ['210006', 'Fajar Nugroho', 'Sistem Informasi', 3.65, 'fajar@example.com', '081234567806'],
            ['210007', 'Gita Ramadhani', 'Teknik Informatika', 3.90, 'gita@example.com', '081234567807'],
            ['210008', 'Hendra Wijaya', 'Teknik Elektro', 3.55, 'hendra@example.com', '081234567808'],
            ['210009', 'Indah Permata', 'Manajemen Informatika', 3.80, 'indah@example.com', '081234567809'],
            ['210010', 'Joko Widodo', 'Sistem Informasi', 3.45, 'joko@example.com', '081234567810'],
        ];

        foreach ($sampleData as [$nim, $nama, $jurusan, $ipk, $email, $noHp]) {
            $this->mahasiswas[] = new Mahasiswa($nim, $nama, $jurusan, (float) $ipk, $email, $noHp);
        }

        $this->persist();
    }
}
