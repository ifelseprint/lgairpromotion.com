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