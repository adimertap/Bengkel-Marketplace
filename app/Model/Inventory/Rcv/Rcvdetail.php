<?php

namespace App\Model\Inventory\Rcv;

use App\Model\Inventory\DetailSparepart\DetailSparepart;
use App\Model\Inventory\Gudang;
use App\Model\Inventory\Rak;
use App\Model\Inventory\Sparepart;
use App\Scopes\OwnershipScope;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Rcvdetail extends Model
{

    protected $table = "tb_inventory_detrcv";

    protected $primaryKey = 'id_detail_rcv';

    protected $fillable = [
        'id_rcv',
        'id_detail_sparepart',
        'id_rak',
        'id_gudang',
        'qty_po',
        'qty_rcv',
        'keterangan',
        'harga_diterima',
        'total_harga'

    ];

    protected $hidden =[ 
        'created_at',
        'updated_at'
    ];

    public $timestamps = true;

    public function Rcv()
    {
        return $this->belongsTo(Rcv::class, 'id_rcv','id_rcv');
    }

    public function Sparepart()
    {
        return $this->belongsTo(DetailSparepart::class, 'id_detail_sparepart','id_detail_sparepart');
    }

    public function Rak()
    {
        return $this->belongsTo(Rak::class, 'id_rak','id_rak');
    }

    public function Gudang()
    {
        return $this->belongsTo(Gudang::class, 'id_gudang','id_gudang');
    }

}
