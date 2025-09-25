<?php
namespace App\Imports;

use App\Models\SeznamEanKod;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use PhpOffice\PhpSpreadsheet\Shared\Date;

class SeznamEanImport implements ToModel, WithHeadingRow
{
  public function model(array $row)
  {
    // Poskrbimo za EAN kodo
    $ean = $row['ean'] ?? $row['ean_koda'] ?? $row['ean koda'] ?? null;

    // Pretvorimo datum, če je številka
    $dzs = null;
    if (!empty($row['dzs'])) {
      if (is_numeric($row['dzs'])) {
        $dzs = Date::excelToDateTimeObject($row['dzs'])->format('Y-m-d');
      } else {
        $dzs = date('Y-m-d', strtotime($row['dzs']));
      }
    }

    return new SeznamEanKod([
      'ean' => $ean,
      'status' => $row['status'] ?? 'vnesen',
      'dzs' => $dzs,
    ]);
  }
}
