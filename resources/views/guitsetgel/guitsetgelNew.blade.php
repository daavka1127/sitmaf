{{-- START NEW COMPANY --}}
<div class="modal fade" id="newGuitsetgelModal">
  <div class="modal-dialog" style="width:80%;">
    <div class="modal-content">

      <div class="modal-header">
        <span class="red-required">* - той талбарыг заавал бөглөнө үү!!!</span>
        <button type="button" class="close" data-dismiss="modal">X</button>
      </div>

      <div class="modal-body">
        <h2 style="text-align:center;"><strong>Аж ахуйн нэгжийн гүйцэтгэлийн бүртгэл</strong></h2>
        <form id="frmNewGuitsetgel" action="{{ action('GuitsetgelController@store')}}" method="post" data-parsley-validate class="form-horizontal form-label-left">
          @csrf
          <div class="form-group col-md-3 text-left">
            <label>Аж ахуйн нэгжийн нэр <span class="red-required">*</span> </label>
            <input type="hidden" id="txtEditID" name="id" class="form-control" />
            <select name='companyID' class="form-control" id="cmbNewCompanyID">
              <option value="-1">Сонгоно уу.</option>
              @foreach ($companies as $company)
                  <option value="{{$company->id}}">{{$company->companyName}}</option>
              @endforeach

            </select>
          </div>
          <div class="form-group col-md-3 text-left">
            <label>Огноо <span class="red-required">*</span> </label>
            <input type="date" id="txtOgnoo" name="ognoo" class="form-control" required />
          </div>




          <div class="col-md-12" id="CheckBoxes"></div>
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
