$.widget("ui.dialog", $.extend({}, $.ui.dialog.prototype, {
    _title: function (title) {
        if (!this.options.title) {
            title.html("&#160;");
        } else {
            title.html(this.options.title);
        }
    }
}));

$("[rel=tooltip]").tooltip();

(function ($) {

    $.ucfirst = function (str) {

        var text = str;

        var parts = text.split(' '),
                len = parts.length,
                i, words = [];
        for (i = 0; i < len; i++) {
            var part = parts[i];
            var first = part[0].toUpperCase();
            var rest = part.substring(1, part.length);
            var word = first + rest;
            words.push(word);

        }

        return words.join(' ');
    };

})(jQuery);


$('.tablecuriosity tbody').on('click', 'tr', function () {
    if ($(this).hasClass('info')) {
        $(this).removeClass('info');
    } else {
        $('.tablecuriosity').dataTable().$('tr.info').removeClass('info');
        $(this).addClass('info');
    }
    $(this).find(".selrow").prop("checked", true);
});

$("#dialog-smart-error").dialog({
    autoOpen: false,
      width : 320,
    resizable: false,
    modal: true,
    title: "<div class='widget-header text-info'><h4><i class='fa fa-info-circle'></i> Sistema de gestión académica </h4></div>",
    show: {
        effect: "highlight",
        duration: 300
    },
    hide: {
        effect: "clip",
        duration: 300
    },
    buttons: [{
            html: "Aceptar",
            "class": "btn btn-primary btn-sm ",
            click: function () {
                $(this).dialog("close");
            }
        }]
});

function errordialogtablecuriosity() {
    $("#dialog-smart-error").dialog("open");
    CuriositySoundError();
}

function CuriositySoundError() {
    var e = 0;
    if (e = 1, 0 == isIE8orlower()) {
        var f = document.createElement("audio");
        f.setAttribute("src", base_url+"public/" + $.sound_path + "voice_alert.ogg"), $.get(), f.addEventListener("load", function () {
            f.play();
        }, !0), $.sound_on && (f.pause(), f.play());
    }
}