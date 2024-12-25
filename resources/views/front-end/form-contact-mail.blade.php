<style>
    .chatbox {
        transition: none;
    }

    .chatbox-top {
        border-top-left-radius: 10px;
        border-top-right-radius: 10px;
        background-color: #044ea2;
        /* padding: 10px 15px; */
    }

    .chat-partner-name {
        display: flex;
        padding: 0 !important;
    }

    .message-send {
        padding: 5px 0;
    }

    a.message-send {
        color: #ffffff;
        text-decoration: none;
    }

    .company-contact {
        overflow-y: scroll;
        max-height: 110px;
    }

    .chatbox-holder .icofont-minus {
        position: absolute;
        right: 10px;
        font-size: 37px;
        cursor: pointer;
    }
</style>

<div class="openedChat">
    <div class="chatbox-holder">
        <div class="chatbox chatbox-min d-none">
            <div class="chatbox-top">
                <div class="chat-partner-name">
                    <h5 class="bold mb-0">@lang('phrase.contact.inquiry') <div class="notification"></div> <i class="icofont-minus"></i></h5>
                </div>
            </div>
            <div class="chat-messages">
                <div class="content-form">
                    <form method="get" action="{{ Session('lang') }}/{{ $module }}/confirmation"
                        id="formContact">
                        <div class="row">
                            <div class="col-12 ">
                                <label>@lang('phrase.form.to')</label>
                                <div class="form-group">
                                    <div class="form-control company-contact"></div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label class="control-label">@lang('phrase.contact.company')</label>
                                    <input type="text" name="company" class="form-control" autocomplete="off" />
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label class="control-label">@lang('phrase.contact.name')</label>
                                    <input type="text" name="name" class="form-control" autocomplete="off" />
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label class="control-label">@lang('phrase.contact.department')</label>
                                    <input type="text" name="department" class="form-control" autocomplete="off" />
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label class="control-label">@lang('phrase.contact.telephone')</label>
                                    <input type="text" name="telephone" class="form-control" autocomplete="off" />
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label class="control-label">@lang('phrase.contact.email')</label>
                                    <input type="email" name="email" class="form-control" autocomplete="off" />
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label class="control-label">@lang('phrase.contact.detail')</label>
                                    <textarea type="textarea" rows="4" class="form-control" name="message"></textarea>
                                    <input type="hidden" name="page" value="CP {{$row->type}} Page">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            @if (!@$customerStatus)
                                @if ($row->type != 'basic')
                                    <div class="col-lg-6">
                                        <a class="message-send btn-block d-flex justify-content-center" href="javascript:"
                                            lang="{{ Session('lang') }}" category="{{ Request::segment(2) }}"
                                            tag="{{ $row->id }}" text="{{ $row->name }}"
                                            title="@lang('phrase.contact.choose-more-title')"
                                            data-email="{{ $row->email }}" style="background-color: #044ea2">
                                            @lang('phrase.contact.choose-more')
                                        </a>
                                    </div>
                                @endif
                            @endif
                            <div class="@if (!@$customerStatus) @if($row->type != 'basic') col-lg-6 float-right @else col-lg-12 @endif @endif">
                                <input type="submit" value="@lang('phrase.contact.send-form')" class="message-send btn-block" />
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
