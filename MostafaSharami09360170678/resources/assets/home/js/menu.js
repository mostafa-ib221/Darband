$(".menu-collapsed").click(function() {
    $(this).toggleClass("menu-expanded");
});

$(window).scroll(function() {
    var height = $(window).scrollTop();
    if (height > 10) {
        console.log('scroll1');
        $('.head-main').addClass('head-1');
    } else {

        console.log('scroll2');
        $('.head-main').removeClass('head-1');
    }
});

$('#close-menu-image1').click(function() {
    $('.row-close-menu').addClass('close-style-row-menu');
});
$('.menu-icon').click(function() {
    if ($('.menu-collapsed').hasClass('menu-expanded')) {
        $('.menu-icon').css({
            'background': 'black'
        });
    } else {
        $('.menu-icon').css({
            'background': '#0000'
        });
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
            'background': 'black'
        });
    } else {
        $('.menu-icon').css({
            'background': '#0000'
        });
    }
});
$(window).scroll(function() {
    var height = $(window).scrollTop();
    if (height > 10) {
        console.log('scroll1');
        $('.head-main').addClass('head-1');
        $('.menu-collapsed')
    } else {

        console.log('scroll2');
        $('.head-main').removeClass('head-1');
    }
});
$('.dropdown-menu').click(function(e) {
    e.stopPropagation();
});