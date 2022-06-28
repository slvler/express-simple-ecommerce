// ============================================================================================================
// READY FUNCTIONS
// ============================================================================================================
$(function() {

	// Resolution info window - delete on publish
	$('body').append('<span id="q" style="position:fixed; top:0px; right:0px; z-index:9999999; opacity: .5; padding: 2px 5px; background-color: #fff; box-shadow: 0 0 2px #666; font-family:Arial; font-weight:bold;"></span>');

	// Back to top button
	$('.back-to-top').on('click', function() {
		$('html, body').animate({
			scrollTop: 0
		}, 300);
	});

	// Direct call on mobile
	$('.link-phone-number').on('click', function() {
		if ( ! $.isMobile() ) return false;
	});

});


// ============================================================================================================
// WINDOW FUNCTIONS
// ============================================================================================================
// Update resolution info - delete on publish
$(window).on('load ready resize orientationchange', function() {
	var booEnv = $.findBootstrapEnvironment();
	$('#q').html($(window).width() + "*" + $(window).height() + "*" + booEnv);
});

// Scroll
$(window).on('scroll',  function() {

	// Back to top show/hide
	if( $(window).scrollTop() > 300 )
		$('.back-to-top').addClass('active');
	else
		$('.back-to-top').removeClass('active');

	// Fixed menu
	if( $(window).scrollTop() > 155 )
		$('.section-header').addClass('fixed');
	else
		$('.section-header').removeClass('fixed');

});

// ============================================================================================================
// GENERAL FUNCTIONS
// ============================================================================================================
// Null link
$('a').on('click', function() {
	if ( $(this).attr('href') == 'null' ) return false;
});

// Mobile browser test
$.isMobile = function () {
	return ( /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent) ) ? true : false;
}


// ============================================================================================================
// SOCIAL FUNCTIONS
// ============================================================================================================
$.shareOnFacebook = function(url, caption, picture) {
    FB.ui({
        method: 'feed',
        link: url,
        caption: caption,
        picture: picture
    }, function(response){});
};

$.shareOnTwitter = function(url, caption) {
    var width  = 575,
        height = 400,
        left   = ($(window).width()  - width)  / 2,
        top    = ($(window).height() - height) / 2,
        url    = url,
        opts   = 'status=1' + ',width=' + width + ',height=' + height + ',top=' + top + ',left=' + left;

    window.open('https://twitter.com/share?url=' + url + '&text=' + caption, '_blank', opts);
};

$.shareOnGPlus = function(theUrl) {
    window.open(theUrl, '_blank', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=600');
    return false;
    //gapi.plus.go();
};

$.findBootstrapEnvironment = function() {

    var envs	= ['xxs', 'xs', 'sm', 'md', 'lg'],
		$el		= $('<div>'),
		env, i;

    $el.appendTo( $('body') );

	for( i = 0; i < envs.length; i++) {

        env = envs[i];

        $el.addClass('hidden-'+env);
        if( $el.is(':hidden') ) {
			$el.remove();
            return env;
        }
    }

}

$(function () {
    jQuery('img.svg').each(function(){
        var $img = jQuery(this);
        var imgID = $img.attr('id');
        var imgClass = $img.attr('class');
        var imgURL = $img.attr('src');

        jQuery.get(imgURL, function(data) {
            var $svg = jQuery(data).find('svg');
            if(typeof imgID !== 'undefined') { $svg = $svg.attr('id', imgID); }
            if(typeof imgClass !== 'undefined') { $svg = $svg.attr('class', imgClass+' replaced-svg'); }
            $svg = $svg.removeAttr('xmlns:a');
            $img.replaceWith($svg);
        }, 'xml');

    });
});