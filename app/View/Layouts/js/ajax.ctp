function page_load_callback() {

  $.ajaxSetup({
        cache: true // We want our client to cache stuff, and override this in PHP.
  });

  $.ajax({
        cache: false, // Force this to not cache via jQuery
        beforeSend: function() {
            $('body').prepend('<div id="flash_message_popup"></div>');
        },
        url: flash_message_popup_link, // global variable set in default.ctp
        success: function(data) {
            $('#flash_message_popup').html(data);
            if ($('#flash_message_popup').is(':empty')) {
                $('#flash_message_popup').remove();
            } else {
                create_popup('flash_message_popup');
            }
        },
        error: function(a, b, c) {
            $('#flash_message_popup').remove();
        }
    });
}

function create_popup(tag) {
    if (editing_hall == true) {
        return false;
    }
    var selector = '#' + tag;
    $(selector).attr('style', 'position: absolute; display: none; top: 5; left: 5; z-index: 100;');
    $(selector).slideDown('slow');
}