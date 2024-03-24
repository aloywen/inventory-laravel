<footer>
    <div class="footer clearfix mb-0 text-muted">
        <div class="float-start">
            <p>2023 &copy; Mazer</p>
        </div>
        <div class="float-end">
            <p>Crafted with <span class="text-danger"><i class="bi bi-heart-fill icon-mid"></i></span>
                by <a href="https://saugi.me">Saugi</a></p>
        </div>
    </div>
</footer>

</div>
</div>
<script src="{{ url('dist/jquery.min.js')}}"></script>
<script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>
<script src="{{ url('dist/select2.min.js')}}"></script>
<script src="{{ url('dist/assets/static/js/components/dark.js')}}"></script>
<script src="{{ url('dist/assets/extensions/perfect-scrollbar/perfect-scrollbar.min.js')}}"></script>

<script src="{{ url('dist/assets/compiled/js/app.js')}}"></script>


<script src="{{ url('dist/assets/extensions/simple-datatables/umd/simple-datatables.js') }}"></script>
<script src="{{ url('dist/assets/static/js/pages/simple-datatables.js') }}"></script>

{{-- <script src="{{ url('dist/assets/extensions/choices.js/public/assets/scripts/choices.js') }}"></script>
<script src="{{ url('dist/assets/static/js/pages/form-element-select.js') }}"></script> --}}
{{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-3-typeahead/4.0.1/bootstrap3-typeahead.min.js"></script> --}}

<script>
    $(document).ready(function () {
        $('#table1').DataTable();
    });


    $(document).ready(function() {
        $('.js-example-basic-single').select2();
    });


    $(document).ready(function() {

        //TAMBAH BARIS BARANG MASUK
        var count = 1
        $("#addField").click(function (e) {
            e.preventDefault()
            count++
            $(".isi").append(`
            <tr id="row_${count}" style="height: 20px">
                <td><input data-field-name="kode" type="text" class="form-control autoKodebarang" id="kode_barang_${count}" name="kode_barang[]"></td>
                <td><input data-field-name="barang" type="text" class="form-control autoNamabarang" id="nama_barang_${count}" name="nama_barang[]"></td>
                <td><input type="text" class="form-control" id="qty_${count}" name="qty[]"></td>
                <td scope="row"><div id="delete_${count}" class="btn btn-danger delete_row"><i class="bi bi-trash-fill"></i></div></td>
                </tr>
                
                `)
        });


        //TAMBAH BARIS EDIT BARANG MASUK
        let kode = document.getElementsByClassName('isiEdit');
        let o = kode[0]
        let a = o.querySelectorAll("tr")
        // console.log(a.length);
        let no = a.length

        $("#addFieldEdit").click(function (e) {
            e.preventDefault();
            no++
            $(".isiEdit").append(`
                <tr id="row_${no}" style="height: 20px">
                    <td><input type="text" class="form-control" id="kode_barang_${no}" name="kode_barang[]"></td>
                    <td><input type="text" class="form-control" id="nama_barang_${no}" name="nama_barang[]"></td>
                    <td><input type="text" class="form-control" id="qty_${no}" name="qty[]"></td>
                    <td scope="row"><div id="delete_${no}" class="btn btn-danger delete_row"><i class="bi bi-trash-fill"></i></div></td>
                    </tr>
                    
                    `)
        });
    })


    $(document).ready(function() {

        function getID(element) {
        let id, adArr;
        id = element.attr('id')
        idArr = id.split("_")
        return idArr[idArr.length - 1]
        }

        // HAPUS BARIS
        function deleteRow() {
        var currentEle, rowNo; // buat variable element dan no baris

        currentEle = $(this); // element yang sedang diklik

        rowNo = getID(currentEle) // cari no baris yg sedang diklik
        // console.log('row', rowNo)
        $("#row_"+rowNo).remove() // hapus baris sesuai no barisnya
        }
 
        let path = "{{ route('autocompleteKBarang') }}"
        let pathSupplier = "{{ route('autocompleteSupplier') }}"

        // AUTO FILL BARANG MASUK
        function handleNamasupplier() {
            let fieldName, currentEle
            currentEle = $(this);
            
            fieldName = currentEle.data('field-name')

            // console.log('saas',fieldName)

            if(typeof fieldName === 'undefined'){
                return false;
            }

            currentEle.autocomplete({
                minLength: 3,
                source: function( request, response ) {
                    $.ajax({
                    url: pathSupplier,
                    type: 'GET',
                    dataType: "json",
                    data: {
                        search: request.term
                    },
                    success: function( data ) {
                        // console.log(data)
                        var result;
                        result = [
                            {
                            label: request.term+ ' Tidak ada',
                            value: ''
                            }
                        ];
                        // console.log('tes format', res);

                        if(data.length){
                            result = $.map(data, function(obj) {
                            // console.log('apa sih obj', obj)
                            return {
                                label: obj.kode_supplier + ' - ' + obj.nama_supplier,
                                value: obj.nama_supplier,
                                data: obj,
                            }
                            })
                        }

                        // console.log('abis format', result)
                        response(result)
                        
                    }
                });
                },  
                // select: function( event, selectedData ) {
                //     // console.log(selectedData)
                //     if(selectedData && selectedData.item && selectedData.item.data){
                //         var rowNo, data;
                //         rowNo = getID($(this))
                //         // console.log('id',rowNo)
                //         data = selectedData.item.data;
                //         $('#kode_barang_'+rowNo).val(data.kode_barang)
                //         $('#nama_barang_'+rowNo).val(data.nama_barang)

                //     }
                // }
            })

        }

        function handleNamabarang() {
            let fieldName, currentEle
            currentEle = $(this);
            
            fieldName = currentEle.data('field-name')

            // console.log('saas',fieldName)

            if(typeof fieldName === 'undefined'){
                return false;
            }

            currentEle.autocomplete({
                minLength: 3,
                source: function( request, response ) {
                    $.ajax({
                    url: path,
                    type: 'GET',
                    dataType: "json",
                    data: {
                        search: request.term
                    },
                    success: function( data ) {
                        // console.log(data)
                        var result;
                        result = [
                            {
                            label: request.term+ ' Tidak ada',
                            value: ''
                            }
                        ];
                        // console.log('tes format', res);

                        if(data.length){
                            result = $.map(data, function(obj) {
                            // console.log('apa sih obj', obj)
                            return {
                                label: obj.kode_barang + ' - ' + obj.nama_barang + ' - Stok: ' + obj.stok,
                                value: obj.nama_barang,
                                data: obj,
                            }
                            })
                        }

                        // console.log('abis format', result)
                        response(result)
                        
                    }
                });
                },  
                select: function( event, selectedData ) {
                    // console.log(selectedData)
                    if(selectedData && selectedData.item && selectedData.item.data){
                        var rowNo, data;
                        rowNo = getID($(this))
                        // console.log('id',rowNo)
                        data = selectedData.item.data;
                        $('#kode_barang_'+rowNo).val(data.kode_barang)
                        $('#nama_barang_'+rowNo).val(data.nama_barang)
                        $('#qty_'+rowNo).val(1)

                    }
                }
            })

        }
    
        function registerEvents() {
        $(document).on('focus', '.autoNamabarang', handleNamabarang)
        $(document).on('focus', '.autoSupplier', handleNamasupplier)
        $(document).on('click', '.delete_row', deleteRow)
        }

        registerEvents();

    });


    
</script>

</body>

</html>