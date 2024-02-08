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
<script src="{{ url('dist/assets/static/js/components/dark.js')}}"></script>
<script src="{{ url('dist/assets/extensions/perfect-scrollbar/perfect-scrollbar.min.js')}}"></script>

<script src="{{ url('dist/assets/compiled/js/app.js')}}"></script>


<script src="{{ url('dist/assets/extensions/simple-datatables/umd/simple-datatables.js') }}"></script>
<script src="{{ url('dist/assets/static/js/pages/simple-datatables.js') }}"></script>

<script src="{{ url('dist/assets/extensions/choices.js/public/assets/scripts/choices.js') }}"></script>
<script src="{{ url('dist/assets/static/js/pages/form-element-select.js') }}"></script>

<script>
    $(document).ready(function() {
    var count = 1
        $("#addField").click(function (e) {
        e.preventDefault()
        count++
        $(".isi").append(`
            <tr id="row_${count}" style="height: 20px">
                <td scope="row">${count}</td>
                <td><input type="text" class="form-control" id="kode_barang_${count}" name="kode_barang[]"></td>
                <td><input type="text" class="form-control" id="nama_barang_${count}" name="nama_barang[]"></td>
                <td><input type="text" class="form-control" id="qty_${count}" name="qty[]"></td>
                <td scope="row"><div id="delete_${count}" class="btn btn-danger delete_row"><i class="bi bi-trash-fill"></i></div></td>
            </tr>

        `)
        });

    function getID(element) {
      var id, adArr;
      id = element.attr('id')
      idArr = id.split("_")
      return idArr[idArr.length - 1]
    }

    function deleteRow() {
      var currentEle, rowNo;
      currentEle = $(this);
      rowNo = getID(currentEle)
      console.log('row', rowNo)
      $("#row_"+rowNo).remove()

      getTotal()
    }
    
    function registerEvents() {
      $(document).on('click', '.delete_row', deleteRow)
    }

    registerEvents();
    });
</script>
</body>

</html>