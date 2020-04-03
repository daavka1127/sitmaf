{{-- START NEW COMPANY --}}
<input type="hidden" name="companyID" value="0" />
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
            <label>Хэсэг <span class="red-required">*</span> </label>
            <select class="form-control" id="cmbHeseg" name="heseg_id">
              <option value="0">Сонгоно уу</option>
              <option value="1">Зүүнбаян чиглэл I хэсэг</option>
              <option value="2">Мандах чиглэл II хэсэг</option>
              <option value="3">Цогтцэций чиглэл III чиглэл</option>
              <option value="4">Бүх аж ахуйн нэгжээр</option>
            </select>
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
          </form>
          <div class="clearfix"></div>
          @php
            $worktypes = \App\Http\Controllers\WorktypeController::getCompactWorkType();
          @endphp
          @foreach ($worktypes as $worktype)
            <div class="col-md-12">
                <label class="checkbox-inline"><input type="checkbox" workTypeId="{{$worktype->id}}" id="checkBoxes{{$worktype->id}}">  {{$worktype->name}}</label>
            </div>
            <form id="saveWorks{{$worktype->id}}" class="saveWorks" action="{{ action('companyController@storeWorks')}}" method="post" workTypeID = "{{$worktype->id}}">
              <div class="col-md-12" style="display:none; border: 1px solid grey; margin-top: 5px; border-radius: 5px; border-color: #d1cfcf;" id="worktypeid{{$worktype->id}}">
                @php
                  $works = \App\Http\Controllers\WorkController::getCompactWorks($worktype->id);
                @endphp

                  @foreach ($works as $work)
                    <div class="form-group col-md-2 text-left" style="padding-top: 5px;">
                      <label style="font-size: 11px;">{{$work->name}} /{{$work->hemjih_negj}}/</label>
                      <input type="number" min="0" step="1" id="txtInput{{$worktype->id}}" name="input{{$work->id}}" class="txtclass{{$worktype->id}} form-control input-sm" />
                    </div>
                  @endforeach
                  @if (count($works) != 0)
                    <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-5">
                      <button id="btnWork" type="button" btnworkid="{{$worktype->id}}" class="btnWorkTypeID btn btn-success">Хадгалах</button>
                    </div>
                  @endif
              </div>
            </form>
          @endforeach

      </div>
      <div class="clearfix"></div>
      <div class = "modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Хаах</button>
      </div>

    </div>
  </div>
</div>
{{-- END NEW COMPANY --}}
