{{-- START NEW COMPANY --}}
<div class="modal fade" id="modalEditGuitsetgel">
  <div class="modal-dialog" style="width:80%;">
    <div class="modal-content">

      <div class="modal-header">
        <span class="red-required">* - той талбарыг заавал бөглөнө үү!!!</span>
        <button type="button" class="close" data-dismiss="modal">X</button>
      </div>

      <div class="modal-body">
        <h2 style="text-align:center;"><strong>Аж ахуйн нэгжийн гүйцэтгэлийн бүртгэл</strong></h2>
        <form id="frmEditGuitsetgel" action="{{ action('GuitsetgelController@update')}}" method="post" data-parsley-validate class="form-horizontal form-label-left">
          @csrf
          <div class="form-group col-md-3 text-left">
            <label>Аж ахуйн нэгжийн нэр <span class="red-required">*</span> </label>
            <input type="hidden" id="txtEditGID" name="id" class="form-control" />
            <select name='companyID' class="form-control" id="cmbEditGCompany" disabled>

              @foreach ($companies as $company)
                  <option value="{{$company->id}}">{{$company->companyName}}</option>
              @endforeach

            </select>
          </div>
          <div class="form-group col-md-3 text-left">
            <label>Огноо <span class="red-required">*</span> </label>
            <input type="date" id="txtEditOgnoo" name="ognoo" class="form-control" required />
          </div>

          <div class="clearfix"></div>
          <script type="text/javascript">

          var getExecByCompany = "{{url("/guitsetgel/getExecByCompany")}}";
          var execEditRow = "";
              $(document).ready(function(){
                $('#editExecTable').DataTable( {
                    "language": {
                        "lengthMenu": "_MENU_ мөрөөр харах",
                        "zeroRecords": "Хайлт илэрцгүй байна",
                        "info": "Нийт _PAGES_ -аас _PAGE_-р хуудас харж байна ",
                        "infoEmpty": "Хайлт илэрцгүй",
                        "infoFiltered": "(_MAX_ мөрөөс хайлт хийлээ)",
                        "sSearch": "Хайх: ",
                        "paginate": {
                          "previous": "Өмнөх",
                          "next": "Дараахи"
                        }
                    },
                    "processing": true,
                    "serverSide": true,
                    "ajax":{
                             "url": getExecByCompany,
                             "dataType": "json",
                             "type": "POST",
                             "data":{
                                  comID: dataRow["id"],
                                  _token: "{{ csrf_token() }}"
                                }
                           },
                    "columns": [
                        { data: "id", name: "id" },
                        { data: "workTypeID", name: "workTypeID"},
                        { data: "workID", name: "workID"},
                        { data: "date", name: "date"},
                        { data: "execution", name: "execution" }

                      ]
                });
              });
              $(document).ready(function(){
              $('#editExecTable tbody').on( 'click', 'tr', function () {
                  var currow = $(this).closest('tr');
                  $('#editExecTable tbody tr').css("background-color", "white");
                  $(this).closest('tr').css("background-color", "yellow");
                  execEditRow = $('#editExecTable').DataTable().row(currow).data();
                  // alert(dataRow["companyName"]);
                });
              });
          </script>
          <table id="editExecTable" class="table table-striped table-bordered" style="width:100%;">
              <thead>
                  <tr>
                      <th>ID</th>
                      <th>Ажлын төрөл</th>
                      <th>Хийх ажил</th>
                      <th>Огноо</th>
                      <th>Гүйцэтгэл</th>
                  </tr>
              </thead>
          </table>
          <div class="col-md-6" id="error_message"></div>
          <div class="form-group">
            <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-5">
              <button id="btnEditPostGuitsetgel" type="submit" class="btn btn-success">Засах</button>
            </div>
          </div>
          <div class="clearfix"></div>
        </form>
      </div>
      <div class="clearfix"></div>
      <div class = "modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Хаах</button>
      </div>

    </div>
  </div>
</div>
{{-- END NEW COMPANY --}}
