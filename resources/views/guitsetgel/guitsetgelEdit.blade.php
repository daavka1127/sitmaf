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
            <input type="hidden" id="txtEditGID" name="id" value="12" class="form-control" />
            <select name='companyID' class="form-control" id="cmbEditGCompany">

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

          {{-- START HIIGDEH AJIL --}}
          <h3 style="text-align:center;"><strong>Гүйцэтгэсэн ажил</strong></h3>
          <div class="form-group col-md-3 text-left">
            <label>Хөрс хуулалт </label>
            <input type="number" min="0" id="txtEditGHursHuulalt" step="any" name="gHursHuulalt" class="form-control" />
          </div>
          <div class="form-group col-md-3 text-left">
            <label>Далан </label>
            <input type="number" min="0" id="txtEditGDalan" step="any" name="gDalan" class="form-control" />
          </div>
          <div class="form-group col-md-3 text-left">
            <label>Ухмал </label>
            <input type="number" min="0" id="txtEditGUhmal" step="any" name="gUhmal" class="form-control" />
          </div>
          <div class="form-group col-md-3 text-left">
            <label>Суурийн үе </label>
            <input type="number" min="0" id="txtEditGSuuriinUy" step="any" name="gSuuriinUy" class="form-control" />
          </div>
          <div class="form-group col-md-3 text-left">
            <label>Шуудуу </label>
            <input type="number" min="0" id="txtEditGShuuduu" step="any" name="gShuuduu" class="form-control" />
          </div>
          <div class="form-group col-md-3 text-left">
            <label>Ухмалын хамгаалалт </label>
            <input type="number" min="0" id="txtEditGUhmaliinHamgaalalt" step="any" name="gUhmaliinHamgaalalt" class="form-control" />
          </div>
          <div class="form-group col-md-3 text-left">
            <label>Уулын шуудуу </label>
            <input type="number" min="0" id="txtEditGUuliinShuuduu" step="any" name="gUuliinShuuduu" class="form-control" />
          </div>
          <div class="clearfix"></div>
          {{-- END HIIGDEH AJIL --}}


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
