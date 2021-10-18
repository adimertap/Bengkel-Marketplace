<?php

namespace App\Http\Controllers\AdminMarketplace;

use App\Bank;
use App\Http\Controllers\Controller;
use App\Model\Inventory\DetailSparepart\DetailSparepart;
use App\Model\Inventory\Sparepart;
use Illuminate\Support\Facades\Auth;
use App\Model\Marketplace\Keuangan;
use App\Model\Marketplace\Transaksi;
use Illuminate\Http\Request;

class SparepartMarketplaceController extends Controller
{
    public function index()
    {
        $sparepart = DetailSparepart::with('Sparepart')->get();
        // return $sparepart;


        return view('pages.adminmarketplace.sparepart', [
            'sparepart' => $sparepart
        ]);        
   
    }
    
    public function update(Request $request, $id)
    {
        // return $request;
        $sparepart= DetailSparepart::findOrFail($id);
        $sparepart->keterangan= $request->keterangan;
        $sparepart->harga_market= $request->harga_market;
        $sparepart->update();
        
        return redirect()->back()->with('messageberhasil','Data Sparepart Berhasil Diubah');
    }

        
    //     return redirect()->back()->with('messageberhasil','Pengajuan Penarikan Saldo Berhasil');
    
    // }
}
