(function ($) {
	"use strict";

	var App = function () {
		var o = this; // Create reference to this instance
		$(document).ready(function () {
			o.initialize();
		}); // Initialize app when document is ready

	};
	var p = App.prototype;

	// =========================================================================
	// INIT
	// =========================================================================

	p.initialize = function () {
		// Init events
		this._eventCreate();
        this._eventUpdate();
        this._enableEvents();
        // this._tinymce();
    };

    p.initializeInPjax = function() {
      this._eventModalCreate();
      this._eventModalUpdate();
      this._eventModalView();
        // this._tinymce();
    };

	// =========================================================================
	// EVENTS
	// =========================================================================

	p._enableEvents = function () {

	};

	// =========================================================================
	// EVENT GOBAL MODAL
	// =========================================================================
    p._eventModalCreate = function () {
        $("#btn-modal-create").click(function() {
            $('#loadingOverlay').show();
            $('#modal-create')
            .find('#modal-content-create')
            .load($(this).attr('value'),function () {
                p._tinymce();
                $(".select2").select2({
                   width: '100%'
               });
                $('#modal-create').modal('show');
                $('#loadingOverlay').hide();
            });
        });
    };

    p._eventModalUpdate = function () {
        $(".btn-modal-update").click(function() {

            $('#loadingOverlay').show();
            $('#modal-update')
            .find('#modal-content-update')
            .load($(this).attr('value'),function () {
                p._tinymce();
                $(".select2").select2({
                   width: '100%'
                });
                $('#modal-update').modal('show');
                $('#loadingOverlay').hide();
           });
        });
    };

    p._eventModalView = function () {
        $(".btn-modal-view").click(function() {
            $('#modal-view').find('#modal-content-view').html('');
            $('#loadingOverlay').show();
            $('#modal-view')
            .find('#modal-content-view')
            .load($(this).attr('value'),function () {
                $('#modal-view').modal('show');
                $('#loadingOverlay').hide();
            });
        });
    };

    p._eventCreate = function () {
        $("#create").click(function() {
            var form = $('#form-create');
            var formData = new FormData($('#form-create')[0]);

            $.ajax({
                url: form.attr("action"),
                type: form.attr("method"),
                data: formData,
                enctype: 'multipart/form-data',
                processData: false,
                contentType: false,
                success: function (response) {
                	$('#modal-create').modal('hide');
                    // switch (response.code) {
                    //     case true:
                    //     alert("success");
                    //     break;
                    //     case false:
                    //     alert("error");
                    //     break;
                    // }
                },
                error: function (errors) {
                    $('#modal-create').modal('hide');
                },
                complete: function() {
                    $.pjax.reload({container:"#pjax-grid"});  //Reload GridView
                    $('#modal-create').modal('hide');
                }
            });
        });
    }

    p._eventUpdate = function () {
        $("#update").click(function() {
            var form = $('#form-update');
            var formData = new FormData($('#form-update')[0]);
            $.ajax({
                url: form.attr("action"),
                type: form.attr("method"),
                data: formData,
                enctype: 'multipart/form-data',
                processData: false,
                contentType: false,
                success: function (response) {
                    $('#modal-update').modal('hide');
                    // switch (response.code) {
                    //     case true:          
                    //     alert("success");
                    //     break;
                    //     case false:
                    //     alert("error");
                    //     break;
                    // }
                },
                error: function (errors) {
                    $('#modal-update').modal('hide');
                },
                complete: function() {
                    $.pjax.reload({container:"#pjax-grid"});  //Reload GridView
                    $('#modal-update').modal('hide');
                }
            });
        });
    };

    p._tinymce = function () {

        $.getJSON("filemanager/config", function(config) {

            tinymce.init({
                selector: "textarea.editor",
                theme: "modern",
                width: "100%",
                height: 300,
                convert_urls:false,
                relative_urls:true,
                plugins: 'image code',
                toolbar: 'undo redo | link image | code',
                document_base_url: config.document_base_url,
                automatic_uploads: false,
                images_upload_url: 'filemanager/upload',
                file_picker_types: 'image',
                images_upload_handler: function (blobInfo, success, failure) {

                    var formData = new FormData($(this)[0]);
                    formData.append('file', blobInfo.blob(), blobInfo.filename());

                    $.ajax({
                        url: 'filemanager/upload',
                        type: 'POST',
                        data: formData,
                        async: false,
                        success: function (data) {
                            var response = $.parseJSON(data);
                            success(response.location);
                        },
                        cache: false,
                        contentType: false,
                        processData: false
                    });

                },
                setup: function (editor) {
                    editor.on('change', function () {
                        editor.save();
                    });
                }
            });
        });
    }
	// =========================================================================
	// DEFINE NAMESPACE
	// =========================================================================

	window.appWebsite = window.appWebsite || {};
	window.appWebsite.App = new App;
}(jQuery)); // pass in (jQuery):
$('.modal').on('hide.bs.modal', function () {
    $(".mce-tinymce").remove();
});