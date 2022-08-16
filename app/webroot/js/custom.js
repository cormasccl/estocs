//jQuery.noConflict();
/**
 * Main Javascript all plugins and theme code declared here.
 */

j = jQuery.noConflict();

if (!j.support.transition) {
    j.fn.transition = j.fn.animate;
}

/**
 * Code that needs to be executed at first.
 */

j(document).ready(function() {
    "use strict";
   
    j('.rad-holder').children('p').remove(); 

    j('.searche').on('click', function() {
        if (j('#top').hasClass('showed')) {
            j('#top').removeClass('showed');
        } else {
            j('#top').addClass('showed');
        }
    });
    
    j('div.metro-blog-wrapper').width(j(window).width() - 290);
    //j(".format-video, .video, .ioa-video ").fitVids();

//if (!j('.super-wrapper').hasClass('no-np-loader'))
    //    NProgress.start();

    if ((window.retina || window.devicePixelRatio > 1)) {
        var logo = j('#logo img');

        if (typeof logo.data('retina') != "undefined" && logo.data('retina') != "")
            logo.attr('src', logo.data('retina'));
    }

    var icon = 'angle-righticon-';
    if (j('body').hasClass('rtl')) icon = 'angle-lefticon-';

    j(".sidebar-wrap.widget_recent_entries ul li,.sidebar-wrap.widget_archive ul li, .sidebar-wrap.widget_categories ul li, .sidebar-wrap.widget_meta ul li, .sidebar-wrap.widget_recent_comments ul li , .sidebar-wrap.widget_nav_menu ul li  ").append('<i class="ioa-front-icon  ' + icon + ' w-pin"></i>');

});


/**
 * Main Code Starts From Here
 */
