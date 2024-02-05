@extends('layout.header')

@section('content')
    
{{-- TITLE --}}
<div class="page-title">

    @if (session('loketStore'))
        <div class="alert alert-success alert-dismissible show fade">
            {{ session('loketStore') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    @if (session('loketUpdate'))
        <div class="alert alert-success alert-dismissible show fade">
            {{ session('loketUpdate') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    @if (session('loketDelete'))
        <div class="alert alert-success alert-dismissible show fade">
            {{ session('loketDelete') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="row">
        <div class="col-12 col-md-6 order-md-1 order-last">

            <h3>Loket</h3>
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModalLong">
                Tambah Transaksi
            </button>

        </div>
    </div>
</div>

{{-- ISI --}}
<section class="section mt-4">
    <div class="card">
        <div class="card-header">
            <h5 class="card-title">
                Pengaturan Loket
            </h5>
        </div>
        <div class="card-body">
            <table class="table table-striped" id="table1">
                <thead>
                    <tr>
                        <th>Nomor Loket</th>
                        <th>Nama Loket</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no = 1 ?>
                    @foreach ($data as $u)
                    <tr>
                        <td>{{ $u->nomor_loket }}</td>
                        <td>{{ $u->nama_loket }}</td>
                        <td>
                            <button class="btn badge bg-warning" data-bs-toggle="modal" data-bs-target="#exampleModalLongEdit{{ $u->id }}">Edit</button>
                            <a href="{{ route('loketDelete',$u->id) }}">
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
            <form action="{{ route('loketStore') }}" method="POST">
                @csrf
                <div class="modal-content">
                    <div class="modal-header bg-primary">
                        <h5 class="modal-title text-white" id="exampleModalLongTitle">Tambah Data Loket</h5>
                        <button type="button" class="close" data-bs-dismiss="modal"
                            aria-label="Close">
                            <i data-feather="x"></i>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="nomor_loket">Nomor Loket</label>
                            <input type="text" id="nomor_loket" class="form-control round" name="nomor_loket" required autocomplete="off">
                        </div>
                        <div class="form-group">
                            <label for="nama_loket">Nama Loket</label>
                            <input type="text" id="nama_loket" class="form-control round" name="nama_loket" required autocomplete="off">
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

    {{-- modal edit data --}}
@foreach ($data as $u)
    <div class="modal fade" id="exampleModalLongEdit{{ $u->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <form action="{{ route('loketUpdate', $u->id) }}" method="POST">
                @csrf
                <div class="modal-content">
                    <div class="modal-header bg-primary">
                        <h5 class="modal-title text-white" id="exampleModalLongTitle">Edit Data Loket</h5>
                        <button type="button" class="close" data-bs-dismiss="modal"
                            aria-label="Close">
                            <i data-feather="x"></i>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="nomor_loket">Nomor Loket</label>
                            <input type="text" id="nomor_loket" value="{{ $u->nomor_loket }}" class="form-control round" name="nomor_loket" required autocomplete="off">
                        </div>
                        <div class="form-group">
                            <label for="nama_loket">Nama Loket</label>
                            <input type="text" id="nama_loket" value="{{ $u->nama_loket }}" class="form-control round" name="nama_loket" required autocomplete="off">
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
