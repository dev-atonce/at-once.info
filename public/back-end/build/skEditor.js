(function($) {
    $.skEditor = function(box, options) {
        var box = $(box);
        var defaults = {
            class: null,
            width: null,
            height: null,
            event: ''
        };
        var obj = $.extend(defaults, options);
        var value = $.parseHTML(box.val());
        var dateStr = Date.now();
        var id = new Date(dateStr).getTime();
        var display = {
            none : {'display':'none'},
            block : {'display':'block'},
        }
        var area = $(box).closest('.row').find('.sk-area');
        var tools = $('<div class="sk-tools text-left"></div>');
        var group1 = '<div class="sk-btn-group">\
            <div class="sk-btn"><button type="button" class="sk undo" title="Undo" cmd="undo"><i class="fas fa-undo-alt fs-17"></i></button></div>\
            <div class="sk-btn"><button type="button" class="sk redo" title="Redo" cmd="redo"><i class="fas fa-redo-alt fs-17"></i></button></div>\
            </div>';
        var group2 = '<div class="sk-btn-group">\
            <div class="sk-btn dropdown">\
                <button type="button" class="sk bold dropdown-toggle" id="dropdownMenuH'+id+'" title="Headings" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Headings </button>\
                <div class="dropdown-menu" aria-labelledby="dropdownMenuH'+id+'">\
                    <a class="dropdown-item sk heading" heading="h1" href="javascript:" style="padding:.25rem 1.25rem;"><h1 style="font-size:19px;font-weight:bold;">Heading 1</h1></a>\
                    <a class="dropdown-item sk heading" heading="h2" href="javascript:" style="padding:.25rem 1.25rem;"><h2 style="font-size:18px;font-weight:bold;">Heading 2</h2></a>\
                    <a class="dropdown-item sk heading" heading="h3" href="javascript:" style="padding:.25rem 1.25rem;"><h3 style="font-size:17px;font-weight:bold;">Heading 3</h3></a>\
                    <a class="dropdown-item sk heading" heading="h4" href="javascript:" style="padding:.25rem 1.25rem;"><h4 style="font-size:16px;font-weight:bold;">Heading 4</h4></a>\
                    <a class="dropdown-item sk heading" heading="h5" href="javascript:" style="padding:.25rem 1.25rem;"><h5 style="font-size:15px;font-weight:bold;">Heading 5</h5></a>\
                    <a class="dropdown-item sk heading" heading="h6" href="javascript:" style="padding:.25rem 1.25rem;"><h6 style="font-size:14px;font-weight:bold;">Heading 6</h6></a>\
                </div>\
            </div>\
            <div class="sk-btn dropdown">\
                <button type="button" class="sk bold dropdown-toggle" id="dropdownMenuF'+id+'" title="Font Sizes" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Font Sizes </button>\
                <div class="dropdown-menu" aria-labelledby="dropdownMenuF'+id+'">\
                    <a class="dropdown-item font-size" size="1" href="javascript:" style="padding:.25rem 1.25rem;">8pt</a>\
                    <a class="dropdown-item font-size" size="2" href="javascript:" style="padding:.25rem 1.25rem;">10pt</a>\
                    <a class="dropdown-item font-size" size="3" href="javascript:" style="padding:.25rem 1.25rem;">12pt</a>\
                    <a class="dropdown-item font-size" size="4" href="javascript:" style="padding:.25rem 1.25rem;">14pt</a>\
                    <a class="dropdown-item font-size" size="5" href="javascript:" style="padding:.25rem 1.25rem;">18pt</a>\
                    <a class="dropdown-item font-size" size="6" href="javascript:" style="padding:.25rem 1.25rem;">24pt</a>\
                    <a class="dropdown-item font-size" size="7" href="javascript:" style="padding:.25rem 1.25rem;">36pt</a>\
                </div>\
            </div>\
        </div>';
        var group3 = '<div class="sk-btn-group">\
                <div class="sk-btn"><button type="button" class="sk paragraph" heading="p"><i class="fas fa-paragraph fs-17"></i></button></div>\
                <div class="sk-btn"><button type="button" class="sk bold" title="Bold"><i class="fas fa-bold fs-17"></i></button></div>\
                <div class="sk-btn"><button type="button" class="sk underline" title="Underline"><i class="fas fa-underline fs-17"></i></button></div>\
                <div class="sk-btn"><button type="button" class="sk italic" title="Italic"><i class="fas fa-italic fs-17"></i></button></div>\
                <div class="sk-btn dropdown">\
                    <button type="button" class="sk color" title="Text Color"><i class="fas fa-font fs-17"></i><span class="sk-preview" style="background-color:rgb(0,0,0);"></span></button>\
                    <button type="button" class="sk dropdown-toggle dropdown-toggle-split" id="dropdownMenuColor'+id+'" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">\
                        <span class="sr-only">Toggle Dropdown</span>\
                    </button>\
                    <div class="dropdown-menu p-2 aria-labelledby="dropdownMenuColor'+id+'">\
                        <div class="color-picker" acp-color="#000000" acp-show-rgb="no" acp-show-hsl="no" acp-show-hex="yes" acp-palette="PALETTE_MATERIAL_CHROME" acp-palette-editable></div>\
                        <button type="button" class="btn btn-secondary btn-sm btn-block mt-2" title="No color">No color <i class="fas fa-times"></i></button>\
                    </div>\
                </div>\
                <div class="sk-btn dropdown">\
                    <button type="button" class="sk background-color" title="Background Color">\
                        <i class="fas fa-font fs-17" style="background-color:rgb(0,0,0,0.2);"></i>\
                        <span class="sk-preview" style="background-color:rgb(0,0,0);"></span>\
                    </button>\
                    <button type="button" class="sk dropdown-toggle dropdown-toggle-split" id="dropdownMenuBgColor'+id+'" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">\
                        <span class="sr-only">Toggle Dropdown</span>\
                    </button>\
                    <div class="dropdown-menu p-2" aria-labelledby="dropdownMenuBgColor'+id+'">\
                        <div class="background-color-picker" acp-color="#000000" acp-show-rgb="no" acp-show-hsl="no" acp-show-hex="no" acp-palette="PALETTE_MATERIAL_CHROME" acp-palette-editable></div>\
                        <button type="button" class="btn btn-secondary btn-sm btn-block mt-2 sk no-background" title="No color">No background color <i class="fas fa-times"></i></button>\
                    </div>\
                </div>\
            </div>';
        var group4 = '<div class="sk-btn-group">\
            <div class="sk-btn"><button type="button" class="sk left" title="Align Left"><i class="fas fa-align-left fs-17"></i></button></div>\
            <div class="sk-btn"><button type="button" class="sk center" title="Align Center"><i class="fas fa-align-center fs-17"></i></button></div>\
            <div class="sk-btn"><button type="button" class="sk right" title="Align Right"><i class="fas fa-align-right fs-17"></i></button></div>\
            <div class="sk-btn"><button type="button" class="sk justify" title="Justify"><i class="fas fa-align-justify fs-17"></i></button></div>\
            </div>';
        var group5 = '<div class="sk-btn-group">\
                <div class="sk-btn dropdown">\
                    <button type="button" class="sk list dropdown-toggle" id="dropdownMenuBullet'+id+'" data-toggle="dropdown" aria-expanded="false" title="Bullet list"><i class="fas fa-list-ul fs-17"></i></button>\
                    <div class="dropdown-menu" aria-labelledby="dropdownMenuBullet'+id+'">\
                        <a class="dropdown-item sk bullet" bullet="disc" cmd="insertUnorderedList" href="javascript:">Default</a>\
                        <a class="dropdown-item sk bullet" bullet="circle" href="javascript:">Circle</a>\
                        <a class="dropdown-item sk bullet" bullet="square" href="javascript:">Square</a>\
                        <a class="dropdown-item sk bullet" bullet="number" cmd="insertOrderedList" href="javascript:">Number</a>\
                    </div>\
                </div>\
                <div class="sk-btn"><button type="button" class="sk outdent" title="Text Indent"><i class="fas fa-outdent fs-17"></i></button></div>\
                <div class="sk-btn"><button type="button" class="sk indent" title="Text Indent"><i class="fas fa-indent fs-17"></i></button></div>\
                <div class="sk-btn"><button type="button" class="sk text-indent" title="Text Indent First"><i class="fas fa-step-forward fs-17"></i></button></div>\
            </div>';
        var group7 = '<div class="sk-btn-group">\
                <div class="sk-btn"><button type="button" class="sk reset">Reset Style</button></div>\
                <div class="sk-btn"><button type="button" class="sk all-code"><i class="fas fa-code"></i></button></div>\
            </div>';
        var group6 = '<div class="sk-btn-group">\
            <div class="sk-btn"><button type="button" class="sk hr" title="Horizontal line"><i class="fas fa-minus"></i></button></div>\
            <div class="sk-btn"><button type="button" class="sk link" title="Insert/Edit link"><i class="fas fa-link"></i></button></div>\
            <div class="sk-btn"><button type="button" class="sk image" title="Insert/Edit image"><i class="far fa-image fs-17"></i></button></div>\
        </div>';
        var group8 = '<div class="sk-sort">\
            <div class="sk-btn"><button type="button" class="sk sort" title="Sort" style="font-weight:bold;">Sort</button></div>\
            <div class="sk-btn"><button type="button" class="sk save" title="Source Code" style="font-weight:bold; display:none;">Save</button></div>\
            <div class="sk-btn"><button type="button" class="sk cancel" title="Source Code" style="font-weight:bold; display:none;">Cancel</button></div>\
        </div>';
        var group9 = '<div class="float-right sk-full-screen"><div class="sk-btn"><button type="button" class="sk full-screen" title="Full Screen"><i class="fas fa-expand"></i></button></div></div>'; 
        var codeModal = $('<div class="modal fade" id="sk-code-'+id+'" abindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">\
                <div class="modal-dialog modal-xl">\
                    <div class="modal-content">\
                        <div class="modal-header"><h5 class="p-0">Source Code</h5></div>\
                        <div class="modal-body"><textarea class="form-control" name="source_code" rows="30"></textarea></div>\
                        <div class="modal-footer"><button class="btn btn-primary sk-ok">OK</button><button class="btn btn-secondary sk-dismiss">CANCEL</button></div>\
                    </div>\
                </div>\
            </div>');
        var LinkModal = $('<div class="modal fade" id="sk-link-'+id+'" abindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">\
            <div class="modal-dialog modal-xl">\
                <div class="modal-content">\
                    <div class="modal-header"><h5 class="p-0">Insert/Edit Link</h5></div>\
                    <div class="modal-body">\
                        <div class="form-group">\
                            <label>URL</label>\
                            <input type="text" name="hyperlink" class="form-control">\
                        </div>\
                        <div class="form-group">\
                            <label>Title</label>\
                            <input type="text" name="link-title" class="form-control">\
                        </div>\
                        <div class="form-group">\
                            <label>Open link in...</label>\
                            <select name="link-target" class="form-control">\
                                <option value="_self" selected>Current Window</option>\
                                <option value="_blank">New Window</option>\
                            </select>\
                        </div>\
                    </div>\
                    <div class="modal-footer"><button class="btn btn-primary sk-ok">SAVE</button><button class="btn btn-secondary sk-dismiss">CANCEL</button></div>\
                </div>\
            </div>\
        </div>');
        var ImageModal = $('<div class="modal fade" id="sk-image-manager-'+id+'" tabindex="-1" role="dialog" aria-labelledby="imageManagerTitle" aria-hidden="true">\
            <div class="modal-dialog modal-xl" role="document">\
                <div class="modal-content">\
                    <div class="modal-body">\
                        <div class="row">\
                            <div class="col-lg-12 border-bottom pb-2">\
                                <span style="line-height:20px; font-size:20px; font-weight:bold;">Image Manager</span>\
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">\
                                    <span aria-hidden="true"><i class="fas fa-times"></i></span>\
                                </button>\
                            </div> \
                        </div>\
                        <div class="row im-s">\
                            <div class="col-12"><div class="form-group mt-2"><code class="img-code"><img></code></div></div>\
                            <div class="col-12">\
                                <div class="form-group">\
                                    <label>Source</label>\
                                    <div class="input-group mb-3">\
                                        <input type="text" name="im_source" class="form-control" placeholder="Source" >\
                                        <div class="input-group-append">\
                                            <button class="btn btn-outline-dark" type="button"><i class="fas fa-search-plus"></i></button>\
                                        </div>\
                                    </div>\
                                </div>\
                            </div>\
                            <div class="col-lg-4 col-md-6 col-xs-12">\
                                <div class="form-group">\
                                    <label>alt=""</label>\
                                    <input type="text" class="form-control" name="im_alt" required="true">\
                                </div>\
                            </div>\
                            <div class="col-lg-4 col-md-6 col-xs-12">\
                                <div class="form-group">\
                                    <label>title=""</label>\
                                    <input type="text" class="form-control" name="im_title">\
                                </div>\
                            </div>\
                            <div class="col-lg-4 col-md-6 col-xs-12"><div class="form-group"><label>class=""</label><input type="text" class="form-control" name="im_class"></div></div>\
                            <div class="col-lg-12 col-md-12 col-xs-12"><div class="form-group"><labrl></label>Hyperlink :</label><input type="text" class="form-control" name="hyperlink"></div></div>\
                            <div class="col-lg-12 mt-2 mb-2">\
                                <div class="form-group">\
                                    <label>Dimension</label>\
                                    <div class="input-group">\
                                        <div class="input-group-prepend">\
                                            <span class="input-group-text"><i class="fas fa-ruler-combined fa-lg"></i></span>\
                                        </div>\
                                        <input type="text" class="form-control" name="im_width" placeholder="Width">\
                                        <input type="text" class="form-control" name="im_height" placeholder="Height">\
                                    </div>\
                                </div>\
                            </div>\
                            <div class="col-lg-6 col-md-6 col-xs-12"><div class="form-group"><label><input type="checkbox" name="im_caption" class="mr-1">Add Caption</label></div></div>\
                            <div class="col-lg-12 im-footer">\
                                <div class="float-right">\
                                    <button type="button" class="btn btn-primary btn-sm im-select">Ok</button>\
                                    <button type="button" class="btn btn-secondary btn-sm im-close" data-dismiss="modal">Cancel</button>\
                                </div>\
                            </div>\
                        </div>\
                        <div class="row im-f" style="display: none;">\
                            <div class="col-lg-12 im-tools">\
                                <button class="btn btn-outline-primary btn-sm im-upload" title="New upload"><i class="fas fa-upload"></i>&nbsp;Upload</button>\
                                <button class="btn btn-outline-dark btn-sm im-refresh" title="Refresh"><i class="fas fa-sync fa-xs"></i>&nbsp;Refresh</button>\
                                <button class="btn btn-outline-danger btn-sm im-delete" title="Delete"><i class="fas fa-trash fa-xs"></i>&nbsp;Delete</button>\
                                <div class="float-right">\
                                <a href="javascript:" class="btn btn-outline-dark btn-sm im-view -list"><i class="fas fa-list-ul"></i></a>\
                                <a href="javascript:" class="btn btn-outline-dark btn-sm im-view -grid"><i class="fas fa-th-large"></i></a>\
                                </div>\
                            </div>\
                            <div class="col-lg-12"><div class="im-content-image im-container"></div></div>\
                            <div class="col-lg-12 im-footer">\
                                <div class="float-right">\
                                    <button type="button" class="btn btn-primary btn-sm im-select">Insert</button>\
                                    <button type="button" class="btn btn-secondary btn-sm im-cancel">Cancel</button>\
                                </div>\
                            </div>\
                        </div>\
                        <div class="row im-u" style="display: none;">\
                            <div class="col-lg-12"><div class="im-content-upload" style="display: grid;"><span class="choose" style="margin: auto;">Choose file</span></div></div>\
                            <div class="col-lg-12 float-right"><button class="btn btn-secondary my-3 btn-sm im-btn-choose">Add files<input type="file" name="im_upload" multiple style="display: none"></button></div>\
                            <div class="col-lg-12 im-footer">\
                                <div class="float-right">\
                                    <button class="btn btn-primary btn-sm im-upload">Upload</button>\
                                    <button class="btn btn-secondary btn-sm im-cancel">Cancel</button>\
                                </div>\
                            </div>\
                        </div>\
                    </div>\
                </div>\
            </div>\
        </div>');
        var templateModal = $('<div class="modal fade" id="sk-template-'+id+'" tabindex="-1" role="dialog" aria-labelledby="templateTitle" aria-hidden="true">\
            <div class="modal-dialog modal-lg" role="document">\
            <div class="modal-content">\
                <div class="modal-body">\
                <div class="row">\
                    <div class="col-lg-12">\
                    <span>Template</span>\
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">\
                        <span aria-hidden="true"><i class="fas fa-times"></i></span>\
                    </button>\
                    </div> \
                </div>\
                <div class="row">\
                    <div class="col-lg-12">\
                    <button type="button" class="btn btn-primary btn-block mt-2 select-template">เลือก</button>\
                    </div>\
                </div>\
                <div class="template-item card mt-2">\
                    <div class="row">\
                    <div class="col-lg-4 img" data-text="Image" style="min-height:20px;"><div style="display:grid; padding: 15px 0 15px 0;"><h5 style="margin:auto;">IMAGE (Col-4)</h5></div></div>\
                    <div class="col-lg-8 txt" data-text="Text" style="min-height:20px;"><div style="display:grid; padding: 15px 0 15px 0;"><h5 style="margin:auto;">TEXT (Col-8)</h5></div></div>\
                    </div>\
                </div>\
                <div class="template-item card mt-2">\
                    <div class="row">\
                    <div class="col-lg-6 img" data-text="Image" style="min-height:20px;"><div style="display:grid; padding: 15px 0 15px 0;"><h5 style="margin:auto;">IMAGE (Col-6)</h5></div></div>\
                    <div class="col-lg-6 txt" data-text="Text" style="min-height:20px;"><div style="display:grid; padding: 15px 0 15px 0;"><h5 style="margin:auto;">TEXT (Col-6)</h5></div></div>\
                    </div>\
                </div>\
                <div class="template-item card mt-2">\
                    <div class="row">\
                    <div class="col-lg-8 img" data-text="Image" style="min-height:20px;"><div style="display:grid; padding: 15px 0 15px 0;"><h5 style="margin:auto;">IMAGE (Col-8)</h5></div></div>\
                    <div class="col-lg-4 txt" data-text="Text" style="min-height:20px;"><div style="display:grid; padding: 15px 0 15px 0;"><h5 style="margin:auto;">TEXT (Col-4)</h5></div></div>\
                    </div>\
                </div>\
                <div class="template-item card mt-2">\
                    <div class="row">\
                    <div class="col-lg-12 txt" data-text="Text" style="min-height:20px;"><div style="display:grid; padding: 15px 0 15px 0;"><h5 style="margin:auto;">TEXT</h5></div></div>\
                    </div>\
                </div>\
                <div class="template-item card mt-2">\
                    <div class="row">\
                    <div class="col-lg-4 txt" data-text="Text" style="min-height:20px;"><div style="display:grid; padding: 15px 0 15px 0;"><h5 style="margin:auto;">TEXT (Col-4)</h5></div></div>\
                    <div class="col-lg-8 img" data-text="Image" style="min-height:20px;"><div style="display:grid; padding: 15px 0 15px 0;"><h5 style="margin:auto;">IMAGE (Col-8)</h5></div></div>\
                    </div>\
                </div>\
                <div class="template-item card mt-2">\
                    <div class="row">\
                    <div class="col-lg-6 txt" data-text="Text" style="min-height:20px;"><div style="display:grid; padding: 15px 0 15px 0;"><h5 style="margin:auto;">TEXT (Col-6)</h5></div></div>\
                    <div class="col-lg-6 img" data-text="Image" style="min-height:20px;"><div style="display:grid; padding: 15px 0 15px 0;"><h5 style="margin:auto;">IMAGE (Col-6)</h5></div></div>\
                    </div>\
                </div>\
                <div class="template-item card mt-2">\
                    <div class="row">\
                    <div class="col-lg-8 txt" data-text="Text" style="min-height:20px;"><div style="display:grid; padding: 15px 0 15px 0;"><h5 style="margin:auto;">TEXT (Col-8)</h5></div></div>\
                    <div class="col-lg-4 img" data-text="Image" style="min-height:20px;"><div style="display:grid; padding: 15px 0 15px 0;"><h5 style="margin:auto;">IMAGE (Col-4)</h5></div></div>\
                    </div>\
                </div>\
                <div class="template-item card mt-2">\
                        <div class="row">\
                    <div class="col-lg-3 img" data-text="Image" style="min-height:20px;"><div style="display:grid; padding: 15px 0 15px 0;"><h5 style="margin:auto;">IMAGE</h5></div></div>\
                    <div class="col-lg-3 img" data-text="Image" style="min-height:20px;"><div style="display:grid; padding: 15px 0 15px 0;"><h5 style="margin:auto;">IMAGE</h5></div></div>\
                    <div class="col-lg-3 img" data-text="Image" style="min-height:20px;"><div style="display:grid; padding: 15px 0 15px 0;"><h5 style="margin:auto;">IMAGE</h5></div></div>\
                    <div class="col-lg-3 img" data-text="Image" style="min-height:20px;"><div style="display:grid; padding: 15px 0 15px 0;"><h5 style="margin:auto;">IMAGE</h5></div></div>\
                    </div>\
                </div>\
                <div class="template-item card mt-2">\
                    <div class="row">\
                    <div class="col-lg-4 img" data-text="Image" style="min-height:20px;"><div style="display:grid; padding: 15px 0 15px 0;"><h5 style="margin:auto;">IMAGE</h5></div></div>\
                    <div class="col-lg-4 img" data-text="Image" style="min-height:20px;"><div style="display:grid; padding: 15px 0 15px 0;"><h5 style="margin:auto;">IMAGE</h5></div></div>\
                    <div class="col-lg-4 img" data-text="Image" style="min-height:20px;"><div style="display:grid; padding: 15px 0 15px 0;"><h5 style="margin:auto;">IMAGE</h5></div></div>\
                    </div>\
                </div>\
                <div class="template-item card mt-2">\
                    <div class="row">\
                    <div class="col-lg-6 img" data-text="Image" style="min-height:20px;"><div style="display:grid; padding: 15px 0 15px 0;"><h5 style="margin:auto;">IMAGE</h5></div></div>\
                    <div class="col-lg-6 img" data-text="Image" style="min-height:20px;"><div style="display:grid; padding: 15px 0 15px 0;"><h5 style="margin:auto;">IMAGE</h5></div></div>\
                    </div>\
                </div>\
                <div class="template-item card mt-2">\
                    <div class="row">\
                    <div class="col-lg-12 img" data-text="Image" style="min-height:20px;"><div style="display:grid; padding: 15px 0 15px 0;"><h5 style="margin:auto;">IMAGE</h5></div></div>\
                    </div>\
                </div>\
                <div class="template-item card mt-2">\
                    <div class="row">\
                    <div class="col-lg-6 txt" data-text="Text" style="min-height:20px;"><div style="display:grid; padding: 15px 0 15px 0;"><h5 style="margin:auto;">TEXT</h5></div></div>\
                    <div class="col-lg-6 txt" data-text="Text" style="min-height:20px;"><div style="display:grid; padding: 15px 0 15px 0;"><h5 style="margin:auto;">TEXT</h5></div></div>\
                    </div>\
                </div>\
                <div class="template-item card mt-2">\
                    <div class="row">\
                    <div class="col-lg-4 txt" data-text="Text" style="min-height:20px;"><div style="display:grid; padding: 15px 0 15px 0;"><h5 style="margin:auto;">TEXT</h5></div></div>\
                    <div class="col-lg-4 txt" data-text="Text" style="min-height:20px;"><div style="display:grid; padding: 15px 0 15px 0;"><h5 style="margin:auto;">TEXT</h5></div></div>\
                    <div class="col-lg-4 txt" data-text="Text" style="min-height:20px;"><div style="display:grid; padding: 15px 0 15px 0;"><h5 style="margin:auto;">TEXT</h5></div></div>\
                    </div>\
                </div>\
                <div class="template-item card mt-2">\
                    <div class="row">\
                    <div class="col-lg-3 txt" data-text="Text" style="min-height:20px;"><div style="display:grid; padding: 15px 0 15px 0;"><h5 style="margin:auto;">TEXT</h5></div></div>\
                    <div class="col-lg-3 txt" data-text="Text" style="min-height:20px;"><div style="display:grid; padding: 15px 0 15px 0;"><h5 style="margin:auto;">TEXT</h5></div></div>\
                    <div class="col-lg-3 txt" data-text="Text" style="min-height:20px;"><div style="display:grid; padding: 15px 0 15px 0;"><h5 style="margin:auto;">TEXT</h5></div></div>\
                    <div class="col-lg-3 txt" data-text="Text" style="min-height:20px;"><div style="display:grid; padding: 15px 0 15px 0;"><h5 style="margin:auto;">TEXT</h5></div></div>\
                    </div>\
                </div>\
                <div class="row">\
                    <div class="col-lg-12">\
                    <button type="button" class="btn btn-primary btn-block mt-2 select-template">เลือก</button>\
                    </div>\
                </div>\
                </div>\
            </div>\
            </div>\
        </div>');
        var addButton = $('<div class="sk-footer"><button type="button" class="btn btn-secondary btn-block sk add" style="font-size:20px; border-radius:unset;">Add Template+</button></div>');
        var imageArea = '<div class="sk-img img-p" class=" style="display:grid;" ><h5 style="margin:auto;">IMAGE</h5></div>';
        var removeButton = '\
        <div class="col-12 sk-panel">\
            <div class="sk-btn float-right mt-2">\
                <select name="sort_select" class="sk sort-select" style="display:none;"></select>\
                <button type="button" class="sk move" tiitle="Move" style="display:none;"><i class="fas fa-arrows-alt"></i></button>\
                <button type="button" class="sk source-code"><i class="fas fa-code"></i></button>\
                <button type="button" class="sk align-items-center" title="Align item center"><i class="fas fa-align-center"></i></button>\
                <button type="button" class="sk remove-content bg-danger" title="Remove Content"><i class="fas fa-times" style="height:unset;"></i></button>\
            </div>\
        </div>';
        //================= Build Object =================//
        area.append(tools);
        tools.append(group1+group2+group3+group4+group5+group6+group7+group8+group9);
        area.append('<div class="sk-body"></div>');
        if(obj.height!=null) area.find('.sk-body').css({'height':obj.height,'overflow-y':'scroll','overflow-x':'hidden'});
        area.append(addButton);
        if(value.length>0)area.find('.sk-body').append(value);
        ////================= Fetch Data ================= //
        let countRow = 0;
        var sortSelect = '';
        area.find('.row').each(function(i,item){
            $.each($(item).find('.col-txt'),function(k,col){
                $(col).attr('contentEditable',true);
                $(col).attr('data-text','Text');
            });
            $.each($(item).find('.col-img'),function(k,col){
                $(col).find('.sk-img').addClass('img-p');
                if($(this).find('img').length==0 && $(this).find('.img-p').length==0)$(col).append(imageArea);
                $(this).find('.img-caption').attr('contentEditable',true);             
                $(this).find('.img-p').each(function(){
                    let image  = $(this).find('img');
                    $(this).find('a').remove();
                    $(this).append(image);
                })
            });
            countRow++;
            sortSelect += '<option value="'+countRow+'">'+countRow+'</option>';
        });
        
        
        //================= Remove button & Drag button =================//
        var rows = area.find('.sk-body').find('.row');
        $.each(rows,function(k,v){if($(this).find('.sk-panel').length==0)$(this).prepend(removeButton);});
        //================= Command in editor =================//
        area.find('.sk.undo').click(function(){
            document.getSelection();
            document.execCommand("undo",false,null);
            setTimeout(()=>{formStorage()},1000);
        });
        area.find('.sk.redo').click(function(){
            document.getSelection();
            document.execCommand("redo",false,null);
            setTimeout(()=>{formStorage()},1000);
        });

        const Heading = (e) =>{
            const h = $(e).attr('heading');
            document.getSelection();            
            document.execCommand('formatblock', false, `${h}`);
        }

        const TextIndent = (e) => {
            var curSelect = document.getSelection();
            const textIndent = `<p style="text-indent:60px">${curSelect}</p>`;
            if(curSelect.baseNode.nodeName=='#text' && curSelect!=''){
                document.execCommand('insertHTML', false, textIndent);
            }
        }

        area.find('.sk.heading').click(function(){ Heading(this); setTimeout(()=>{formStorage()},1000); });
        area.find('.sk.text-indent').click(function(){ TextIndent(); setTimeout(()=>{formStorage()},1000); });
        area.find('.sk.paragraph').click(function(){
            document.getSelection();
            document.execCommand('formatblock', false, 'p');
            setTimeout(()=>{formStorage()},1000);
        });
        area.find('.font-size').click(function(){
            document.getSelection();
            document.execCommand('fontSize',false,parseFloat($(this).attr('size'))) 
            setTimeout(()=>{formStorage()},1000);
        });
        area.find('.sk.bold').click(function(){
            document.getSelection();
            document.execCommand("bold",false,null)
            setTimeout(()=>{formStorage()},1000);
        });
        area.find('.sk.underline').click(function(){
            document.getSelection();
            document.execCommand("underline",false,null)
            setTimeout(()=>{formStorage()},1000);
        });
        area.find('.sk.italic').click(function(){
            document.getSelection();
            document.execCommand("italic",false,null)
            setTimeout(()=>{formStorage()},1000);
        });
        area.find('.sk.color').click(function(){
            color=$(this).find('.sk-preview');
            color=color.attr('style');
            if(color!=undefined)color=color.split(':');
            color=color[1].replace(';','');
            document.getSelection();document.execCommand('foreColor',false,color);
            setTimeout(()=>{formStorage()},1000);
        })
        AColorPicker.from(area.find('.color-picker')).on('change',(picker,color)=>{area.find('.sk-preview').css('background-color',color);document.getSelection();document.execCommand('foreColor',false,color)});
        AColorPicker.from(area.find('.background-color-picker')).on('change',(picker,color)=>{area.find('.sk-tools').next().find('.col-img').css('background-color',color);area.find('.sk-tools').next().find('.col-txt').css('background-color',color);});
        // area.find('.sk.code').click(function(){codeModal.find('textarea').html(area.find('.sk-tools').next().html().trim()); codeModal.modal('show')});

        //------- SOURCE CODE -------/
        area.on('click','.source-code',function(el){
            console.log(el.currentTarget.parentNode.parentNode);
            const current = $(this);
            row = current.closest('.row');
            html = row.clone();
            html.find('.sk-panel').remove();

            // const select = row.find('div[class^="col-"]');
            codeModal.find('textarea').html(html.html().trim()); 
            codeModal.modal({backdrop: false,show:true});
            $('.modal-dialog').draggable({handle:".modal-header"});
            codeModal.on('click','.sk-ok',function(){
                const code = $(this).closest('.modal-content').find('textarea').val();
                row.html('');
                row.append(removeButton);
                row.append(code);
                codeModal.modal('hide');
                codeModal.find('textarea').html('');
            })
            codeModal.find('.sk-dismiss').click(function(){ 
                codeModal.modal('hide');
                codeModal.find('textarea').html('');
            });
        });
        
        // All Code

        area.on('click','.all-code',function(){
            let content = $('.sk-body');
            let html = content.clone();
            html.find('.sk-panel').remove();
            codeModal.find('textarea').val(html.html().trim());
            // codeModal.find('.sk-ok').css('display','none');
            // codeModal.find('.sk-ok').prop('disabled',true);
            codeModal.modal({backdrop: false,show:true});
            $('.modal-dialog').draggable({handle:".modal-header"});
            codeModal.on('click','.sk-ok',function(){
                let newHtml = codeModal.find('textarea').val();
                let toObject = $(newHtml);
                area.find('.sk-body').html('');
                area.find('.sk-body').append(toObject);
                area.find('.row').prepend(removeButton);
                codeModal.modal('hide');
                codeModal.find('textarea').html('');          
            });
            codeModal.find('.sk-dismiss').click(function(){ 
                codeModal.modal('hide');
                codeModal.find('textarea').html('');
            });

        });        

        //------- /SOURCE CODE -------//

        area.find('.sk.left').click(function(){
            document.getSelection();
            document.execCommand('justifyLeft',false,null);
            setTimeout(()=>{formStorage()},1000);
        });
        area.find('.sk.center').click(function(){
            document.getSelection();
            document.execCommand('justifyCenter',false,null);
            setTimeout(()=>{formStorage()},1000);
        });
        area.find('.sk.right').click(function(){
            document.getSelection();
            document.execCommand('justifyRight',false,null);
            setTimeout(()=>{formStorage()},1000);
        });
        area.find('.sk.justify').click(function(){
            document.getSelection();
            document.execCommand('justifyFull',false,null);
            setTimeout(()=>{formStorage()},1000);
        });
        area.find('.sk.bullet').click(function(){
            if($(this).attr('bullet')=='number'){
                document.getSelection();document.execCommand('insertOrderedList',false,null)
            }else{
                const select = document.getSelection();
                document.execCommand('insertUnorderedList',false,null);
                // console.log($(select.baseNode.parentNode).closest('ul').css('list-style-type',$(this).attr('bullet')));
            }
            setTimeout(()=>{formStorage()},1000);
        });
        area.find('.sk.list-number').click(function(){
            document.getSelection();
            document.execCommand($(this).attr('cmd'),false,null);
            setTimeout(()=>{formStorage()},1000);
        });
        
        area.find('.sk.indent').click(function(){
            document.getSelection();
            document.execCommand('indent',false,null);
            setTimeout(()=>{formStorage()},1000);
        });
        area.find('.sk.outdent').click(function(){
            document.getSelection();
            document.execCommand('outdent',false,null);
            setTimeout(()=>{formStorage()},1000);
        });
        area.find('.sk.hr').click(function(){
            document.getSelection();
            document.execCommand('insertHorizontalRule',false,null);
            setTimeout(()=>{formStorage()},1000);
        });
        const hyperLink = () => {
            sText = document.getSelection();
            linkURL = LinkModal.find('input[name="hyperlink"]').val();
            linkTitle = LinkModal.find('input[name="link-title"]').val();
            linkTarget = LinkModal.find('select[name="link-target"]').val();
            if(sText.baseNode.nodeName=='#text' && sText!=''){
                document.execCommand(
                    'insertHTML', 
                    false, 
                    '<a href="https://www.example.com" target="_self" title="">' + sText + '</a>'
                )
            }
            current = $(sText.anchorNode?.parentNode);
            LinkModal.modal('show');
            LinkModal.find('input[name="hyperlink"]').val($(sText.anchorNode?.parentNode).attr('href'))
            LinkModal.find('input[name="link-title"]').val($(sText.anchorNode?.parentNode).attr('title'))
            // LinkModal.find('input[name="link-target"]').val($(sText.anchorNode?.parentNode).attr('title'))
            LinkModal.find('select[name="link-target"]').map(function(){
                if($(this).val() == $(sText.anchorNode?.parentNode).attr('target')){
                    $(this).attr('selected');
                }
            })            
            
            $(document).on('click','button.sk-ok',function(){
                current.attr({
                    'href': LinkModal.find('input[name="hyperlink"]').val(),
                    'target': LinkModal.find('select[name="link-target"]').val(),
                    'title': LinkModal.find('input[name="link-title"]').val()
                });
                setTimeout(()=>{formStorage()},1000);
                LinkModal.modal('hide');
            })    
            LinkModal.find('button.sk-dismiss').on('click',function(){
                LinkModal.modal('hide');
                LinkModal.find('[name="hyperlink"]').val('');
                LinkModal.find('[name="link-title"]').val('');
            })
            
        }
        
        area.find('.sk.link').click(function(){ hyperLink() });
        area.find('.sk.reset').click(function(){area.find('.col-txt').each(function(){el=$(this).find('[style]');$.each(el,function(i,v){$(v).removeAttr('style')})})});
        area.find('.sk.add').click(function(){templateModal.modal('show')});
        area.find('.sk.no-background').click(function(){area.find('.sk-tools').next().find('.col-img').css('background-color','unset');area.find('.sk-tools').next().find('.col-txt').css('background-color','unset');})
        //================= Add Row =================//
        $(document).on('click','.template-item',function(){$(this).addClass('border-selected');$('.template-item').not(this).removeClass('border-selected')})
        templateModal.find('.select-template').click(function(){
            const template = $('.border-selected').children().clone();
            template.removeClass('template-item active mt-2');
            template.find('.sk-panel').remove();
            template.prepend(removeButton);
            template.find('.txt').children().removeAttr('style');
            template.find('.img').children().removeAttr('style');
            template.find('.img').removeClass('img').addClass('col-img').children().addClass('sk-img img-p').find('h5').remove();
            template.find('.col-img').removeAttr('style');
            template.find('.sk-img').attr('style','min-height:20px');
            template.find('.txt').removeClass('txt').addClass('col-txt').attr('contentEditable',true);
            template.removeClass('card');
            template.find('.col-txt').html('');
            template.find('.col-txt').find('h5').remove();
            area.find('.sk-body').append(template);
            $('.border-selected').removeClass('border-selected');
            templateModal.modal('hide');
            area.find('.sk-body').animate({scrollTop:area.find('.sk-body')[0].scrollHeight},800);
            setTimeout(()=>{formStorage()},1000);
        });
        //================= Sort Zone =================//
        area.find('.sk.sort').click(function(){
            arrangeAble($(this));
        })
        area.find('.sk.sort-select').each(function(){
            $(this).html(sortSelect);
        })
        area.find('.sk.sort-select').each(function(i,e){
            let no = i+1;
            $(e).children().each(function(){let selected=parseFloat($(this).val())==no?true:false;if(selected===true){$(this).attr('selected','selected')}})
        })
        function arrangeAble(ev) {
            var original = area.find('.sk-body').html();
            area.find('.sk-btn').css(display.none);  
            area.find('.sk-panel').find('.sk-btn').css(display.block);
            area.find('.sk-sort').find('.sk-btn').removeAttr('style');
            area.find('.sk-sort').addClass('float-right');
            area.find('.sk-sort').find('.sort').css(display.none);
            area.find('.sk-sort').find('.save').css(display.block);
            area.find('.sk-sort').find('.cancel').css(display.block);
            area.find('.move').removeAttr('style');
            area.find('.sort-select').removeAttr('style');
            area.find('.sk-body').removeAttr('style');
            /////// Save ///////
            area.find('.sk.save').click(function(){                
                area.find('.sk-btn').removeAttr('style');
                area.find('.sk-sort').removeClass('float-right');
                area.find('.sort').css(display.block);
                area.find('.save').css(display.none);
                area.find('.cancel').css(display.none);
                area.find('.sk.move').css(display.none);
                area.find('.sk.sort-select').css(display.none);
                area.find('.sk-body').css({'height':obj.height,'overflow-y':'scroll','overflow-x':'hidden'});
                setTimeout(()=>{formStorage()},1000);
            });
            /////// Cancel ///////
            area.find('.sk.cancel').click(function(){                
                area.find('.sk-btn').removeAttr('style');
                area.find('.sk-btn').find('.sk-sort').removeAttr('style');
                area.find('.sk-sort').removeClass('float-right');
                area.find('.sk.move').css(display.none);
                area.find('.sk-body').html('');
                area.find('.sk-body').append(original);
                area.find('.sort').css(display.block);
                area.find('.save').css(display.none);
                area.find('.cancel').css(display.none);
                area.find('.sk-body').css({'height':obj.height,'overflow-y':'scroll','overflow-x':'hidden'});
            });
            $('.sk-body').find('.row').arrangeable({dragSelector:'.move'});
            formStorage()
        }
        //=================== Select Sort ===================//
        const bodyToSort = area.find('.sk-body');
        var df = 0;
        area.find('.sk.sort-select').on('click',function(){df=parseFloat($(this).val());})
        area.find('.sk.sort-select').on('change',function(){
            let n = parseFloat($(this).val());
            var rows = bodyToSort.find('.row');
            c = rows[(df-1)];
            rows[(df-1)].remove();
            bodyToSort.find('.row').each(function(i,el){                
                if(i==(n-2)){ $(c).insertAfter(el); }
            });
            area.find('.sk.sort-select').each(function(){
                let sl = $(this);
                sl.children().each(function(i,e){
                    $(e).removeAttr('selected');
                })
            })
            afterSelectSort()
            setTimeout(()=>{formStorage()},1000);
        });
        function afterSelectSort(){
            area.find('.sk.sort-select').each(function(k,v){
                let sl = $(this);
                sl.children().each(function(i,e){     
                    // console.log((k+1) +' == '+parseFloat($(e).val()));             
                    if((k+1)==parseFloat($(e).val())){ $(e).attr('selected','selected'); }
                })
            });
        }
        area.find('.sk.full-screen').on('click',function(){

            $(this).find('i').toggleClass('fa-expand fa-compress');
            var doc = window.document;
            var docEl = area.closest('.tab-content')[0];
            var requestFullScreen = docEl.requestFullscreen || docEl.mozRequestFullScreen || docEl.webkitRequestFullScreen || docEl.msRequestFullscreen;
            var cancelFullScreen = doc.exitFullscreen || doc.mozCancelFullScreen || doc.webkitExitFullscreen || doc.msExitFullscreen;
            if(!doc.fullscreenElement && !doc.mozFullScreenElement && !doc.webkitFullscreenElement && !doc.msFullscreenElement) {
                requestFullScreen.call(docEl);
                area.find('.sk-body').css('height','100vh');
            }else {
                cancelFullScreen.call(doc);
                area.find('.sk-body').css('height',obj.height);
            }
        })
        //================= Aligh Item =================//
        area.on('click','.sk.align-items-center',function(el){
            let r = $(this).closest('.row');
            let rs = r.attr('style');
            if (typeof rs === 'undefined'){ r.css('align-items','center'); }
            else { r.removeAttr('style'); }
            setTimeout(()=>{formStorage()},1000);
        })
        //================= Remove Row =================//
        $(document).on('click','.sk.remove-content',function(){
            $(this).closest('.row').remove();
            setTimeout(()=>{formStorage()},1000);
        });
        //================= Image Manager =================//
        var im = ImageModal;
        var ts = im.find('.im-s');
        var tf = im.find('.im-f');
        var tu = im.find('.im-u');
        var imUrl = window.location.pathname;
        var imUrlSegment = imUrl.split('/');
        var prefix = imUrlSegment[1];
        var imModule = imUrlSegment[2];
        var cpID = imUrlSegment[3];
        var categoryId = imUrlSegment[4];
        var imgCode = ts.find('.img-code');
        var img = null;
        var imgCodeHtml = imgCode.html();
        var imgCodeObj = $(imgCodeHtml);
        var choose = tu.find('.choose').clone();

        $(document).on('click','.sk-remove',function(){
            $(this).closest('.sk-row').remove();
            setTimeout(()=>{formStorage()},1000);
        });       
        area.on('click','.sk-img',function(){
            ImageModal.modal({backdrop:false,keyboard:false,show:true});myFolder();
            img = $(this);
            if($(this).find('img').length>0){
                image = $(this).find('img');
                ts.find('input[name="im_source"]').val(image.attr('src'));
                ts.find('input[name="im_class"]').val(image.attr('class'));
                ts.find('input[name="im_alt"]').val(image.attr('alt'));
                ts.find('input[name="im_title"]').val(image.attr('title'));
                ts.find('input[name="width"]').val(image.attr('width'));
                ts.find('input[name="height"]').val(image.attr('height'));
                if(image.attr('data-href')!='')ts.find('input[name="hyperlink"]').val(image.attr('data-href'));
                imgCodeObj.attr("src",ts.find('input[name="im_source"]').val());
                imgCodeObj.attr("class",ts.find('input[name="im_class"]').val());
                if(ts.find('input[name="im_alt"]').val()!='')imgCodeObj.attr("alt",ts.find('input[name="im_alt"]').val());
                if(ts.find('input[name="im_title"]').val()!='')imgCodeObj.attr("alt",ts.find('input[name="im_title"]').val());
                if(ts.find('input[name="width"]').val()!='')imgCodeObj.attr("width",ts.find('input[name="width"]').val());
                if(ts.find('input[name="height"]').val()!='')imgCodeObj.attr("height",ts.find('input[name="height"]').val());
                              
                imgCode.html(escapeHtml(imgCodeObj[0].outerHTML));
                if(image.parent().next().hasClass('img-caption')){ ImageModal.find('input[name="im_caption"]').prop('checked',true); }
            }else{
                image = $(this).append('<img class="img-fluid">');
            }
        });
        $(document).on('change keyup','input[name="im_source"]',function(){imgCodeObj.attr("src",ts.find('input[name="im_source"]').val());imgCode.html(escapeHtml(imgCodeObj[0].outerHTML));});
        $(document).on('keyup','input[name="im_class"]',function(){imgCodeObj.attr("class",ts.find('input[name="im_class"]').val());imgCode.html(escapeHtml(imgCodeObj[0].outerHTML));});
        $(document).on('keyup','input[name="im_alt"]',function(){imgCodeObj.attr("alt",ts.find('input[name="im_alt"]').val());imgCode.html(escapeHtml(imgCodeObj[0].outerHTML));});
        $(document).on('keyup','input[name="im_title"]',function(){imgCodeObj.attr("alt",ts.find('input[name="im_title"]').val());imgCode.html(escapeHtml(imgCodeObj[0].outerHTML));});
        $(document).on('keyup','input[name="width"]',function(){imgCodeObj.attr("width",ts.find('input[name="width"]').val());imgCode.html(escapeHtml(imgCodeObj[0].outerHTML));});
        $(document).on('keyup','input[name="height"]',function(){imgCodeObj.attr("height",ts.find('input[name="height"]').val());imgCode.html(escapeHtml(imgCodeObj[0].outerHTML));});
        ImageModal.on('click','.btn-outline-dark',function(){ts.hide();tf.show();tu.hide();});
        ImageModal.on('click','.im-select',function(){
            if ($(this).closest('.row').hasClass('im-f')) {
                if($(this).closest('.row').find('.im-checked').length==0){
                    alert('กรุณาเลือกรูป'); return false;
                }
                const select = $('.im-checked').find('img');
                ts.show();tf.hide();
                ts.find('input[name="im_source"]').val(select.attr('src'));
                imgCodeObj.attr("src",select.attr('src'));
                imgCode.html(escapeHtml(imgCodeObj[0].outerHTML));
                setTimeout(()=>{formStorage()},1000)
            }
            if($(this).closest('.row').hasClass('im-s')) {
                let required = ImageModal.find('input[required="true"]');
                let error = [];
                required.map(function(k,v){ 
                    // console.log(v,k)
                    if(v.value == ''){ v.classList.add('error'); error.push(v.getAttribute('name')) }
                    else{ v.classList.remove('error'); delete error[v.getAttribute('name')]; }
                })
                if(error.length < 1)
                {
                    if($(this).closest('.row').find('input[name="im_source"]').val()==''){
                        alert('กรุณาเลือกรูป'); return false;
                    }
                    const source = ImageModal.find('input[name="im_source"]');
                    $(this).find('.sk-img').find('h5').remove();
                    $(this).find('.sk-img').html('');
                    var c = ImageModal.find('input[name="im_class"]').val().split(' '), imgC=null;
                    var fixC = 'img-fluid';
                    let cf = Boolean;
                    let im_class = ImageModal.find('input[name="im_class"]');
                    const im_caption = ImageModal.find('input[name="im_caption"]');
                    for(i=0; i<c.length; i++){ cf=(c[i]==fixC)?true:false; }
                    if (ImageModal.find('input[name="im_class"]').val()==''){
                        ImageModal.find('input[name="im_class"]').val(fixC)
                    }else{
                        if(cf==false){ 
                            ImageModal.find('input[name="im_class"]').val(im_class.val()); 
                        }
                    }
                        
    
                    const imClass = ImageModal.find('input[name="im_class"]').val();
                    const imWidth = ImageModal.find('input[name="im_width"]').val();
                    const imHeight = ImageModal.find('input[name="im_height"]').val();
                    const hyperlink = ImageModal.find('input[name="hyperlink"]').val();
                    let newImg = img.find('img');
                    newImg.attr('src',source.val());
                    newImg.attr('class',imgC);
                    if(imClass!='') newImg.attr('class',imClass);
                    if(imWidth!='') newImg.attr('width',imWidth);
                    if(imHeight!='') newImg.attr('height',imHeight);
                    
                    if(ImageModal.find('input[name="im_alt"]').val()!='')newImg.attr('alt',ImageModal.find('input[name="im_alt"]').val());
                    if(ImageModal.find('input[name="im_title"]').val()!='')newImg.attr('title',ImageModal.find('input[name="im_title"]').val());
                    newImg.parent().attr('style','min-height:unset;');
                    img.find('img').append(newImg);
                    
                    if(im_caption.is(':checked')) 
                        if(newImg.parent().parent().find('.img-caption').length==1) 
                            $('.img-caption');
                        else 
                            $('<div class="img-caption" contenteditable="true">Caption</div>').insertAfter(newImg.parent());
                    else 
                        newImg.parent().parent().find('.img-caption').remove();
                    
                    if (hyperlink!='')  newImg.attr('data-href',hyperlink); 
    
                    setTimeout(()=>{formStorage()},1000)
                    // console.log($(this).find('.sk-img'));
                    ImageModal.modal('hide');                
                }
            }
        });
        ImageModal.on('click','.im-cancel',function(){
            if($(this).closest('.row').hasClass('im-f')){ts.show();tf.hide();}   
            if($(this).closest('.row').hasClass('im-u')){tf.show();tu.hide();}   
        });
        ImageModal.on('click','.im-upload',function(){ts.hide();tf.hide();tu.show();});
        ImageModal.on('click','.im-btn-choose',function(){$(this).find('[type="file"]')[0].click();});
        
        $(document).on('change','input[name="im_upload"]',function(){
            im.find('.im-content-upload').removeAttr('style');
            newIM = [];
            let row = $('<div class="row px-3"></div>');            
            $.each(this.files,function(i,v){    
                newIM.push(v);
                tu.find('.im-content-upload').html('')
                let thumbanil = $('<div class="col-lg-12 p-0"><div class="im-preview im-item sk-img rounded"><div class="im-image rounded-left"></div><div class="im-details"><div class="im-progress progress"><div class="progress-bar" role="progressbar" style="width: 0%;" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100">0%</div></div></div><div class="im-action"><button class="btn btn-danger btn-sm"><i class="far fa-trash-alt"></i></button></div></div></div>');
                var reader = new FileReader();
                reader.readAsDataURL(v);
                let size = v.size;
                let name = v.name;
                let sizeImg = (size/(1024*1024)).toFixed(2);
                if (sizeImg > 2) {
                    thumbanil.find('.im-details').prepend('<div class="im-name text-left"><span alt="'+name+'">'+name+'</span></div><div class="text-left"><small class="text-danger">*ขนาดไฟล์ไม่เกิน 2 MB</small></div>');
                    thumbanil.find('.im-preview').css('border', '1px solid #dc3545');
                } else {
                    thumbanil.find('.im-details').prepend('<div class="im-name text-left"><span alt="'+name+'">'+name+'</span></div>');
                }
                // thumbanil.find('.gu-details').append('<div class="text-left"><span>'+(size/(1024*1024)).toFixed(2)+' MB</span></div>');
                thumbanil.find('.im-details').prepend('<div class="im-name text-left"><span alt="'+name+'">'+name+'</span></div>');
                reader.onload = function(e) {
                    let image = new Image();
                    image.src = e.target.result;
                    let img = $('<div style="min-width:120px"></div>');
                    img.css({
                        'background-image' : 'url('+e.target.result+')',
                        'height' : '120px',
                        'display' : 'block',
                        'background-position': 'center',
                        'background-size': 'cover',
                    });
                    thumbanil.find('.im-image').append(img);
                }
                row.append(thumbanil);
                tu.find('.im-content-upload').append(row);
            });
            if(this.files.length==0) tu.find('.im-content-upload').append(choose);
        
        });
        $(document).on('click','.im-action .btn-danger',function(){
            $(this).parent().parent().parent().remove();
            $(this).parent().parent().parent().remove();
            if(tu.find('.im-item').length==0){
                tu.find('.im-content-upload').find('.row').remove();
                tu.find('.im-content-upload').css('display','grid');
                tu.find('.im-content-upload').append(choose);
            }
        });
        ImageModal.on('click','.im-upload',function(){
            let images = $('.im-image');
            images.each(function(i,ev){
                var curr = $(this);
                let progress = curr.next().find('.progress-bar');
                let row = curr.children().attr('style'),
                    find = row.split('"'),
                    block = find[1].split(";"),
                    contentType = block[0].split(":")[1],
                    realData = block[1].split(",")[1],
                    blob = b64toBlob(realData, contentType);
                    size = (blob.size/(1024*1024)).toFixed(2);
                if (size <= 2) {
                    var fd = new FormData();                    
                    fd.append("_method",'put');
                    fd.append("image",blob);
                    fd.append("_id",cpID);
                        
                    $.ajax({
                        headers: {'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')},
                        xhr: function() {
                            var xhr = new window.XMLHttpRequest();
                            xhr.upload.addEventListener("progress", function(evt) {
                                if (evt.lengthComputable) {
                                    var percentComplete = ((evt.loaded / evt.total) * 100);
                                    progress.css('width',percentComplete+'%');
                                    progress.html(percentComplete+'%');
                                }
                            }, false);
                            return xhr;
                        },
                        method : 'post',
                        url: prefix+'/'+imModule+'/upload/profile-images',
                        contentType:false,
                        processData:false,
                        cache:false,
                        data: fd,
                        success:function(res){
                            curr.next().find('.progress-bar').html('Uploaded').removeClass('bg-danger').addClass('bg-success');
                            setTimeout(function(){
                                curr.parent().parent().remove();
                                // $('.my-gl').prepend(glImage);
                            },1000);
                        },
                        error:function(){
                            curr.next().find('.progress-bar').html('Failed').addClass('bg-danger');
                        },
                        // complete:function(){ curr.next().find('.progress-bar').html('Uploaded.'); }
                    });
                }
            });
            myFolder()
        });
        function myFolder()
        {
            $.ajax({
                url : prefix+'/'+imModule+'/profile-images?ind='+categoryId+'&cp='+cpID,
                success: function (data) {
                    $.each(data,function(i, val){
                        tf.find('.im-content-image').append('<div class="im-image-grid"><img src="'+val+'" title="'+val.split('/')[4]+'"><div class="im-info" title="'+val.split('/')[4]+'">'+val.split('/')[4]+'</div></div>');
                    });
                }
            });
            tf.find('.im-content-image').html('');
        }
        $(document).on('click','.im-view',function(){if($(this).hasClass('-grid')) $('.im-image-list').toggleClass('im-image-list im-image-grid');else $('.im-image-grid').toggleClass('im-image-grid im-image-list');});
        ImageModal.on('click','.im-image-grid',function(){selected($(this))});
        $(document).on('click','.im-image-list',function(){selected($(this))});
        function selected(el)
        {
            console.log(el)
            if ($(el).hasClass('im-checked')) {
                $(el).removeClass('im-checked');
                // $('.im-image-grid').not(el).removeClass('im-checked');
            } else{
                $(el).addClass('im-checked');
                // $('.im-image-list').not(el).removeClass('im-checked');
            }
        }        
        ImageModal.on('click','.im-refresh',function(){myFolder()});
        ImageModal.on('click','.im-delete',function(){
            if ($('.im-checked').length>0) {
                let img = [];
                $.each(ImageModal.find('.im-checked'),function(k,v){
                    img.push($(v).find('img').attr('src')); 
                });
                // console.log(img)
                if(confirm('ลบรูปนี้ใช่หรือไม่!')){
                    $.ajax({method:'get',url: prefix+'/'+imModule+'/delete/profile-image',data:{u:img},dataType:'JSON',success:function(data){if(data===true)$('.im-checked').remove()}});
                }
            }
        })
        
        $(document).on('submit','#formEdit',function(e){
            const lang = area.attr('data-lang');    
            if(window.location.href.indexOf("members") > -1)
            {
                text = document.querySelector(`.sk-area[data-lang="${lang}"]`).querySelector('.sk-body').innerText;
 
                if(text !== '') $(`textarea[name="detail_${lang}"]`).html(text.replace(/\s+/g, ' '));
            }
                
            $.each(area.find('.sk-panel'),function(){$(this).remove();});        
            $.each(area.find('.col-img'),function(){
                $(this).removeAttr('style');
                $(this).find('h5').remove();
                $(this).find('.img-caption').removeAttr('contenteditable');
                $(this).find('.sk-img').each(function(){
                    let hyperlink = $(this).find('img').attr('data-href');
                    let img = $(this).find('img').remove('data-href');
                    if(typeof hyperlink !== typeof undefined) {
                        $(this).find('img').remove();
                        $(this).append('<a href="'+hyperlink+'"></a>');
                        $(this).find('a').append(img);
                    }
                })
            });
            area.find('.col-txt').removeAttr('style');
            $.each(area.find('.col-txt'),function(){
                $(this).removeAttr('contenteditable');
            });
            area.find('.col-img').find('.bg-light').removeClass('bg-light').addClass('img-');
            // console.log(area.find('.sk-body').html());
            // return false;
            // if($('textarea[name="more_'+lang+'"]').length>0) $('textarea[name="more_'+lang+'"]').html(area.find('.sk-body').html());
            box.html(area.find('.sk-body').html());
 
            localStorage.removeItem('formStorage');
        });

        
        let timer;
        var waitTime = 2000; 

        $(box).closest('.row').find('.sk-area').on('keyup',function(){
            clearTimeout(timer);
            timer = setTimeout(()=>{ formStorage(); }, waitTime);
        })
        $(box).closest('.row').find('.sk-area').on('keydown',function(){
            clearTimeout(timer);
        })


        function formStorage(){
            let formStore = JSON.parse(localStorage.getItem('formStorage'));
            let name = box.attr('name');

            value = area.find('.sk-body').html();
            if(value != ''){
                formStore[`${name}`] = value;
                localStorage.setItem(`formStorage`,JSON.stringify(formStore));
            }
            // console.log(JSON.parse(localStorage.getItem(`formStorage`)))

        }
   

        function escapeHtml(text) {
            var map = {'&':'&amp;','<':'&lt;','>':'&gt;','"':'&quot;',"'":'&#039;'};
            return text.replace(/[&<>"']/g, function(m) { return map[m]; });
        }

    };

    $.fn.extend({
        skEditor:function(options){
            options = $.extend({},options);
            this.each(function(){ new $.skEditor(this, options); });
            return this;
        }
    });

})(jQuery);