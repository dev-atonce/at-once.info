

{{----- Modal Detail of Company-----}}
  <style>
    @media only screen and (max-width: 476px) {
      .modal{
        height: calc(100vh);
      }
      .modal .dialog-xs{
        margin: 0;
      }      
      .modal-content .modal-header,
      .modal-content .modal-footer{
        width: 100%;
        position: fixed;
        background-color: white;
        z-index: 999;
      }
      .modal-content .modal-header{
        top:0;
      }
      .modal-content .modal-footer{
        bottom: 0;
      }
      /* .modal-content .modal-body{
        margin: 64px 0 0 0;
        height: calc(100vh);
        overflow-y: scroll;
      } */
    }
  </style>
  <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-detail dialog-xs" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title bold" id="exampleModalLabel">@lang('phrase.detail')</h5>
          <div class="float-right">
            <a class="btn btn-secondary btn-sm new-tab" href="">@lang('phrase.new-tab')</a>
            <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal">@lang('phrase.close')</button>
          </div>
        </div>
        <div class="modal-body">
          <div class="container">
            <div class="row">
              <div class="col-lg-12"></div>
            </div>
          </div>
        </div>
        <div class="modal-footer d-none d-sm-block">
          <div class="float-right">
            <a class="btn btn-secondary btn-sm new-tab" href="">@lang('phrase.new-tab')</a>
            <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal">@lang('phrase.close')</button>
          </div>
        </div>
      </div>
    </div>
  </div>