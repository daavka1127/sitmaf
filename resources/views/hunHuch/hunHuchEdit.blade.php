{{-- START NEW COMPANY --}}
<div class="modal fade" id="editHunHuchModal">
  <div class="modal-dialog" style="width:80%;">
    <div class="modal-content">

      <div class="modal-header">
        <span class="red-required">* - той талбарыг заавал бөглөнө үү!!!</span>
        <button type="button" class="close" data-dismiss="modal">X</button>
      </div>

      <div class="modal-body">
        <h2 style="text-align:center;"><strong>Хүн хүчний бүртгэл засах</strong></h2>
        <form id="frmEditHunHuch" action="{{ action('hunHuchController@update')}}" method="post" data-parsley-validate class="form-horizontal form-label-left">
          @csrf

          <div class="clearfix"></div>
          <div class="form-group col-md-3 text-center">
            <label>Аж ахуйн нэгжийн нэр <span class="red-required">*</span> </label>
            <h4><label class="hunhuchEditCompanyName"></label></h4>

          </div>
          <script type="text/javascript">
        
          </script>
          <table id="editHunhuchTable" class="table table-striped table-bordered" style="width:100%;">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Хүн хүч</th>
                        <th>Ажлын машин техник</th>
                        <th>Огноо</th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>

          <div class="row">
            <form id="frmEditHunhuch" action="{{ action('hunHuchController@editOneCompanyHunhuch')}}" method="post" data-parsley-validate class="form-horizontal form-label-left">
              @csrf
              <input type="hidden" name="hunhuchRowID" id="hunhuchRowID" value="">
              <div class="container">
                <div class="col-md-2">
                  <label>Хүн хүч</label>
                  <input class="form-group" type="text" name="hunhuchEditRow" id="hunhuchEditRow" value="" />
                </div>
                <div class="col-md-2">
                  <label>Ажлын машин техник</label>
                  <input class="form-group" type="text" name="texnikEditRow" id="texnikEditRow" value="" />
                </div>
                <div class="col-md-2">
                  <label>Огноо</label>
                  <input class="form-group" type="text" name="ognooEditRow" id="ognooEditRow" value="" />
                </div>
              </div>

          <div class="form-group">
            <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-5">
              <button id="btnEditPostOneHunhuch" type="button" class="btn btn-success">Засах</button>
              <button id="btnDeleteOneHunhuch" type="button" class="btn btn-danger">Устгах</button>
            </div>
          </div>
          <div class="clearfix"></div>
        </form>
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
