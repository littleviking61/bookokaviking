
$(document).ready(function() {
	$( 'audio' ).audioPlayer();
	$('.fullPage').fullpage({
		verticalCentered: false,
		onLeave: function(index, nextIndex, direction){
        var leavingSection = $(this);

				var nextElmt = $('.fullPage .section:nth-child('+nextIndex+')');
				if(nextElmt.data('background') !== undefined && nextElmt.data('background') !== "") {
					changeBackground(nextElmt.data('background'));
				}
    }

	});
});

var bg = $('.bg');
function changeBackground(newBg) {

	if($('.active',bg).css('background-image') !== 'url(http://book.laventurierviking.fr/'+newBg+')') {
		$(':not(.active)',bg).css('background-image', 'url('+newBg+')');
		$('div', bg).toggleClass('active');
	}

}
