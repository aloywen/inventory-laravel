@extends('layout.header')

@section('content')
    
{{-- TITLE --}}
<div class="page-title">
    <div class="row">
        <div class="col-12 col-md-6 order-md-1 order-last">
            <h3>Users</h3>
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModalLong">
                Tambah Data
            </button>
        </div>
    </div>

    @if (session('userNew'))
        <div class="alert alert-success alert-dismissible show fade">
            {{ session('userNew') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    @if (session('userUpdate'))
        <div class="alert alert-success alert-dismissible show fade">
            {{ session('userUpdate') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    @if (session('userDelete'))
        <div class="alert alert-success alert-dismissible show fade">
            {{ session('userDelete') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    
</div>

{{-- ISI --}}
<section class="section mt-5">
    <div class="card">
        <div class="card-header">
            <h5 class="card-title">
                Data Users
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
            <table class="table table-striped table-responsive" id="table1">
                <thead>
                    <tr>
                        <th>Username</th>
                        <th>Name</th>
                        <th>Role</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $u)
                    <tr>
                        <td>{{ $u->username }}</td>
                        <td>{{ $u->name }}</td>
                        <td>{{ $u->role->name }}</td>
                        <td>
                            <button class="btn badge bg-warning" data-bs-toggle="modal" data-bs-target="#exampleModalLongEdit{{ $u->id }}">Edit</button>
                            <a href="{{ route('userDelete', $u->id) }}">
                                <button class="btn badge bg-danger" onclick="confirm('yakin dihapus?')">Hapus</button>
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
        <form action="{{ route('userStore') }}" method="POST">
            @csrf
            <div class="modal-content">
                <div class="modal-header bg-primary">
                    <h5 class="modal-title text-white" id="exampleModalLongTitle">Tambah Data USer</h5>
                    <button type="button" class="close" data-bs-dismiss="modal"
                        aria-label="Close">
                        <i data-feather="x"></i>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="name">Nama User</label>
                        <input type="text" id="name" class="form-control round" name="name" required autocomplete="off">
                    </div>
                    <div class="form-group">
                        <label for="username">Username</label>
                        <input type="text" id="username" class="form-control round" name="username" required autocomplete="off">
                    </div>
                    <div class="form-group">
                        <label for="role_id">Role</label>
                        {{-- <input type="text" id="role_id" class="form-control round" name="role_id" required autocomplete="off"> --}}
                        <select class="form-select" name="role_id" aria-label="Default select example">
                            <option selected>Role</option>
                            <option value="1">Adminstrator</option>
                            <option value="2">Staff</option>
                          </select>
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
@foreach ($users as $u)
    <div class="modal fade" id="exampleModalLongEdit{{ $u->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <form action={{ route('userUpdate', $u->id) }} method="POST">
                @csrf
                <div class="modal-content">
                    <div class="modal-header bg-primary">
                        <h5 class="modal-title text-white" id="exampleModalLongTitle">Edit Data Role</h5>
                        <button type="button" class="close" data-bs-dismiss="modal"
                            aria-label="Close">
                            <i data-feather="x"></i>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="name">Nama User</label>
                            <input type="text" id="name" value="{{ $u->name }}" class="form-control round" name="name" required autocomplete="off">
                        </div>
                        <div class="form-group">
                            <label for="username">Username</label>
                            <input type="text" id="username" value="{{ $u->username }}" class="form-control round" name="username" required autocomplete="off">
                        </div>
                        <div class="form-group">
                            <label for="name">Role</label>
                            <select id="role_id" name="role_id" class="form-control">
                                <option selected value="{{ $u->role_id }}">{{ $u->role->name }}</option>
                                <option value="1">Adminstrator</option>
                                <option value="2">Staff</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="name">Status</label>
                            <input type="text" id="name" value="{{ $u->status }}" class="form-control round" name="name" required autocomplete="off">
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
