/**
 * Created by Ivan on 7/06/2016.
 */
function alertP(title, bodyText) {
    var $modal = popupHTML(title, bodyText);
    $modal.modal();
}

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

function popupHTML(title, $content, $footer) {
    if (typeof $footer == 'undefined') {
        $footer = $("<button>").addClass("btn").attr({
            "type": "button",
            "data-dismiss": "modal"
        }).text("OK");
    }
    return $("<div>").attr("id", randomString(10)).addClass("modal fade popup").append(
        $("<div>").addClass("modal-dialog modal-sm").append(
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

function randomString(length, chars) {
    if (typeof chars == 'undefined') {
        chars = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    }
    var result = '';
    for (var i = length; i > 0; --i) result += chars[Math.floor(Math.random() * chars.length)];
    return result;
}