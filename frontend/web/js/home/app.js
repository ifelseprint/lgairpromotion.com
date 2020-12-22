(function(namespace, $) {
    "use strict";

    var Home = function () {
        var o = this; // Create reference to this instance
        $(document).ready(function () {
            o.initialize();
        }); // Initialize app when document is ready

    };
    var p = Home.prototype;

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
        // 

        $(".banner").click(function(e) {
            e.preventDefault();
            $('html,body').animate({
            scrollTop: $("form").offset().top},
            'fast');
        });

    };

    // =========================================================================
    // DEFINE NAMESPACE
    // =========================================================================
    namespace.Home = new Home;
}(this.appLG, jQuery)); // pass in (namespace, jQuery):