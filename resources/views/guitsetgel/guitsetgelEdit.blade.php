{{-- START EDIT COMPANY --}}
<div class="modal fade" id="modalEditGuitsetgel">
  <div class="modal-dialog" style="width:80%;">
    <div class="modal-content">

      <div class="modal-header">
        <span class="red-required">* - той талбарыг заавал бөглөнө үү!!!</span>
        <button type="button" class="close" data-dismiss="modal">X</button>
      </div>

      <div class="modal-body">
        <h2 style="text-align:center;"><strong>Аж ахуйн нэгжийн гүйцэтгэлийн бүртгэл</strong></h2>

          <div class="form-group col-md-3 text-center">
            <label>Аж ахуйн нэгжийн нэр <span class="red-required">*</span> </label>
            <input type="hidden" id="txtEditGID" name="id" class="form-control" />
            <h4><label class="printCompanyName"></label></h4>

          </div>
          <script type="text/javascript">
          $(document).ready(function(){

          $('#editExecTable tbody').on( 'click', 'tr', function () {
              var currow1 = $(this).closest('tr');
              $('#editExecTable tbody tr').css("background-color", "white");
              $(this).closest('tr').css("background-color", "yellow");
              execEditRow = $('#editExecTable').DataTable().row(currow1).data();
              $("#execRowID").val(execEditRow['id']);
              $("#workType").val(execEditRow['workTypeName']);
              $("#work").val(execEditRow['workName']);
              $("#editDate").val(execEditRow['date']);
              $("#editExec").val(execEditRow['execution']);

            });

          });
          </script>
          <div class="clearfix"></div>
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
                <tbody>

                </tbody>
            </table>

          <div class="col-md-6" id="error_message"></div>
            <div class="clearfix"></div>
            <form id="frmEditExec" action="{{ action('ExecutionContoller@execUpdate')}}" method="post" data-parsley-validate class="form-horizontal form-label-left">
              @csrf
              <input type="hidden" name="execRowID" id="execRowID" value="">
              <input type="hidden" name="hiddenCompanyName" id="hiddenCompanyName" value="">
              <div class="container">
                <div class="col-md-2">
                  <label>Ажлын төрөл</label>
                  <input class="form-group" type="text" id="workType" value="" disabled/>
                </div>
                <div class="col-md-2">
                  <label>Хийх ажил</label>
                  <input class="form-group" type="text" name="work" id="work" value="" disabled/>
                </div>
                <div class="col-md-2">
                  <label>Огноо</label>
                  <input class="form-group" type="text" name="editDate" id="editDate" value="" disabled/>
                </div>
                <div class="col-md-2">
                  <label>Гүйцэтгэл</label>
                  <input class="form-group" type="text" name="editExec" id="editExec" value=""/>
                </div>
              </div>

          <div class="form-group">
            <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-5">
              <button id="btnEditPostGuitsetgel" type="button" class="btn btn-success">Засах</button>
              <button id="btnDeletePostGuitsetgel" type="button" class="btn btn-danger">Устгах</button>
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
{{-- END EDIT COMPANY --}}
