<?php

namespace App\Model\Inventory;

use App\Model\Inventory\DetailSparepart\DetailSparepart;
use App\Scopes\OwnershipScope;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;

class Gudang extends Model
{
    use SoftDeletes;
    
    protected $table = "tb_inventory_master_gudang";

    protected $primaryKey = 'id_gudang';

    protected $fillable = [
    	'kode_gudang',
    	'nama_gudang',
        'alamat_gudang',
        'id_bengkel'
    ];

    protected $hidden =[ 
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    public $timestamps = false;

    public static function getId(){
        // return $this->orderBy('id_sparepart')->take(1)->get();
        $getId = DB::table('tb_inventory_master_gudang')->orderBy('id_gudang','DESC')->take(1)->get();
        if(count($getId) > 0) return $getId;
        return (object)[
            (object)[
                'id_gudang'=> 0
            ]
            ];
    }

    public function Sparepart()
    {
        return $this->hasMany(DetailSparepart::class, 'id_gudang','id_gudang');
    }

    public function Rak()
    {
        return $this->belongsTo(Rak::class, 'id_rak','id_rak');
    }

    protected static function booted()
    {
        static::addGlobalScope(new OwnershipScope);
    }

}
