<?php

namespace App\Http\Controllers;

use App\Domain\Mahasiswa;
use App\Exceptions\DuplicateNimException;
use App\Exceptions\FileOperationException;
use App\Exceptions\MahasiswaNotFoundException;
use App\Http\Requests\StoreMahasiswaRequest;
use App\Http\Requests\UpdateMahasiswaRequest;
use App\Services\MahasiswaService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\View\View;

class MahasiswaController extends BaseController
{
    public function __construct(private readonly MahasiswaService $mahasiswaService)
    {
    }

    public function index(Request $request): View
    {
        $keyword = $request->input('keyword', '');
        $search_type = $request->input('search_type', 'linear');
        $sort_field = $request->input('sort_field', '');
        $sort_algo = $request->input('sort_algo', 'bubble');

        $mahasiswas = $this->mahasiswaService->getAll();

        if ($keyword !== '') {
            if ($search_type === 'binary') {
                $found = $this->mahasiswaService->binarySearchByNim($keyword);
                $mahasiswas = $found ? [$found] : [];
            } else {
                $mahasiswas = $this->mahasiswaService->searchByKeyword($keyword);
            }
        }

        if ($sort_field !== '') {
            $mahasiswas = $this->mahasiswaService->sortData($mahasiswas, $sort_field, $sort_algo);
        }

        return view('Mahasiswa.index', compact('mahasiswas', 'keyword', 'search_type', 'sort_field', 'sort_algo'));
    }

    public function create(): View
    {
        return view('Mahasiswa.create');
    }

    public function store(StoreMahasiswaRequest $request): RedirectResponse
    {
        try {
            $mahasiswa = new Mahasiswa(
                $request->input('nim'),
                $request->input('nama'),
                $request->input('jurusan'),
                (float) $request->input('ipk'),
                $request->input('email'),
                $request->input('no_hp')
            );

            $this->mahasiswaService->store($mahasiswa);

            return redirect()->route('mahasiswa.index')->with('success', 'Data mahasiswa berhasil ditambahkan.');
        } catch (DuplicateNimException $e) {
            return back()->withErrors(['nim' => $e->getMessage()])->withInput();
        } catch (FileOperationException $e) {
            return back()->withErrors(['file' => $e->getMessage()])->withInput();
        }
    }

    public function edit(string $nim): View
    {
        $mahasiswa = $this->mahasiswaService->searchByNim($nim);
        if (!$mahasiswa) {
            abort(404);
        }

        return view('Mahasiswa.edit', compact('mahasiswa'));
    }

    public function update(UpdateMahasiswaRequest $request, string $nim): RedirectResponse
    {
        try {
            $updated = new Mahasiswa(
                $request->input('nim'),
                $request->input('nama'),
                $request->input('jurusan'),
                (float) $request->input('ipk'),
                $request->input('email'),
                $request->input('no_hp')
            );

            $this->mahasiswaService->update($nim, $updated);

            return redirect()->route('mahasiswa.index')->with('success', 'Data mahasiswa berhasil diperbarui.');
        } catch (MahasiswaNotFoundException $e) {
            return back()->withErrors(['nim' => $e->getMessage()]);
        } catch (FileOperationException $e) {
            return back()->withErrors(['file' => $e->getMessage()]);
        }
    }

    public function destroy(string $nim): RedirectResponse
    {
        try {
            $this->mahasiswaService->delete($nim);

            return redirect()->route('mahasiswa.index')->with('success', 'Data mahasiswa berhasil dihapus.');
        } catch (MahasiswaNotFoundException $e) {
            return back()->withErrors(['nim' => $e->getMessage()]);
        } catch (FileOperationException $e) {
            return back()->withErrors(['file' => $e->getMessage()]);
        }
    }

    public function search(Request $request): View
    {
        $keyword = $request->input('keyword', '');
        $result = null;

        if ($keyword !== '') {
            $result = $this->mahasiswaService->searchByNim($keyword);
        }

        return view('Mahasiswa.search-result', compact('keyword', 'result'));
    }

    public function export(Request $request): Response
    {
        $format = $request->input('format', 'csv');
        $data = $this->mahasiswaService->getAll();
        $rows = [];

        foreach ($data as $student) {
            $rows[] = [
                $student->getNim(),
                $student->getNama(),
                $student->getJurusan(),
                $student->getIpk(),
                $student->getEmail(),
                $student->getNoHp(),
            ];
        }

        if ($format === 'json') {
            $content = json_encode($rows, JSON_PRETTY_PRINT);
            return response($content, 200, ['Content-Type' => 'application/json', 'Content-Disposition' => 'attachment; filename="mahasiswa.json"']);
        }

        if ($format === 'pdf') {
            $content = "Export PDF belum tersedia di demo ini.\n";
            return response($content, 200, ['Content-Type' => 'application/pdf', 'Content-Disposition' => 'attachment; filename="mahasiswa.pdf"']);
        }

        if ($format === 'excel') {
            $content = "Export Excel belum tersedia di demo ini.\n";
            return response($content, 200, ['Content-Type' => 'application/vnd.ms-excel', 'Content-Disposition' => 'attachment; filename="mahasiswa.xls"']);
        }

        $csv = fopen('php://temp', 'r+');
        fputcsv($csv, ['nim', 'nama', 'jurusan', 'ipk', 'email', 'no_hp']);
        foreach ($rows as $row) {
            fputcsv($csv, $row);
        }
        rewind($csv);
        $content = stream_get_contents($csv);
        fclose($csv);

        return response($content, 200, ['Content-Type' => 'text/csv', 'Content-Disposition' => 'attachment; filename="mahasiswa.csv"']);
    }

    public function import(Request $request): RedirectResponse
    {
        $request->validate([
            'csv_file' => ['required', 'file', 'mimes:csv,txt'],
        ]);

        $content = file_get_contents($request->file('csv_file')->getRealPath());
        $imported = $this->mahasiswaService->importFromCsv((string) $content);

        return redirect()->route('mahasiswa.index')->with('success', 'Berhasil mengimpor ' . $imported . ' data mahasiswa dari CSV.');
    }
}
