/*! Lottery Rewards - v0.1.0 - 2014-03-11 */$(document).ready(function() {
    $(".description").autosize(), $(".fadeout").delay(3e3).fadeOut("slow"), $("[data-toggle=popover]").popover(), 
    $(window).on("resize", function() {
        window.MorrisObjects.yw2.redraw();
    }), $('a[data-toggle="tab"]').on("shown.bs.tab", function() {
        window.MorrisObjects.yw2.redraw();
    }), $.fn.urlCopy = function() {
        var root = this;
        this.find("[url-click]").on("click", function() {
            var domain = root.find("[url-domain]").val(), path = root.find("[url-path]").val().replace(/\/$/, "");
            return window.prompt("Copy to clipboard: Ctrl+C, Enter", "http://" + domain + "/" + path), 
            !1;
        });
    }, $("[url-copy]").each(function() {
        arr = $(this).urlCopy();
    }), $.fn.infiniteScroll = function() {
        console.log("loaded");
        var loading = !1, element = this, table = this.find("table"), tableBody = this.find("tbody"), loader = this.find(".ajax-loader");
        $(window).scroll(function() {
            if ($(window).scrollTop() + $(window).height() >= element.offset().top + element.outerHeight() - 50) {
                var url = table.attr("page-url");
                $.ajax({
                    async: !1,
                    url: url,
                    beforeSend: function() {
                        return loading ? !1 : (loading = !0, loader.show(), !0);
                    },
                    success: function(response) {
                        if (response) {
                            var nextPageURL = $(response).find(".table-scrollable").attr("page-url");
                            if (0 != nextPageURL) {
                                table.attr("page-url", nextPageURL);
                                var html = $(response).find("tbody").html();
                                tableBody.append(html), loader.hide(), loading = !1;
                            } else {
                                var html = $(response).find("tbody").html();
                                $(".table-scrollable tbody").append(html), loader.html('<div class="no-records">No more records.</div>');
                            }
                        } else loader.html("Error loading records.");
                    }
                });
            }
        });
    }, $("body").on("dblclick", "table > tbody > tr[dbl-href]", function() {
        var link = $(this).attr("dbl-href");
        document.location.href = link;
    });
});