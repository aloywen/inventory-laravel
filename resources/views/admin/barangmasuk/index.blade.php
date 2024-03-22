@extends('layout.header')

@section('content')
    
{{-- TITLE --}}
<div class="page-title">

    @if (session('bmasukStore'))
        <div class="alert alert-success alert-dismissible show fade">
            {{ session('bmasukStore') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    @if (session('bmasukUpdate'))
        <div class="alert alert-success alert-dismissible show fade">
            {{ session('bmasukUpdate') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    @if (session('bmasukDelete'))
        <div class="alert alert-success alert-dismissible show fade">
            {{ session('bmasukDelete') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    
</div>

{{-- ISI --}}
<section class="section">
    <div class="card">
        <div class="card-header">

            <div class="gap-4 row">
                <div class="col-md-3">
                    <p>Cari Transaksi :</p>
                    <input type="text" class="form-control">
                </div>

                <div class="col-md-3">
                    <p>Tanggal Dari : </p>
                    <input type="date" value="{{ \Carbon\Carbon::now()->startOfMonth()->format('Y-m-d') }}" class="form-control">
                </div>

                <div class="col-md-3">
                    <p>Tanggal Sampai :</p>
                    <input type="date" value="{{ \Carbon\Carbon::now()->lastOfMonth()->format('Y-m-d') }}" class="form-control">
                </div>
            </div>

            <div class="row mt-3">
                <div class="col-12 col-md-6 order-md-1 order-last">
                    <a href="{{ route('bmasukAdd'); }}"><button type="button" class="btn btn-primary">
                        + Tambah Transaksi
                    </button></a>
                </div>
            </div>
        </div>

        <div class="card-body">
            <table class="table table-striped" id="">
                <thead>
                    <tr>
                        <th>Nomor Transaksi</th>
                        <th>Tanggal Transaksi</th>
                        <th>Nama Supplier</th>
                        <th>User Buat</th>
                        <th>User Ubah</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no = 1 ?>
                    @foreach ($data as $u)
                    <tr>
                        <td>{{ $u->no_transaksi }}</td>
                        <td>{{ $u->tgl_transaksi }}</td>
                        <td>{{ $u->kode_supplier }}</td>
                        <td>{{ $u->user_buat }}</td>
                        <td>{{ $u->user_ubah }}</td>
                        <td>
                            <?php
                                $no_trans = str_replace('/', '', $u->no_transaksi);
                                ?>
                            <a href="{{ route('bmasukEdit',$no_trans) }}">
                                <button class="btn badge bg-warning">
                                    Lihat
                                </button>
                            </a>
                            <a href="{{ route('bmasukDelete',$u->id) }}">
                                <button type="submit" class="btn badge bg-danger" onclick="return confirm('yakin dihapus?')">
                                    Hapus
                                </button>
                            </a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</section>



@endsection
