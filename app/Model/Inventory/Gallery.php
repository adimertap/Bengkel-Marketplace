<?php

namespace App\Model\Inventory;

use App\Model\Inventory\DetailSparepart\DetailSparepart;
use App\Model\Inventory\Kelolastock\Stock;
use App\Scopes\OwnershipScope;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Gallery extends Model
{
    use SoftDeletes;

    protected $table = "tb_inventory_master_gallery_sparepart";

    protected $primaryKey = 'id_gallery';

    protected $fillable = [
        'id_detail_sparepart',
        'photo',
        'id_bengkel',
    ];

    protected $hidden =[ 
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    public $timestamps = true;

    public function Detailsparepart(){
        return $this->belongsTo(DetailSparepart::class,'id_detail_sparepart','id_detail_sparepart');
    }

    protected static function booted()
    {
        static::addGlobalScope(new OwnershipScope);
    }
}
