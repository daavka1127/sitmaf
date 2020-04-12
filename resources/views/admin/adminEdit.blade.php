{{-- START EDIT COMPANY --}}
<div class="modal fade" id="modalEditAdmin">
  <div class="modal-dialog" >
    <div class="modal-content">

      <div class="modal-header">
        <span >Admin эрх засах</span>
        <button type="button" class="close" data-dismiss="modal">X</button>
      </div>

      <div class="modal-body">




            <div class="clearfix"></div>
            <form id="frmEditExec" action="{{ action('ExecutionContoller@execUpdate')}}" method="post" data-parsley-validate class="form-horizontal form-label-left">
              @csrf
              <input type="hidden" name="execRowID" id="adminRowID" value="">
              <div class="container">
                <div class="col-md-6">
                  <label>Нэр</label>
                  <input class="form-control" type="text" id="name" value="" />
                </div>
                <div class="col-md-6">
                  <label>Цахим хаяг</label>
                  <input class="form-control" type="text"  id="email" value="" />
                </div>
                <div class="col-md-6">
                  <label>Нууц үг</label>
                  <input class="form-control" type="text" id="pass" value="" />
                </div>
                <div class="col-md-6">
                  <label>хандах эрх</label>
                  <input class="form-control" type="text"  id="access" value=""/>
                </div>
              </div>


          <div class="clearfix"></div>
        </form>
      </div>
      <div class="clearfix"></div>
      <div class = "modal-footer">
          <button id="btnEditPostGuitsetgel" type="button" class="btn btn-success">Засах</button>
        <button type="button" class="btn btn-danger" data-dismiss="modal">Хаах</button>
      </div>

    </div>
  </div>
</div>
{{-- END EDIT COMPANY --}}
