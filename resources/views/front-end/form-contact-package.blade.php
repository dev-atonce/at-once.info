<style>
    .chatbox {
        transition: none;
    }

    .chatbox-top {
        border-top-left-radius: 10px;
        border-top-right-radius: 10px;
        background-color: #044ea2;
        padding: 10px 15px;
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
                    <h6 class="bold mb-0">@lang('phrase.contact.contact-form')</h6>
                    <div><i class="icofont-minus"></i></div>
                </div>
            </div>
            <div class="chat-messages">
                <div class="content-form">
                    <form method="get" action="" id="formContactPackage">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="form-group mb-1">
                                    <span class="badge badge-dark"><i class="fas fa-star mr-1 package-color"></i><span class="package-name"></span></span>
                                </div>
                            </div>
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
                                    <label class="control-label">@lang('phrase.contact.telephone')</label>
                                    <input type="text" name="telephone" class="form-control" autocomplete="off" />
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label class="control-label">@lang('phrase.contact.email')</label>
                                    <input type="email" name="email" class="form-control" autocomplete="off" />
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label class="control-label">@lang('phrase.contact.category')</label>
                                    <input type="text" name="category" class="form-control" autocomplete="off" />
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label class="control-label">@lang('phrase.contact.deatil')</label>
                                    <textarea type="textarea" rows="4" class="form-control" name="detail"></textarea>
                                    <input type="hidden" name="package" id="package">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <input type="submit" value="ส่งข้อความ" class="message-send btn-block"/>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
