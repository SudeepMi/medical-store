"use strict";
var KTBlockUIDemo = {
    init: function() {

        $(document).on('click', '.btn-loading', function(e) {
            blockUI($(this).data('content'));
        })

        var blockUI = function (item) {
            var $item = "." + item;
            KTApp.block($item, {
                overlayColor: "#000000",
                type: "v2",
                state: "success",
                message: "Please wait..."
            }), setTimeout(function() {
                KTApp.unblock($item)
            }, 2e3)
        }
    }
};
jQuery(document).ready(function() {
    KTBlockUIDemo.init()
});