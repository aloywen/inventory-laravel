@extends('layout.header')

@section('content')
    
{{-- TITLE --}}
<div class="page-title">

    @if (session('fiturStore'))
        <div class="alert alert-success alert-dismissible show fade">
            {{ session('fiturStore') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    @if (session('fiturUpdate'))
        <div class="alert alert-success alert-dismissible show fade">
            {{ session('fiturUpdate') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    @if (session('fiturDelete'))
        <div class="alert alert-success alert-dismissible show fade">
            {{ session('fiturDelete') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="row">
        <div class="col-12 col-md-6 order-md-1 order-last">

            <h3>Fitur</h3>
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
                Data Fitur
            </h5>
        </div>
        <div class="card-body">
            <table class="table table-striped" id="table1">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Fitur</th>
                        <th>Categori</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no = 1 ?>
                    @foreach ($data as $u)
                    <tr>
                        <td>{{ $no++ }}</td>
                        <td>{{ $u->name }}</td>
                        <td>{{ $u->category->name_cat }}</td>
                        <td>
                            <button class="btn badge bg-warning" data-bs-toggle="modal" data-bs-target="#exampleModalLongEdit{{ $u->id }}">Edit</button>
                            <a href="/panel/deletefitur/{{ $u->id }}">
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
            <form action="{{ route('fiturStore') }}" method="POST">
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
                            <label for="name">Nama Fitur</label>
                            <input type="text" id="name" class="form-control round" name="name" required autocomplete="off">
                        </div>
                        <div class="form-group">
                            <label for="name">Category</label>
                            {{-- <input type="text" id="name" class="form-control round" name="category_id" required autocomplete="off"> --}}
                            <div class="form-group">
                                <select class="choices form-select multiple-remove" multiple="multiple">
                                    <optgroup label="Figures">
                                        <option value="romboid">Romboid</option>
                                        <option value="trapeze" selected>Trapeze</option>
                                        <option value="triangle">Triangle</option>
                                        <option value="polygon">Polygon</option>
                                    </optgroup>
                                    <optgroup label="Colors">
                                        <option value="red">Red</option>
                                        <option value="green">Green</option>
                                        <option value="blue" selected>Blue</option>
                                        <option value="purple">Purple</option>
                                    </optgroup>
                                </select>
                            </div>
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
            <form action="/panel/updatefitur/{{ $u->id }}" method="POST">
                @csrf
                <div class="modal-content">
                    <div class="modal-header bg-primary">
                        <h5 class="modal-title text-white" id="exampleModalLongTitle">Edit Data Fitur</h5>
                        <button type="button" class="close" data-bs-dismiss="modal"
                            aria-label="Close">
                            <i data-feather="x"></i>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="name">Nama Fitur</label>
                            <input type="text" id="name" value="{{ $u->name }}" class="form-control round" name="name" required autocomplete="off">
                        </div>
                        <div class="form-group">
                            <label for="name">Category</label>
                            {{-- <input type="text" id="name" value="{{ $u->category_id }}" class="form-control round" name="category_id" required autocomplete="off"> --}}
                            <fieldset class="form-group">
                                <select class="form-select" id="basicSelect">
                                    
                                    <option value="{{ $u->category_id }}">{{ $u->name_cat }}</option>
                                </select>
                            </fieldset>
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
