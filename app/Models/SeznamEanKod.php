<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class SeznamEanKod extends Model {
    protected $table = 'seznam_ean_kod';
    protected $fillable = ['ean','status','dzs'];
}
