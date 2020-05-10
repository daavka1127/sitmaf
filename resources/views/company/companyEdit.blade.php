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

          @csrf
          <div class="form-group col-md-3 text-left">
            <label>Аж ахуйн нэгжийн нэр <span class="red-required">*</span> </label>
            <input type="hidden" id="txtEditID" name="id" class="form-control" />
            <input type="text" id="txtEditCompanyName" name="companyName" class="form-control" />
          </div>
          <div class="form-group col-md-3 text-left">
            <label>Хэсэг <span class="red-required">*</span> </label>
            @php
              $getTbHeseg = \App\Http\Controllers\companyController::getHesegID();
            @endphp
            <select class="form-control" id="cmbHeseg" name="heseg_id">
              @foreach ($getTbHeseg as $tbHeseg)
                <option value="{{$tbHeseg->id}}">{{$tbHeseg->name}}</option>
              @endforeach

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
            <label>Дугаар <span class="red-required">*</span> </label>
            <input type="number" id="txtEditDaraalal" name="daraalal" class="form-control" required />
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
                      <label style="font-size: 11px;" id="editWorkName{{$work->id}}">{{$work->name}} /{{$work->hemjih_negj}}/</label>
                      <input type="number" min="0" step="1" value="" workTypeID="{{$worktype->id}}" workID="{{$work->id}}" id="editTxtWork{{$work->id}}" class="editTxtclass{{$worktype->id}} numbersPlanEdit form-control input-sm" />
                    </div>

                    @php $i++; @endphp
                    @if ($i%6 == 0)
                        <div class="clearfix"></div>
                    @endif

                  @endforeach
                  @if (count($works) != 0)
                    <div class="clearfix"></div>
                    <label style="font-size: 19px;" id="sumPlanEdit{{$worktype->id}}"></label>
                    <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-5">
                      <button type="button" btnworkid="{{$worktype->id}}" class="editBtnWorkTypeID btn btn-success">Засах</button>
                    </div>
                  @endif
              </div>

          @endforeach
          <div class="col-md-6" id="error_message"></div>
          <div class="clearfix"></div>

      </div>
      <div class="clearfix"></div>
      <div class = "modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Хаах</button>
      </div>

    </div>
  </div>
</div>
{{-- END NEW COMPANY --}}
