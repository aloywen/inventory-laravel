<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Barangmasuk;
use App\Models\Itemtransaksi;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class BarangmasukController extends Controller
{
    public function index()
    {
        $data = [
            'title' => 'Barang Masuk',
            'data' => Barangmasuk::all()
        ];

        return view('admin.barangmasuk.index', $data);
    }

    public function add()
    {
        $data = [
            'title' => 'Barang Masuk Baru'
        ];

        return view('admin.barangmasuk.add', $data);
    }

    public function show(Request $request)
    {
        $data = [
            'title' => 'Edit Barang Masuk'
        ];

        return view('admin.barangmasuk.edit', $data);
    }

    public function store(Request $request)
    {
        $barang_masuk = Barangmasuk::latest()->first();
        $kode_transak = "BM";
        $kode_tahun = date('Y');
        $kode_bulan = date('m');

        $i = 0;
        $kode_b = $request->kode_barang;
        // $no_transaksi = $request->no_transaksi;


        // cek nomor transaksi di tabel barang masuk
        if($barang_masuk == null){
            $nomor = '0001';
        } else{
            $explode = explode("/", $barang_masuk->no_transaksi);
            $nomor = intval($explode[3])+1;
            $nomor = str_pad($nomor, 4, "0", STR_PAD_LEFT);
        }

        
        // var_dump($nomor_transaksi);
        
        $nomor_transaksi = "$kode_transak/$kode_tahun/$kode_bulan/$nomor";
        
        $transaksi = [
                'no_transaksi' => $nomor_transaksi,
                'tgl_transaksi' => $request->tgl_transaksi,
                'kode_supplier' => $request->supplier,
                'qty' => $request->qty[$i],
                'user_buat' => $request->user_buat,
                'user_ubah' => '',
                'keterangan' => $request->keterangan,
            ];
            $i++;
            $data = Barangmasuk::create($transaksi);
            // var_dump($transaksi);
            
        
        foreach($kode_b as $no){
            $œnomor_transaksi = "$kode_transak/$kode_tahun/$kode_bulan/$nomor";
            $data_item = [
                'no_transaksi' => $nomor_transaksi,
                'kode_barang' => $no,
                'tipe' => 'masuk'
            ];
            $i++;
            $data = Itemtransaksi::create($data_item);
            // var_dump($data_tem);
        }

        return redirect()->back()->with('bmasukStore', 'Transaksi berhasil ditambah!');
    }
    
    public function edit(Request $request)
    {
        // var_dump($request->no_transaksi);

        $contoh1 = substr_replace($request->no_transaksi, '/', 2, 0);
        $contoh2 = substr_replace($contoh1, '/', 7, 0);
        $no_transk = substr_replace($contoh2, '/', 10, 0);

        // $transaksi = DB::table('barang_masuk')->first()->where('no_transaksi',$no_transk);

        $transaksi = Barangmasuk::where('no_transaksi',$no_transk)->first();

        $item_transaksi = DB::table('item_transaksi')->join('barang', 'item_transaksi.kode_barang', '=', 'barang.kode_barang')->select('item_transaksi.*', 'barang.nama_barang')->get()->where('no_transaksi',$no_transk);
 
        // var_dump($transaksi);
        // var_dump('<br>');
        // var_dump($item_transaksi);

        $data = [
            'title' => 'Edit Barang Masuk',
            'transaksi' => $transaksi,
            'item_transaksi' => $item_transaksi,
        ];

        return view('admin.barangmasuk.edit', $data);
    }

    public function update(Request $request)
    {
        $data = Barangmasuk::find($request->id);
        
        $data->nomor_loket = $request->nomor_loket;
        $data->nama_loket = $request->nama_loket;
        
        $data->save();
        return redirect()->back()->with('bmasukUpdate', 'Transaksi berhasil diupdate!');
    }

    public function delete(Request $request)
    {
        $loket = Barangmasuk::find($request->id);

        $loket->delete();

        return redirect()->back()->with('bmasukDelete', 'Transaksi dihapus!');
    }
}
