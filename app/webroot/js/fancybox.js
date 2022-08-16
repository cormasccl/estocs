
j = jQuery.noConflict();
j(document).ready(function() {
    
	j('.various').fancybox({
		fitToView	: true,
		width		: '850px',
		/*height		: '60%',*/
		autoSize	: true,
		closeClick	: true,
		openEffect	: 'none',
		closeEffect	: 'none',
		closeBtn    : true,
        iframe : {
          preload : false
        }
	});
    j('.distribution').fancybox({
        fitToView   : true,
        width       : '950px',
        /*height        : '60%',*/
        autoSize    : true,
        closeClick  : true,
        openEffect  : 'none',
        closeEffect : 'none',
        closeBtn    : true,
        iframe : {
          preload : false
        }
    });

	j(".fancybox-thumb").fancybox({
        afterLoad: function () {
            var aux = this.title;
            var res = aux.replace("\\n", "<br>");

            this.title = '<center>' + res + '</center>';
        },
        helpers: {
            title: {
                type: 'inside',
                position: 'bottom'
            },
            overlay: {
                showEarly: true,
                speedIn: 200,
                speedOut: 200
            },
            thumbs: {
                width: 50,
                height: 50
            }
        }
    });

});

