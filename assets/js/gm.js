/*
 * Google Map Controller
 * begin;
 */

function initializeMap ( object ){

    var localeCoordinate = ( object.coordinate ).split(','),
        coordinate = {
            x : localeCoordinate[0],
            y : localeCoordinate[1]
        },
        loc = new google.maps.LatLng( coordinate.x, coordinate.y );

    google.maps.event.addDomListener(window,'load',initialize( object, loc ));
};

function initialize ( object, loc ) {
	//harita renk verilmesi
	//var styles	= [{"stylers":[{"hue":"#e6eff4"},{"saturation":10}]}];
	//harita özelliklerinin verilmesi

	var myOptions = {
            zoom        : object.zoom,
            center      : loc,
            mapTypeId   : google.maps.MapTypeId.ROADMAP,
            mapTypeControlOptions : {
                style   : google.maps.MapTypeControlStyle.DROPDOWN_MENU
            },
            streetViewControl: false
        },
        map = new google.maps.Map(document.getElementById( object.mapWrapperId ),myOptions),
        marker = new google.maps.Marker({
            draggable : false,
            position  : loc,
            map       : map,
			icon	  : object.marker,
            title     : object.title,
            url       : 'https://www.google.com/maps/@'+ object.coordinate.replace(' ', '') +',18z'
    	});

    google.maps.event.addListener(marker, 'click', function() {
        window.open(this.url, '_blank');
    });

}

/*
 * Google Map Controller
 * end;
 */