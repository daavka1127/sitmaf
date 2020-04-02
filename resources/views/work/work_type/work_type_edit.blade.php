{{-- START NEW COMPANY --}}
<div class="modal fade" id="btnEditWorkType">
  <div class="modal-dialog">
    <div class="modal-content">

      <div class="modal-header">
        <span>Ажлын төрөл нэмэх</span>
        <button type="button" class="close" data-dismiss="modal">X</button>
      </div>
        <form id="frmAddWorkTypeName" action="{{ action('WorktypeController@store')}}" method="post" data-parsley-validate class="form-horizontal form-label-left">
          @csrf
          <div class="modal-body">
              <div class="clearfix"></div>
              <div class="form-group">
                <div class="form-inline">
                  <label class="col-md-2 text-right">Нэр:</label>
                  <input class="col-md-10" type="text" id="work_type_id" name="work_type_name" class="form-control">
                </div>
              </div>
            <div class="clearfix"></div>
          </div>
          <div class="clearfix"></div>
          <div class = "modal-footer">
            <button id="btnWorkTypeAdd" type="submit" class="btn btn-success">Нэмэх</button>
            <button type="button" class="btn btn-danger" data-dismiss="modal">Хаах</button>
          </div>
        </form>



    </div>
  </div>
</div>
{{-- END NEW COMPANY --}}
