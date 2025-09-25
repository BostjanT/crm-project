<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\MultiSheetImport;

class ExcelImportSeeder extends Seeder
{
    public function run()
    {
        $file = database_path('seeders/podatki-test.xlsx');

        if (!file_exists($file)) {
            $this->command->error("Datoteka $file ne obstaja. Prosim kopirajte podatki-test.xlsx v database/seeders/.");
            return;
        }

        // Importiraj vse potrebne sheete preko MultiSheetImport
        Excel::import(new MultiSheetImport(), $file);

        $this->command->info("Podatki iz $file so bili uvoženi (podatki_spletna_trgovina + seznam_ean_kod).");
    }
}
