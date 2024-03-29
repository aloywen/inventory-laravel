@extends('layout.header')

@section('content')

    {{--tambah data --}}
    <div class="page-title">
        @if (session('warning'))
            <div class="alert alert-success alert-dismissible show fade">
                {{ session('warning') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
    </div>

    <section class="section">
        <div class="card">
            <div class="card-header">
            </div>
                <div class="card-body">
                    <form action="{{ route('bmasukStore') }}" method="POST">
                        @csrf
                        <div class="row">
                            <div class="row -mt-3">
                                <div class="col-md-6 d-flex flex-wrap gap-3">
                                    <div class="">
                                        <label for="no_transaksi" class="form-label">No. Transaksi :</label>
                                        <input type="text" class="form-control" id="no_transaksi" placeholder="Auto" value="Auto" name="no_transaksi">
                                    </div>
                                    <div class="">
                                        <label for="tgl_transaksi" class="form-label">Tanggal :</label>
                                        <input type="date" class="form-control" id="tgl_transaksi" name="tgl_transaksi" value="{{ \Carbon\Carbon::now()->format('Y-m-d') }}" readonly>
                                    </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-4">
                                    <div class="">
                                        <label for="supplier" class="form-label">Supplier</label>
                                        <input data-field-name="supplier" type="text" class="form-control autoSupplier" id="supplier" placeholder="" name="supplier">
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
                                <tbody class="isi">
                                    <tr id="row_1" style="height: 20px">
                                        <td>
                                            <input data-field-name="kode" type="text" class="form-control" id="kode_barang_1" name="kode_barang[]" class="form-control autoKodebarang" autocomplete="off" value="">
                                        </td>
                                        <td>
                                            <input data-field-name="barang" type="text" class="form-control  autoNamabarang" id="nama_barang_1" name="nama_barang[]" autocomplete="off">
                                        </td>
                                        <td>
                                            <input type="text" class="form-control" id="qty_1" name="qty[]">
                                        </td>
                                        <td scope="row">
                                            <div id="delete_1" class="btn btn-danger delete_row"><i class="bi bi-trash-fill"></i></div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>


                            <button class="btn btn-outline-primary px-5" id="addField">+ Item</button>
                            
                            <div class="row mt-5">
                                <div class="col-md-6">
                                    <label for="keterangan" class="form-label">Keterangan</label>
                                    <input type="text" class="form-control" id="keterangan" name="keterangan">
                                </div>
                                <div class="col-md-2">
                                    <label for="total_item" class="form-label">Total Item:</label>
                                    <input type="text" class="form-control" id="total_item" name="total_item" readonly>
                                </div>
                                <div>
                                    <input type="hidden" name="user_buat" value="{{ auth()->user()->username }}">
                                </div>
                            </div>
                            
                            <div class="d-flex gap-3 mt-5">
                                <a href="{{ route('bmasukAdd') }}" onclick="return confirm('Tambah transaksi baru?')"><button class="btn btn-primary px-5">+ Tambah</button></a>
                                <button type="submit" class="btn btn-success px-5"><i class="bi bi-floppy2"></i> Simpan</button>
                                <button class="btn btn-dark px-5"><i class="bi bi-printer-fill"></i> Print</button>
                                
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
    @endsection