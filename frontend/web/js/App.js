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
        // this._enableEvents();
	};

	// =========================================================================
	// EVENTS
	// =========================================================================

	p._enableEvents = function () {

		
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
        	var preview = $(this).attr('target_preview');
        	$(preview).html('ไฟล์ที่คุณได้เลือกอัพโหลด คือ "' + fileName +  '" .');
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
