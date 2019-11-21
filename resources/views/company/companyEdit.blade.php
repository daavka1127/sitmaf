{{-- START NEW COMPANY --}}
<div class="modal fade" id="modalEditCompany">
  <div class="modal-dialog" style="width:80%;">
    <div class="modal-content">

      <div class="modal-header">
        <span class="red-required">* - той талбарыг заавал бөглөнө үү!!!</span>
        <button type="button" class="close" data-dismiss="modal">X</button>
      </div>

      <div class="modal-body">
        <h2 style="text-align:center;"><strong>Бүртгэгдсэн аж ахуйн нэгж бүртгэл</strong></h2>
        <form id="frmEditCompany" action="{{ action('companyController@update')}}" method="post" data-parsley-validate class="form-horizontal form-label-left">
          @csrf
          <div class="form-group col-md-3 text-left">
            <label>Аж ахуйн нэгжийн нэр <span class="red-required">*</span> </label>
            <input type="hidden" id="txtEditID" name="id" class="form-control" />
            <input type="text" id="txtEditCompanyName" name="companyName" class="form-control" />
          </div>
          <div class="form-group col-md-3 text-left">
            <label>Ажлын хэсэг <span class="red-required">*</span> </label>
            <input type="text" id="txtEditAjliinHeseg" name="ajliinHeseg" class="form-control" required />
          </div>
          <div class="form-group col-md-3 text-left">
            <label>Ажил эхэлсэн огноо <span class="red-required">*</span> </label>
            <input type="date" id="txtEditGereeOgnoo" name="gereeOgnoo" class="form-control" required />
          </div>
          <div class="form-group col-md-3 text-left">
            <label>Хүн хүч <span class="red-required">*</span> </label>
            <input type="number" min="0" step="1" id="txtEditHunHuch" name="hunHuch" class="form-control" required />
          </div>
          <div class="form-group col-md-3 text-left">
            <label>Ажлын машин техник <span class="red-required">*</span> </label>
            <input type="number" min="0" step="1" id="txtEditMashinTehnik" name="mashinTehnik" class="form-control" required />
          </div>
          <div class="clearfix"></div>

          {{-- START HIIGDEH AJIL --}}
          <h5 style="text-align:center;"><strong>Хийгдэх ажил</strong></h5>
          <div class="form-group col-md-3 text-left">
            <label>Хөрс хуулалт </label>
            <input type="number" min="0" id="txtEditHursHuulalt" step="any" name="hursHuulalt" class="form-control" />
          </div>
          <div class="form-group col-md-3 text-left">
            <label>Далан </label>
            <input type="number" min="0" id="txtEditDalan" step="any" name="dalan" class="form-control" />
          </div>
          <div class="form-group col-md-3 text-left">
            <label>Ухмал </label>
            <input type="number" min="0" id="txtEditUhmal" step="any" name="uhmal" class="form-control" />
          </div>
          <div class="form-group col-md-3 text-left">
            <label>Суурийн үе </label>
            <input type="number" min="0" id="txtEditSuuriinUy" step="any" name="suuriinUy" class="form-control" />
          </div>
          <div class="form-group col-md-3 text-left">
            <label>Шуудуу </label>
            <input type="number" min="0" id="txtEditShuuduu" step="any" name="shuuduu" class="form-control" />
          </div>
          <div class="form-group col-md-3 text-left">
            <label>Ухмалын хамгаалалт </label>
            <input type="number" min="0" id="txtEditUhmaliinHamgaalalt" step="any" name="uhmaliinHamgaalalt" class="form-control" />
          </div>
          <div class="form-group col-md-3 text-left">
            <label>Уулын шуудуу </label>
            <input type="number" min="0" id="txtEditUuliinShuuduu" step="any" name="uuliinShuuduu" class="form-control" />
          </div>
          <div class="clearfix"></div>
          {{-- END HIIGDEH AJIL --}}

          {{-- START GUITSETGELT --}}
          <h5 style="text-align:center;"><strong>Яг одоо хийгдсэн гүйцэтгэлт</strong></h5>
          <div class="form-group col-md-3 text-left">
            <label>Хөрс хуулалт </label>
            <input type="number" min="0" id="txtEditgHursHuulalt" step="any" name="gHursHuulalt" class="form-control" />
          </div>
          <div class="form-group col-md-3 text-left">
            <label>Далан </label>
            <input type="number" min="0" id="txtEditgDalan" step="any" name="gDalan" class="form-control" />
          </div>
          <div class="form-group col-md-3 text-left">
            <label>Ухмал </label>
            <input type="number" min="0" id="txtEditgUhmal" step="any" name="gUhmal" class="form-control" />
          </div>
          <div class="form-group col-md-3 text-left">
            <label>Суурийн үе </label>
            <input type="number" min="0" id="txtEditgSuuriinUy" step="any" name="gSuuriinUy" class="form-control" />
          </div>
          <div class="form-group col-md-3 text-left">
            <label>Шуудуу </label>
            <input type="number" min="0" id="txtEditgShuuduu" step="any" name="gShuuduu" class="form-control" />
          </div>
          <div class="form-group col-md-3 text-left">
            <label>Ухмалын хамгаалалт </label>
            <input type="number" min="0" id="txtEditgUhmaliinHamgaalalt" step="any" name="gUhmaliinHamgaalalt" class="form-control" />
          </div>
          <div class="form-group col-md-3 text-left">
            <label>Уулын шуудуу </label>
            <input type="number" min="0" id="txtEditgUuliinShuuduu" step="any" name="gUuliinShuuduu" class="form-control" />
          </div>
          <div class="clearfix"></div>
          {{-- END GUITSETGELT --}}
          <div class="col-md-6" id="error_message"></div>
          <div class="form-group">
            <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-5">
              <button id="btnEditPostCompany" type="submit" class="btn btn-success">Засах</button>
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
