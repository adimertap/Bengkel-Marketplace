<?php

namespace App\Model\Inventory\Purchase;

use App\Model\Inventory\DetailSparepart\DetailSparepart;
use App\Model\Inventory\Hargasparepart;
use App\Model\Inventory\Sparepart;
use App\Scopes\OwnershipScope;
use Illuminate\Database\Eloquent\Model;


class POdetail extends Model
{
    protected $table = "tb_inventory_detpo";

    protected $primaryKey = 'id_detail_po';

    protected $fillable = [
        'id_po',
        'id_detail_sparepart',
        'qty',
        'qty_po_sementara'
    ];

    protected $hidden =[ 
        'created_at',
        'updated_at',
    ];

    public $timestamps = true;

    public function PO()
    {
        return $this->belongsTo(PO::class, 'id_po','id_po');
    }

    public function Sparepart()
    {
        return $this->belongsTo(DetailSparepart::class, 'id_detail_sparepart','id_detail_sparepart');
    }

    
}
