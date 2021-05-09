$(".bar").click(function() {
    $('.menu-collapsed').toggleClass("menu-expanded");
    if($('.menu-collapsed').hasClass('menu-expanded')) {
        if($('.header-respons-style').hasClass('head-1')) {
            window.heade_1 = true;
            $('.header-respons-style').removeClass('head-1');
        }else {
            window.heade_1 = false;
        }
    } else {
       if (window.heade_1){
           $('.header-respons-style').addClass('head-1');
       }
        window.heade_1 = false;
    }
});
$('#close-menu-image1').click(function() {
    $('.row-close-menu').addClass('close-style-row-menu');
});
$('.menu-icon').click(function() {
    if ($('.menu-collapsed').hasClass('menu-expanded')) {
        $('.menu-icon').css({
            'background': 'black !important'
        });
        $('.header-respons-style').removeClass('background-style');
    } else {
        $('.menu-icon').css({
            'background': '#0000 !important'
        });
        $('.header-respons-style').addClass('background-style');
    }
});
$('#image-badge').click(function() {
    console.log('basket');
    if ($('.rw').hasClass('rw-hide')) {
        $('.rw').removeClass('rw-hide');
        $('.rw').addClass('rw-show');
    } else {
        $('.rw').removeClass('rw-show');
        $('.rw').addClass('rw-hide');
    }
});
$('#close-menu').click(function() {
    $('.row-close-menu').addClass('close-style-row-menu');
});
$('.menu-icon').click(function() {
    if ($('.menu-collapsed').hasClass('menu-expanded')) {
        $('.menu-icon').css({
            'background': '#0000'
        });

    } else {
        $('.menu-icon').css({
            'background': 'black'
        });
    }
});
$(window).scroll(function() {
    if(!$('.menu-collapsed').hasClass('menu-expanded')){
        var height = $(window).scrollTop();
        if (height > 10) {
            console.log('scroll1');
            $('.header-respons-style').addClass('head-1');
            $('.menu-collapsed')
        } else {

            console.log('scroll2');
            $('.header-respons-style').removeClass('head-1');
        }
    }
});



$('.dropdown-menu').click(function(e) {
    e.stopPropagation();
});
