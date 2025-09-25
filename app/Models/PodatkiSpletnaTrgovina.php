<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class PodatkiSpletnaTrgovina extends Model {
    protected $table = 'podatki_spletna_trgovina';
    public $incrementing = false;
    protected $keyType = 'int';
    protected $fillable = [
        'id','firstname','lastname','street','zipcode','city','email','phone',
        'birthdate','interest','gender','sizes','status','mailing','sms','date'
    ];
}
