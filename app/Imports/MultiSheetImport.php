<?php
namespace App\Imports;

use Maatwebsite\Excel\Concerns\WithMultipleSheets;

class MultiSheetImport implements WithMultipleSheets
{
  public function sheets(): array
  {
    return [
      'podatki_spletna_trgovina' => new PodatkiSpletnaTrgovinaImport(),
      'seznam_ean_kod' => new SeznamEanImport(),
    ];
  }
}
