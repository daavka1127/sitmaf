{{-- START EDIT COMPANY --}}
<div class="modal fade" id="modalEditCompany">
  <div class="modal-dialog" style="width:80%;">
    <div class="modal-content">

      <div class="modal-header">
        <span class="red-required">* - той талбарыг заавал бөглөнө үү!!!</span>
        <button type="button" class="close" data-dismiss="modal">X</button>
      </div>

      <div class="modal-body">
        <h2 style="text-align:center;"><strong>Аж ахуйн нэгж засах</strong></h2>
        <form id="frmEditCompany" action="{{ action('companyController@update')}}" method="post" data-parsley-validate class="form-horizontal form-label-left">
          @csrf
          <div class="form-group col-md-3 text-left">
            <label>Аж ахуйн нэгжийн нэр <span class="red-required">*</span> </label>
            <input type="hidden" id="txtEditID" name="id" class="form-control" />
            <input type="text" id="txtEditCompanyName" name="companyName" class="form-control" />
          </div>
          <div class="form-group col-md-3 text-left">
            <label>Хэсэг <span class="red-required">*</span> </label>
            <select class="form-control" id="cmbEditHeseg" name="heseg_id">
              <option value="0">Сонгоно уу</option>
              <option value="1">Зүүнбаян чиглэл I хэсэг</option>
              <option value="2">Мандах чиглэл II хэсэг</option>
              <option value="3">Цогтцэций чиглэл III чиглэл</option>
              <option value="4">Бүх аж ахуйн нэгжээр</option>
            </select>
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
          <h4 style="text-align:center;"><strong>Төсөвлөсөн ажил</strong></h4>
          @php
            $worktypes = \App\Http\Controllers\WorktypeController::getCompactWorkType();
          @endphp
          @foreach ($worktypes as $worktype)
            <div class="col-md-12">
                <label class="checkbox-inline"><input type="checkbox" workTypeId="{{$worktype->id}}" id="editCheckBoxes{{$worktype->id}}">  {{$worktype->name}}</label>
            </div>

              <div class="col-md-12 vision"  style="display:none; border: 1px solid grey; margin-top: 5px; border-radius: 5px; border-color: #d1cfcf;" id="editWorktypeid{{$worktype->id}}">
                @php
                  $works = \App\Http\Controllers\WorkController::getCompactWorks($worktype->id);
                  $i=0;
                @endphp

                  @foreach ($works as $work)
                    <div class="form-group col-md-2 text-left" style="padding-top: 5px;">
                      <label style="font-size: 11px;">{{$work->name}} /{{$work->hemjih_negj}}/</label>
                      <input type="number" min="0" step="1" value="" workID="{{$work->id}}" id="editTxtWork{{$work->id}}" class="editTxtclass{{$worktype->id}} form-control input-sm" />
                    </div>

                    @php $i++; @endphp
                    @if ($i%6 == 0)
                        <div class="clearfix"></div>
                    @endif

                  @endforeach
                  @if (count($works) != 0)
                    <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-5">
                      <button type="button" btnworkid="{{$worktype->id}}" class="editBtnWorkTypeID btn btn-success">Засах</button>
                    </div>
                  @endif
              </div>

          @endforeach
          <div class="col-md-6" id="error_message"></div>
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
