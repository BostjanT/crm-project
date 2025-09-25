<?php
namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use App\Models\PodatkiSpletnaTrgovina;
use App\Models\PodatkiCrm;
use App\Models\SeznamEanKod;
use Carbon\Carbon;
use Exception;

class TransferToCrm extends Command {
    protected $signature = 'transfer:crm';
    protected $description = 'Prenese podatke iz podatki_spletna_trgovina v podatki_crm';

    public function handle() {
        $orders = PodatkiSpletnaTrgovina::where('status', 0)->get();
        if ($orders->isEmpty()) {
            $this->info("Ni vrstic za prenos.");
            return 0;
        }

        foreach ($orders as $order) {
            DB::beginTransaction();
            try {
                $nextCkSif = $this->nextCkSif();
                $ck_podr = 1;
                $ean = SeznamEanKod::where('status','vnesen')->lockForUpdate()->first();
                if (!$ean) {
                    $this->error("Ni več prostih EAN kod.");
                    DB::rollBack();
                    return 1;
                }
                $ck_intrs = $this->mapInterestToMask($order->interest);
                PodatkiCrm::create([
                    'ck_sif'=>$nextCkSif,
                    'ck_podr'=>$ck_podr,
                    'ck_uspr'=> get_current_user() ?: 'system',
                    'ck_dspr'=> Carbon::now(),
                    'ck_zaup13'=>$ean->ean,
                    'ck_priimek'=>$order->lastname,
                    'ck_ime'=>$order->firstname,
                    'ck_ulic'=>$order->street,
                    'ck_post'=>$order->zipcode,
                    'ck_kraj'=>$order->city,
                    'ck_tel1'=>$order->phone,
                    'ck_email'=>$order->email,
                    'ck_intrs'=>$ck_intrs
                ]);
                $ean->status='porabljen'; $ean->save();
                $order->status=1; $order->save();
                DB::commit();
                $this->info("Prenesena vrstica id {$order->id}");
            } catch (Exception $e) {
                DB::rollBack();
                $this->error("Napaka: ".$e->getMessage());
            }
        }
        return 0;
    }

    protected function nextCkSif() {
        $used = PodatkiCrm::orderBy('ck_sif')->pluck('ck_sif')->toArray();
        $candidate=1;
        foreach ($used as $u) {
            if ($u==$candidate) $candidate++; elseif ($u>$candidate) break;
        }
        return $candidate;
    }

    protected function mapInterestToMask($interestString) {
        $map=['zm','mm','pc','ph','sm','tk'];
        if (!$interestString) return null;
        $parts=array_map('trim',explode(',',strtolower($interestString)));
        $mask='';
        foreach ($map as $m) $mask .= in_array($m,$parts)?'X':'_';
        return $mask;
    }
}
