$(document).ready(function() {
    
    // Fade in tab content
    $('.nav-link').on('click', function() {
        var target = $(this).data('bs-target');
        $(target).hide().fadeIn(600);
        $(this).addClass('pulse');
        setTimeout(() => $(this).removeClass('pulse'), 300);
    });

    // Card hover and click effects
    $('.card').hover(
        function() { $(this).css('transform', 'scale(1.02)'); },
        function() { $(this).css('transform', 'scale(1)'); }
    ).on('click', function() {
        $(this).find('.card-body').slideToggle(400);
    });

    // Scroll to top button
    $(window).scroll(function() {
        $(this).scrollTop() > 100 ? $('#scrollTop').fadeIn() : $('#scrollTop').fadeOut();
    });
    $('#scrollTop').click(function() {
        $('html, body').animate({scrollTop: 0}, 800);
    });

    // Animations on load
    $('header h1').hide().slideDown(1000);
    $('.card').hide().each(function(i) {
        $(this).delay(200 * i).fadeIn(500);
    });

    console.log('jQuery working!');
});
