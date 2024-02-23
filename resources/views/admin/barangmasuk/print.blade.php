<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ $title ?? 'print' }}</title>

    <link rel="stylesheet" href="{{ url('dist//assets/compiled/css/app.css')}}">
</head>
<body>

    <h5>PT. YAHUUUD</h5>
    <h5 class="re">Jl. Raya Sumber Jaya No.18 Tambun - Bekasi</h5>
    <h5>Telp. 021 22162106
    </h5>

    <h5 class="text-right">No. Transaksi : </h5>

    <div class="row">
        <h5 class="col-md-6">No. RM : </h5>
        <h5 class="col-md-6">Register  : </h5>
    </div>

    <h5 class="re">Nm. pasien :  </h5>

    <div class="row">
        <h5 class="col-md-6">Penanggung : </h5>
        <h5 class="col-md-6">Nm. Dokter : </h5>
    </div>

    <hr class="g">
    <div class="row tes">
        <h5 class="col-md-2">No.</h5>
        <h5 class="col-md-6">Nama Barang</h5>
        <h5 class="col-md-3">Qty</h5>
    </div>
    <hr class="g">
    <?php $no = 1;
    ?>
    <?php foreach ($item_transaksi as $r) : ?>
        <div class="row is">
            <h5 class="col-md-2"><?= $no++ ?></h5>
            <h5 class="col-md-6">{{ $r->nama_barang }}</h5>
            <h5 class="col-md-3">{{ $r->qty }}</h5>
        </div>
    <?php endforeach; ?>
    
    
    <hr class="g">


    <div class="row">
        <div class="col-md-6">
            <h5>Copy Resep</h5>
            <div class="row">
                <div class="col-md-12">
                    <div class="row d-flex-wrap">
                    {{-- <?php foreach ($data_obat as $r) : ?>
                        <?php if($r['ket'] == 'O'){
                            echo "<div class='col-md-6'>";
                            echo "-" .$r['nama'];  echo "  (" .$r['qty']. ")";
                            echo "</div>";
                        }?>
                    <?php endforeach; ?> --}}
                    </div>
                </div>
            </div> 
        </div>
        <div class="col-md-6">
            <h5 class="text-center">Bekasi, <?php date_default_timezone_set('Asia/Jakarta'); 
            echo date('d F Y')
            ?></h5>
            <br>
            <br>
            <br>

        </div>
    </div>



    <script>
        // my()

        function my() {
            window.print();
        }

        window.onafterprint = function () {
            closePrintView()
        }

        function closePrintView() {
            window.location.href =  'http://127.0.0.1:8000/panel/updatebarangmasuk/BM2024020001'
        }
    </script>
    </body>
</html>