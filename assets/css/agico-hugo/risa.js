$('.page-scroll').on('click', function (e) {

    var ambil = $(this).attr('href');

    var elemenAmbil = $(ambil);

    $('html, body').animate({
        scrollTop: elemenAmbil.offset().top
    }, 1250, 'easeInOutExpo');

    e.preventDefault();

});