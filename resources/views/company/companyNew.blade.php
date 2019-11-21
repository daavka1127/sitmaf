{{-- START NEW COMPANY --}}
<div class="modal fade" id="newCompany">
  <div class="modal-dialog" style="width:80%;">
    <div class="modal-content">

      <div class="modal-header">
        <span class="red-required">* - той талбарыг заавал бөглөнө үү!!!</span>
        <button type="button" class="close" data-dismiss="modal">X</button>
      </div>

      <div class="modal-body">
        <h2 style="text-align:center;"><strong>Бүртгэгдсэн аж ахуйн нэгж бүртгэл</strong></h2>
        <form id="frmNewCompany" action="{{ action('companyController@store')}}" method="post" data-parsley-validate class="form-horizontal form-label-left">
          @csrf
          <div class="form-group col-md-3 text-left">
            <label>Аж ахуйн нэгжийн нэр <span class="red-required">*</span> </label>
            <input type="text" id="txtCompanyName" name="companyName" class="form-control" />
          </div>
          <div class="form-group col-md-3 text-left">
            <label>Ажлын хэсэг <span class="red-required">*</span> </label>
            <input type="text" id="txtAjliinHeseg" name="ajliinHeseg" class="form-control" required />
          </div>
          <div class="form-group col-md-3 text-left">
            <label>Ажил эхэлсэн огноо <span class="red-required">*</span> </label>
            <input type="date" id="txtGereeOgnoo" name="gereeOgnoo" class="form-control" required />
          </div>
          <div class="form-group col-md-3 text-left">
            <label>Хүн хүч <span class="red-required">*</span> </label>
            <input type="number" min="0" step="1" id="txtHunHuch" name="hunHuch" class="form-control" required />
          </div>
          <div class="form-group col-md-3 text-left">
            <label>Ажлын машин техник <span class="red-required">*</span> </label>
            <input type="number" min="0" step="1" id="txtMashinTehnik" name="mashinTehnik" class="form-control" required />
          </div>
          <div class="clearfix"></div>

          {{-- START HIIGDEH AJIL --}}
          <h5 style="text-align:center;"><strong>Хийгдэх ажил</strong></h5>
          <div class="form-group col-md-3 text-left">
            <label>Хөрс хуулалт </label>
            <input type="number" min="0" id="txtHursHuulalt" step="any" name="hursHuulalt" class="form-control" />
          </div>
          <div class="form-group col-md-3 text-left">
            <label>Далан </label>
            <input type="number" min="0" id="txtDalan" step="any" name="dalan" class="form-control" />
          </div>
          <div class="form-group col-md-3 text-left">
            <label>Ухмал </label>
            <input type="number" min="0" id="txtUhmal" step="any" name="uhmal" class="form-control" />
          </div>
          <div class="form-group col-md-3 text-left">
            <label>Суурийн үе </label>
            <input type="number" min="0" id="txtSuuriinUy" step="any" name="suuriinUy" class="form-control" />
          </div>
          <div class="form-group col-md-3 text-left">
            <label>Шуудуу </label>
            <input type="number" min="0" id="txtShuuduu" step="any" name="shuuduu" class="form-control" />
          </div>
          <div class="form-group col-md-3 text-left">
            <label>Ухмалын хамгаалалт </label>
            <input type="number" min="0" id="txtUhmaliinHamgaalalt" step="any" name="uhmaliinHamgaalalt" class="form-control" />
          </div>
          <div class="form-group col-md-3 text-left">
            <label>Уулын шуудуу </label>
            <input type="number" min="0" id="txtUuliinShuuduu" step="any" name="uuliinShuuduu" class="form-control" />
          </div>
          <div class="clearfix"></div>
          {{-- END HIIGDEH AJIL --}}


          <div class="col-md-6" id="error_message"></div>
          <div class="form-group">
            <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-5">
              <button id="btnNewCompany" type="submit" class="btn btn-success">Нэмэх</button>
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
