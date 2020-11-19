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
	};

	p.initializeInPjax = function() {
        this._enableInit();
        this._enableEvents();
	};

	// =========================================================================
	// EVENTS
	// =========================================================================

	p._enableEvents = function () {

		// $(".submit-register").click(function(e) {
		// 	e.preventDefault();
		// 	$('.popup-sendForm').css('display','block');
		// });
		// 

		$(".banner").click(function(e) {
			e.preventDefault();
			$('html,body').animate({
	        scrollTop: $("form").offset().top},
	        'fast');
	    });

        $("input,select").change(function() {
            if ($(this).attr('required') == 'required') {
                var form = $('#formRegister');
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
       			

                if(form.valid()){ }
            }
        });

        $('.submit-register').click(function (e){

            var form = $('#formRegister');
            form.validate({
                errorElement: 'span',
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
                $('.submit-register').attr('disabled','disabled').find("i").removeClass('fa fa-floppy-o').addClass('fa fa-spin fa-spinner');
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
                        $("#modal-action").modal({
                            show: true,
                        });
                        if(dataJson.status==true){
                        	$('#modal-action .modal-header').attr('style','background: #28a745;color: #fff;');
                        	$('#modal-action .modal-header .modal-title').html('<i class="fa fa-check-square-o"></i> ลงทะเบียนสำเร็จ');
                        }else{
                        	$('#modal-action .modal-header').attr('style','background: #dc3545;color: #fff;');
                        	$('#modal-action .modal-header .modal-title').html('<i class="fa fa-window-close-o"></i> ลงทะเบียนไม่สำเร็จ');
                        }
                        $('#modal-content-action').html(dataJson.response);

                        $('.submit-register').removeAttr('disabled').find("i").removeClass('fa fa-spin fa-spinner').addClass('fa fa-floppy-o');
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
	p._enableInit = function () {

		function zipSelTemplate(data,container){
		    return data.text;
		}
		function zipResTemplate(data,container){
		    return data.d +', '+data.a+', '+data.p+', '+data.text;
  		}

  		$('input[type="file"]').change(function(e){
        	var fileName = e.target.files[0].name;
        	$('.file_result').html('ไฟล์ที่คุณได้เลือกอัพโหลด คือ "' + fileName +  '" .');
		});

		$.getJSON('js/area.json').done(
		    function( data ) {

		        data = $.map(data, function(item) {
		            return { id: item.text, d: item.d, a: item.a, p: item.p, text: item.text }; 
		        });

	        	$('#ZIPCODE').select2({
					data:data,
					minimumInputLength:3,
					language:'th',
					placeholder: "พิมพ์รหัสไปรษณีย์",
					templateSelection: zipSelTemplate,
					templateResult: zipResTemplate,
				}).on('select2:select', function (evt) {
					var data=evt.params.data;
					$('#DISTRICT').val(data.d);
					$('#AMPHUR').val(data.a);
					$('#PROVINCE').val(data.p);
				});
		    }
		);

		$('.select2').select2({
            width: '100%'
        });
        $(".close-modal").click(function(e) {
			$('.custom-modal').css('display','none');
		});

		$('.datepicker').daterangepicker({
            singleDatePicker: true,
            autoUpdateInput: false,
            locale: {
                "format": "DD/MM/YYYY"
            },
            drops: "up",
            showDropdowns: true,
        });
        $('.datepicker').on('apply.daterangepicker', function(ev, picker) {

            var date_select = picker.startDate.format('DD/MM/YYYY');
            $(this).val(date_select);
            
        });
        $('.datepicker').on('cancel.daterangepicker', function(ev, picker) {
            $(this).val('');
        });

        // {
        // 	var filename = $('input[type=file]').val().replace(/.*(\/|\\)/, '');
        // }
		// $(".reset-button").click(function() {
		// 	$('input').removeAttr('value');
		// 	$('select option:nth-child(1)').prop("selected", true).change();
		// 	$("select").find('option').attr("selected",false);
		// });
	};

	p.OnlyNumbers = function(e) {
    	var keynum;
    	var keychar;
    	var numcheck;

    	if(window.event)
    	{
    		keynum = e.keyCode;
    	}
    	else if(e.which)
    	{
    		keynum = e.which;
    	}
    	if(keynum != 8){
    		keychar = String.fromCharCode(keynum);
    		numcheck = /\d/;
    		return numcheck.test(keychar);
    	}
    }
	// =========================================================================
	// DEFINE NAMESPACE
	// =========================================================================

	window.appLG = window.appLG || {};
	window.appLG.App = new App;
}(jQuery)); // pass in (jQuery):
