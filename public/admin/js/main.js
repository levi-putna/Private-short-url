$(document).ready(function () {

    //window.console.log = function(){}


    $('.description').autosize();

    $(".fadeout").delay(3000).fadeOut("slow");

    $('[data-toggle=popover]').popover();

//    $('a[data-toggle="tab"]').on('shown', function (e) {
//        e.target // activated tab
//        e.relatedTarget // previous tab
//        window.MorrisObjects["yw2"].redraw();
//    });

    $(window).on('resize', function () {
        window.MorrisObjects["yw2"].redraw();
    });

    $('a[data-toggle="tab"]').on('shown.bs.tab', function (e) {
        window.MorrisObjects["yw2"].redraw();
    });

//    $(document).on('shown.bs.tab', 'a[data-toggle="tab"]', function (e) {
//        alert('TAB CHANGED');
//    })


    /**
     * URL Copy
     *
     * Combine the parent url with the key and open a dialog that allows to copy past the url
     */
    $.fn.urlCopy = function () {
        var root = this;
        this.find('[url-click]').on("click", function () {

            var domain = root.find('[url-domain]').val();
            var path = root.find('[url-path]').val().replace(/\/$/, '');
            window.prompt("Copy to clipboard: Ctrl+C, Enter", "http://" + domain + '/' + path);
            return false;
        });
    };

    //$('[url-copy]').urlCopy();

    $("[url-copy]").each(function (index) {
        arr = $(this).urlCopy();
    });

    /**
     * Infinite scrolling table.
     *
     * This is part of the grid system and trigers the next page load upon reaching the end of the table.
     */

    $.fn.infiniteScroll = function () {
        console.log('loaded');
        var loading = false,
            element = this,
            table = this.find("table"),
            tableBody = this.find("tbody"),
            loader = this.find('.ajax-loader');


        $(window).scroll(function () {

            if (($(window).scrollTop() + $(window).height()) >= ((element.offset().top + element.outerHeight()) - 50)) {
                var url = table.attr("page-url");

                $.ajax({
                    async: false,
                    url: url,
                    beforeSend: function () {
                        if (!loading) {
                            loading = true;
                            loader.show();
                            return true;
                        } else {
                            return false;
                        }
                    },
                    success: function (response, textStatus, jqXHR) {
                        if (response) {
                            var nextPageURL = $(response).find('.table-scrollable').attr("page-url");

                            if (nextPageURL != false) {
                                table.attr("page-url", nextPageURL);
                                var html = $(response).find("tbody").html();
                                tableBody.append(html);
                                loader.hide();
                                loading = false;
                            } else {
                                var html = $(response).find("tbody").html();
                                $(".table-scrollable tbody").append(html);
                                loader.html('<div class="no-records">No more records.</div>');
                            }
                        } else {
                            loader.html('Error loading records.');
                        }


                    }
                });
            }
        });

    };

    /* ---------- Double Click Table Row ---------- */
    $('body').on('dblclick', "table > tbody > tr[dbl-href]", function () {
        var link = $(this).attr('dbl-href');
        document.location.href = link;
    });

});