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

            <form action="{{ route('cariByTgl') }}" method="POST" id="formCari">
                <div class="gap-4 row">
                    <div class="col-md-3">
                        <p>Cari Transaksi :</p>
                        <input type="text" class="form-control">
                    </div>

                    <div class="col-md-3">
                        <p>Tanggal Dari : </p>
                        <input type="date" id="tgl_dari" value="{{ \Carbon\Carbon::now()->startOfMonth()->format('Y-m-d') }}" class="form-control">
                    </div>

                    <div class="col-md-3">
                        <p>Tanggal Sampai :</p>
                        <input type="date" id="tgl_sampai" onchange="" id="dateCari" value="{{ \Carbon\Carbon::now()->lastOfMonth()->format('Y-m-d') }}" class="form-control">
                    </div>
                </div>
            </form>

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
                <tbody id="isiData">
                    <?php $no = 1 ?>
                    @if (!$data)
                        <tr>
                            <td colspan="5"><p class="text-center">Data belum ada .</p></td>
                        </tr>
                    @else
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
                    @endif
                </tbody>
                <tfoot>
                    <tr>
                        <td>
                            <p>Total Data : {{ $data->total() }}</p>
                            {{ $data->links() }}
                        </td>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
</section>



@endsection

<script>
        

        let urlSearchByTgl = "{{ route('cariByTgl') }}"

        function cariByTgl() {
            let dari = document.getElementById("tgl_dari").value
            let sampai = document.getElementById("tgl_sampai").value

            let isi = document.getElementById("isiData")

            // console.log(dari)
            $.ajax({
                url: "{{ route('cariByTgl') }}",
                type: 'GET',
                dataType: "json",
                beforeSend: function (xhr) {
                    var token = $('meta[name="csrf_token"]').attr('content');

                    if (token) {
                        return xhr.setRequestHeader('X-CSRF-TOKEN', token);
                    }
                },  
                data: {
                    tgl_dari: dari,
                    tgl_sampai: sampai
                },
                success: function( data ) {
                    table_post_row(data)
                },
            })
        }

        function table_post_row(res){
            let htmlView = '';
            if(res.data.length <= 0){
                htmlView+= `
                <tr>
                    <td colspan="4">No data.</td>
                </tr>`;
            }
            for(let i = 0; i < res.data.length; i++){
                let str = res.data[i].no_transaksi
                let id = res.data[i].id

                let no_trans = str.replaceAll("/", "")

                let url = '{{ route("bmasukEdit", ":no_trans" ) }}'
                let urlEdit = url.replace(':no_trans', no_trans)
                
                let urlD = '{{ route("bmasukDelete", ":id") }}'
                let urlDelete = url.replace(':no_trans', id)

                htmlView += `
                    <tr>
                        <td>${str}</td>
                        <td>`+res.data[i].tgl_transaksi+`</td>
                        <td>`+res.data[i].kode_supplier+`</td>
                        <td>`+res.data[i].user_buat+`</td>
                        <td>`+res.data[i].user_ubah+`</td>
                        <td>
                            <a href='`+urlEdit+`'>
                                    <button class='btn badge bg-warning'>
                                        Lihat
                                    </button>
                            </a>
                            <a href="`+urlDelete+`">
                                    <button type="submit" class="btn badge bg-danger" onclick="return confirm('yakin dihapus?')">
                                        Hapus
                                    </button>
                            </a>
                        </td>
                    </tr>`;
                }

                $('tbody').html(htmlView);

        }

</script>