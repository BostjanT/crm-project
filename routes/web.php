<?php
/* use App\Exports\CrmSestavljenExport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Route;

Route::get('/export-crm', function () {
    return Excel::download(new CrmSestavljenExport, 'sestavljen_excel.xlsx');
}); */

use App\Exports\CrmExport;
use Maatwebsite\Excel\Facades\Excel;

Route::get('/export-crm', function () {
    return Excel::download(new CrmExport, 'sestavljen_excel.xlsx');
});
