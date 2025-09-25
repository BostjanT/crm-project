<?php
namespace App\Exports;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use App\Models\PodatkiCrm;

class CrmSestavljenExport implements FromCollection, WithHeadings {
    public function collection() {
        return PodatkiCrm::selectRaw("
            CONCAT(ck_ime,' ',ck_priimek) as `ime in priimek`,
            ck_ulic as naslov,
            ck_post as `poštna številka`,
            ck_kraj as pošta,
            ck_zaup13 as `ean koda`
        ")->get();
    }
    public function headings(): array {
        return ['ime in priimek','naslov','poštna številka','pošta','ean koda'];
    }
}
