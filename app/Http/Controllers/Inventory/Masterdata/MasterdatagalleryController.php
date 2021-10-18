<?php

namespace App\Http\Controllers\Inventory\Masterdata;

use App\Http\Controllers\Controller;
use App\Http\Requests\Inventory\Galleryrequest;
use App\Http\Requests\Inventory\Sparepartrequest;
use App\Model\Inventory\DetailSparepart\DetailSparepart;
use App\Model\Inventory\Gallery;
use App\Model\Inventory\Sparepart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MasterdatagalleryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $gallery = Gallery::with('Detailsparepart')->get();

        return view('pages.inventory.masterdata.gallery.gallery')->with([
            'gallery' => $gallery
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id_detail_sparepart)
    {
        $sparepart = DetailSparepart::with('Sparepart')->find($id_detail_sparepart);
        // $sparepart = Sparepart::all();

        return view('pages.inventory.masterdata.gallery.create')->with([
            'sparepart' => $sparepart
            
        ]);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Galleryrequest $request)
    {
          $image = new Gallery;
  
          if ($request->file('photo')) {
            $imagePath = $request->file('photo');
            $imageName = $imagePath->getClientOriginalName();
           
            $imagePath->move(public_path().'/image/', $imageName); 
            $data[] = $imageName;
          }
  
          $image->photo = $imageName;
          $image->id_detail_sparepart = $request->id_detail_sparepart;
          $image->id_bengkel = $request['id_bengkel'] = Auth::user()->id_bengkel;
        //   $image->id_sparepart = $idSparePart;
          
          $image->save();
  
          return redirect()->route('Detailsparepart-gallery', $request->id_detail_sparepart)->with('messageberhasil','Foto Berhasil ditambahkan');


    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id_gallery)
    {
        $gallery = Gallery::findOrFail($id_gallery);
        $gallery->delete();

        return redirect()->back()->with('messagehapus','Data Foto Sparepart Berhasil dihapus');

        
    }
    
}
