@extends('layout.header')

@section('content')

    {{--tambah data --}}

    <section class="section">
        <div class="card">
            <div class="card-header">
            </div>
            <div class="card-body">
                <form action="{{ route('bmasukUpdate', $transaksi->no_transaksi) }}" method="POST">
                    @csrf
                    <div class="row">
                        <div class="row -mt-3">
                            <div class="col-md-7 d-flex flex-wrap gap-3">
                                <div class="">
                                    <label for="no_transaksi" class="form-label">No. Transaksi</label>
                                    <input type="text" class="form-control bg-secondary text-white" id="no_transaksi" placeholder="Auto" name="no_transaksi" value="{{ $transaksi->no_transaksi }}" readonly>
                                  </div>
                                  <div class="">
                                    <label for="tgl_transaksi" class="form-label">Tanggal</label>
                                    <input type="date" class="form-control bg-secondary text-white" id="tgl_transaksi" name="tgl_transaksi" value="{{ $transaksi->tgl_transaksi }}" readonly>
                                  </div>
                                </div>
                            </div>
                        </div>
 
                        <div class="row mt-3">
                            <div class="col-md-4">
                                <div class="">
                                    <label for="supplier" class="form-label">Supplier</label>
                                    <input type="text" class="form-control" id="supplier" placeholder="" name="supplier" value="{{ $transaksi->kode_supplier }}">
                                  </div>
                            </div>
                        </div>

                        <table class="table table-hover mt-3" style="">
                            <thead>
                                <tr>
                                    {{-- <th scope="col">No</th> --}}
                                    <th scope="col">Kode Barang</th>
                                    <th scope="col">Nama Barang</th>
                                    <th scope="col">Qty</th>
                                    <th scope="col"></th>
                                </tr>
                            </thead>
                            <tbody class="isiEdit">
                                <?php $no = 0; ?>
                                @foreach ($item_transaksi as $item)
                                
                                <?php $no++ ?>
                                <tr id="row_<?= $no ?>" style="height: 20px">
                                    {{-- <td scope="row">1</td> --}}
                                    <td><input type="text" class="form-control" id="kode_barang_<?php $no = 1; ?>" name="kode_barang[]" value="{{ $item->kode_barang }}"></td>
                                    <td><input type="text" class="form-control" id="nama_barang_<?php $no = 1; ?>" name="nama_barang[]" value="{{ $item->nama_barang }}"></td>
                                    <td><input type="text" class="form-control" id="qty_<?php $no = 1; ?>" name="qty[]" value="{{ $item->qty }}"></td>
                                    <td scope="row"><div id="delete_<?php $no = 1; ?>" class="btn btn-danger delete_row"><i class="bi bi-trash-fill"></i></div></td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>


                        <button class="btn btn-outline-primary px-5" id="addFieldEdit">+ Item</button>
                        
                        <div class="row mt-5">
                            <div class="col-md-6">
                                <label for="keterangan" class="form-label">Keterangan</label>
                                <input type="text" class="form-control" id="keterangan" name="keterangan" value="{{ $transaksi->keterangan }}">
                            </div>
                            <div class="col-md-2">
                                <label for="total_item" class="form-label">Total Item:</label>
                                <input type="text" class="form-control" id="total_item" name="total_item" readonly>
                            </div>
                            <div>
                                <input type="hidden" name="user_buat" value="{{ auth()->user()->name }}">
                            </div>
                        </div>
                        
                            <div class="d-flex gap-3 mt-5">
                                <button class="btn btn-primary px-5" id="addField">+ Tambah</button>
                                <button type="submit" class="btn btn-success px-5" id="addField"><i class="bi bi-floppy2"></i> Simpan</button>
                                <button class="btn btn-dark px-5" id="addField"><i class="bi bi-printer-fill"></i> Print</button>
                            
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>
    @endsection