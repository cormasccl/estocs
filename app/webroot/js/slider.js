jQuery(function() {
 j = jQuery.noConflict();
  j.silverTrackRecipes("basic", function(factory) {
    factory.createTrack(function(element, options) {
      return element.silverTrack({
        easing: "easeInOutQuad",
        duration: 600
      });
    });

    factory.installPlugins(function(track, options) {
      var parent = track.container.parents(".track");

      track.install(new SilverTrack.Plugins.Navigator({
        prev: j("a.prev", parent),
        next: j("a.next", parent)
      }));

      track.install(new SilverTrack.Plugins.BulletNavigator({
        container: j(".bullet-pagination", parent)
      }));

      track.install(new SilverTrack.Plugins.ResponsiveHubConnector({
        layouts: ["phone", "small-tablet", "tablet", "web"],
        onReady: function(track, options, event) {
          options.onChange(track, options, event);
        },

        onChange: function(track, options, event) {
          track.options.mode = "horizontal";
          track.options.autoheight = false;
          track.options.perPage = 4;

          if (event.layout === "small-tablet") {
            track.options.perPage = 3;

          } else if (event.layout === "phone") {
            track.options.mode = "vertical";
            track.options.autoHeight = true;
          }

          track.restart({keepCurrentPage: true});
        }
      }));
    });
  });

});


jQuery(function() {
j = jQuery.noConflict();
  j(".track.slider1 .slider-container").each(function() {
    j.silverTrackRecipes.create("basic", j(this)).start();
  });


j = jQuery.noConflict();
var track = j(".slider-container").silverTrack();

track.install(new SilverTrack.Plugins.Navigator({
  prev: j("a.prev", parent),
  next: j("a.next", parent)
}));

track.start();
});
