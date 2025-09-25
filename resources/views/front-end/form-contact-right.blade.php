<div class="col-md-5 col-lg-5 card-mail col-02-content d-xl-block">
    <link rel="stylesheet" href="css/card-list.css">
    <div id="fix-scroll">
        <div class="d-none d-lg-block">
            <div class="row">
                <div class="col-lg-12">
                    <button type="button" class="btn btn-popover heartBeat" data-toggle="modal"
                        data-target="#email-popup">
                        <i class="icofont-envelope"></i> @lang('phrase.how-to-send') <span>@lang('phrase.click')</span>
                    </button>
                </div>
            </div>
            <div class="content-form mt-2">
                <h2 class="bold text-white mb-2" style="position: relative;">@lang("phrase.$module.form-caption") <div
                        class="notification"></div>
                </h2>
                <span class="bold text-white"
                    style=" border-radius: 4px; padding: 3px; color: #555;">#@lang("phrase.$module.form-limit", ['max' => 10])</span>
                <div class="row mt-3">
                    <div class="col-12 ">
                        <label>@lang("phrase.$module.sendto")</label>
                        <div class="form-group">
                            <div id="companyList" class="form-control company-contact">กรุณาเลือกบริษัทที่ต้องการติดต่อ
                            </div>
                        </div>
                    </div>
                </div>
                <form id="formContact" action="{{ Session('lang') }}/{{ $module }}/confirmation" class='form'>
                    <div class="mb-3">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label class="text-white">@lang('phrase.company-name')</label>
                                    <input type="text" class="form-control" name="company"
                                        placeholder="@lang('phrase.form.your-company')">
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label class="text-white">@lang('phrase.name')</label>
                                    <input type="text" class="form-control" name="name"
                                        placeholder="@lang('phrase.form.your-name')">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label class="text-white">@lang('phrase.department')</label>
                                    <input type="text" class="form-control" name="department"
                                        placeholder="@lang('phrase.form.your-department')">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label class="text-white">@lang('phrase.telephone')</label>
                                    <input type="text" class="form-control" name="telephone"
                                        placeholder="@lang('phrase.form.your-mobile')">
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label class="text-white">@lang('phrase.member.email')</label>
                                    <input type="text" class="form-control" name="email"
                                        placeholder="@lang('phrase.form.your-email')">
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label class="text-white">@lang('phrase.contact-detail')</label>
                                    <textarea name="message" class="form-control" rows="19" placeholder="{{ __('phrase.contact-detail') }}"></textarea>
                                    <input type="hidden" name="page" id="page" value="CAT Page">
                                </div>
                            </div>
                        </div>
                    </div>
                    <input type="submit" value="@lang('phrase.submit')" class="message-send float-right">
                </form>
            </div>
        </div>
    </div>
</div>
<script src='js/jquery-3.5.1.slim.min.js'></script>
<script src='js/popper.min.js'></script>
<script>
    $(document).ready(function() {
        //Tooltip, activated by hover event
        $("body").popover({
            selector: "[data-toggle='popover']",
            trigger: "hover focus",
            container: "body"
        })
        //Popover, activated by clicking
        // .popover({
        //   selector: "[data-toggle='popover']",
        //   container: "body",
        //   html: true
        // });
        //They can be chained like the example above (when using the same selector).
    });
    var cardMailHeight = $('.card-mail').height();
    $('.company-list').css('max-height', `${cardMailHeight-10}px`);
</script>
<script type="text/javascript">
    (function() {
        var floatingLabel;
        floatingLabel = class floatingLabel {
            constructor(form, options = {}) {
                var event, i, input, j, label, len, len1, ref, ref1;
                if (!form) {
                    return;
                }
                options.focusClass || (options.focusClass = "focus");
                options.activeClass || (options.activeClass = "active");
                options.errorClass || (options.errorClass = "error");
                form.classList.add('has-floated-label');
                ref = form.querySelectorAll('label');
                for (i = 0, len = ref.length; i < len; i++) {
                    label = ref[i];
                    if (!(input = document.querySelector(`#${label.getAttribute('for')}`))) {
                        return;
                    }
                    ref1 = ['keyup', 'input', 'change'];
                    for (j = 0, len1 = ref1.length; j < len1; j++) {
                        event = ref1[j];
                        input.addEventListener(event, function() {
                            this.parentNode.classList.remove(options.errorClass);
                            return this.parentNode.classList.toggle(options.activeClass, !!this
                                .value);
                        });
                    }
                    input.addEventListener('focus', function() {
                        return this.parentNode.classList.add(options.focusClass);
                    });
                    input.addEventListener('blur', function() {
                        return this.parentNode.classList.remove(options.focusClass);
                    });
                    input.parentNode.classList.toggle(options.activeClass, !!input.value);
                }
            }
        };
        // initialize
        window.floatingLabel = new floatingLabel(document.querySelector('.form'));
    }).call(this);
</script>
