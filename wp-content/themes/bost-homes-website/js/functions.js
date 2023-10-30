;(function($, window, document, undefined) {
	var $win = $(window);
	var $doc = $(document);
	var $body = $(document.body);
	var $classes = {
		FsrImage         : 'image-full',
		FsrHolder        : 'fsr-holder',
		Hover            : 'hover',
		Active           : 'active',
		ShowNavMain      : 'show-nav-main',
		SliderContainer  : 'ul.slides',
		SliderPrev       : 'btn-prev',
		SliderNext       : 'btn-next',
		SliderActions    : 'slider-actions',
		ShowFixedHeader  : 'show-fixed-header'
	};
	var $listSlider = '';
	var $listSliderHTML = '';
	var _isDesktop = false;
	var _isMobile  = false;
	var _isTablet  = false;
	var offsetArr  = [];
	var _scroll    = 0;
	var $pages     = {};
	var offsetInnerBox = [];
	var offsetInnerImage = [];
	var _viewportHeight = 0;
	var _mapStyle  = [{"featureType":"water","elementType":"geometry","stylers":[{"visibility":"on"},{"color":"#b4cecb"}]},{"featureType":"landscape","elementType":"geometry.fill","stylers":[{"color":"#e9efd5"}]},{"featureType":"poi","elementType":"geometry.fill","stylers":[{"color":"#769E72"}]},{"featureType":"poi","elementType":"labels.text.fill","stylers":[{"color":"#373e1f"}]},{"featureType":"poi","elementType":"labels.text.stroke","stylers":[{"color":"transparent"}]},{"featureType":"poi.park","elementType":"geometry","stylers":[{"visibility":"simplified"},{"color":"#8dab68"}]},{"featureType":"road","elementType":"labels.text.fill","stylers":[{"color":"#000000"}]},{"featureType":"road","elementType":"labels.text.stroke","stylers":[{"color":"transparent"}]},{"featureType":"road.local","elementType":"geometry","stylers":[{"color":"#ffffff"}]},{"featureType":"road.arterial","elementType":"geometry","stylers":[{"color":"#ffffff"}]},{"featureType":"road.highway","elementType":"geometry","stylers":[{"color":"#ffffff"}]},{"featureType":"transit","stylers":[{"visibility":"off"}]},{"featureType":"administrative","elementType":"geometry.stroke","stylers":[{"visibility":"on"},{"color":"#b9c0a0"}]},{"featureType":"administrative","elementType":"geometry.fill","stylers":[{"color":"#7f2200"},{"visibility":"off"}]},{"featureType":"administrative","elementType":"labels.text.stroke","stylers":[{"color":"#ffffff"},{"visibility":"on"},{"weight":4.1}]},{"featureType":"administrative","elementType":"labels.text.fill","stylers":[{"color":"#495421"}]},{"featureType":"administrative.neighborhood","elementType":"labels","stylers":[{"visibility":"off"}]},{
              featureType: 'road',
              elementType: 'geometry',
              stylers: [{color: '#ffffff'},]
            },{
              featureType: 'transit.line',
              elementType: 'geometry',
              stylers: [{color: '#ffffff'}]
            }];

	function selectBox() {
		if ( $('.galleria-categories select').length ) {
			$('.galleria-categories select').selectbox({
				onOpen: function () {
					$(this).next().addClass('active');

					var $select = $(this);

						$select.find('option').each(function (idx) {
							var classes = $(this).attr('class');

							if (classes !== undefined) {

								$select.next().find('li').eq(idx).addClass(classes);

							};

						});
				},
				onClose: function () {
					$(this).next().removeClass('active');
				}
			}).each(function() {
				var $select = $(this),
					idx = $select.find('option').index($select.find('option.active')),
					text = $select.find('option').eq(idx).text();
			});
		};
	}
	$(document).on('change', '.galleria-categories select', function(e){
		window.location = this.value;
	});

	$(document).on('click','[data-image-id]', function(e){
		e.preventDefault();
		var index = $(this).data('image-id');
		gallery(index);
	});

    function gallery(index) {
		$('.galleria-wrapper').fadeIn(200);
    	Galleria.ready(function(){
    		var gallery = this;
    		var galleryOptions = _json;
    		var categories = _cats;
    		gallery.show(index);
    		gallery.addElement('exit').appendChild('container','exit');
    		gallery.addElement('categories').appendChild('container','categories');
    		this.bind("loadstart", function(e) {
    			index = e.index;
    			galleriaOptions(index, galleryOptions, gallery);
    		});
    		galleriaOptions(index, galleryOptions, gallery);
    		var selectList = document.createElement("select");
		    var option = document.createElement("option");
		    option.value = '';
		    option.text = 'Select a Gallery';
		    option.attritube = 'selected';
		    selectList.appendChild(option);
			for (var i = 0; i < categories.length; i++) {
			    var option = document.createElement("option");
			    option.value = categories[i]['link'];
			    option.text = categories[i]['name'];
			    selectList.appendChild(option);
			}
    		gallery.$('categories').html(selectList);
    		selectBox();
		    gallery.$('exit').html('<i class="ion-android-close"></i>').click(function(e) {
		    	$('.galleria-wrapper').fadeOut(function(){
		    		$('.galleria-options').remove();
		    		$('.galleria-exit').remove();
		    		$('.galleria-categories').remove();
		    	});
		    });
    	});
    }
    function galleriaOptions(index, galleryOptions, gallery) {
    	$('.galleria-options').remove();
    	gallery.addElement('options').appendChild('container','options');
		if (galleryOptions[index] == undefined) {
			var href = window.location.href;
			index = href.split('/').pop();
		}
		if (galleryOptions[index] != undefined) {
    		if(galleryOptions[index]['tour_link_type'] != 'none') {
    			gallery.$('options').append('<a href="'+galleryOptions[index]['tour_link']+'" target="'+galleryOptions[index]['tour_link_target']+'" class="gallery-option gallery-option--tour-link">'+galleryOptions[index]['tour_text']+'</a>');
    		}
    		if(galleryOptions[index]['home_link']) {
    			gallery.$('options').append('<a href="'+galleryOptions[index]['home_link']+'" target="_self" class="gallery-option gallery-option--home-link">'+galleryOptions[index]['home_text']+'</a>');
    		}
    	}
    }

    $doc.ready(function(){
		if($('.galleria').length && isChild === 0) {
			var href = window.location.href;
			var index = href.split('/').pop();
			Galleria.run('.galleria', {
			    transition: 'fade',
			    height: _viewportHeight,
			    imageCrop: false,
		        debug: false,
		        responsive: true,
		        carousel: true,
		        thumbnails: true,
		        trueFullscreen: false,
		        fullscreenDoubleTap: false,
		        imageMargin: 50,
		        maxScaleRatio: 1,
		        swipe: true,
		        showImagenav: true,
				extend:function() {
					var gallery = this;
	    			gallery.attachKeyboard({
			            left: gallery.prev,
			            right: gallery.next,
			            escape: function() {
					    	$('.galleria-wrapper').fadeOut(function(){
					    		$('.galleria-options').remove();
					    		$('.galleria-exit').remove();
					    	});
			            }
	    			});
		        }
			});
	    	Galleria.ready(function(){
	    		gallery(index);
	    	});
		}
    });

	$doc.ready(function() {
		$body = $('body');
		$listSlider = $('.list-slider');
		$listSliderHTML = $listSlider.find('.list-body').html();

		if($('.widget_archive ul').length){
			$('.widget_archive li ~ li ~ li ~ li ~ li ~ li ~ li ~ li ~ li').remove();
		}

		if($('.widget_categories ul').length){
			$('.widget_categories li ~ li ~ li ~ li ~ li ~ li ~ li ~ li ~ li').remove();
		}

		/*
			- Click
		*/

		$body.click(function(event){
			$target = $(event.target);

			if(_isTablet || _isMobile){
				if(!$target.parents('.nav').length){
					$('.nav li').removeClass($classes.Hover);
				}

				if(!$target.parents('.inner-image').length && !$target.hasClass('inner-image')){
					$('.inner-image').removeClass($classes.Hover);
				}
			}
		});

		$('.nav .sub-menu a').on('click', function(e) {
			var url = $(this).attr('href');
			var hash = url.substring(url.indexOf('#'));

			var headerHeight = $('.header').innerHeight();

			if ( $(hash).length ) {
				var offset = $(hash).offset().top - headerHeight;

				$("html, body").animate({ scrollTop: offset + 'px' });

				e.preventDefault()
			};
		})

		$('.inner-group p').has('img').css('margin', 0)

		$('.inner-image').click(function(){
			if(_isTablet || _isMobile){
				$('.inner-image').removeClass($classes.Hover);
				$(this).addClass($classes.Hover);
			}
		});

		$('article').find('img').each(function () {
			if ( !$(this).parents().hasClass('inner-group') ) {
				$(this).wrap('<div class="inner-image"><div class="inner-group"></div></div>')
			};
		})

		$('.btn-main').click(function(event){
			event.preventDefault();

			$body.toggleClass($classes.ShowNavMain);
		});

		$('.nav a').click(function(event){
			if(_isTablet || _isMobile){
				var $this = $(this);
				var $parent = $this.parent();

				if($parent.find('> ul').length && !$parent.hasClass($classes.Hover)){
					event.preventDefault();

					$parent.addClass($classes.Hover).siblings().removeClass($classes.Hover);
				}
			}
		});

		$('.slider-gallery-primary .slider-thumbs li a').click(function(event){
			event.preventDefault();

			var $this = $(this);
			var _pos = $this.data('position');
			var $sliderHead = $this.parents('.slider-gallery-primary').find('.slider-head ' + $classes.SliderContainer);
			var $sliderThumbs = $this.parents('.slider-gallery-primary').find('.slider-thumbs ' + $classes.SliderContainer);

			$this.parents('li').addClass($classes.Active).siblings().removeClass($classes.Active);
			$sliderHead.triggerHandler('slideTo', _pos);
			$sliderThumbs.triggerHandler('slideTo', _pos);

		});

		$('.list-posts .btn-plus').click(function(event){
			event.preventDefault();

			$(this).parents('li').toggleClass($classes.Active).siblings().removeClass($classes.Active);
		});

		$('.inner-quote-secondary .btn-plus').click(function(event){
			event.preventDefault();
			$(this).parents('.inner-quote-secondary').toggleClass($classes.Active).siblings().removeClass($classes.Active);
		});

		$('.slider-gallery-primary .slider-head a.btn-arrow').on('mousedown', function(){
			var $this = $(this);
			var $sliderThumbs = $this.parents('.slider-gallery-primary').find('.slider-thumbs ' + $classes.SliderContainer);

			if($this.hasClass($classes.SliderPrev)){
				$sliderThumbs.triggerHandler('prev');
			}

			if($this.hasClass($classes.SliderNext)){
				$sliderThumbs.triggerHandler('next');
			}
		});

		$doc.on('click', '.btn-tags a', function(event){
			event.preventDefault();

			$(this).parents('.owl-item').toggleClass('hide-tags');
		});

		$body.on('click', '.inner-image-person > .inner-group > a, .mfp-container .inner-box .inner-head ul a', function(event){
			event.preventDefault();

			var $this = $(this);
			var _url = $this.attr('href');

			if($pages[_url] != undefined){
				$.magnificPopup.open({
					removalDelay: 300,
					mainClass: 'mfp-fade',
					items: {
						src: $pages[_url],
						type: 'inline'
					},
					callbacks: {
						open: function() {
							$body.slider();

							setTimeout(function() {
								$body.slider();
							}, 1550);
						},
						change: function(){
							setTimeout(function() {
								$body.slider();
							}, 1550);
						}
					}
				});
			}else{
				$.ajax({
					url: _url,
				}).done(function(data){
					$pages[_url] = $(data).find('.section-pattern-primary .section-body').html();

					$.magnificPopup.open({
						removalDelay: 300,
						mainClass: 'mfp-fade',
						items: {
							src: $pages[_url],
							type: 'inline'
						},
						callbacks: {
							open: function() {
								$body.slider();

								setTimeout(function() {
									$body.slider();
								}, 1550);
							},
							change: function(){
								setTimeout(function() {
									$body.slider();
								}, 1550);
							}
						}
					});
				});
			}
		});

		/*
			- Plugins
		*/

		$('.' + $classes.FsrImage).fullscreener({
			parentClass : $classes.FsrHolder
		});

		$('.slider-gallery-secondary img').fullscreener({
			parentClass : $classes.FsrHolder
		});

		$('.inner-image-ribbon > .inner-group > a').magnificPopup({
			removalDelay: 300,
			mainClass: 'mfp-fade',
			type : 'image',
			image : {
				markup: '<div class="mfp-figure">'+
							'<div class="mfp-close"></div>'+
							'<div class="mfp-img"></div>'+
							'<div class="mfp-bottom-bar">'+
								'<div class="mfp-title"></div>'+
								'<div class="mfp-counter"></div>'+
							'</div>'+
						'</div>',
				verticalFit: false
			}
		});

		$('.slider-gallery-primary .slider-head ul.slides').magnificPopup({
			delegate: 'a.slide-image',
			removalDelay: 300,
			mainClass: 'mfp-fade',
			type : 'image',
			image : {
				markup: '<div class="mfp-figure">'+
							'<div class="mfp-close"></div>'+
							'<div class="mfp-img"></div>'+
							'<div class="mfp-bottom-bar">'+
								'<div class="mfp-title"></div>'+
								'<div class="mfp-counter"></div>'+
							'</div>'+
						'</div>'
			},
			gallery:{
				enabled:true
			}
		});

		$('.btn-play').magnificPopup({
			removalDelay: 300,
			mainClass: 'mfp-fade',
			type : 'iframe',
			iframe: {
				markup: '<div class="mfp-iframe-scaler">'+
						'<div class="mfp-close"></div>'+
							'<iframe class="mfp-iframe" frameborder="0" allowfullscreen></iframe>'+
						'</div>',
				patterns: {
					youtube: {
						index: 'youtube.com/',
						id: 'v=',
						src: '//www.youtube.com/embed/%id%?autoplay=1' // URL that will be set as a source for iframe.
					},
					vimeo: {
						index: 'vimeo.com/',
						id: '/',
						src: '//player.vimeo.com/video/%id%?autoplay=1'
					},
					gmaps: {
						index: '//maps.google.',
						src: '%id%&output=embed'
					}
				},
			srcAction: 'iframe_src'
			}
		});

		$doc.on('click', '.btn-popup-view a', function(event){
			event.preventDefault();

			var _url = $(this).attr('href');

			$.magnificPopup.open({
			  items: {
			    src: _url
			  },
			  type: 'iframe'
			}, 0);
		});

		$('.btn-popup-view a').magnificPopup({
			removalDelay: 300,
			mainClass: 'mfp-fade',
			type : 'iframe'
		});

		$body.gfromCols({
			Container : '.form-inner',
			Class : 'separator'
		});

		$body.viewport();
		$('.inner-body-map-group').googleMap();
		$('.section-map-primary').googleMapPrimary();
	});

	$win.load(function(){
		$('body').addClass('loaded');

		$body.slider();

		$doc.on('gform_post_render', function(data){
			$body.gfromCols({
				Container : '.form-inner',
				Class : 'separator'
			});
		});

		setTimeout(function() {
			$body.sectionOffsets();
			$body.currentSection();
		}, 200);
	});

	$win.scroll(function(){
		_scroll = $win.scrollTop();

		$body.toggleClass($classes.ShowFixedHeader, (_scroll >= 10));

		$body.currentSection();
	});

	$win.on('resize orientationchange', function(){
		$body.viewport();
		$body.slider();
		$body.sectionOffsets();
	});


	$.fn.fullscreener = function(options){
		$(this).each(function(){
			var $this = $(this);

			$this.parent().addClass(options.parentClass).attr('style', 'background-image: url(' + $this.attr('src') + ');');
		});
	}

	$.fn.viewport = function(){
		var _deviceWidth = $win.width();

		_isDesktop = (_deviceWidth > 1024) ? true : false;
		_isMobile  = (_deviceWidth <= 767) ? true : false;
		_isTablet  = (_deviceWidth <= 1024 && _deviceWidth >= 768) ? true : false;
	}

	$.fn.slider = function(){
		var $listSlider = $('.list-slider');
		if($listSlider.length){

			$listSlider.find('.list-body').html('');
			$listSlider.find('.list-body').append($listSliderHTML);

			$listSlider.find('.list-body > ul').carouFredSel({
				auto : 6000,
				width : '100%',
				items : {
					visible : {
						min : 1,
						max : 3
					}
				},
				scroll : {
					items : 1,
					duration : 1000
				},
				prev : $listSlider.find('.' + $classes.SliderPrev),
				next : $listSlider.find('.' + $classes.SliderNext),
				swipe : {
					onTouch : true
				}
			});
		}

		var $sliderHome = $('.slider-home');
		if($sliderHome.length){
			$sliderHome.find($classes.SliderContainer).carouFredSel({
				auto : 5000,
				responsive : true,
				 nav: true,
				items : {
					visible : 1
				},
				scroll : {
					items : 1,
					duration : 1000,
					fx : 'crossfade'
				},
				pagination : $sliderHome.find('.' + $classes.SliderActions),
				swipe : {
					onTouch : true
				}
			});
		}

		var $sliderGallery = $('.slider-gallery');
		if($sliderGallery.length){
			$sliderGallery.find($classes.SliderContainer).carouFredSel({
				auto : 4000,
				responsive : true,
				items : {
					visible : 1
				},
				scroll : {
					items : 1,
					duration : 1000,
					fx : 'crossfade'
				},
				swipe : {
					onTouch : true
				}
			});
		}

		var $sliderIntro = $('.slider-intro');
		if($sliderIntro.length){
			$sliderIntro.find($classes.SliderContainer).carouFredSel({
				auto : false,
				width : '100%',
				items : {
					visible : {
						min : 1,
						max : 5
					}
				},
				scroll : {
					items : 1,
					duration : 1000
				},
				prev : $sliderIntro.find('.' + $classes.SliderPrev),
				next : $sliderIntro.find('.' + $classes.SliderNext),
				swipe : {
					onTouch : true
				}
			});
		}

		var $innerImage = $('.inner-image');
		if($innerImage.length){
			$innerImage.each(function(){
				var $this = $(this);

				$this.find($classes.SliderContainer).carouFredSel({
					auto : 6000,
					responsive : true,
					items : {
						visible : 1
					},
					scroll : {
						items : 1,
						duration : 1000,
						fx : 'crossfade'
					},
					swipe : {
						onTouch : true
					}
				});
			});
		}

		var $sliderGalleryPrimary = $('.slider-gallery-primary');
		if($sliderGalleryPrimary.length){
			$sliderGalleryPrimary.find('.slider-head ' + $classes.SliderContainer).carouFredSel({
				auto : false,
				responsive : true,
				items : {
					visible : 1
				},
				scroll : {
					items : 1,
					duration : 1000
				},
				prev : $sliderGalleryPrimary.find('.slider-head .' + $classes.SliderPrev),
				next : $sliderGalleryPrimary.find('.slider-head .' + $classes.SliderNext)
			});

			$sliderGalleryPrimary.find('.slider-thumbs ' + $classes.SliderContainer).carouFredSel({
				auto : false,
				width: '100%',
				height : 'variable',
				items : {
					visible : {
						min : 1,
						max : 5
					},
					minimum : 1
				},
				scroll : {
					items : 1,
					duration : 1000,
					onAfter : function(){
						$sliderGalleryPrimary.find('.slider-thumbs li:first-child').addClass($classes.Active).siblings().removeClass($classes.Active);
						$sliderGalleryPrimary.find('.slider-thumbs li:first-child a').trigger('click');
					}
				},
				prev : $sliderGalleryPrimary.find('.slider-thumbs .' + $classes.SliderPrev),
				next : $sliderGalleryPrimary.find('.slider-thumbs .' + $classes.SliderNext),
				swipe : {
					onTouch : true
				}
			});
		}

		var $sliderGallerySecondary = $('.slider-gallery-secondary');
		if($sliderGallerySecondary.length){
			$sliderGallerySecondary.find($classes.SliderContainer).carouFredSel({
				auto : 4000,
				responsive : true,
				items : {
					visible : 1
				},
				scroll : {
					items : 1,
					duration : 1000
				},
				prev : $sliderGallerySecondary.find('.' + $classes.SliderPrev),
				next : $sliderGallerySecondary.find('.' + $classes.SliderNext),
				pagination : $sliderGallerySecondary.find('.' + $classes.SliderActions),
				swipe : {
					onTouch : true
				}
			});
		}
	}

	$.fn.googleMap = function(settings){
		$(this).each(function(){

			var $this = $(this);
			var map, marker, myOptions;
			var _address = $this.data('location').split(',');
			var _zoom = $this.data('zoom');
			var _id = $this.attr('id');

			myOptions = {
				zoom: _zoom,
				center: new google.maps.LatLng(_address[0], _address[1]),
				mapTypeId: google.maps.MapTypeId.ROADMAP,
				sensor: 'true',
				panControl: false,
				zoomControl: false,
				mapTypeControl: false,
				scaleControl: false,
				streetViewControl: false,
				overviewMapControl: false
			}

			map = new google.maps.Map(document.getElementById(_id), myOptions);

			marker = new google.maps.Marker({
				position: new google.maps.LatLng(_address[0], _address[1]),
				map: map
			});
		});
	}

	$.fn.googleMapPrimary = function(settings){
		$(this).each(function(){

			var $this = $(this);
			var map, marker, myOptions;
			var _address = $this.data('location').split(',');
			var _zoom = $this.data('zoom');
			var _id = $this.attr('id');

			myOptions = {
				zoom: _zoom,
				center: new google.maps.LatLng(_address[0], _address[1]),
				mapTypeId: google.maps.MapTypeId.ROADMAP,
				sensor: 'true',
				scrollwheel: false,
				draggable: false,
				panControl: false,
				zoomControl: false,
				mapTypeControl: false,
				scaleControl: false,
				streetViewControl: false,
				overviewMapControl: false,
				styles: _mapStyle
			}

			map = new google.maps.Map(document.getElementById(_id), myOptions);

			marker = new google.maps.Marker({
				position: new google.maps.LatLng(_address[0], _address[1]),
				map: map
			});
		});
	}

	$.fn.sectionOffsets = function(){
		$('.wrapper .article-primary').each(function(i){
			var _offset = parseInt($(this).offset().top - ($win.height()), 10);
				_offset = (_offset < 0) ? 0 : _offset

			offsetArr[i] = _offset;
		});

		$('.inner-box').each(function(i){
			var _offset = parseInt($(this).offset().top - ($win.height() / 1.3), 10);
				_offset = (_offset < 0) ? 0 : _offset

			offsetInnerBox[i] = _offset;
		});

		$('.inner-image').each(function(i){
			var _offset = parseInt($(this).offset().top - ($win.height() / 1.7), 10);
				_offset = (_offset < 0) ? 0 : _offset

			offsetInnerImage[i] = _offset;
		});
	}

	$.fn.currentSection = function(){

		/* -- Sections -- */

		var _allSections = offsetArr.length - 1;
		var _currentSection = -1;
		var _container = $('.wrapper  .article-primary');

		if(_allSections >= 0){
			for (var i=0; i<=_allSections; i++) {
				var _this = offsetArr[i];
				var _next = offsetArr[i+1];
					_next = (_next == undefined) ? offsetArr[_allSections] + 9999 : _next;

				if(_scroll >= _this && _scroll <= _next){
					_currentSection = i;
				}
			}


			if(_currentSection >= 0){
				_container.eq(_currentSection).addClass($classes.Active);

				for (var i=0; i<=_currentSection; i++) {
					if(!_container.eq(i).hasClass($classes.Active)){
						_container.eq(i).addClass($classes.Active);
					}
				}
			}
		}

		/* -- Box -- */

		var _next = null;
		var _allSectionsBox = offsetInnerBox.length - 1;
		var _currentSectionBox = -1;
		var _container = $('.inner-box');

		if(_allSectionsBox >= 0){
			for (var i=0; i<=_allSectionsBox; i++) {
				var _this = offsetInnerBox[i];
				var _next = offsetInnerBox[i+1];
					_next = (_next == undefined) ? offsetInnerBox[_allSectionsBox] + 9999 : _next;

				if(_scroll >= _this && _scroll <= _next){
					_currentSectionBox = i;
				}
			}

			if(_currentSectionBox >= 0){
				_container.eq(_currentSectionBox).addClass($classes.Active);

				for (var i=0; i<=_currentSectionBox; i++) {
					if(!_container.eq(i).hasClass($classes.Active)){
						_container.eq(i).addClass($classes.Active);
					}
				}
			}
		}

		/* -- Image -- */

		var _next = null;
		var _allSectionsImage = offsetInnerImage.length - 1;
		var _currentSectionImage = -1;
		var _container = $('.inner-image');

		if(_allSectionsImage >= 0){
			for (var i=0; i<=_allSectionsImage; i++) {
				var _this = offsetInnerImage[i];
				var _next = offsetInnerImage[i+1];
					_next = (_next == undefined) ? offsetInnerImage[_allSectionsImage] + 9999 : _next;

				if(_scroll >= _this && _scroll <= _next){
					_currentSectionImage = i;
				}
			}

			if(_currentSectionImage >= 0){
				_container.eq(_currentSectionImage).addClass($classes.Active);

				for (var i=0; i<=_currentSectionImage; i++) {
					if(!_container.eq(i).hasClass($classes.Active)){
						_container.eq(i).addClass($classes.Active);
					}
				}
			}
		}
	}

	$.fn.gfromCols = function(settings){
		if($(settings.Container).length){
			var cols_value   = $('.' + settings.Class).length,
				i            = 0,
				secondList   = '',
				flag         = true;

			for(i=cols_value;i>=0;i--){
				secondList = '';
				$('.' + settings.Class).eq(i).each(function(){
					secondList  = $('<ul />');
					flag = true;

					while(flag){
						var $this = $(this);

						if($this.next().is('.gfield') && !$this.next().hasClass(settings.Class)){

						}else{
							flag = false;
						}

						$this.next().appendTo(secondList);
					}

					$(settings.Container).find('.gform_fields').after(secondList);
				});
			}
		}
	}
})(jQuery, window, document);

jQuery(document).ready(function($) {

// owl carousel
	$('#custom_slide').owlCarousel({
		loop:true,
		margin:0,
		autoplay: true,
		responsiveClass:true,
		autoplaySpeed:1500,
		nav:true,
		dots: false,
		autoHeight: true,
		autoHeightClass: 'owl-height',
		responsive:{
			0:{
				items:1,
			},
			600:{
				items:1,
			},

			1000:{
				items:1,

			}
		}
	});

	$('#custom_intro_slide').owlCarousel({
		loop:false,
		margin:30,
		center:false,
		autoHeight: true,
		autoHeightClass: 'owl-height',
		autoplay: true,
		responsiveClass:true,
		autoplaySpeed:1500,
		nav:true,
		dots: false,
		responsive:{
			0:{
				items:1,
			},
			600:{
				items:2,
			},

			1000:{
				items:4,

			}
		}
	});

});