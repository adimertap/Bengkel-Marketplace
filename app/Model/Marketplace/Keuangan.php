<?php

namespace App\Model\Marketplace;

use App\Bank;
use App\Model\Accounting\Bankaccount;
use Illuminate\Database\Eloquent\Model;

class Keuangan extends Model
{
  protected $table = "tb_marketplace_keuangan";

    protected $primaryKey = 'id_keuangan';

    protected $fillable = [
       'id_bengkel', 'jumlah', 'nama_bank', 'no_rekening', 'nama_rekening', 'id_bank_account'];

    public function Bank()
    {
        return $this->belongsTo(Bank::class, 'nama_bank', 'id_bank');
    }
    public function Bankacc()
    {
        return $this->belongsTo(Bankaccount::class, 'id_bank_account', 'id_bank_account');
    }
}
