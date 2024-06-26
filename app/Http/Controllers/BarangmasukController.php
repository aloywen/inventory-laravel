<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Barang;
use App\Models\Barangmasuk;
use App\Models\Itemtransaksi;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class BarangmasukController extends Controller
{
    public function index()
    {
        $first = Carbon::now()->startOfMonth()->format('Y-m-d');
        $last = Carbon::now()->lastOfMonth()->format('Y-m-d');
        $data = [
            'title' => 'Barang Masuk',
            'data' => Barangmasuk::whereBetween('tgl_transaksi',[$first,$last])->paginate(2)
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


        // cek nomor transaksi di tabel barang masuk
        if($barang_masuk == null){
            $nomor = '0001';
        } elseif($request->no_transaksi === "Auto"){
            $explode = explode("/", $barang_masuk->no_transaksi);
            $nomor = intval($explode[3])+1;
            $nomor = str_pad($nomor, 4, "0", STR_PAD_LEFT);

            // membuat format nomor traksaksi
            $nomor_transaksi = "$kode_transak/$kode_tahun/$kode_bulan/$nomor";
        } else {
            $nomor_transaksi = $request->no_transaksi;
        }


        DB::transaction(function () use($nomor_transaksi, $kode_b, $request) {
            
            // INSERT DATA TRANSAKSI BARANG MASUK
            $transaksi = [
                    'no_transaksi' => $nomor_transaksi,
                    'tgl_transaksi' => $request->tgl_transaksi,
                    'kode_supplier' => $request->supplier,
                    'user_buat' => $request->user_buat,
                    'user_ubah' => '',
                    'keterangan' => $request->keterangan,
            ];
            $datas = Barangmasuk::create($transaksi);
                
                
                // INSERT DATA ITEM TRANSAKSI
            $index = 0;
            foreach($kode_b as $no){
                $data_item = [
                    'no_transaksi' => $nomor_transaksi,
                    'kode_barang' => $no,
                    'qty' => $request->qty[$index],
                    'tipe' => 'masuk'
                ];
                $index++;
                $data = Itemtransaksi::create($data_item);
            }

            return redirect()->back()->with('bmasukStore', 'Transaksi berhasil ditambah!');


        });

    }
    
    public function edit(Request $request)
    {

        $contoh1 = substr_replace($request->no_transaksi, '/', 2, 0);
        $contoh2 = substr_replace($contoh1, '/', 7, 0);
        $no_transk = substr_replace($contoh2, '/', 10, 0);

        $transaksi = Barangmasuk::where('no_transaksi',$no_transk)->first();

        $item_transaksi = DB::table('item_transaksi')->join('barang', 'item_transaksi.kode_barang', '=', 'barang.kode_barang')->select('item_transaksi.*', 'barang.nama_barang')->get()->where('no_transaksi',$no_transk);

        $data = [
            'title' => 'Edit Barang Masuk',
            'transaksi' => $transaksi,
            'item_transaksi' => $item_transaksi,
        ];

        return view('admin.barangmasuk.edit', $data);
    }

    public function print(Request $request)
    {
        $contoh1 = substr_replace($request->no_transaksi, '/', 2, 0);
        $contoh2 = substr_replace($contoh1, '/', 7, 0);
        $no_transk = substr_replace($contoh2, '/', 10, 0);

        $transaksi = Barangmasuk::where('no_transaksi',$no_transk)->first();

        $item_transaksi = DB::table('item_transaksi')->join('barang', 'item_transaksi.kode_barang', '=', 'barang.kode_barang')->select('item_transaksi.*', 'barang.nama_barang')->get()->where('no_transaksi',$no_transk);

        $data = [
            'title' => 'Print Barang Masuk',
            'transaksi' => $transaksi,
            'item_transaksi' => $item_transaksi,
        ];

        return view('admin.barangmasuk.print', $data);
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

    public function cariBarangByTgl(Request $request)
    {
        $tgl_dari = $request->tgl_dari;
        $tgl_sampai = $request->tgl_sampai;

        if($request->ajax()){

            $query = Barangmasuk::whereBetween('tgl_transaksi',[$tgl_dari,$tgl_sampai])->paginate(2);
            
            
            return response()->json(['data' => $query]);
        }

    }
}
