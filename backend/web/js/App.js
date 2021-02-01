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
		this._enableExcel();
		// Init events
        // this._tinymce();
    };

    p.initializeInPjax = function() {
    	this._enableInit();
		this._eventModalView();
	};

	// =========================================================================
	// Form
	// =========================================================================
	p._enableForm = function () {

		$('.submit-form').click(function (e){

            var form = $('#formRegister');
          
            $('.submit-form').attr('disabled','disabled').find("i").removeClass('fa fa-floppy-o').addClass('fa fa-spin fa-spinner');
            $('#loadingOverlay').show();
            $.ajax({
                url    : form.attr('action'),
                type   : form.attr('method'),
                data   : new FormData(form[0]),
                enctype: 'multipart/form-data',
                processData: false,
                contentType: false,
                success: function (response) 
                {
                    var dataJson = $.parseJSON(response);
                    $('.submit-form').removeAttr('disabled').find("i").removeClass('fa fa-spin fa-spinner').addClass('fa fa-floppy-o');
                    $('#loadingOverlay').hide();
                    $.pjax.reload({container:"#pjax-grid", timeout: false});  //Reload GridView
                    
                },
                error  : function () 
                {
                    console.log('internal server error');
                }
            });
        });
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

		$('.datepicker_range').daterangepicker({
		    autoUpdateInput: false,
		    locale: {
		        "format": "DD/MM/YYYY",
		        "separator": " - ",
		        "applyLabel": "Apply",
		        "cancelLabel": "Cancel",
		        "fromLabel": "From",
		        "toLabel": "To",
		        "customRangeLabel": "Custom",
		        "weekLabel": "W",
		        "firstDay": 1
		    },
		    drops: "down",
		    showDropdowns: true,
		},function(start, end, label) {
		    console.log("A new date selection was made: " + start.format('YYYY-MM-DD') + ' to ' + end.format('YYYY-MM-DD'));
		});
	    $('.datepicker_range').on('apply.daterangepicker', function(ev, picker) {
	        $(this).val(picker.startDate.format('DD/MM/YYYY') + ' - ' + picker.endDate.format('DD/MM/YYYY'));
	    });
	    $('.datepicker_range').on('cancel.daterangepicker', function(ev, picker) {
	        $(this).val('');
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