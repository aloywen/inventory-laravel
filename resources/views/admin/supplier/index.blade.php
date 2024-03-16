@extends('layout.header')

@section('content')
    
{{-- TITLE --}}
<div class="page-title">

    @if (session('supplierStore'))
        <div class="alert alert-success alert-dismissible show fade">
            {{ session('supplierStore') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    @if (session('supplierUpdate'))
        <div class="alert alert-success alert-dismissible show fade">
            {{ session('supplierUpdate') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    @if (session('supplierDelete'))
        <div class="alert alert-success alert-dismissible show fade">
            {{ session('supplierDelete') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="row">
        <div class="col-12 col-md-6 order-md-1 order-last">
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModalLong">
                Tambah Supplier
            </button> 

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
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
        </div>
        <div class="card-body">
            <table class="table table-striped" id="table1">
                <thead>
                    <tr>
                        <th>Kode Supplier</th>
                        <th>Nama Supplier</th>
                        <th>Alamat</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no = 1 ?>
                    @foreach ($supplier as $u)
                    <tr>
                        <td>{{ $u->kode_supplier }}</td>
                        <td>{{ $u->nama_supplier }}</td>
                        <td>{{ $u->alamat }}</td>
                        <td>
                            {{-- <a href="{{ route('bmasukEdit',$no_trans) }}"> --}}
                                <button class="btn badge bg-warning" data-bs-toggle="modal" data-bs-target="#exampleModalLongEdit{{ $u->id }}">
                                    Lihat
                                </button>
                            {{-- </a> --}}
                            <a href="{{ route('supplierDelete',$u->id) }}">
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

   {{-- modal tambah data --}}
   <div class="modal fade" id="exampleModalLong" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <form action="{{ route('supplierStore') }}" method="POST">
            @csrf
            <div class="modal-content">
                <div class="modal-header bg-primary">
                    <h5 class="modal-title text-white" id="exampleModalLongTitle">Tambah Data Supplier</h5>
                    <button type="button" class="close" data-bs-dismiss="modal"
                        aria-label="Close">
                        <i data-feather="x"></i>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group" id="kode_b">
                        <label for="kode_supplier">Kode Supplier</label>
                        <input type="text" id="kode_supplier" class="form-control" name="kode_supplier" required autocomplete="off" value="{{ old('kode_supplier') }}">
                    </div>
                    <div class="form-group">
                        <label for="nama_supplier">Nama Supplier</label>
                        <input type="text" id="nama_supplier" class="form-control" name="nama_supplier" required autocomplete="off" value="{{ old('nama_supplier') }}">
                    </div>
                    <div class="form-group">
                        <label for="alamat_supplier">Alamat</label>
                        <input type="text" id="alamat_supplier" class="form-control" name="alamat_supplier" required autocomplete="off" value="{{ old('alamat_supplier') }}">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light-secondary"
                        data-bs-dismiss="modal">
                        <i class="bx bx-x d-block d-sm-none"></i>
                        <span class="d-none d-sm-block">Tutup</span>
                    </button>

                    <button type="submit" class="btn btn-success ms-1" data-bs-dismiss="modal">
                        <i class="bx bx-check d-block d-sm-none"></i>
                        <span class="d-none d-sm-block">Simpan</span>
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>

{{-- modal edit data --}}
@foreach ($supplier as $u)
<div class="modal fade" id="exampleModalLongEdit{{ $u->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <form action="{{ route('supplierUpdate',$u->id) }}" method="POST">
            @csrf
            <div class="modal-content">
                <div class="modal-header bg-primary">
                    <h5 class="modal-title text-white" id="exampleModalLongTitle">Edit Data Supplier</h5>
                    <button type="button" class="close" data-bs-dismiss="modal"
                        aria-label="Close">
                        <i data-feather="x"></i>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="kode_supplier">Kode Supplier</label>
                        <input type="text" id="kode_supplier" value="{{ $u->kode_supplier }}" class="form-control" name="kode_supplier" required autocomplete="off">
                    </div>
                    <div class="form-group">
                        <label for="nama_supplier">Nama Supplier</label>
                        <input type="text" id="nama_supplier" value="{{ $u->nama_supplier }}" class="form-control" name="nama_supplier" required autocomplete="off">
                    </div>
                    <div class="form-group">
                        <label for="alamat_supplier">Alamat</label>
                        <input type="text" id="alamat_supplier" value="{{ $u->alamat }}" class="form-control" name="alamat_supplier" required autocomplete="off">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light-secondary"
                        data-bs-dismiss="modal">
                        <i class="bx bx-x d-block d-sm-none"></i>
                        <span class="d-none d-sm-block">Close</span>
                    </button>

                    <button type="submit" class="btn btn-primary ms-1" data-bs-dismiss="modal">
                        <i class="bx bx-check d-block d-sm-none"></i>
                        <span class="d-none d-sm-block">Accept</span>
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>
@endforeach

@endsection
