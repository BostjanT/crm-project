<?php
namespace App\Imports;

use App\Models\PodatkiSpletnaTrgovina;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use PhpOffice\PhpSpreadsheet\Shared\Date;

class PodatkiSpletnaTrgovinaImport implements ToModel, WithHeadingRow
{
  public function model(array $row)
  {
    // Pretvorba datuma, če je število
    $birthdate = null;
    if (!empty($row['birthdate'])) {
      if (is_numeric($row['birthdate'])) {
        $birthdate = Date::excelToDateTimeObject($row['birthdate'])->format('Y-m-d');
      } else {
        $birthdate = date('Y-m-d', strtotime($row['birthdate']));
      }
    }

    // Podobno za "date" stolpec (če ga imaš kot datetime)
    $datum = null;
    if (!empty($row['date'])) {
      if (is_numeric($row['date'])) {
        $datum = Date::excelToDateTimeObject($row['date'])->format('Y-m-d H:i:s');
      } else {
        $datum = date('Y-m-d H:i:s', strtotime($row['date']));
      }
    }

    return new PodatkiSpletnaTrgovina([
      'id' => isset($row['id']) ? (int) $row['id'] : null,
      'firstname' => $row['firstname'] ?? null,
      'lastname' => $row['lastname'] ?? null,
      'street' => $row['street'] ?? null,
      'zipcode' => $row['zipcode'] ?? null,
      'city' => $row['city'] ?? null,
      'email' => $row['email'] ?? null,
      'phone' => $row['phone'] ?? null,
      'birthdate' => $birthdate,
      'interest' => $row['interest'] ?? null,
      'gender' => $row['gender'] ?? null,
      'sizes' => $row['sizes'] ?? null,
      'status' => isset($row['status']) ? (int) $row['status'] : 0,
      'mailing' => isset($row['mailing']) ? (int) $row['mailing'] : 0,
      'sms' => isset($row['sms']) ? (int) $row['sms'] : 0,
      'date' => $datum,
    ]);
  }
}
