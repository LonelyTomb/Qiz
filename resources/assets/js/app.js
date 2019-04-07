/**
 * First, we will load all of this project's Javascript utilities and other
 * dependencies. Then, we will be ready to develop a robust and powerful
 * application frontend using useful Laravel and JavaScript libraries.
 */
require("./bootstrap.js");
$(document).ready(function () {
    if ($('input')) {
        [].forEach.call(document.querySelectorAll('input[type="tags"]'), tagsInput);
    }
    $('select').material_select();
    $(".button-collapse").sideNav();
    $('.modal').modal();
    $(document).on("scroll", onScroll);
    $('a[href^="#"]').on('click', function (e) {
        e.preventDefault();
        $(document).off("scroll");

        $('a').each(function () {
            $(this).removeClass('active');
        });
        $(this).addClass('active');

        let target = this.hash;
        $target = $(target);
        $('html, body').stop().animate({
            'scrollTop': $target.offset().top + 2
        }, 500, 'swing', function () {
            window.location.hash = target;
            $(document).on("scroll", onScroll);
        });
    });
    let time = $('input[name="time"]').val();
    let clock = $('.your-clock').FlipClock(parseInt(time), {
        countdown: true,
        callbacks: {
            stop: function () {
                console.log('done');
                document.getElementById('form').submit()

            }
        }
    });

});

function onScroll(event) {
    let scrollPosition = $(document).scrollTop();
    $('nav a').each(function () {
        let currentLink = $(this);
        let refElement = $(currentLink.attr("href"));
        if (refElement.position().top <= scrollPosition && refElement.position().top + refElement.height() > scrollPosition) {
            $('nav ul li a').removeClass("active");
            currentLink.addClass("active");
        }
        else {
            currentLink.removeClass("active");
        }
    });
}