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

        // this._tinymce();
    };

    p.initializeInPjax = function() {
		this._enableInit();
		this._eventModalView();
		this._enableExcel();
	};

	// =========================================================================
	// EVENTS
	// =========================================================================

	p._enableInit = function () {
		$('.select2').select2({
            width: '100%'
        });
		$(".reset-button").click(function() {
			$('input').removeAttr('value');
			$('select option:nth-child(1)').prop("selected", true).change();
			$("select").find('option').attr("selected",false);
		});

		$('.modal').on("hidden.bs.modal", function() {
		    $(".modal-content-display").html("");
		}); 

		$('#modal-action').on("hidden.bs.modal", function() {
		    $("body").addClass("modal-open");
		    // $.pjax.reload({container:"#pjax-grid", timeout: false});  //Reload GridView
		}); 
	}

	p._enableExcel = function () {

		$(document).on("click",'#download-excel-button', function(e){

			var form = $('#formReport');
            form.validate({
                errorElement: 'div',
                errorPlacement: function (error, element) {
                    error.addClass('invalid-feedback');
                    if(element.attr('type')=='checkbox'){
                        element.parent().next().append(error);
                    }else{
                        element.next().append(error);
                    }
                },
                highlight: function (element, errorClass, validClass) {
                    $(element).addClass('is-invalid');
                },
                unhighlight: function (element, errorClass, validClass) {
                    $(element).removeClass('is-invalid');
                }
            });
            
            if(form.valid()) {
                $('#loadingOverlay').show();
                $('#download-excel-button').attr('disabled','disabled').find("i").removeClass('icofont icofont-download').addClass('fa fa-spin fa-spinner');

                $.ajax({
                    url    : ['admin/dashboard/excel'],
                    type   : 'post',
                    data   : form.serialize(),
                    dataType:'json',
                    success: function (response) 
                    {

                        console.log(response);
 
                        if(response.status==true){
                            var $a = $("<a>");
                            $a.attr("href",response.file);
                            $("body").append($a);
                            $a.attr("download",response.filename);
                            $a[0].click();
                            $a.remove();
                        }

                        $('#download-excel-button').removeAttr('disabled').find("i").removeClass('fa fa-spin fa-spinner').addClass('icofont icofont-download');
                        $('#loadingOverlay').hide();
                    },
                    error  : function () 
                    {
                        console.log('internal server error');
                    }
                });
            }
        });
    };    

	// =========================================================================
	// EVENT GOBAL MODAL
	// =========================================================================
	p._eventModalView = function () {
		$(".btn-modal-view").click(function() {
			$('#loadingOverlay').show();
			$('#modal-view')
			.find('#modal-content-view')
			.load($(this).attr('value'),function () {
				$("#modal-view").modal({
					show: true,
                });
   				$('#loadingOverlay').hide();
   			});
		});
	};

	// =========================================================================
	// DEFINE NAMESPACE
	// =========================================================================

	window.LG = window.LG || {};
	window.LG.App = new App;
}(jQuery)); // pass in (jQuery):