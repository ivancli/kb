/**
 * Created by Ivan on 7/06/2016.
 */

/**
 * Generate alert popup
 * @param title
 * @param bodyText
 */
function alertP(title, bodyText) {
    var $modal = popupHTML(title, bodyText);
    $modal.modal();
}

/**
 * Generate confirmation popup
 * @param title
 * @param bodyText
 * @param btnOpts
 */
function confirmP(title, bodyText, btnOpts) {
    var $footer = $("<div>").append(
        $("<button>")
            .addClass("btn")
            .addClass(typeof btnOpts.affirmativeBtnClass == 'undefined' ? "" : btnOpts.affirmativeBtnClass)
            .on("click", function () {
                if (typeof btnOpts.affirmativeCallback != 'undefined' && $.isFunction(btnOpts.affirmativeCallback)) {
                    btnOpts.affirmativeCallback();
                }
            })
            .attr("data-dismiss", function () {
                return typeof btnOpts.affirmativeDismiss != 'undefined' && btnOpts.affirmativeDismiss == true ? "modal" : "";
            })
            .text(typeof btnOpts.affirmativeText != 'undefined' ? btnOpts.affirmativeText : 'OK'),
        $("<button>")
            .addClass("btn")
            .addClass(typeof btnOpts.negativeBtnClass == 'undefined' ? "" : btnOpts.negativeBtnClass)
            .on("click", function () {
                if (typeof btnOpts.negativeCallback != 'undefined' && $.isFunction(btnOpts.negativeCallback)) {
                    btnOpts.negativeCallback();
                }
            })
            .attr("data-dismiss", function () {
                return typeof btnOpts.negativeDismiss != 'undefined' && btnOpts.negativeDismiss == true ? "modal" : "";
            })
            .text(typeof btnOpts.negativeText != 'undefined' ? btnOpts.negativeText : 'Cancel')
    );
    var $modal = popupHTML(title, bodyText, $footer);
    $modal.modal();
}

/**
 * Create and append popup HTML
 * @param title
 * @param $content
 * @param $footer
 * @param dialogSize
 * @returns {void|*|jQuery}
 */
function popupHTML(title, $content, $footer, dialogSize) {
    if (typeof $footer == 'undefined') {
        $footer = $("<button>").addClass("btn").attr({
            "type": "button",
            "data-dismiss": "modal"
        }).text("OK");
    }
    if (typeof dialogSize == "undefined") {
        dialogSize = "modal-sm";
    }
    return $("<div>").attr("id", randomString(10)).addClass("modal fade popup").append(
        $("<div>").addClass("modal-dialog " + dialogSize).append(
            $("<div>").addClass("modal-content").append(
                $("<div>").addClass("modal-header").append(
                    $("<button>").addClass("close").attr({
                        "type": "button",
                        "data-dismiss": "modal",
                        "aria-label": "Close"
                    }).append(
                        $("<span>").attr({
                            "aria-hidden": "true"
                        }).html("&nbsp;")
                    ),
                    $("<h4>").addClass("modal-title").text(title)
                ),
                $("<div>").addClass("modal-body").append($content),
                $("<div>").addClass("modal-footer m-0").append($footer)
            )
        )
    );
}

/**
 * Generate random string
 * @param length
 * @param chars
 * @returns {string}
 */
function randomString(length, chars) {
    if (typeof chars == 'undefined') {
        chars = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    }
    var result = '';
    for (var i = length; i > 0; --i) result += chars[Math.floor(Math.random() * chars.length)];
    return result;
}

/**
 * Load Data URL from HTML input
 * @param input
 */
function readURLFromInput(input, callback) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function (e) {
            if (typeof callback == "function") {
                callback(e.target.result);
            }
        };
        reader.readAsDataURL(input.files[0]);
    }
}

function getFileSizeFromInput(input) {
    if (input.files && input.files[0] && input.files[0].size) {
        return input.files[0].size;
    }
    return 0;
}

function getRESTCountries(params, callback) {
    $.getJSON(params.url, function (response) {
        if (typeof callback == "function") {
            callback(response);
        }
    });
}
//# sourceMappingURL=commonFunctions.js.map
