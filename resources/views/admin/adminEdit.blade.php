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
            <form id="frmEditAdmin" action="{{ action('adminController@adminUpdate')}}" method="post" data-parsley-validate class="form-horizontal form-label-left">
              @csrf
              <input type="hidden" name="adminRowID" id="adminRowID" value="">
              <div class="container">
                <div class="col-md-6">
                  <label>Нэр</label>
                  <input class="form-control" type="text" name="name" id="name" value="" />
                </div>
                <div class="col-md-6">
                  <label>Цахим хаяг</label>
                  <input class="form-control" type="text" name="email" id="email" value="" />
                </div>
                <div class="col-md-6">
                  <label>Нууц үг</label>
                  <input class="form-control" type="text" name="pass" id="pass" value="" />
                </div>
                <div class="col-md-6">
                  <label>Хандах эрх</label>
                  <select class="form-control" name="heseg" id="access">
                    <option value="1">Зүүнбаян чиглэл  I хэсэг</option>
                    <option value="2">Мандах чиглэл II хэсэг</option>
                    <option value="3">Цогтцэций чиглэл III хэсэг</option>
                    <option value="4">Зөвхөн хардаг</option>
                    <option value="5">Мастер</option>
                  </select>

                </div>
                <div class="col-md-6">

                </div>
                <input type="hidden" name="edit" value="off" id="hideCheck" />
                <div class="col-md-6">
                    <label class="checkbox-inline" style="padding-top: 10px;"><input type="checkbox" id="edit"> Өгөгдөл нэмэх </label>
                </div>
              </div>


          <div class="clearfix"></div>
        </form>
      </div>
      <div class="clearfix"></div>
      <div class = "modal-footer">
          <button id="btnEditPostAdmin" type="button" class="btn btn-success">Засах</button>
        <button type="button" class="btn btn-danger" data-dismiss="modal">Хаах</button>
      </div>

    </div>
  </div>
</div>
{{-- END EDIT COMPANY --}}
