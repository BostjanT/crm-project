<?php
namespace App\Exports;

use App\Models\PodatkiCrm;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class CrmExport implements FromCollection, WithHeadings
{
  public function collection()
  {
    return PodatkiCrm::select([
      'ck_priimek',
      'ck_ime',
      'ck_ulic',
      'ck_post',
      'ck_kraj',
      'ck_zaup13'
    ])->get();
  }

  public function headings(): array
  {
    return [
      'Priimek',
      'Ime',
      'Ulica',
      'Poštna številka',
      'Kraj',
      'EAN koda'
    ];
  }
}
