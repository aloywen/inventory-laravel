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

    <div class="row">
        <div class="col-12 col-md-6 order-md-1 order-last">
            <a href="{{ route('bmasukAdd'); }}"><button type="button" class="btn btn-primary">
                Tambah Transaksi
            </button></a>

        </div>
    </div>
</div>

{{-- ISI --}}
<section class="section mt-4">
    <div class="card">
        <div class="card-header">
            <h5 class="card-title">
                Data <?= $title ?>
            </h5>
        </div>
        <div class="card-body">
            <table class="table table-striped" id="table1">
                <thead>
                    <tr>
                        <th>Nomor Transaksi</th>
                        <th>Nama Supplier</th>
                        <th>Tanggal Transaksi</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no = 1 ?>
                    @foreach ($data as $u)
                    <tr>
                        <td>{{ $u->no_transaksi }}</td>
                        <td>{{ $u->kode_supplier }}</td>
                        <td>{{ $u->tgl_transaksi }}</td>
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
