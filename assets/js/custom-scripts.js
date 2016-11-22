(function($) {
	

	// Triggering Tooltip Function
	$('[data-toggle="tooltip"]').tooltip();
		
	
	// Replacing Star Rating - language-skills
	$('.list-language li').each(function () {
		var $this = $(this).find('.language-skills');
		var $star = '<span class="fa fa-star"></span>';
		var $starEmpty = '<span class="fa fa-star-o"></span>';
		
		if ($this.text() == 'Elementary') {
			$this.html($star+$starEmpty+$starEmpty+$starEmpty+$starEmpty);
		} else if($this.text() == 'Limited') {
			$this.html($star+$star+$starEmpty+$starEmpty+$starEmpty);
		} else if($this.text() == 'Proficient') {
			$this.html($star+$star+$star+$starEmpty+$starEmpty);
		} else if($this.text() == 'Professional') {
			$this.html($star+$star+$star+$star+$starEmpty);
		} else if($this.text() == 'Native') {
			$this.html($star+$star+$star+$star+$star);
		}
	});
	
	
	// Animated Progress Bars on Screen Appear
	var $animProgress = $('[data-progress-animate]');

	if ( $animProgress.length > 0 ) {
		$animProgress.each(function() {
			var $this = $(this);

			$this.appear(function() {
				$this.animate({
					width: $this.attr("data-progress-animate")
				}, 600 );
			}, {accX: 0, accY: -100});
		});
	};

	
	// Triggering Wow Animation Function
	wow = new WOW({
		animateClass: 'animated',
		offset:       100,
		//callback:     function(box) {console.log("WOW: animating <" + box.tagName.toLowerCase() + ">")}
	});
	wow.init();
	
	
	// Counting Nav buttons and Add class to parent
	var $btnCount = $('#resume-options a').size();
	$('#resume-options').addClass('btn-group-' + $btnCount);
	
	
	// Iniating Animation to Top on Click
	$(window).scroll(function () {
		if ($(this).scrollTop() != 0) {
			$('#toTop').fadeIn('slow');
		} else {
			$('#toTop').fadeOut();
		}
	}); 
    $('#toTop').click(function(){
        $("html, body").animate({ scrollTop: 0 }, 600);
        return false;
    });


})(jQuery);