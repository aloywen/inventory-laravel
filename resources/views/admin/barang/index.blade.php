@extends('layout.header')

@section('content')
    
{{-- TITLE --}}
<div class="page-title">

    @if (session('barangStore'))
        <div class="alert alert-success alert-dismissible show fade">
            {{ session('barangStore') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    @if (session('barangUpdate'))
        <div class="alert alert-success alert-dismissible show fade">
            {{ session('barangUpdate') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    @if (session('barangDelete'))
        <div class="alert alert-success alert-dismissible show fade">
            {{ session('barangDelete') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="row">
        <div class="col-12 col-md-6 order-md-1 order-last">

            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModalLong">
                Tambah Data
            </button>

        </div>
    </div>
</div>

{{-- ISI --}}
<section class="section mt-4">
    <div class="card">
        <div class="card-header">
            <h5 class="card-title">
                Data Barang
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
                        <th>No</th>
                        <th>Kode Barang</th>
                        <th>Nama Barang</th>
                        <th>Stok</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no = 1 ?>
                    @foreach ($barang as $u)
                    <tr>
                        <td>{{ $no++ }}</td>
                        <td>{{ $u->kode_barang }}</td>
                        <td>{{ $u->nama_barang }}</td>
                        <td>{{ $u->stok }}</td>
                        <td>
                            <button class="btn badge bg-warning" data-bs-toggle="modal" data-bs-target="#exampleModalLongEdit{{ $u->id }}">Edit</button>
                            <a href="{{ route('barangDelete', $u->id) }}">
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
            <form action="{{ route('barangStore') }}" method="POST">
                @csrf
                <div class="modal-content">
                    <div class="modal-header bg-primary">
                        <h5 class="modal-title text-white" id="exampleModalLongTitle">Tambah Data Fitur</h5>
                        <button type="button" class="close" data-bs-dismiss="modal"
                            aria-label="Close">
                            <i data-feather="x"></i>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="kode_barang">Kode Barang</label>
                            <input type="text" id="kode_barang" class="form-control" name="kode_barang" required autocomplete="off" value="{{ old('kode_barang') }}">
                        </div>
                        <div class="form-group">
                            <label for="nama_barang">Nama Barang</label>
                            <input type="text" id="nama_barang" class="form-control" name="nama_barang" required autocomplete="off" value="{{ old('nama_barang') }}">
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
@foreach ($barang as $u)
    <div class="modal fade" id="exampleModalLongEdit{{ $u->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <form action="{{ route('barangUpdate',$u->id) }}" method="POST">
                @csrf
                <div class="modal-content">
                    <div class="modal-header bg-primary">
                        <h5 class="modal-title text-white" id="exampleModalLongTitle">Edit Data Barang</h5>
                        <button type="button" class="close" data-bs-dismiss="modal"
                            aria-label="Close">
                            <i data-feather="x"></i>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="kode_barang">Kode Barang</label>
                            <input type="text" id="kode_barang" value="{{ $u->kode_barang }}" class="form-control" name="kode_barang" required autocomplete="off">
                        </div>
                        <div class="form-group">
                            <label for="nama_barang">Nama Barang</label>
                            <input type="text" id="nama_barang" value="{{ $u->nama_barang }}" class="form-control" name="nama_barang" required autocomplete="off">
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
