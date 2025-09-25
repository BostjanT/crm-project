<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class PodatkiCrm extends Model {
    protected $table = 'podatki_crm';
    protected $fillable = [
        'ck_sif','ck_podr','ck_uspr','ck_dspr','ck_zaup13',
        'ck_priimek','ck_ime','ck_ulic','ck_post','ck_kraj','ck_tel1','ck_email','ck_intrs'
    ];
}
