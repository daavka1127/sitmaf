{{-- START NEW COMPANY --}}
<div class="modal fade" id="ModelEditWorkType">
  <div class="modal-dialog">
    <div class="modal-content">

      <div class="modal-header">
        <span>Ажлын төрөл засах</span>
        <button type="button" class="close" data-dismiss="modal">X</button>
      </div>
        <form id="frmUpdateWorkType" action="{{ action('WorktypeController@update')}}" method="post" data-parsley-validate class="form-horizontal form-label-left">
          @csrf
          <input type="hidden" id="txtEditWorkTypeID" name="id" class="form-control" />
          <div class="modal-body">
              <div class="clearfix"></div>
              <div class="form-group">
                <div class="form-inline">
                  <label class="col-md-2 text-right">Нэр:</label>
                  <input class="col-md-10" type="text" id="ework_type_id" name="work_type_name" class="form-control">
                </div>
              </div>
            <div class="clearfix"></div>
          </div>
          <div class="clearfix"></div>
          <div class = "modal-footer">
            <button id="btnWorkTypeEdit" type="submit" class="btn btn-success">Нэмэх</button>
            <button type="button" class="btn btn-danger" data-dismiss="modal">Хаах</button>
          </div>
        </form>



    </div>
  </div>
</div>
{{-- END NEW COMPANY --}}
