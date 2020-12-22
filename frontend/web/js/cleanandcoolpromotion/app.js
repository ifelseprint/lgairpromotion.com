(function(namespace, $) {
    "use strict";

    var Cleanandcoolpromotion = function () {
        var o = this; // Create reference to this instance
        $(document).ready(function () {
            o.initialize();
        }); // Initialize app when document is ready

    };
    var p = Cleanandcoolpromotion.prototype;

    // =========================================================================
    // INIT
    // =========================================================================

    p.initialize = function () {
        // Init events
    };

    p.initializeInPjax = function() {
        this._enableEvents();
    };

    // =========================================================================
    // EVENTS
    // =========================================================================

    p._enableEvents = function () {
        // $(".submit-register").click(function(e) {
        //  e.preventDefault();
        //  $('.popup-sendForm').css('display','block');
        // });
        $('.datepicker').daterangepicker({
            singleDatePicker: true,
            autoUpdateInput: false,
            minDate: '01/03/2021',
            maxDate: '31/12/2021',
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
    // DEFINE NAMESPACE
    // =========================================================================
    namespace.Cleanandcoolpromotion = new Cleanandcoolpromotion;
}(this.appLG, jQuery)); // pass in (namespace, jQuery):