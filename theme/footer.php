<?php wp_footer(); ?>
		<script>
			jQuery(document).ready(function($) {

				var currentHash = window.location.hash;
				// jquery force reload for hash links
				$('a.reload').on('click', function(event) {
					// Get the URL of the clicked link
					var targetUrl = $(this).attr('href');
					// Set window location to the target URL
					window.location.href = targetUrl;
					// Force a reload
					window.location.reload(true);
				});

				// get hash & scroll to element
				setTimeout(function(){
					var ancloc = window.location.hash;
					if(ancloc) {
						$('html, body').animate({
							scrollTop: $(ancloc).offset().top - 100
						}, 1000);
						expand(ancloc);
					}
				}, 500);

				checkWindowWidth();

				function checkWindowWidth() {
					var windowWidth = $(window).width();
				}

				$(window).scroll(function(){
					var scroll = $(window).scrollTop();
					if (scroll >= 200) {
						$(".header").addClass("visible");
					} else {
						$(".header").removeClass("visible");
					}
					var fromTop = $(this).scrollTop()+100;
				});
				$(".overlay__page").on('click', function (event) {
					$(".header__menu").slideUp();
					$(".overlay__page").fadeOut();
					$("body").removeClass("noscroll");
					$("#close").toggle();
					$("#open").toggle();
				});
				$('.header__mobile').on('click', function (event) {
					event.stopPropagation();
					$('.nav-mobile').toggleClass('active');
					$("#close").toggle();
					$("#open").toggle();
					var scrollPosition = window.pageYOffset || document.documentElement.scrollTop;
					$(".overlay__page").fadeToggle();
					$(".header__menu").slideToggle();
					$("body").toggleClass("noscroll");
					$("body").css("top", -scrollPosition + "px");
					return false;
				});
				$(".expand2").click(function(){
					if ( $( this ).hasClass( "active" ) ) {
						$(this).removeClass("active");
					}
					else {
						$(".expand2").removeClass("active");
						$(this).addClass("active");
					}
					var who = $(this).attr("id");
					function explode(){
					$('html, body').animate({
						scrollTop: $(".section-id."+ who).offset().top - 100
					}, 500);
					}
					setTimeout(explode, 500);
					$(".childs").slideUp();
					
					if($(".childs." + who).is(":visible")) {
						$(".childs." + who).slideUp();
					}
					else {
						$(".childs." + who).slideDown();
					}
				});

				function expand(element){
					if ( $( element ).hasClass( "active" ) ) {
						$(element).removeClass("active");
					}
					else {
						$(".expand2").removeClass("active");
						$(element).addClass("active");
					}
					var who = $(element).attr("id");
					$(".childs").slideUp();
					
					if($(".childs." + who).is(":visible")) {
						$(".childs." + who).slideUp();
					}
					else {
						$(".childs." + who).slideDown();
					}
				};

				$(".repeater__dropdown").click(function(event){
					event.stopPropagation();
				});

				$("#close").click(function(event){
					event.preventDefault();
					$(".nav-mobile__inner").removeClass('hide');
					$(".nav-mobile__contact").removeClass('show');
				});

				$(".menu-contact a").click(function(event){
					event.preventDefault();
					$(".nav-mobile__inner").addClass('hide');
					$(".nav-mobile__contact").addClass('show');
					return false;
				});
			});
		</script>
	</body>
</html>