<?php

namespace App\Exports;

use App\Models\User;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class UserExport implements FromCollection, WithHeadings, ShouldAutoSize
{
    /**
    * @return \Illuminate\Support\Collection
    */
    protected $dataCollection;

    public function __construct(Collection $dataCollection)
    {
        $this->dataCollection = $dataCollection;
    }

    public function collection()
    {
        return $this->dataCollection;
    }

    public function headings(): array
    {
        return [
            'ID',
            'Users & Apoteker',
            // 'Apoteker',
            'Pertanyaan-Pra',
            'Jawaban-Pra',
            'Pertanyaan-Final',
            'Jawaban-Final',
        ];
    }


}
