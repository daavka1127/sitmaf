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
          <div class="form-group col-md-3 text-left">
            <label>Аж ахуйн нэгж <span class="red-required">*</span> </label>
            <input type="hidden" id="hideEditHunHuchID" name="id" value=""/>
            <select class="form-control" name="companyID" id="cmbEditCompanyID" disabled>
                @foreach ($companies as $company)
                    <option value="{{$company->id}}">{{$company->companyName}}</option>
                @endforeach
            </select>
          </div>
          <div class="form-group col-md-3 text-left">
            <label>Хүн хүч <span class="red-required">*</span> </label>
            <input type="number" min="0" step="1" id="txtEditHunHuch" name="hunHuch" class="form-control" required />
          </div>
          <div class="form-group col-md-3 text-left">
            <label>Ажлын машин техник <span class="red-required">*</span> </label>
            <input type="number" min="0" step="1" id="txtEditMashinTehnik" name="mashinTehnik" class="form-control" required />
          </div>
          <div class="form-group col-md-3 text-left">
            <label>Огноо <span class="red-required">*</span> </label>
            <input type="date" id="txtEditOgnoo" name="ognoo" class="form-control" required />
          </div>
          <div class="clearfix"></div>


          <div class="col-md-6" id="error_message"></div>
          <div class="form-group">
            <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-5">
              <button id="btnEditPostHunHuch" type="submit" class="btn btn-success">Засах</button>
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
