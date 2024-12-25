<div class="chatbox-holder">
    <div class="chatbox chatbox-min">
        <div class="chatbox-top">
            <div class="chat-partner-name">
                <h5 class="bold mb-0">@lang("phrase.contact.inquiry") <div class="notification"></div>
            </h5>
            </div>     
        </div>        
        <div class="chat-messages">
            <div class=" content-form">
                <form method="get" action="{{Session('lang')}}/{{$module}}/confirmation" id="mobileFormContact">
                <div class="row">
                    <div class="col-12 ">
                        <label>@lang("phrase.form.to")</label>
                        <div class="form-group">
                            <div class="form-control company-contact"></div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="form-group">
                            <label class="control-label">@lang("phrase.contact.company")</label>  
                            <input type="text" name="company" class="form-control" autocomplete="off"/>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="form-group">
                            <label class="control-label">@lang("phrase.contact.name")</label>
                            <input type="text" name="name" class="form-control" autocomplete="off"/>                            
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label class="control-label">@lang("phrase.contact.department")</label>
                            <input type="text" name="department" class="form-control" autocomplete="off"/>                            
                        </div>
                    </div>
                    <div class="col-lg-6">  
                        <div class="form-group">
                            <label class="control-label">@lang("phrase.contact.telephone")</label>
                            <input type="text" name="telephone" class="form-control" autocomplete="off"/>                            
                        </div> 
                    </div>
                    <div class="col-lg-12">  
                        <div class="form-group">
                            <label class="control-label">@lang("phrase.contact.email")</label>
                            <input type="email" name="email" class="form-control" autocomplete="off"/>                            
                        </div>  
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="form-group">
                            <label class="control-label">@lang("phrase.contact.detail")</label>
                            <textarea type="textarea" rows="4" class="form-control" name="message" required="required"></textarea>
                        
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <input type="submit" value="@lang("phrase.contact.send-form")" class="message-send btn-block" />
                    </div>
                </div>
                </form>
            </div>
        </div>
    </div>
</div>