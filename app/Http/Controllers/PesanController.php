<?php

namespace App\Http\Controllers;
use App\Models\Item;
use App\Models\Pesanan;
use Illuminate\Http\Request;
use Auth;
use Carbon\Carbon;
use App\Models\PesananDetail;

class PesanController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index($id)
    {
    	$item = Item::where('id', $id)->first();

    	return view('pesan.index', compact('item'));
    }

    public function pesan(Request $request, $id)
    {	
    	$item = Item::where('id', $id)->first();
    	$tanggal = Carbon::now();

    	if($request->jumlah_pesan > $item->stok)
    	{
    		return redirect('pesan/'.$id);
    	}

    	$cek_pesanan = Pesanan::where('user_id', Auth::user()->id)->where('status',0)->first();
    	if(empty($cek_pesanan))
    	{
    		$pesanan = new Pesanan;
	    	$pesanan->user_id = Auth::user()->id;
	    	$pesanan->tanggal = $tanggal;
	    	$pesanan->status = 0;
	    	$pesanan->jumlah_barang = 0;
	    	$pesanan->save();
    	}
    	

    	$pesanan_baru = Pesanan::where('user_id', Auth::user()->id)->where('status',0)->first();

    	$cek_pesanandetail = PesananDetail::where('barang_id', $item->id)->where('pesanan_id', $pesanan_baru->id)->first();
    	if(empty($cek_pesanandetail))
    	{
    		$PesananDetail = new PesananDetail;
	    	$PesananDetail->barang_id = $item->id;
	    	$PesananDetail->pesanan_id = $pesanan_baru->id;
	    	$PesananDetail->jumlah = $request->product__quantity;
	    	$PesananDetail->jumlah_harga = $item->harga*$request->product__quantity;
	    	$PesananDetail->save();
    	}else 
    	{
    		$PesananDetail = PesananDetail::where('barang_id', $item->id)->where('pesanan_id', $pesanan_baru->id)->first();

    		$PesananDetail->jumlah = $PesananDetail->jumlah+$request->product__quantity;

    		$harga_pesanandetail_baru = $item->harga*$request->product__quantity;
	    	$PesananDetail->jumlah_harga = $PesananDetail->jumlah_harga+$harga_pesanandetail_baru;
	    	$PesananDetail->update();
    	}

        $pesanan = Pesanan::where('user_id', Auth::user()->id)->where('status', 0)->first();
        $PesananDetail->jumlah_harga += $item->harga * $request->jumlah_pesan;
        $pesanan->update();
    	
    	return redirect('/checkout');

    }

    public function checkout()
    {
        $pesanan = Pesanan::where('user_id', Auth::user()->id)->where('status',0)->first();
 	$PesananDetails = [];
        if(!empty($pesanan))
        {
            $pesanandetails = PesananDetail::where('pesanan_id', $pesanan->id)->get();

        }
        
        return view('pesan.checkout', compact('pesanan', 'pesanandetails'));
    }

    public function delete($id)
    {
        $pesanan_detail = PesananDetail::where('id', $id)->first();

        $pesanan = Pesanan::where('id', $pesanan_detail->pesanan_id)->first();
        $pesanan->update();

        $pesanan_detail->delete();
        return redirect('/checkout');
    }

	public function invoice()
	{
		$pesanan = Pesanan::where('user_id', Auth::user()->id)->where('status', 0)->first();
		$pesanandetails = [];
		
		if (!empty($pesanan)) {
			$pesanandetails = PesananDetail::where('pesanan_id', $pesanan->id)->get();
		}
	
		return view('pesan.invoice', compact('pesanan', 'pesanandetails'));
	}
	
}