@extends('layout.header')

@section('content')

    {{--tambah data --}}

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
                                    <label for="no_transaksi" class="form-label">No. Transaksi</label>
                                    <input type="email" class="form-control" id="no_transaksi" placeholder="Auto" name="no_transaksi">
                                  </div>
                                  <div class="">
                                    <label for="tgl" class="form-label">Tanggal</label>
                                    <input type="date" class="form-control" id="tgl" name="tgl">
                                  </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>
    @endsection