function main_code() {
    "use strict";

j = jQuery.noConflict();

    setTimeout(function() {
        j('div.ioa_overlay').transition({
            opacity: 0
        }, 400, '', function() {
            j(this).remove();
        });

    }, 1000);
    /**
     * Basic Variables Declaration
     */

    var DEBUGMODE = false;
    var obj, temp, i, j, k, parent, str = '',
        super_wrapper = j('.super-wrapper'),
        doc = j(document);

    /**
     * Window Dimensions Here
     */


    var win = {
            obj: j(window),
            width: null,
            height: null

        },
        responsive = {

            ratio: 1,
            width: 1060,
            height: 600,
            platform: 'web',
            getPlatform: function() {

            }

        },
        utils = {

            debug: function(message) {

                if (window.console && window.console.log && DEBUGMODE)
                    window.console.log('~~ IOA Debug Mode: ' + message);
            },

            exists: function(cl) {
                if (bowser.msie && bowser.version < 8)
                    if (getElementsByClassName(document.body, cl).length > 0) return true;
                    else return false;


                if (bowser.msie && bowser.version <= 8)
                    if (document.querySelectorAll('.' + cl).length > 0) return true;
                    else return false;
                else
                if (typeof super_wrapper[0] != "undefined" && super_wrapper[0].getElementsByClassName(cl).length > 0) return true;
                else return false;
            },
            existsP: function(cl, parent) {
                if (bowser.msie && bowser.version < 8)
                    if (getElementsByClassName(parent, cl).length > 0) return true;
                    else return false;


                if (bowser.msie && bowser.version <= 8)
                    if (document.querySelectorAll('.' + cl).length > 0) return true;
                    else return false;
                else
                if (parent.getElementsByClassName(cl).length > 0) return true;
                else return false;
            }
        };

    win.width = win.obj.width();
    win.height = win.obj.height();

    responsive.ratio = j('.skeleton').width() / 1060;
    responsive.width = win.width;
    responsive.height = win.height;

    var iso_layout = 'fitRows',
        iso_opts;

    j('.video-bg').each(function() {
        j(this).css({
            width: responsive.width,
            height: j(this).parents('.page-section').outerHeight()
        });
        j(this).children('video').mediaelementplayer({
            loop: true,
            features: []
        });
    });

    if (win.width <= 767) {
        responsive.ratio = (win.obj.width() * 0.7) / 1060;

    }

    j('a.wpml-lang-selector').click(function(e) {
        e.preventDefault();
        var l = j(this).next();

        if (l.is(':hidden')) {
            l.css({
                opacity: 0,
                marginTop: -10,
                display: "block"
            }).transition({
                opacity: 1,
                marginTop: 0
            }, 400);
        } else {
            l.transition({
                opacity: 0,
                marginTop: 0
            }, 400, '', function() {
                l.hide();
            });

        }
    });

    j('.live_search').focusin(function() {
        if (j(this).val() == "" || j(this).val() == ioa_localize.search_placeholder) j(this).val('');
    });

    j('.live_search').focusout(function() {
        if (j(this).val() == "") j(this).val(ioa_localize.search_placeholder);
    });


    j('.sc_name,.sc_email,.sc_msg').focusin(function() {
        if (j(this).val() == "" || j(this).val() == j(this).data('default')) j(this).val('');
    });

    j('.sc_name,.sc_email,.sc_msg').focusout(function() {
        if (j(this).val() == "") j(this).val(j(this).data('default'));
    });


    var valFlag = false;
    j(".sc_submit").click(function(e) {

        e.preventDefault();
        obj = j(this);
        valFlag = false;
        obj.parent().find("input[type=text],input[type=email],textarea").each(function() {
            temp = j(this);
            if (j(this).hasClass('sc_email') && !validateEmail(j(this).val())) {
                temp.addClass("error");
                valFlag = true;
                temp.parent().find('.error-note').css('visibility', 'visible').transition({
                    opacity: 0.8
                }, 300);

            } else if (j.trim(j(this).val()) === "" || temp.val() === j(this).data('default')) {
                temp.addClass("error");
                valFlag = true;
                temp.parent().find('.error-note').css('visibility', 'visible').transition({
                    opacity: 0.8
                }, 300);
            } else {
                temp.removeClass("error");
                temp.parent().find('.error-note').transition({
                    opacity: 0
                }, 300, '', function() {
                    j(this).css('visibility', 'hidden');
                });
            }

        });

        if (valFlag) {
            return;
        }

        var msg = obj.parent().find(".success");

        obj.val(obj.data('sending'));
        j.post(ioa_listener_url, {
            type: 'sticky_contact',
            action: 'ioalistener',
            name: obj.parent().find('.sc_name').val(),
            email: obj.parent().find('.sc_email').val(),
            msg: obj.parent().find('.sc_msg').val(),
            notify_email: obj.parent().find(".notify_email").val()
        }, function(data) {
            obj.val(obj.data('sent'));

            msg.fadeIn("slow").delay(3000).fadeOut("fast");
            obj.parent().find("input[type=text],input[type=email],textarea").each(function() {
                j(this).val(j(this).data('default'));
            });

        });



    });


    j('div.sticky-contact a.trigger').click(function(e) {
        e.preventDefault();

        if (j('div.sticky-contact').offset().left > responsive.width - 50) {
            j('div.sticky-contact').transition({
                right: 0
            }, 400);
        } else {
            j('div.sticky-contact').transition({
                right: -301
            }, 400);
            j('div.sticky-contact').parent().find('.error-note').transition({
                opacity: 0
            }, 300, '', function() {
                j(this).css('visibility', 'hidden');
            });

        }

    });


    /**
     * Header Constructor Code Begins Here
     */


    var compact_menu = j('div.compact-bar ul.menu'),
        compact_bar = j('div.compact-bar'),
        themeheader = j('.theme-header').height();
    var topbar = j('#top-bar'),
        menu_area = j('div.top-area-wrapper'),
        menu_bar, bottombar = j('.bottom-area');

    win.obj.scroll(function() {

        if (win.obj.scrollTop() > (themeheader)) {
            if (compact_bar.is(':hidden'))
                compact_bar.fadeIn('normal');
            j('a.back-to-top').stop(true, true).fadeIn('normal')
        }

        if (win.obj.scrollTop() < (themeheader)) {
            if (compact_bar.is(':visible'))
                compact_bar.fadeOut('fast');
            j('a.back-to-top').stop(true, true).fadeOut('normal')

        }

    });



    /**
     * Menu Layout / Effects Builder
     */

    var Menu_builder = {
        center: function(menu) {
            var childs = menu.children('li'),
                width = 0;
            childs.each(function() {

                width += j(this).outerWidth() + 4 + parseInt(j(this).css('margin-right'));
                //console.log(parseInt(j(this).css('margin-right')));
            });
            setTimeout(function() {

                if (menu.hasClass('menu')) {
                    var fz = parseInt(childs.children('a').css('font-size'));
                    menu.parents('.menu-wrapper').width(width + 2 + (fz * 2)).animate({
                        opacity: 1
                    }, 'normal');
                } else {
                    menu.width(width + 2);
                    menu.animate({
                        opacity: 1
                    }, 'normal');
                }


            }, 30);
        },

        appendMenuTail: function(menu) {
            var arrow = '';

            menu.find('li').each(function() {

                if (j(this).children('.sub-menu').length > 0) {
                    if (j(this).is(menu.children())) {
                        arrow = '<span class="menu-arrow ioa-front-icon down-diricon-"></span>';
                    } else {
                        arrow = '<span class="menu-arrow ioa-front-icon rights-dir-1icon-"></span>';
                    }


                    j(this).children('a').append('<span class="menu-tail"></span>' + arrow);

                    if (j(this).children('ul.sub-menu').length > 0) {
                        j(this).addClass('hasDropDown relative');
                    } else {
                        j(this).addClass('hasDropDown');
                    }

                    j(this).children('.sub-menu').append('<span class="faux-holder"></span>');


                }

            });



        },
        childHoverEffect: function(menu) {

            menu.find('li.menu-item').each(function() {
                obj = j(this);
                
                obj.hoverdir();

            });

        },

        registerMenuHover: function(menu) {

            var effect = menu.parents('div.menu-wrapper').data('effect'),
                sense;
            //console.log(responsive.width);

            menu.find('li').hoverIntent(function() {
                temp = j(this);
                temp.removeClass('forceRightChain');

                if (temp.find('.sub-menu .sub-menu').length > 0)
                    sense = (responsive.width - (temp.offset().left + temp.width()) - (180 * 2));
                else
                    sense = (responsive.width - (temp.offset().left + temp.width()) - (180));

                if (sense < 0 && temp.children('div.sub-menu').length === 0 && temp.is(menu.children())) {
                    temp.addClass('forceRightChain');
                    temp.find('ul.sub-menu').find('.menu-arrow').addClass('left-dir-1icon-').removeClass('right-dir-1icon-');
                } else {
                    temp.find('ul.sub-menu').find('.menu-arrow').addClass('right-dir-1icon-').removeClass('left-dir-1icon-');
                }


                if (utils.existsP('sub-menu', this)) {

                    switch (effect) {
                        case 'None':
                            temp.children('.sub-menu').stop(true, true).show();
                            break;

                        case 'Fade':
                            temp.children('.sub-menu').stop(true, true).fadeIn('normal');
                            break;
                        case 'Fade Shift Down':

                            temp.children('.sub-menu').css({
                                'opacity': 0,
                                'display': 'block',
                                marginTop: -10
                            });
                            temp.children('.sub-menu').stop(true, true).animate({
                                opacity: 1,
                                marginTop: 0
                            }, 300);

                            break;
                        case 'Fade Shift Right':

                            temp.children('.sub-menu').css({
                                'opacity': 0,
                                'display': 'block',
                                marginLeft: -10
                            });
                            temp.children('.sub-menu').stop(true, true).transition({
                                opacity: 1,
                                marginLeft: 0
                            }, 300);

                            break;
                        case 'Scale In Fade':

                            temp.children('.sub-menu').css({
                                'opacity': 0,
                                'display': 'block',
                                scale: 1.2
                            });
                            temp.children('.sub-menu').stop(true, true).transition({
                                opacity: 1,
                                scale: 1
                            });

                            break;
                        case 'Scale Out Fade':

                            temp.children('.sub-menu').css({
                                'opacity': 0,
                                'display': 'block',
                                scale: 0.8
                            });
                            temp.children('.sub-menu').stop(true, true).transition({
                                opacity: 1,
                                scale: 1
                            });

                            break;
                        case 'Grow':
                            temp.children('.sub-menu').stop(true, true).show('normal');
                            break;
                        case 'Slide':
                            temp.children('.sub-menu').stop(true, true).slideDown('normal');
                            break;
                        default:
                            temp.children('.sub-menu').stop(true, true).fadeIn('normal');
                            break;
                    }

                }

            }, function() {
                if (utils.existsP('sub-menu', this)) {
                    temp = j(this);
                    switch (effect) {
                        case 'None':
                            temp.children('.sub-menu').stop(true, true).hide();
                            break;

                        case 'Fade':
                            temp.children('.sub-menu').stop(true, true).fadeOut('normal');
                            break;
                        case 'Fade Shift Down':
                            temp.children('.sub-menu').stop(true, true).transition({
                                opacity: 0,
                                marginTop: -10
                            }, 300, function() {
                                j(this).hide()
                            });
                            break;
                        case 'Fade Shift Right':
                            temp.children('.sub-menu').stop(true, true).transition({
                                opacity: 0,
                                marginLeft: -10
                            }, 300, function() {
                                j(this).hide()
                            });
                            break;
                        case 'Scale In Fade':
                            temp.children('.sub-menu').stop(true, true).transition({
                                opacity: 0,
                                scale: 1.2
                            }, 200, '', function() {
                                j(this).hide()
                            });
                            break;
                        case 'Scale Out Fade':
                            temp.children('.sub-menu').stop(true, true).transition({
                                opacity: 0,
                                scale: 0.8
                            }, 200, '', function() {
                                j(this).hide()
                            });
                            break;
                        case 'Grow':
                            temp.children('.sub-menu').stop(true, true).hide('normal');
                            break;
                        case 'Slide':
                            temp.children('.sub-menu').stop(true, true).slideUp('normal');
                            break;
                        default:
                            temp.children('.sub-menu').stop(true, true).fadeOut('normal');
                            break;
                    }



                }

            });
        }

    }

    /**
     * Menu Effects & Stuff
     */

    Menu_builder.childHoverEffect(j('.theme-header .menu, div.sidebar-wrap ul.sub-menu, .compact-bar .menu'));

    Menu_builder.appendMenuTail(compact_menu);
    Menu_builder.registerMenuHover(compact_menu);


    if (utils.exists('menu-centered')) {
        j('.menu-centered .menu').each(function() {
            Menu_builder.center(j(this));
        });
    }

    Menu_builder.appendMenuTail(j('.theme-header .menu'));
    Menu_builder.registerMenuHover(j('.theme-header .menu , div.sidebar-wrap ul.menu'));


    setTimeout(function() {

        if (compact_menu.length > 0) {
            var cposi = compact_bar.find('.menu-wrapper').position().left;

            compact_menu.children('li').each(function() {

                if (j(this).find('div.sub-menu').length > 0) {
                    j(this).find('div.sub-menu').css("left", -(cposi + j(this).position().left) + "px");
                }
            });
            compact_bar.css({
                'display': 'none',
                'visibility': 'visible'
            });

        }


        if (menu_area.find('.menu').length > 0) {
            menu_area.find('.menu-wrapper').each(function() {
                var temp = j(this),
                    posi = temp.position().left;
                temp.find('.menu').children('li').each(function() {

                    if (j(this).find('div.sub-menu').length > 0) {
                        j(this).find('div.sub-menu').css("left", -(posi + j(this).position().left) + "px");
                    }

                    if (j('.fluid-menu').length > 0) {
                        j(this).find('div.sub-menu').width(responsive.width);
                    }

                });
            });
        }





        if (topbar.find('.menu').length > 0) {
            topbar.find('.menu-wrapper').each(function() {

                var temp = j(this),
                    posi = temp.position().left;
                temp.find('.menu').children('li').each(function() {

                    if (j(this).find('div.sub-menu').length > 0) {
                        j(this).find('div.sub-menu').css("left", -(posi + j(this).position().left) + "px");
                    }
                });

            });

        }

        if (bottombar.find('.menu').length > 0) {
            bottombar.find('.menu-wrapper').each(function() {

                var temp = j(this),
                    posi = temp.position().left;
                temp.find('.menu').children('li').each(function() {

                    if (j(this).find('div.sub-menu').length > 0) {
                        j(this).find('div.sub-menu').css("left", -(posi + j(this).position().left) + "px");
                    }
                });

            });
        }

        if (win.obj.scrollTop() > (themeheader)) {
            j('a.back-to-top').stop(true, true).fadeIn('normal')
            compact_bar.stop(true, true).fadeIn('normal');
        }


    }, 80);



    j('div.sub-menu li a').hover(function() {
            j(this).stop(true, true).transition({
                paddingLeft: 24
            }, 400);
        },
        function() {

            if (!(j(this).parent().hasClass('current-menu-item') || j(this).parent().hasClass('current_page_item')))
                j(this).stop(true, true).transition({
                    paddingLeft: 0
                }, 400);
        }
    );

    /**
     * Social Icons code
     */

    j('ul.top-area-social-list li a').hover(function() {
        temp = j(this);
        temp.children('.proxy-color').stop(true, true).transition({
            opacity: 1
        }, 300);
    }, function() {
        temp = j(this);
        temp.children('span.proxy-color').stop(true, true).transition({
            opacity: 0
        }, 300);
    });




    /**
     * Ajax Search Code
     */

    var search_parent = j('.ajax-search'),
        search_loader = search_parent.find('span.search-loader');

    j('.ajax-search-pane input[type=text]').keyup(function(e) {
        var val = j(this).val().length;

        if (e.keyCode == 27) {
            j('a.ajax-search-trigger').trigger('click');
            return;
        }

        if (val >= 2) {

            search_loader.fadeIn('fast');
            j.post(search_parent.data('url'), {
                type: 'search',
                action: 'ioalistener',
                query: j(this).val()
            }, function(data) {
                if (j.trim(data) == "") return;


                search_parent.find('.no-results').fadeOut('fast');
                search_parent.find('.search-results ul').html(data);
                search_parent.find('div.search-results').stop(true, true).fadeIn('fast', function() {
                    search_loader.fadeOut('fast');
                });

            });

        } else {
            search_parent.find('div.search-results').hide();
            search_parent.find('.search-results ul').html('');

        }

    });

    j('body').bind('rad_widget_dropped', function(e, key, obj) {
        PageWidgets(obj);

    });

    j('body').bind('rad_widget_preview', function(e, key, obj) {
        PageWidgets(obj);

    });


    j('a.ajax-search-trigger').click(function(e) {
        e.preventDefault();
        temp = j(this).parent().find('div.ajax-search-pane');

        if (temp.is(":hidden")) {
            temp.css({
                'opacity': 0,
                'display': 'block',
                marginTop: -20
            });
            temp.stop(true, true).transition({
                opacity: 1,
                marginTop: 0
            });
            j('a.ajax-search-trigger').addClass('active');
        } else {
            temp.stop(true, true).transition({
                opacity: 0,
                marginTop: -20
            }, 200, '', function() {
                j(this).hide()
            });
            j('a.ajax-search-trigger').removeClass('active');
        }
    });

    j('a.ajax-search-close').click(function(e) {
        e.preventDefault();
        j(this).parent().stop(true, true).transition({
            opacity: 0,
            marginTop: -20
        }, 200, '', function() {
            j(this).hide()
        });
        j('a.ajax-search-trigger').removeClass('active');
    });


    /**
     * Title Effects & Intro
     */


    var title_area = j('div.title-wrap'),
        delay = 0,
        delay_inc = parseFloat(title_area.data('delay')) * 1000,
        animate_delay = parseFloat(title_area.data('duration')) * 1000,
        animate_position = title_area.data('position');
    var effect_builder = {

        animate: function(el, effect) {

            switch (effect) {
                case 'fade':
                    el.delay(delay).transition({
                        opacity: 1
                    }, 'slow');
                    break;
                case 'fade-left':
                case 'fade-right':
                    el.delay(delay).transition({
                        margin: '0px',
                        opacity: 1,
                        duration: 500
                    });
                    break;

                case 'rotate-left':
                    el.css({
                        rotate: '-40deg'
                    }).delay(delay).transition({
                        opacity: 1,
                        rotate: '0deg'
                    });
                    break;
                case 'rotate-right':
                    el.css({
                        rotate: '40deg'
                    }).delay(delay).transition({
                        opacity: 1,
                        rotate: '0deg'
                    });
                    break;

                case 'scale-in':
                    el.css({
                        scale: 1.2
                    }).delay(delay).transition({
                        opacity: 1,
                        scale: 1
                    });
                    break;
                case 'scale-out':
                    el.css({
                        scale: 0.8
                    }).delay(delay).transition({
                        opacity: 1,
                        scale: 1
                    });
                    break;

                case 'curtain-fade':

                    setTimeout(function() {

                        el.data("width", el.width() + parseInt(el.children().css("padding-left")));
                        el.width(0);
                        el.children().css({
                            "opacity": 0,
                            "width": el.data("width")
                        });
                        el.transition({
                            width: el.data("width"),
                            opacity: 1,
                            duration: 500
                        });
                        setTimeout(function() {
                            el.children().transition({
                                opacity: 1
                            }, 'fast');
                        }, 600);

                    }, delay);

                    break;
                case 'curtain-show':

                    setTimeout(function() {

                        el.data("width", el.width() + parseInt(el.children().css("padding-left")));
                        el.css({
                            width: 0,
                            overflow: "hidden"
                        });
                        el.children().css({
                            "opacity": 0,
                            "width": el.data("width"),
                            x: -el.data("width")
                        });
                        el.transition({
                            width: el.data("width"),
                            opacity: 1,
                            duration: 500
                        });
                        setTimeout(function() {
                            el.children().transition({
                                opacity: 1,
                                x: 0
                            }, 'fast');
                        }, 600);

                    }, delay);


                    break;
                case 'metro':
                    el.transition({
                        perspective: '800px',
                        rotateY: '0deg',
                        opacity: 1
                    });
                    break;
                case 'animate-bg':
                    el.transition({
                        backgroundPosition: animate_position
                    }, animate_delay, 'linear');
                    break;

            }

            delay += delay_inc;
        }

    }

    if (title_area.length > 0) {
        if (title_area.data('effect') == "metro") title_area.css({
            perspective: '400px',
            rotateY: '25deg',
            opacity: 0
        });


        j(window).load(function() {

            effect_builder.animate(title_area, title_area.data('effect'));

            setTimeout(function() {
                if (utils.exists('animate-block'))
                    j('.animate-block').each(function() {
                        effect_builder.animate(j(this), j(this).data('effect'));
                    });
            }, 200);

        });
    }

    /**
     * Shortcodes Coding Starts Here ===================================
     */

    if (utils.exists('power-section')) {

        if (!utils.exists('power-overlay'))
            j('body').append('<div class="power-overlay"></div> <div class="power-overlay-content clearfix"><div class="filler"></div> <a href="" class="close  cancel-2icon- ioa-front-icon"></a> </div>');

        var ov = j('body').find('.power-overlay');
        var ovc = j('body').find('.power-overlay-content');

        j('.power-section h3').click(function() {
            ovc.children('div.filler').html(j(this).next().html());
            ov.css({
                display: 'block',
                'opacity': 0,
                "background-color": j(this).css("background-color")
            }).transition({
                opacity: 0.7
            }, 400);
            ovc.css({
                display: 'block',
                opacity: 0,
                scale: 0.5,
                "background-color": j(this).css("background-color")
            });

            ovc.css({

                height: ovc.children('div.filler').height() + 40,
                left: responsive.width / 2 - 225,
                top: responsive.height / 2 - ovc.height() / 2

            }).transition({
                opacity: 1,
                scale: 1
            }, 400);

        });

        ovc.find('a.close').on("click", function(e) {
            e.preventDefault();
            ov.fadeOut('normal');
            setTimeout(function() {
                ovc.transition({
                    opacity: 0,
                    scale: 0
                }, 400, '');
            }, 100);
        });
    }
    j('div.posts_slider div.slide').hover(function() {

        j(this).children('div.desc').fadeIn('normal');

    }, function() {

        j(this).children('div.desc').fadeOut('normal');
    });

    if (utils.exists('media-listener')) {

        j('.media-listener').waypoint(function() {

            var c = j(this);

            switch (c.data('effect')) {
                case 'fade':
                    c.transition({
                        opacity: 1
                    }, 400);
                    break;
                case 'fade-right':
                    c.css({
                        x: -20
                    }).transition({
                        opacity: 1,
                        x: 0
                    }, 400);
                    break;
                case 'fade-left':
                    c.css({
                        x: 20
                    }).transition({
                        opacity: 1,
                        x: 0
                    }, 400);
                    break;
                case 'fade-grow':
                    c.css({
                        scale: 0.4
                    }).transition({
                        opacity: 1,
                        scale: 1
                    }, 400);
                    break;
            }

        }, {
            offset: '70%',
            triggerOnce: true
        });

    }


    /**
     * Tabs Shortcode
     */

    j('div.ioa_box a.close').click(function(e) {
        e.preventDefault();
        j(this).parent().parent().slideUp('normal', function() {
            j(this).remove();
        })
    });

    if (utils.exists('ioa_tabs')) {
        j(".ioa_tabs").tabs({
            show: {
                effect: "fadeIn",
                duration: 300
            }
        })
    }
    if (utils.exists('ioa_accordion')) {
        j(".ioa_accordion").accordion({
            create: function(event, ui) {
                ui.header.find('i').removeClass('down-diricon-').addClass('up-diricon-')
            },
            beforeActivate: function(event, ui) {
                ui.newHeader.find('i').removeClass('down-diricon-').addClass('up-diricon-');
                ui.oldHeader.find('i').addClass('down-diricon-').removeClass('up-diricon-');
            },
            heightStyle: "content"
        });
    }


    function hexToRgb(hex) {
        var result = /^#?([a-f\d]{2})([a-f\d]{2})([a-f\d]{2})$/i.exec(hex);
        return "rgba(" + parseInt(result[1], 16) + "," + parseInt(result[2], 16) + "," + parseInt(result[3], 16) + ",0.6)";

    }


    win.obj.load(function() {
        if (utils.exists('menu-centered')) {
            j('.menu-centered .top-area-social-list').each(function() {
                Menu_builder.center(j(this));
            });
        }

        if (utils.exists('line-chart-wrap')) {
            j('.line-chart-wrap').waypoint(function() {
                temp = j(this), vals;
                var ds = [];
                temp.find('.line-val').each(function(i) {
                    vals = j(this).data('values').toString();

                    if (vals.indexOf(',') != -1) {
                        vals = vals.split(',');
                    } else
                        vals = [parseInt(vals)];

                    for (var j = 0; j < vals.length; j++) vals[j] = parseInt(vals[j]);

                    ds[i] = {
                        fillColor: j(this).data('fillcolor'),
                        strokeColor: j(this).data('strokecolor'),
                        pointColor: j(this).data('pointcolor'),
                        pointStrokeColor: j(this).data('pointstrokecolor'),
                        data: vals
                    };

                });

                var data = {
                    labels: temp.data('labels').split(','),
                    datasets: ds
                }


                var ctx = temp.children('canvas')[0].getContext("2d");
                var myNewChart = new Chart(ctx);

                var options = {};
                if (bowser.msie && bowser.version <= 8) options.animation = false;

                new Chart(ctx).Line(data, options);
            }, {
                offset: '70%',
                triggerOnce: true
            });
        }


        if (utils.exists('polar-chart-wrap')) {
            j('.polar-chart-wrap').waypoint(function() {
                temp = j(this);
                var ds = [],
                    total = 0;
                temp.find('.polar-val').each(function(i) {

                    total += parseInt(j(this).data('value'));

                });
                temp.find('.polar-val').each(function(j) {

                    ds[j] = {
                        value: parseInt(j(this).data('value')),
                        color: j(this).data('fillcolor')
                    };

                    j(this).children('.block').html(Math.round(parseInt(j(this).data('value')) / total * 1000) / 10 + "%");
                });

                var ctx = temp.children('canvas')[0].getContext("2d");
                var myNewChart = new Chart(ctx);

                var options = {};
                if (bowser.msie && bowser.version <= 8) options.animation = false;

                new Chart(ctx).PolarArea(ds, options);

            }, {
                offset: '70%',
                triggerOnce: true
            });
        }



        if (utils.exists('pie-chart-wrap')) {
            j('.pie-chart-wrap').waypoint(function() {

                temp = j(this);
                var ds = [],
                    total = 0;
                temp.find('.pie-val').each(function(i) {

                    total += parseInt(j(this).data('value'));

                });
                temp.find('.pie-val').each(function(i) {

                    ds[i] = {
                        color: j(this).data('fillcolor'),
                        value: j(this).data('value')
                    };
                    j(this).children('.block').html(Math.round(parseInt(j(this).data('value')) / total * 1000) / 10 + "%");

                });
                var ctx = temp.children('canvas')[0].getContext("2d");
                var myNewChart = new Chart(ctx);
                new Chart(ctx).Pie(ds, {
                    animateScale: true,
                    animationEasing: "easeOutExpo"
                });

            }, {
                offset: '70%',
                continuous: false,
                triggerOnce: true
            });
        }


        if (utils.exists('donut-chart-wrap')) {
            j('.donut-chart-wrap').waypoint(function() {
                temp = j(this);
                temp = j(this);
                var ds = [],
                    total = 0;
                temp.find('.donut-val').each(function(i) {

                    total += parseInt(j(this).data('value'));

                });
                temp.find('.donut-val').each(function(i) {

                    ds[i] = {
                        color: j(this).data('fillcolor'),
                        value: j(this).data('value')
                    };

                    j(this).children('.block').html(Math.round(parseInt(j(this).data('value')) / total * 1000) / 10 + "%");
                });

                var ctx = temp.children('canvas')[0].getContext("2d");
                var myNewChart = new Chart(ctx);
                new Chart(ctx).Doughnut(ds, {
                    animationEasing: "easeOutExpo"
                });
            }, {
                offset: '70%',
                triggerOnce: true
            });
        }

        if (utils.exists('bar-chart-wrap')) {
            var vals;
            j('.bar-chart-wrap').waypoint(function() {
                temp = j(this);
                var ds = [],
                    j;
                temp.find('.bar-val').each(function(i) {
                    vals = j(this).data('values').toString();

                    if (vals.indexOf(',') != -1) {
                        vals = vals.split(',');
                    } else
                        vals = [parseInt(vals)];
                    for (var j = 0; j < vals.length; j++) vals[j] = parseInt(vals[j]);

                    ds[i] = {
                        fillColor: j(this).data('fillcolor'),
                        strokeColor: j(this).data('strokecolor'),
                        data: vals
                    };

                });

                var data = {
                    labels: temp.data('labels').split(','),
                    datasets: ds
                }
                console.log(ds);
                var ctx = temp.children('canvas')[0].getContext("2d");
                var myNewChart = new Chart(ctx);

                var options = {};
                if (bowser.msie && bowser.version <= 8) options.animation = false;

                new Chart(ctx).Bar(data, options);
            }, {
                offset: '70%',
                triggerOnce: true
            });
        }

    });


    if (utils.exists('toggle-title')) {

        j('a.toggle-title').click(function(e) {
            e.preventDefault();
            if (j(this).next().is(':hidden')) {
                j(this).children('i').removeClass('plus-1icon-').addClass(' minusicon-');
            } else {
                j(this).children('i').addClass('plus-1icon-').removeClass(' minusicon-');
            }
            j(this).next().slideToggle('normal');

        });

    }

    j('a.ioa-button').hover(function() {
        j(this).children('span.underlay').stop(true, true).fadeIn('normal');
    }, function() {
        j(this).children('span.underlay').stop(true, true).fadeOut('normal');
    });

    j("div.text-inner-wrap").hoverIntent(function() {
        var icon = j(this).find('.icon,.ioa-front-icon');

        if (icon.data('icon_hover') != "")
            icon.children('.icon-wrap').addClass(icon.data('icon_hover'));


    }, function() {
        var icon = j(this).find('.icon,.ioa-front-icon');

        if (icon.data('icon_hover') != "")
            icon.children('.icon-wrap').removeClass(icon.data('icon_hover'));

    });




    /**
     * Gallery
     */

    if (utils.exists('ioa-gallery')) {
        j('.ioa-gallery').seleneGallery({
            domMapping: true
        });
    }


    /**
     * Slider
     */

    if (utils.exists('ioaslider')) {
        j('.ioaslider').quartzSlider({
            domMapping: true
        });
    }

    /**
     * Scrollable
     */

    if (utils.exists('scrollable')) {
        var t, n, minx;
        j('.scrollable').each(function() {

            t = j(this).parent().width();
            n = j(this).children().width() + 20;
            minx = Math.ceil(t / n);
            //console.log(t+" "+n+minx);
            j(this).bxSlider({
                slideWidth: n,
                maxSlides: minx,
                moveSlides: minx,
                infiniteLoop: false,
                slideMargin: 20,

                pager: false
            });

        });
    }

    j(document).on('mouseenter', '.bx-wrapper', function() {

        j(this).find('.bx-controls ').stop(true, true).transition({
            opacity: 1
        }, 400);

    });
    j(document).on('mouseleave', '.bx-wrapper', function() {


        j(this).find('.bx-controls ').stop(true, true).transition({
            opacity: 0
        }, 400);

    });

    /**
     * Magic Lists
     */

    if (utils.exists('magic-list-wrapper')) {
        var hf = 0,
            line;
        win.obj.load(function() {

            j('.magic-list-wrapper').each(function() {
                hf = 0;
                line = j(this).children('.line');
                j(this).find('li').each(function(i) {

                    if (j(this).next().length > 0) hf += j(this).outerHeight(true);

                    temp = j(this).children('div.icon-area');
                    temp.delay(i * 200).transition({
                        opacity: 1,
                        scale: 1,
                        backgroundColor: temp.data('color')
                    }, 500);
                });

            });

        });
    }


    /**
     * Testimonials
     */


    if (utils.exists('rad-testimonials-list')) {


        j('ul.rad-testimonials-list').bxSlider({
            mode: 'fade',
            adaptiveHeight: true,

            pager: false,
            auto: true,
            maxSlides: minx,
            moveSlides: minx,
        });

    }



    /**
     * Easy Chart
     */
    var w;
    if (utils.exists('radial-chart')) {

        j('.radial-chart').each(function() {
            w = j(this).data('width');
            if (w > j(this).width()) w = j(this).width() - 20;
            j(this).easyPieChart({
                size: w,
                lineWidth: j(this).data('line_width'),
                barColor: j(this).data('bar_color'),
                trackColor: j(this).data('track_color'),
                scaleColor: false,
                lineCap: "butt",
                animate: 2000
            }).data('easyPieChart').update(0);

        });

        j('.radial-chart').waypoint(function() {

            j(this).data('easyPieChart').update(j(this).data('start_percent'));

        }, {
            offset: '70%',
            triggerOnce: true
        });

    }


    /**
     * Progress Bar
     */

    if (utils.exists('progress-bar-group')) {

        if (!bowser.msie) j(' div.progress-bar div.filler span').show();

        win.obj.load(function() {

            j('.progress-bar-group').waypoint(function() {

                j(this).find('div.progress-bar').each(function(i) {

                    j(this).find('div.filler').delay(i * 100).transition({
                        opacity: 1,
                        width: parseInt(j(this).find('div.filler').data('fill')) + "%"
                    }, 1500, 'easeInOutQuint', function() {
                        j(this).children().fadeIn('fast');
                    });
                });

            }, {
                offset: '70%',
                triggerOnce: true
            });


        });
    }



    /**
     * Stacked Circles
     */

    if (utils.exists('circles-group')) {

        win.obj.load(function() {

            j('div.circles-group').waypoint(function() {

                var parentw = j(this).width();

                if (parentw >= j(this).parent().width()) {
                    parentw = j(this).parent().width();
                    j(this).width(parentw);
                    j(this).height(parentw);
                }

                j(this).find('div.circle').each(function(j) {
                    j(this).css({
                        "left": (parentw - parseInt(j(this).data('fill')) / 100 * parentw) / 2,
                        scale: 0.2
                    });
                    j(this).delay(j * 100).transition({
                        opacity: 1,
                        scale: 1,
                        width: parseInt(j(this).data('fill')) + "%",
                        height: parseInt(j(this).data('fill')) + "%"
                    }, 500);

                });

            }, {
                offset: '70%',
                triggerOnce: true
            });


        });
    }



    j('div.related-menu li').click(function() {
        j('div.related-menu li').removeClass('active');
        j(this).addClass('active');

        temp = j(this).data('val');

        j('div.related-posts-wrap ul').not("." + temp).transition({
            opacity: 0,
            scale: 0
        }, 300, '', function() {
            j(this).css({
                visibility: "hidden",
                opacity: 0
            })
        });
        j("div.related-posts-wrap ul." + temp).css({
            visibility: "visible",
            opacity: 0,
            scale: 0
        }).transition({
            opacity: 1,
            scale: 1
        }, 300);
    });

    /**
     * Blog Formats Coding
     */
    var iso_posts;

    j('.ioa-menu ul li').click(function() {
        temp = j(this).data('cat');
        j('div.ioa-menu ul li').removeClass('active');
        j(this).addClass('active');
        iso_posts = j(this).parents('.iso-parent').find('.isotope');
        if (iso_posts.length > 0) {
            if (temp == "all") {
                iso_posts.isotope({
                    filter: "*"
                });
            } else {
                iso_posts.isotope({
                    filter: ".category-" + temp
                });
            }
            return;
        }
        if (utils.exists('blog-format4-posts')) {
            var blog_posts = j(this).parents('.mutual-content-wrap').find('.blog_posts');
            if (temp == "all") {
                blog_posts.find('li.post').slideDown('normal');
                return;
            }

            blog_posts.find('li.post').each(function() {

                if (!j(this).hasClass("category-" + temp))
                    j(this).slideUp('slow');
                else
                    j(this).slideDown('slow');

            });

        }

    });


    win.obj.load(function() {


        if (utils.exists('portfolio-masonry') || utils.exists('proportional-resize') || utils.exists('blog_posts')) iso_layout = 'masonry';

        iso_opts = {
            itemSelector: '.isotope li.iso-item ',
            layoutMode: iso_layout
        };

        if (utils.exists('blog_posts')) iso_opts.transformsEnabled = false;

        if (win.width > 767 && j('.isotope').length > 0)
            j('.isotope').isotope(iso_opts);

        window.parent.j("body").trigger('radChildReady');

        j('.blog-format1-posts ul li').waypoint(function() {

            var c = j(this).find('div.proxy-datearea');
            var p = j(this).prev();

            if (p.length > 0)
                p.find('span.line').animate({
                    height: p.height() + 20
                }, 500, '', function() {
                    c.transition({
                        height: 101
                    }, 900);
                });
            else
                c.transition({
                    height: 101
                }, 900);

        }, {
            offset: '70%',
            triggerOnce: true
        });

    });
    // Format 2 Coding ================

    j('div.blog-format2-posts ul li').waypoint(function() {

        var bgc = j(this).data('dbg');
        var c = j(this).data('dc');

        if (bgc != "")
            j(this).find('a.read-more').transition({
                backgroundColor: bgc,
                color: c
            }, 'slow');


    }, {
        offset: '50%',
        triggerOnce: true
    });

    // Format 6 Coding ================

    j('div.blog-format6-posts ul li').waypoint(function() {

        var bgc = j(this).data('dbg');
        var c = j(this).data('dc');

        if (bgc != "") {
            j(this).transition({
                backgroundColor: bgc,
                color: c
            }, 'slow');
            j(this).find('a.read-more').transition({
                borderColor: c,
                color: c
            }, 'slow');
        }

    }, {
        offset: '50%',
        triggerOnce: true
    });


    j('div.blog-format5-posts ul li').waypoint(function() {

        var bgc = j(this).data('dbg');
        var c = j(this).data('dc');

        if (bgc != "")
            j(this).find('a.read-more').transition({
                backgroundColor: bgc,
                color: c
            }, 'slow');
    }, {
        offset: '50%',
        triggerOnce: true
    });

    // Format 7 Coding ================

    win.obj.load(function() {

        j('div.blog-format7-posts ul li').waypoint(function() {

            var te = j(this),
                c = j(this).data('dc');

            if (c != "") {
                te.find('.desc').animate({
                    color: c
                }, 'slow');
                te.find('span.spacer').animate({
                    backgroundColor: c
                }, 'slow');
            }

            te.children('div.overlay').transition({
                height: j(this).height() + 1
            }, 'slow');
        }, {
            offset: '50%',
            triggerOnce: true
        });

    });


    // Blog & Portfolio Format Timeline

    var month, offset = j('div.timeline-post').length,
        position, tesfl, circle = j('span.circle');
    var post_type = circle.data('post_type'),
        line = j('span.line');
    var offset_line = 0,
        distance = 0;

    if (utils.exists('timeline-post')) {


        offset_line = line.position().left
        j('div.left-post').find('span.dot').css("left", (offset_line - 6) + "px");

        if (j('div.right-post').length > 0) {
            distance = j('div.right-post').position().left - offset_line
            j('div.right-post').find('span.dot').css("left", -(distance + 6) + "px");
        }

        circle.css("left", (offset_line - 19) + "px");
        win.obj.load(function() {
            j('div.timeline-post').waypoint(function(dir) {

                if (dir == "down") {
                    var c = j(this).data('dc');
                    var bgc = j(this).data('dbg');

                    if (bgc != "")
                        j(this).find('span.date,a.main-button').transition({
                            color: c,
                            backgroundColor: bgc
                        }, 500);
                    j(this).find('span.tip,span.dot').css({
                        opacity: 0,
                        display: 'block',
                        scale: 0.2
                    }).transition({
                        scale: 1,
                        opacity: 1
                    }, 700, '', function() {


                        j(this).children('span.connector').transition({
                            width: distance
                        }, 400);
                    });
                }

            }, {
                offset: '50%',
                triggerOnce: true
            });
        });

        circle.waypoint(function(direction) {

            if (direction == "down") {

                if (j('.post-end').length > 0) return;


                circle.transition({
                    opacity: 1
                }, 400);
                month = j('div.posts-timeline').find('h4.month-label').last();

                offset = j('div.timeline-post').length;
                j.post(ioa_listener_url, {
                    type: 'posts-timeline',
                    action: 'ioalistener',
                    id: circle.data('id'),
                    post_type: post_type,
                    offset: offset,
                    month: month.data('month')
                }, function(data) {
                    j('span.circle').transition({
                        opacity: 0
                    }, 400);


                    temp = j(j.trim(data));



                    j('div.posts-timeline').append(temp);



                    j('div.posts-timeline').find('div.left-post').find('span.dot').css("left", (offset_line - 6) + "px");
                    j('div.posts-timeline').find('div.right-post').find('span.dot').css("left", -(distance + 6) + "px");

                    offset = j('div.timeline-post').length;

                    ioapreloader(temp, function() {
                        setTimeout(function() {
                            temp.waypoint(function(dir) {

                                if (dir == "down") {
                                    var c = j(this).data('dc');
                                    var bgc = j(this).data('dbg');

                                    if (bgc != "")
                                        j(this).find('span.date,a.main-button').transition({
                                            color: c,
                                            backgroundColor: bgc
                                        }, 600);
                                    j(this).find('span.tip,span.dot').css({
                                        opacity: 0,
                                        display: 'block',
                                        scale: 0.2
                                    }).transition({
                                        scale: 1,
                                        opacity: 1
                                    }, 700, '', function() {
                                        j(this).children('span.connector').transition({
                                            width: distance
                                        }, 400);
                                    });
                                }

                            }, {
                                offset: '50%',
                                triggerOnce: true
                            });

                        }, 50);
                    });
                });




            }

        }, {
            offset: 'bottom-in-view'
        });



    }

    /**
     * All formats common codes
     */

    if (utils.exists('way-animated')) {
        if (win.width <= 1024) {
            j('.way-animated').css('opacity', 1);
        }

        if (win.width > 1024)
            j('.way-animated').waypoint(function(dir) {

                if (dir == "down") {

                    var temp = j(this),
                        effect = temp.data('waycheck'),
                        delay = 0;

                    if (typeof temp.data('delay') != "undefined") delay = parseInt(temp.data('delay'));

                    if (bowser.msie && bowser.version <= 8) effect = 'fade';

                    switch (effect) {
                        case 'fade-left':
                            temp.css({
                                x: -30
                            }).delay(delay).transition({
                                opacity: 1,
                                x: 0
                            }, 400);
                            break;
                        case 'fade-right':
                            temp.css({
                                x: 30
                            }).delay(delay).transition({
                                opacity: 1,
                                x: 0
                            }, 400);
                            break;
                        case 'fade-top':
                            temp.css({
                                y: -30
                            }).delay(delay).transition({
                                opacity: 1,
                                y: 0
                            }, 400);
                            break;
                        case 'fade-bottom':
                            temp.css({
                                y: 30
                            }).delay(delay).transition({
                                opacity: 1,
                                y: 0
                            }, 400);
                            break;

                        case 'big-fade-left':
                            temp.css({
                                x: -100
                            }).delay(delay).transition({
                                opacity: 1,
                                x: 0
                            }, 700);
                            break;
                        case 'big-fade-right':
                            temp.css({
                                x: 100
                            }).delay(delay).transition({
                                opacity: 1,
                                x: 0
                            }, 700);
                            break;
                        case 'big-fade-top':
                            temp.css({
                                y: -100
                            }).delay(delay).transition({
                                opacity: 1,
                                y: 0
                            }, 700);
                            break;
                        case 'big-fade-bottom':
                            temp.css({
                                y: 100
                            }).delay(delay).transition({
                                opacity: 1,
                                y: 0
                            }, 700);
                            break;

                        case 'scale-in':
                            temp.css({
                                scale: 1.5
                            }).delay(delay).transition({
                                opacity: 1,
                                scale: 1
                            }, 400);
                            break;
                        case 'scale-out':
                            temp.css({
                                scale: 0.5
                            }).delay(delay).transition({
                                opacity: 1,
                                scale: 1
                            }, 400);
                            break;

                        case 'fade':
                        default:
                            temp.delay(delay).transition({
                                opacity: 1
                            }, 400);
                    }

                }

            }, {
                offset: '70%',
                triggerOnce: true
            });
    }

    if (utils.exists('chain-animated')) {
        if (win.width <= 1024) {
            j('.chain-animated').find('.chain-link').css('opacity', 1);
        }

        if (win.width > 1024)
            j('.chain-animated').waypoint(function(dir) {

                if (dir == "down") {

                    var temp = j(this),
                        effect = temp.data('chain'),
                        delay = 0;

                    if (bowser.msie && bowser.version <= 8) {
                        temp.find('.chain-link').css("opacity", 1);
                        return;
                    }

                    temp.find('.inner-item-wrap').each(function(i) {
                        delay = i * 100;
                        switch (effect) {
                            case 'fade-left':
                                j(this).css({
                                    x: -30
                                }).delay(delay).transition({
                                    opacity: 1,
                                    x: 0
                                }, 400);
                                break;
                            case 'fade-right':
                                j(this).css({
                                    x: 30
                                }).delay(delay).transition({
                                    opacity: 1,
                                    x: 0
                                }, 400);
                                break;
                            case 'fade-top':
                                j(this).css({
                                    y: -30
                                }).delay(delay).transition({
                                    opacity: 1,
                                    y: 0
                                }, 400);
                                break;
                            case 'fade-bottom':
                                j(this).css({
                                    y: 30
                                }).delay(delay).transition({
                                    opacity: 1,
                                    y: 0
                                }, 400);
                                break;

                            case 'big-fade-left':
                                j(this).css({
                                    x: -100
                                }).delay(delay).transition({
                                    opacity: 1,
                                    x: 0
                                }, 700);
                                break;
                            case 'big-fade-right':
                                j(this).css({
                                    x: 100
                                }).delay(delay).transition({
                                    opacity: 1,
                                    x: 0
                                }, 700);
                                break;
                            case 'big-fade-top':
                                j(this).css({
                                    y: -100
                                }).delay(delay).transition({
                                    opacity: 1,
                                    y: 0
                                }, 700);
                                break;
                            case 'big-fade-bottom':
                                j(this).css({
                                    y: 100
                                }).delay(delay).transition({
                                    opacity: 1,
                                    y: 0
                                }, 700);
                                break;

                            case 'scale-in':
                                j(this).css({
                                    scale: 1.5
                                }).delay(delay).transition({
                                    opacity: 1,
                                    scale: 1
                                }, 400);
                                break;
                            case 'scale-out':
                                j(this).css({
                                    scale: 0.5
                                }).delay(delay).transition({
                                    opacity: 1,
                                    scale: 1
                                }, 400);
                                break;

                            case 'fade':
                            default:
                                j(this).delay(delay).transition({
                                    opacity: 1
                                }, 400);
                        }

                    });

                }

            }, {
                offset: '80%',
                triggerOnce: true
            });
    }

    j('.bx-wrapper .bx-controls-direction a').click(function(e) {
        e.preventDefault();
    });

    j('div.ioa-menu').find('li').each(function() {
        j(this).hoverdir();
    });

    j('div.ioa-menu a').click(function(e) {

        if (!j(this).next().is(':hidden'))
            j(this).next().fadeOut('normal');
        else
            j(this).next().fadeIn('normal');

        e.preventDefault();
    });

    j('div.ioa-menu').hoverIntent(function(e) {
        if (j(this).hasClass('ioa-menu-open')) return;
        j(this).children('ul').fadeIn('normal');
    }, function(e) {
        if (j(this).hasClass('ioa-menu-open')) return;
        j(this).children('ul').fadeOut('normal');
    });

    var hovers = j('div.hoverable  div.image, div.image-frame');

    win.obj.load(function() {



        doc.on('mouseenter', 'div.hoverable  div.image, div.image-frame ', function() {
            var h = j(this).find('.hover'),
                i = h.children('i');

            i.css({
                opacity: 0,
                scale: 0.5
            });
            h.css({
                opacity: 0,
                display: "block"
            }).stop(true, true).transition({
                opacity: 0.9
            }, 500);
            setTimeout(function() {
                h.children('i').transition({
                    opacity: 1,
                    scale: 1
                }, 400);
            }, 60);

        });

        doc.on('mouseleave', 'div.hoverable  div.image, div.image-frame ', function() {
            var h = j(this).find('.hover');
            h.children('a').transition({
                opacity: 0
            }, 400);
            h.transition({
                opacity: 0
            }, 300, '');

        });



    });



    j('ul.single-related-posts li div.image').hover(function() {

        j(this).children('.hover').stop(true, true).fadeIn(400);

    }, function() {

        j(this).children('.hover').stop(true, true).fadeOut(400);

    });

    j('div.portfolio-list ul li').waypoint(function() {

        var c = j(this).find('div.proxy-datearea');
        var p = j(this).prev();

        c.transition({
            height: 101
        }, 900);

    }, {
        offset: '70%',
        triggerOnce: true
    });

    /**
     * Woo Commerce Code
     */
    var button_parent;
    j('body').bind('adding_to_cart', function(evt, button) {

        button_parent = button.parents('.product');
        button.fadeOut('fast');
        button_parent.find('.cart-loader').css({
            marginTop: -15,
            opacity: 0,
            display: 'block'
        }).transition({
            marginTop: 0,
            opacity: 1
        }, 300, '');
        button_parent.find('.product-data').transition({
            opacity: 0.6
        }, 400);

    })

    j('.ajax-cart-trigger').click(function(e) {
        e, preventDefault();
    });

    j('.ajax-cart').hover(function() {

        j('.ajax-cart-items').css({
            marginTop: 15,
            opacity: 0,
            display: 'block'
        }).animate({
            marginTop: 0,
            opacity: 1
        }, 300, '');

    }, function() {

        j('.ajax-cart-items').animate({
            opacity: 0,
            marginTop: 15
        }, 200, '', function() {
            j(this).hide();
        })

    });

    j('body').bind('added_to_cart', function(evt, fragments, cart_hash) {

        button_parent.find('.cart-loader').transition({
            marginTop: -15,
            opacity: 0
        }, 300, '', function() {
            j(this).hide();
        });
        button_parent.find('.product-data').transition({
            opacity: 1
        }, 400);

    })

    j('.show_review_form').click(function() {
        j('#review_form').slideToggle('normal');
    });

    j('.products li').hover(function() {
        obj = j(this);
        obj.find('.button').css({
            marginTop: -15,
            display: "block",
            opacity: 0
        }).transition({
            opacity: 1,
            marginTop: 0
        }, 200);
    }, function() {
        obj = j(this);
        obj.find('.button').transition({
            opacity: 0,
            marginTop: -15
        }, 200, '', function() {
            j(this).hide();
        });


    });

    /**
     * Pagination code
     */

    j('div.pagination-dropdown select').change(function() {

        window.location.href = j(this).val();
    });


    win.obj.load(function() {
        j('div.blog-format4-posts ul li div.post-content-area').each(function() {
            obj = j(this);

            if (obj.height() >= 250) {
                obj.data('height', obj.height());
                obj.animate({
                    height: 250
                }, 'normal');
                obj.parents('li').find('a.bottom-view-toggle').css('visibility', 'visible').transition({
                    opacity: 1
                }, 300);

            } else {
                obj.parents('li').find('a.bottom-view-toggle').remove();
            }


        });
    });


    j('a.bottom-view-toggle').click(function(e) {
        temp = j(this);
        var cl = temp.parent().find('div.post-content-area');
        if (temp.hasClass('down-diricon-')) {
            cl.animate({
                height: cl.data('height')
            }, 'normal');
            temp.addClass('up-diricon-').removeClass('down-diricon-');
        } else {
            cl.animate({
                height: 250
            }, 'normal');
            temp.addClass('down-diricon-').removeClass('up-diricon-');
        }

        e.preventDefault();
    });


    /**
     * Contact Template
     */

    j('div.map-wrapper').hover(function() {

        j(this).children('div.overlay-address-area').stop(true, true).fadeOut(700);

    }, function() {

        j(this).children('div.overlay-address-area').stop(true, true).fadeIn(400);

    });




    if (utils.exists('portfolio-masonry')) {
        if (j('.no-posts-found').length > 0) {
            j('div.portfolio-masonry').css({
                background: 'none',
                'min-height': 0
            });
            j('div.portfolio-masonry ul').transition({
                opacity: 1
            }, 300);
        } else {
            var masonry_items = j('div.portfolio-masonry ul li');
            masonry_items.find('.image').each(function() {
                j(this).hoverdir()
            });



            win.obj.load(function() {


                masonry_items.each(function(i) {
                    temp = j(this);
                    temp.find('.loader').remove();
                    temp.find('.inner-item-wrap').delay(i * 50).transition({
                        opacity: 1
                    });

                });

            });
        }

    }

    var portfolio_posts = super_wrapper.find('.portfolio_posts');

    if (win.width <= 1024) {
        j('.theme-header .menu a').on('click touchend', function(e) {
            var el = j(this);
            var link = el.attr('href');
            if (link === "#" || link === "http://#" || el.parent().children('.sub-menu').length > 0) return;
            window.location = link;
        });
    }

    j('div.ioa-menu ul li').on('touchend', function(e) {
        j(this).trigger('click');
    });


    if (utils.exists('metro-wrapper')) {

        var metro_lists = j('div.portfolio-metro ul'),
            metro_items = metro_lists.children();


        if (bowser.msie && bowser.version <= 8) {
            metro_items.each(function() {
                j(this).find('div.image-wrap').width(j(this).find('div.image-wrap img').width());
            });
        }

        var testwidth = metro_lists.first().width();
        if (j('.no-posts-found').length == 0) {


            if (win.width > 767) {

                if (metro_lists.last().width() > testwidth) testwidth = metro_lists.last().width();

                j('div.portfolio-metro').width(testwidth);
                metro_lists.css('display', 'block');


                win.obj.load(function() {
                    j('div.portfolio-metro').height(metro_lists.height() * 2);
                    j('div.metro-wrapper').jScrollPane({
                        animateScroll: false,
                        mouseWheelSpeed: 80
                    });
                    metro_items.each(function(i) {

                        temp = j(this);
                        temp.css({
                            scale: 0.5
                        }).delay(i * 20).transition({
                            opacity: 1,
                            scale: 1
                        }, 700);

                    });
                    j('.jspHorizontalBar').animate({
                        height: 25
                    }, 'fast');
                    j('.jspDrag').stop(true, true).animate({
                        height: 22
                    }, 'fast');
                });

            } else {
                metro_items.css('opacity', 1);
            }

        } else {
            metro_lists.css('display', 'block');
            j('div.portfolio-metro').css('width', 'auto');
        }

    }
    /**
     * Portfolio Featured
     */

    if (utils.exists('featured-column')) {
        j('li.featured-block').hover(function() {
            j(this).find('div.overlay').transition({
                scale: 0,
                opacity: 0
            }, 300);
        }, function() {
            j(this).find('div.overlay').transition({
                scale: 1,
                opacity: 1
            }, 300);
        });

        j('div.featured-column ul li').waypoint(function(dir) {

            if (dir == "down") {
                var c = j(this).data('dc');
                var bgc = j(this).data('dbg');

                if (bgc != "") {
                    j(this).find('div.title-area,a.read-more').animate({
                        color: c,
                        backgroundColor: bgc
                    }, 'slow');
                    j(this).find('div.desc').animate({
                        borderColor: bgc
                    }, 'slow');

                }
            }

        }, {
            offset: '80%',
            triggerOnce: true
        });
    }



    /**
     * Portfolio Modelie
     */


    /**
     * Scroll Pane usability
     */


    if (utils.exists('portfolio-modelie')) {
        var la, modelie_wrap = j('div.portfolio-modelie'),
            view_pane = modelie_wrap.find('div.view-pane'),
            view_data, view_scroll, modelie_list = modelie_wrap.find('ul');
        var calc_height = win.height - (j('div.theme-header').height());


        var compute_width = 0,
            current_loader, testable_width = responsive.width;

        if (j('.inner-super-wrapper').hasClass('ioa-boxed-layout')) testable_width = modelie_wrap.width();

        if (calc_height < 200) calc_height = 250;

        j.post(ioa_listener_url, {
            type: 'portfolio_modelie',
            action: 'ioalistener',
            id: view_pane.data('id'),
            offset: modelie_list.children('li.post').length,
            height: calc_height - 20,
            width: responsive.width
        }, function(data) {

            j('div.view-pane ul li.span-class').remove();
            modelie_list.append(data);

            view_pane.children('.loader').remove();
            ioapreloader(modelie_list, function() {
                modelie_list.children('li').each(function() {
                    temp = j(this);
                    temp.height(calc_height - 20);
                    la = temp.find('a.hover-lightbox');
                    compute_width += j(this).outerWidth();
                    la.css({
                        top: temp.height() / 2 - la.height() / 2 - 25,
                        left: temp.width() / 2 - la.width() / 2 - 25
                    });

                });

                if (responsive.width > 767) {
                    view_pane.height(calc_height - 20);

                    modelie_list.width(compute_width);
                    setTimeout(function() {


                        view_scroll = view_pane.jScrollPane({
                            mouseWheelSpeed: 100
                        });
                        view_data = view_scroll.data('jsp');

                        modelie_list.children('li').each(function(i) {
                            temp = j(this);
                            temp.css('background-image', 'none');
                            temp.find('.loader').remove();
                            temp.children('.inner-item-wrap').stop(true, true).delay(i * 90).transition({
                                opacity: 1
                            }, 700);

                        });

                        j('.jspHorizontalBar').animate({
                            height: 25
                        }, 'fast');
                        j('.jspDrag').stop(true, true).animate({
                            height: 22
                        }, 'fast');

                        if (bowser.msie && bowser.version <= 8) {
                            setTimeout(function() {
                                j('.jspHorizontalBar').animate({
                                    height: 25
                                }, 'fast');
                                j('.jspDrag').stop(true, true).animate({
                                    height: 22
                                }, 'fast');
                            }, 300);
                        }
                    }, 40);

                } else {
                    modelie_list.find('.inner-item-wrap').css("opacity", 1);
                    modelie_list.find('.loader').remove();
                }

            });



        });

        doc.on('click', 'a.load-more-posts-button', function(e) {
            e.preventDefault()
            current_loader = j(this);
            current_loader.html(current_loader.data('loading'));

            j.post(ioa_listener_url, {
                type: 'portfolio_modelie',
                action: 'ioalistener',
                width: responsive.width,
                id: view_pane.data('id'),
                offset: modelie_list.children('li.post').length,
                height: calc_height - 20
            }, function(data) {



                var test = j(j.trim(data));

                if (!test.hasClass('end-more-posts')) {

                    if (responsive.width > 767) {

                        modelie_list.css("width", "20000em");
                        modelie_list.append(test);
                        compute_width = 0;


                        ioapreloader(modelie_list, function() {

                            current_loader.parent().animate({
                                width: 0
                            }, 'normal', function() {
                                j(this).remove();

                                modelie_list.children('li').each(function() {
                                    temp = j(this);
                                    temp.height(calc_height - 20);
                                    la = temp.find('a.hover-lightbox');
                                    compute_width += j(this).outerWidth();

                                    la.css({
                                        top: temp.height() / 2 - la.height() / 2 - 25,
                                        left: temp.width() / 2 - la.width() / 2 - 25
                                    });

                                });
                                modelie_list.width(compute_width);
                                setTimeout(function() {

                                    view_data.reinitialise();
                                    test.each(function(i) {

                                        temp = j(this);
                                        temp.css('background-image', 'none');
                                        temp.find('.loader').remove();

                                        temp.children('.inner-item-wrap').stop(true, true).delay(i * 90).transition({
                                            opacity: 1
                                        }, 700);

                                    });
                                    view_data.scrollByX(testable_width - 400, true);
                                    j('.jspHorizontalBar').animate({
                                        height: 25
                                    }, 'fast');
                                    j('.jspDrag').stop(true, true).animate({
                                        height: 22
                                    }, 'fast');


                                }, 40);

                            });

                        });

                    } else {
                        current_loader.parent().animate({
                            width: 0
                        }, 'normal', function() {
                            j(this).remove();
                            modelie_list.append(test);
                            modelie_list.find('.loader').remove();

                            modelie_list.find('.inner-item-wrap').css("opacity", 1);
                        });
                    }



                } else {
                    current_loader.parent().replaceWith(test);
                    test.stop(true, true).delay(i * 90).transition({
                        opacity: 1
                    }, 700);
                }

            });

        });



        j(document).on('mouseenter', 'div.view-pane li div.image', function() {

            j(this).children('.hover').stop(true, true).fadeIn(400);

        });


        j(document).on('mouseleave', 'div.view-pane li div.image', function() {

            j(this).children('.hover').stop(true, true).fadeOut(400);

        });

    }



    /**
     * Portfolio Full Screen
     */

    if (utils.exists('portfolio-full-screen')) {

        var fs_wrap = j('div.portfolio-full-screen'),
            fsview_pane = fs_wrap.find('div.full-screen-view-pane');
        var calc_height = win.height - (j('div.theme-header').height());
        if (calc_height < 200) calc_height = 250;
        j.post(ioa_listener_url, {
            type: 'portfolio_fullscreen',
            action: 'ioalistener',
            id: j('.full-screen-view-pane').data('id'),
            height: calc_height - 83,
            width: win.width
        }, function(data) {


            if (j(data).find('.no-posts-found').length == 0) {
                fsview_pane.append(data);
                fsview_pane.find('.ioa-gallery').seleneGallery({
                    domMapping: true
                });
            } else
                fsview_pane.html(j(data).find('.gallery-holder').html());

        })


    }


    /**
     * Portfolio Maerya
     */

    if (utils.exists('portfolio-maerya-list')) {

        if (j('.no-posts-found').length == 0) {

            var dybg, dyc, current_obj = null,
                maerya_list = j('ul.portfolio-maerya-list li'),
                check_flag = false,
                dynamic = j('div.dynamic-content');
            maerya_list.width(maerya_list.parent().width() / 4);
            win.obj.on("debouncedresize", function(event) {

                if (current_obj)
                    j('.portfolio-maerya-wrap .close-section').trigger('click');

                maerya_list.width(maerya_list.parent().width() / 4);
                maerya_list.data('width', maerya_list.width());

            });
            maerya_list.hover(function() {
                if (check_flag) return;

                j(this).find('.hover').stop(true, true).transition({
                    height: 470
                }, 400);

            }, function() {

                j(this).find('.hover').stop(true, true).transition({
                    height: 0
                }, 400);

            });

            maerya_list.find('a').click(function(e) {
                if (responsive.width > 767) e.preventDefault();
            });
            maerya_list.data('width', maerya_list.width());
            maerya_list.click(function() {

                current_obj = j(this);

                if (responsive.width < 767) {
                    window.location.href = current_obj.find('h2 a').attr('href');
                    return;
                }

                if (bowser.msie && bowser.version <= 8)
                    current_obj.find('div.stub').transition({
                        left: -(maerya_list.width() + 4)
                    }, 500);
                else
                    current_obj.find('div.stub').transition({
                        x: -(maerya_list.width() + 4)
                    }, 500);

                maerya_list.not(current_obj).transition({
                    width: 0
                }, 500);
                current_obj.transition({
                    width: current_obj.parent().width()
                }, 500);

                j('.portfolio-maerya-wrap .close-section').fadeIn('fast');

                var temp = j(this).find('div.meta-info');

                check_flag = true;
                current_obj.find('.hover').stop(true, true).transition({
                    height: 0
                }, 400, '', function() {

                });
                dybg = temp.css('background-color');
                dyc = temp.css('color');

                if (!dybg || dybg === "" || dybg === "transparent") dybg = '';
                if (!dyc || dyc === "" || dyc === "transparent") dyc = 'inherit';

                dynamic.css({
                    backgroundColor: dybg,
                    color: dyc
                });


                dynamic.html(temp.html());
                dynamic.show();

                if (bowser.msie && bowser.version <= 8)
                    setTimeout(function() {
                        dynamic.transition({
                            top: -(maerya_list.height() + 4)
                        }, 400, '');
                        dynamic.prev().transition({
                            top: -(maerya_list.height() + 4)
                        }, 400, '');
                    }, 300);
                else
                    setTimeout(function() {
                        dynamic.transition({
                            y: -(maerya_list.height() + 4)
                        }, 400, '');
                        dynamic.prev().transition({
                            y: -(maerya_list.height() + 4)
                        }, 400, '');
                    }, 300);


            });

            doc.on('click', 'a.close-section', function(e) {
                e.preventDefault();

                if (bowser.msie && bowser.version <= 8) {
                    dynamic.transition({
                        top: 0
                    }, 400, '', function() {
                        dynamic.html('');
                    });
                    dynamic.prev().transition({
                        top: 0
                    }, 400, '');
                } else {
                    dynamic.transition({
                        y: 0
                    }, 400, '', function() {
                        dynamic.html('');
                    });
                    dynamic.prev().transition({
                        y: 0
                    }, 400, '');
                }

                setTimeout(function() {

                    if (bowser.msie && bowser.version <= 8)
                        current_obj.find('div.stub').transition({
                            left: 0
                        }, 500);
                    else
                        current_obj.find('div.stub').transition({
                            x: 0
                        }, 500);


                    maerya_list.transition({
                        width: parseInt(maerya_list.data('width')) - 0.5
                    }, 500);



                }, 300);
                j(this).fadeOut('fast');
                check_flag = false;

            });

        } else {
            j('div.portfolio-maerya div.three_fourth').css('height', 'auto').removeClass('three_fourth left');
            j('div.portfolio-maerya div.one_fourth').hide();
        }

    }


    if (utils.exists('climacon-shortcode')) {


        var cl = null;
        if (!(bowser.msie && bowser.version <= 8)) {
            j('.climacon-shortcode').each(function() {

                switch (j(this).data('type')) {
                    case "rain":
                        cl = Skycons.RAIN;
                        break;
                    case "partly cloudy day":
                        cl = Skycons.PARTLY_CLOUDY_DAY;
                        break;
                    case "partly cloudy night":
                        cl = Skycons.PARTLY_CLOUDY_NIGHT;
                        break;
                    case "clear day":
                        cl = Skycons.CLEAR_DAY;
                        break;
                    case "clear night":
                        cl = Skycons.CLEAR_NIGHT;
                        break;
                    case "cloudy":
                        cl = Skycons.CLOUDY;
                        break;
                    case "fog":
                        cl = Skycons.FOG;
                        break;
                    case "sleet":
                        cl = Skycons.SLEET;
                        break;

                    case "snow":
                        cl = Skycons.SNOW;
                        break;
                    case "wind":
                        cl = Skycons.WIND;
                        break;

                }
                var skycons = new Skycons({
                    "color": j(this).data('color')
                });
                skycons.add(this, cl);
                skycons.play();

            });
        } else {
            j('.climacon-shortcode').each(function() {

                switch (j(this).data('type')) {
                    case "rain":
                        cl = "rain";
                        break;
                    case "partly cloudy day":
                        cl = "partly_cloudy_day";
                        break;
                    case "partly cloudy night":
                        cl = "partly_cloudy_night";
                        break;
                    case "clear day":
                        cl = "clear_day";
                        break;
                    case "clear night":
                        cl = "clear_night";
                        break;
                    case "cloudy":
                        cl = "cloudy";
                        break;
                    case "fog":
                        cl = "fog";
                        break;
                    case "sleet":
                        cl = "sleet";
                        break;

                    case "snow":
                        cl = "snow";
                        break;
                    case "wind":
                        cl = "wind";
                        break;

                }

                j(this).replaceWith('<div class="climafallback"><img src="' + theme_url + '/sprites/i/' + cl + '.jpg" alt="climate image" width="' + j(this).attr('width') + '" height="' + j(this).attr('height') + '" /></div>');

            });

        }

    }

    /**
     * Back to Top Button
     */


    j('a.back-to-top').click(function(e) {
        e.preventDefault();
        j('body,html').animate({
            scrollTop: 0
        }, 'normal');
    });

    if (j("a[rel^='prettyPhoto']").length > 0 && j('.rad-page-section').length == 0)
        j("a[rel^='prettyPhoto']").prettyPhoto({
            social_tools: '',
            theme: 'light_square'
        });





    /**
     * Single Portfolio Coding
     */

    if (utils.exists('single-prop-screen-view-pane')) {

        var fsview_pane = j('div.single-prop-screen-view-pane');
        var calc_height = win.height - (j('div.theme-header').height());
        if (calc_height < 200) calc_height = 250;

        j.post(ioa_listener_url, {
            type: 'single_portfolio_fullscreen',
            action: 'ioalistener',
            id: j('.single-prop-screen-view-pane').data('id'),
            height: calc_height - 83,
            width: win.width
        }, function(data) {

            fsview_pane.append(data);
            fsview_pane.find('.ioa-gallery').seleneGallery({
                domMapping: true
            });

        })


    }


    if (utils.exists('single-full-screen-view-pane')) {

        var fsview_pane = j('div.single-full-screen-view-pane');
        var calc_height = win.height - (j('div.theme-header').height()) - 83;
        if (calc_height < 200) calc_height = 250;

        fsview_pane.find('.spfs-gallery').seleneGallery({
            effect_type: 'fade',
            width: win.width,
            height: calc_height,
            duration: 5000,
            autoplay: false,
            captions: true,
            arrow_control: true,
            thumbnails: true
        });


    }


    if (utils.exists('single-portfolio-modelie')) {
        var la, modelie_wrap = j('div.single-portfolio-modelie'),
            view_pane = modelie_wrap.find('div.view-pane'),
            modelie_list = modelie_wrap.find('ul.portfolio_posts');
        var calc_height = j(window).height() - (j('div.theme-header').height());
        if (calc_height < 200) calc_height = 250;

        var compute_width = 0;

        view_pane.scroll(function(event) {
            /* Act on the event */
            event.stopImmediatePropagation();
            return false;
        });

        j.post(ioa_listener_url, {
            type: 'single_portfolio_modelie',
            action: 'ioalistener',
            id: view_pane.data('id'),
            height: calc_height - 20,
            width: responsive.width
        }, function(data) {

            view_pane.children('.loader').remove();
            modelie_list.html(data);

            if (responsive.width > 767) {

                ioapreloader(modelie_list, function() {
                    view_pane.height(calc_height - 10);
                    modelie_list.children('li').each(function() {
                        temp = j(this);
                        temp.height(calc_height - 10);

                        compute_width += j(this).outerWidth();

                    });

                    modelie_list.width(compute_width);

                    setTimeout(function() {

                        view_scroll = view_pane.jScrollPane({
                            mouseWheelSpeed: 100
                        });
                        view_data = view_scroll.data('jsp');
                        modelie_list.children('li').each(function(i) {
                            temp = j(this);
                            temp.css('background-image', 'none');
                            temp.find('.loader').remove();
                            temp.children('.inner-item-wrap').stop(true, true).delay(i * 90).transition({
                                opacity: 1
                            }, 700);

                        });
                        j('.jspHorizontalBar').animate({
                            height: 25
                        }, 'fast');
                        j('.jspDrag').stop(true, true).animate({
                            height: 22
                        }, 'fast');

                    }, 40);

                    setTimeout(function() {

                        view_pane.find('.jspDrag').transition({
                            backgroundColor: view_pane.data('dc')
                        }, 400);

                    }, 2000);

                });

            } else {
                modelie_list.find('.inner-item-wrap').css('opacity', 1);
                modelie_list.find('.loader').remove();
            }


        });


    }

    if (j('.tweets-wrapper.slider ul').length > 0)
        j('.tweets-wrapper.slider ul').bxSlider({
            mode: 'fade',
            adaptiveHeight: true,

            pager: false,
            auto: true
        });

    /**
     * Graphs overlay toggle
     */

    doc.on('click', '.graph-info-toggle', function() {

        if (j(this).hasClass('info-2icon-'))
            j(this).addClass('cancel-2icon-').removeClass('info-2icon-');
        else
            j(this).removeClass('cancel-2icon-').addClass('info-2icon-');

        j(this).parent().children('.info-area').fadeToggle('normal');
    });

    /**
     * Prop Manager
     */


    win.obj.load(function() {

        j('.prop-wrapper').each(function() {

            j(this).data({
                width: j(this).width(),
                height: j(this).height()
            });

            j(this).css({
                width: j(this).width() * responsive.ratio,
                height: j(this).height() * responsive.ratio
            });

            j(this).find('.prop').each(function() {

                t = j(this);
                i = t.children('img');

                t.css({

                    top: t.data('top') * responsive.ratio,
                    left: t.data('left') * responsive.ratio

                });
                i.data({
                    width: i.width(),
                    height: i.height()
                });
                i.css({
                    width: i.width() * responsive.ratio,
                    height: i.height() * responsive.ratio
                });


            });

        });

        if (win.width <= 1024)
            j('div.prop-wrapper').children().each(function() {
                j(this).css('opacity', 1);
            });

        if (win.width > 1024)
            j('div.prop-wrapper').waypoint(function() {

                var prop, props = j(this),
                    effect;

                props.children().each(function(i) {

                    prop = j(this);
                    prop.css("z-index", i + 1);

                    effect = prop.data('effect');
                    switch (effect) {
                        case 'fade-left':
                            prop.css({
                                x: -30
                            }).delay(prop.data('delay')).transition({
                                opacity: 1,
                                x: 0
                            }, 400);
                            break;
                        case 'fade-right':
                            prop.css({
                                x: 30
                            }).delay(prop.data('delay')).transition({
                                opacity: 1,
                                x: 0
                            }, 400);
                            break;
                        case 'fade-top':
                            prop.css({
                                y: -30
                            }).delay(prop.data('delay')).transition({
                                opacity: 1,
                                y: 0
                            }, 400);
                            break;
                        case 'fade-bottom':
                            prop.css({
                                y: 30
                            }).delay(prop.data('delay')).transition({
                                opacity: 1,
                                y: 0
                            }, 400);
                            break;

                        case 'big-fade-left':
                            prop.css({
                                x: -100
                            }).delay(prop.data('delay')).transition({
                                opacity: 1,
                                x: 0
                            }, 700);
                            break;
                        case 'big-fade-right':
                            prop.css({
                                x: 100
                            }).delay(prop.data('delay')).transition({
                                opacity: 1,
                                x: 0
                            }, 700);
                            break;
                        case 'big-fade-top':
                            prop.css({
                                y: -100
                            }).delay(prop.data('delay')).transition({
                                opacity: 1,
                                y: 0
                            }, 700);
                            break;
                        case 'big-fade-bottom':
                            prop.css({
                                y: 100
                            }).delay(prop.data('delay')).transition({
                                opacity: 1,
                                y: 0
                            }, 700);
                            break;

                        case 'scale-in':
                            prop.css({
                                scale: 1.5
                            }).delay(prop.data('delay')).transition({
                                opacity: 1,
                                scale: 1
                            }, 400);
                            break;
                        case 'scale-out':
                            prop.css({
                                scale: 0.5
                            }).delay(prop.data('delay')).transition({
                                opacity: 1,
                                scale: 1
                            }, 400);
                            break;

                        case 'fade':
                        default:
                            prop.delay(prop.data('delay')).transition({
                                opacity: 1
                            }, 400);
                    }



                });

            }, {
                offset: '70%',
                triggerOnce: true
            });

    });


    /**
     * Mobile Search
     */

    var msearch_parent = j('div.majax-search'),
        msearch_loader = msearch_parent.find('span.msearch-loader');

    j('.majax-search-pane input[type=text]').keyup(function(e) {
        var val = j(this).val().length;

        if (e.keyCode == 27) {
            j('a.majax-search-trigger').trigger('click');
            return;
        }

        if (val >= 2) {

            msearch_loader.fadeIn('fast');
            j.post(msearch_parent.data('url'), {
                type: 'search',
                action: 'ioalistener',
                query: j(this).val()
            }, function(data) {
                if (j.trim(data) == "") return;


                msearch_parent.find('.no-results').fadeOut('fast');
                msearch_parent.find('.msearch-results ul').html(data);
                msearch_parent.find('div.msearch-results').stop(true, true).fadeIn('fast', function() {
                    msearch_loader.fadeOut('fast');
                });

            });

        } else {
            msearch_parent.find('div.msearch-results').hide();
            msearch_parent.find('.msearch-results ul').html('');

        }

    });


    j('a.majax-search-trigger').click(function(e) {
        e.preventDefault();
        temp = msearch_parent.find('div.majax-search-pane');

        if (temp.is(":hidden")) {
            j('a.majax-search-trigger').addClass('active');
            j('body,html').animate({
                scrollTop: 0
            }, 'normal');
        } else {
            j('a.majax-search-trigger').removeClass('active');
        }
        temp.stop(true, true).slideToggle('normal');

    });

    j('a.majax-search-close').click(function(e) {
        e.preventDefault();
        temp.stop(true, true).slideToggle('normal');
        j('a.majax-search-trigger').removeClass('active');
    });


    /**
     * Person Code
     */

    j('.person-info-toggle').click(function() {

        if (j(this).hasClass('info-2icon-')) {
            j(this).addClass('cancel-2icon-').removeClass('info-2icon-');
            j(this).parent().children('.desc').css({
                opacity: 0,
                scale: 0.5,
                display: "block"
            }).transition({
                opacity: 0.95,
                scale: 1
            }, 400);
        } else {
            j(this).removeClass('cancel-2icon-').addClass('info-2icon-');
            j(this).parent().children('.desc').transition({
                opacity: 0,
                scale: 0
            }, 400);

        }


    });

    if (utils.exists('menu-centered')) {
        j('.menu-centered .menu,.menu-centered .top-area-social-list').each(function() {
            Menu_builder.center(j(this));
        });
    }


    function PageWidgets(obj) {
        var t, n, minx, vals;
        obj.find('.way-animated, .chain-animated .chain-link').css("opacity", 1);
        obj.find(".ioa_tabs").tabs({
            show: {
                effect: "fadeIn",
                duration: 300
            }
        });
        obj.find(".ioa_accordion").accordion({
            create: function(event, ui) {
                ui.header.find('i').removeClass('down-diricon-').addClass('up-diricon-')
            },
            beforeActivate: function(event, ui) {
                ui.newHeader.find('i').removeClass('down-diricon-').addClass('up-diricon-');
                ui.oldHeader.find('i').addClass('down-diricon-').removeClass('up-diricon-');
            },
            heightStyle: "content"
        });
        obj.find('.ioa-gallery').seleneGallery({
            domMapping: true
        });
        obj.find('.ioaslider').quartzSlider({
            domMapping: true
        });
        obj.find('ul.rad-testimonials-list').bxSlider({
            mode: 'horizontal',
            adaptiveHeight: true,

            pager: false,
            auto: true
        });
        obj.find('.isotope').isotope(iso_opts);
        obj.find('.scrollable').each(function() {

            t = j(this).parent().width();
            n = j(this).children().width() + 20;
            minx = Math.ceil(t / n);
            //console.log(t+" "+n+minx);
            j(this).bxSlider({
                slideWidth: n,
                maxSlides: minx,
                moveSlides: minx,
                infiniteLoop: false,
                slideMargin: 20,

                pager: false
            });

        });

        obj.find('.line-chart-wrap').each(function() {
            temp = j(this), vals;
            var ds = [];
            temp.find('.line-val').each(function(i) {
                vals = j(this).data('values').toString();

                if (vals.indexOf(',') != -1) {
                    vals = vals.split(',');
                } else
                    vals = [parseInt(vals)];

                for (var j = 0; j < vals.length; j++) vals[j] = parseInt(vals[j]);

                ds[i] = {
                    fillColor: j(this).data('fillcolor'),
                    strokeColor: j(this).data('strokecolor'),
                    pointColor: j(this).data('pointcolor'),
                    pointStrokeColor: j(this).data('pointstrokecolor'),
                    data: vals
                };

            });

            var data = {
                labels: temp.data('labels').split(','),
                datasets: ds
            }


            var ctx = temp.children('canvas')[0].getContext("2d");
            var myNewChart = new Chart(ctx);

            var options = {};
            if (bowser.msie && bowser.version <= 8) options.animation = false;

            new Chart(ctx).Line(data, options);
        });

        obj.find('.progress-bar-group').each(function() {

            j(this).find('div.progress-bar').each(function(i) {

                j(this).find('div.filler').delay(i * 100).transition({
                    opacity: 1,
                    width: parseInt(j(this).find('div.filler').data('fill')) + "%"
                }, 1500, 'easeInOutQuint', function() {
                    j(this).children().fadeIn('fast');
                });
            });

        });

        obj.find('.polar-chart-wrap').each(function() {
            temp = j(this);
            var ds = [],
                total = 0;
            temp.find('.polar-val').each(function(i) {

                total += parseInt(j(this).data('value'));

            });
            temp.find('.polar-val').each(function(j) {

                ds[j] = {
                    value: parseInt(j(this).data('value')),
                    color: j(this).data('fillcolor')
                };

                j(this).children('.block').html(Math.round(parseInt(j(this).data('value')) / total * 1000) / 10 + "%");
            });

            var ctx = temp.children('canvas')[0].getContext("2d");
            var myNewChart = new Chart(ctx);

            var options = {};
            if (bowser.msie && bowser.version <= 8) options.animation = false;

            new Chart(ctx).PolarArea(ds, options);

        });

        obj.find('.pie-chart-wrap').each(function() {

            temp = j(this);
            var ds = [],
                total = 0;
            temp.find('.pie-val').each(function(i) {

                total += parseInt(j(this).data('value'));

            });
            temp.find('.pie-val').each(function(i) {

                ds[i] = {
                    color: j(this).data('fillcolor'),
                    value: j(this).data('value')
                };
                j(this).children('.block').html(Math.round(parseInt(j(this).data('value')) / total * 1000) / 10 + "%");

            });
            var ctx = temp.children('canvas')[0].getContext("2d");
            var myNewChart = new Chart(ctx);
            new Chart(ctx).Pie(ds, {
                animateScale: true,
                animationEasing: "easeOutExpo"
            });

        });

        obj.find('.donut-chart-wrap').each(function() {
            temp = j(this);
            temp = j(this);
            var ds = [],
                total = 0;
            temp.find('.donut-val').each(function(i) {

                total += parseInt(j(this).data('value'));

            });
            temp.find('.donut-val').each(function(i) {

                ds[i] = {
                    color: j(this).data('fillcolor'),
                    value: j(this).data('value')
                };

                j(this).children('.block').html(Math.round(parseInt(j(this).data('value')) / total * 1000) / 10 + "%");
            });

            var ctx = temp.children('canvas')[0].getContext("2d");
            var myNewChart = new Chart(ctx);
            new Chart(ctx).Doughnut(ds, {
                animationEasing: "easeOutExpo"
            });
        });

        obj.find('.bar-chart-wrap').each(function() {
            temp = j(this);
            var ds = [],
                j;
            temp.find('.bar-val').each(function(i) {
                vals = j(this).data('values').toString();

                if (vals.indexOf(',') != -1) {
                    vals = vals.split(',');
                } else
                    vals = [parseInt(vals)];
                for (var j = 0; j < vals.length; j++) vals[j] = parseInt(vals[j]);

                ds[i] = {
                    fillColor: j(this).data('fillcolor'),
                    strokeColor: j(this).data('strokecolor'),
                    data: vals
                };

            });

            var data = {
                labels: temp.data('labels').split(','),
                datasets: ds
            }

            var ctx = temp.children('canvas')[0].getContext("2d");
            var myNewChart = new Chart(ctx);

            var options = {};
            if (bowser.msie && bowser.version <= 8) options.animation = false;

            new Chart(ctx).Bar(data, options);
        });

        obj.find('div.circles-group').each(function() {

            var parentw = j(this).width();

            if (parentw >= j(this).parent().width()) {
                parentw = j(this).parent().width();
                j(this).width(parentw);
                j(this).height(parentw);
            }

            j(this).find('div.circle').each(function(j) {
                j(this).css({
                    "left": (parentw - parseInt(j(this).data('fill')) / 100 * parentw) / 2,
                    scale: 0.2
                });
                j(this).delay(j * 100).transition({
                    opacity: 1,
                    scale: 1,
                    width: parseInt(j(this).data('fill')) + "%",
                    height: parseInt(j(this).data('fill')) + "%"
                }, 500);

            });

        });


        obj.find('.radial-chart').each(function() {
            w = j(this).data('width');
            if (w > j(this).width()) w = j(this).width() - 20;
            j(this).easyPieChart({
                size: w,
                lineWidth: j(this).data('line_width'),
                barColor: j(this).data('bar_color'),
                trackColor: j(this).data('track_color'),
                scaleColor: false,
                lineCap: "butt",
                animate: 2000
            }).data('easyPieChart').update(j(this).data('start_percent'));

        });

    }

    win.obj.on("debouncedresize", function(event) {
        responsive.ratio = j('.skeleton').width() / 1060;
        responsive.width = win.obj.width();
        responsive.height = win.obj.height();
        if (responsive.width < 767) {
            responsive.ratio = (win.obj.width() * 0.7) / 1060;

        }
        resizable();
    });

    window.onorientationchange = function() {
        responsive.ratio = j('.skeleton').width() / 1060;
        responsive.width = win.obj.width();
        responsive.height = win.obj.height();
        if (responsive.width < 767) {
            responsive.ratio = (win.obj.width() * 0.7) / 1060;

        }
        resizable();
        setTimeout(function() {
            resizable();
        }, 150);
    };


    function resizable() {
        var t, i, k;

        if (j('.isotope').length > 0 && j('.rad-page-section').length == 0)

            j('.isotope').isotope('reLayout');


        if (responsive.width > 767)
            j('#mobile-menu').hide();

        if (utils.exists('prop-wrapper')) {

            j('.prop-wrapper').each(function() {

                j(this).css({
                    width: j(this).data('width') * responsive.ratio,
                    height: j(this).data('height') * responsive.ratio
                });

                j(this).find('.prop').each(function() {

                    t = j(this);
                    i = t.children('img');

                    t.css({

                        top: t.data('top') * responsive.ratio,
                        left: t.data('left') * responsive.ratio

                    });

                    i.css({
                        width: i.data('width') * responsive.ratio,
                        height: i.data('height') * responsive.ratio
                    });

                });

            });

        }

        if (utils.exists('single-portfolio-modelie')) {
            var la, modelie_wrap = j('div.single-portfolio-modelie'),
                view_pane = modelie_wrap.find('div.view-pane'),
                view_data, modelie_list = modelie_wrap.find('ul');
            var compute_width = 0,
                calc_height = win.height - (j('div.theme-header').height());
            if (calc_height < 200) calc_height = 250;
            if (responsive.width > 767) {
                view_pane.width(responsive.width);
                modelie_wrap.find('ul.portfolio_posts li').each(function() {
                    compute_width += j(this).outerWidth();
                });
                modelie_list.width(compute_width);
                view_pane.height(calc_height - 10);
                view_pane.jScrollPane({
                    mouseWheelSpeed: 100
                });

                j('.jspHorizontalBar').animate({
                    height: 25
                }, 'fast');
                j('.jspDrag').stop(true, true).animate({
                    height: 22
                }, 'fast');

            } else {
                view_data = j('div.view-pane').data('jsp');
                if (view_data) {
                    view_data.destroy();
                }
                modelie_list.width(responsive.width);
                view_pane.css('height', 'auto');
            }
        }

        if (utils.exists('portfolio-modelie')) {
            var la, modelie_wrap = j('div.portfolio-modelie'),
                view_pane = modelie_wrap.find('div.view-pane'),
                view_data, modelie_list = modelie_wrap.find('ul');
            var compute_width = 0,
                calc_height = win.height - (j('div.theme-header').height());
            if (calc_height < 200) calc_height = 250;

            if (responsive.width > 767) {
                view_pane.width(responsive.width);
                view_pane.height(calc_height - 16);

                modelie_list.children('li').each(function() {
                    temp = j(this);
                    la = temp.find('a.hover-lightbox');
                    compute_width += j(this).outerWidth();
                    la.css({
                        top: temp.height() / 2 - la.height() / 2 - 25,
                        left: temp.width() / 2 - la.width() / 2 - 25
                    });

                });
                modelie_list.width(compute_width);
                view_pane.jScrollPane({
                    mouseWheelSpeed: 100
                });

                j('.jspHorizontalBar').animate({
                    height: 25
                }, 'fast');
                j('.jspDrag').stop(true, true).animate({
                    height: 22
                }, 'fast');

            } else {
                view_data = j('div.view-pane').data('jsp');
                if (view_data) {
                    view_data.destroy();
                }
                modelie_list.width(responsive.width);
                modelie_list.children('li').each(function() {
                    temp = j(this);
                    la = temp.find('a.hover-lightbox');
                    la.css({
                        top: temp.height() / 2 - la.height() / 2 - 25,
                        left: temp.width() / 2 - la.width() / 2 - 25
                    });

                });
                view_pane.css('height', 'auto');

            }


        }


        if (utils.exists('metro-wrapper')) {

            if (j('.no-posts-found').length == 0) {



                var dpi = j('div.metro-wrapper').data('jsp');
                if (responsive.width > 767) {
                    j('div.portfolio-metro').css("width", "2000em");

                    metro_lists.css('display', 'inline-block')
                    var testwidth = metro_lists.first().width();

                    if (metro_lists.last().width() > testwidth) testwidth = metro_lists.last().width();
                    j('div.portfolio-metro').css({
                        "height": metro_lists.height() * 2,
                        "width": testwidth
                    });
                    j('div.metro-wrapper').jScrollPane({
                        animateScroll: false,
                        mouseWheelSpeed: 80
                    });
                    j('.jspHorizontalBar').animate({
                        height: 25
                    }, 'fast');
                    j('.jspDrag').stop(true, true).animate({
                        height: 22
                    }, 'fast');
                    j('div.portfolio-metro').height(metro_lists.height() * 2);
                } else {
                    if (dpi)
                        dpi.destroy();
                    metro_items.css('opacity', 1);
                    j('div.portfolio-metro').width(responsive.width);
                    j('div.portfolio-metro').css('height', 'auto');
                }

            } else {
                metro_lists.css('display', 'block');
                j('div.portfolio-metro').css('width', 'auto');
            }

        }


        if (utils.exists('timeline-post')) {

            offset = j('div.timeline-post').length;
            offset_line = line.position().left;

            j('div.left-post').find('span.dot').css("left", (offset_line - 6) + "px");

            if (j('div.right-post').length > 0) {
                distance = j('div.right-post').position().left - offset_line
                j('div.right-post').find('span.dot').css("left", -(distance + 6) + "px");
            }

            circle.css("left", (offset_line - 15) + "px");
            j('div.timeline-post').find('span.connector').transition({
                width: distance
            }, 400);

        }



        if (compact_menu.length > 0) {
            compact_bar.css({
                'display': 'block',
                'visibility': 'hidden'
            });

            var cposi = compact_bar.find('.menu-wrapper').position().left;

            compact_menu.children('li').each(function() {

                if (j(this).find('div.sub-menu').length > 0) {
                    j(this).find('div.sub-menu').css("left", -(cposi + j(this).position().left) + "px");
                }
            });
            compact_bar.css({
                'display': 'none',
                'visibility': 'visible'
            });

        }

        if (menu_area.find('.menu').length > 0) {

            var posi = menu_area.find('.menu-wrapper').position().left;
            if (posi === 0) {
                posi = menu_area.find('.skeleton').width() / 2 - menu_area.find('.menu-wrapper').width() / 2;
            }
            menu_area.find('.menu').children('li').each(function() {

                if (j(this).find('div.sub-menu').length > 0) {
                    j(this).find('div.sub-menu').css("left", -(posi + j(this).position().left) + "px");
                }

                if (j('.fluid-menu').length > 0) {
                    j(this).find('div.sub-menu').width(responsive.width);
                }

            });
        }

        if (topbar.find('.menu').length > 0) {
            var posi = topbar.find('.menu-wrapper').position().left;
            if (posi === 0) {
                posi = topbar.find('.skeleton').width() / 2 - topbar.find('.menu-wrapper').width() / 2;
            }
            topbar.find('.menu').children('li').each(function() {

                if (j(this).find('div.sub-menu').length > 0) {
                    j(this).find('div.sub-menu').css("left", -(posi + j(this).position().left) + "px");
                }
            });
        }

        if (bottombar.find('.menu').length > 0) {
            var posi = bottombar.find('.menu-wrapper').position().left;

            if (posi === 0) {
                posi = bottombar.find('.skeleton').width() / 2 - bottombar.find('.menu-wrapper').width() / 2;
            }

            bottombar.find('.menu').children('li').each(function() {
                if (j(this).find('div.sub-menu').length > 0) {
                    j(this).find('div.sub-menu').css("left", -(posi + j(this).position().left) + "px");
                }
            });
        }


        j('div.circles-group').each(function() {

            var parentw = j(this).width();

            if (parentw >= j(this).parent().width()) {
                parentw = j(this).parent().width();
                j(this).width(parentw);
                j(this).height(parentw);
            }

            j(this).find('div.circle').each(function(j) {
                j(this).css({
                    "left": (parentw - parseInt(j(this).data('fill')) / 100 * parentw) / 2,
                    scale: 0.2
                });
                j(this).delay(j * 100).transition({
                    opacity: 1,
                    scale: 1,
                    width: parseInt(j(this).data('fill')) + "%",
                    height: parseInt(j(this).data('fill')) + "%"
                }, 500);

            });

        });



        if (responsive.width < 767) {
            j('#mobile-logo').width(j('#mobile-logo img').width());
            j('div.mobile-head img').transition({
                opacity: 1
            }, 400);
        }

        if (j('.mobile-side-wrap').length > 0) {
            j('div.mobile-side-wrap').height(responsive.height);
            j('#mobile-side-menu').height(responsive.height - 45);
            var sidemobile = j('#mobile-side-menu').data('jsp');
            if (typeof sidemobile !== "undefined") sidemobile.reinitialise();
            else j('#mobile-side-menu').jScrollPane({
                mouseWheelSpeed: 80
            });
        }

    } // End of function

    // Mobile Menu

    if (win.width < 767) {
        win.obj.load(function() {

            j('#mobile-logo').width(j('#mobile-logo img').width());
            j('div.mobile-head img').transition({
                opacity: 1
            }, 400);

        });

    }
    var sidemobile = null;

    if (j('.mobile-side-wrap').length > 0) {
        j('div.mobile-side-wrap').height(responsive.height);
        j('#mobile-side-menu').height(responsive.height - 45);
        j('#mobile-side-menu').jScrollPane({
            mouseWheelSpeed: 80
        });
        sidemobile = j('#mobile-side-menu').data('jsp');
    }

    j('#mobile-side-menu li a').click(function(e) {

        if (j(this).parent().children('.sub-menu').length > 0) {
            e.preventDefault();
            j(this).parent().children('i').toggleClass('plus-2icon- minus-2icon-');
            j(this).parent().children('.sub-menu').slideToggle('normal', function() {
                setTimeout(function() {
                    sidemobile.reinitialise();
                }, 200);
            });
        }

    });

    j('#mobile-menu,#mobile-side-menu').find('li').each(function() {
        if (j(this).children('.sub-menu').length > 0) j(this).append('<i class="ioa-front-icon plus-2icon-"></i>');
    });


    j('a.mobile-menu').click(function(e) {
        e.preventDefault();

        if (j('#mobile-menu').length > 0) {
            j('body,html').animate({
                scrollTop: 0
            }, 'normal');
            j('#mobile-menu').slideToggle('normal');
        } else {

            if (j('.mobile-side-wrap').offset().left === 0) {
                j('.mobile-side-wrap').transition({
                    left: -210
                }, 400);
            } else {
                j('.mobile-side-wrap').transition({
                    left: 0
                }, 400);
            }

        }


    });

    j('#mobile-menu li i').click(function(e) {

        if (j(this).parent().children('.sub-menu').length > 0) {
            e.preventDefault();
            j(this).parent().children('.sub-menu').slideToggle('normal');
            j(this).toggleClass('plus-2icon- minus-2icon-');
        }

    });


}
j(main_code);

function ioapreloader(obj, callback) {
    var images = [];
    images = j.makeArray(obj.find('img'));
    var limit = images.length,
        timer, i, index;

    timer = setInterval(function() {

        if (limit <= 0) {

            callback();
            clearInterval(timer);
            return;
        }

        for (i = 0; i < images.length; i++) {
            if (images[i].complete || images[i].readyState == 4) {
                images.splice(i, 1);
                limit--;
            }

        }

    }, 200);

}

/**
 * IE 7 Class checker ~~ Basic Support
 */
function getElementsByClassName(node, classname) {
    var a = [];
    var re = new RegExp('(^| )' + classname + '( |$)');
    var els = node.getElementsByTagName("*");
    for (var i = 0, j = els.length; i < j; i++)
        if (re.test(els[i].className)) a.push(els[i]);
    return a;
}

function validateEmail(email) {
    var re = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    return re.test(email);
}


