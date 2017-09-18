// the semi-colon before function invocation is a safety net against concatenated
// scripts and/or other plugins which may not be closed properly.

;(function ( $, window, document, undefined ) {

    // undefined is used here as the undefined global variable in ECMAScript 3 is
    // mutable (ie. it can be changed by someone else). undefined isn't really being
    // passed in so we can ensure the value of it is truly undefined. In ES5, undefined
    // can no longer be modified.

    // window and document are passed through as local variable rather than global
    // as this (slightly) quickens the resolution process and can be more efficiently
    // minified (especially when both are regularly referenced in your plugin).
    
    // Create the defaults once
    var pluginName = "textSlider",
        defaults = {
            intervalTime: 9000,
            duration:4,
            definedHeight: false
        };

    // The actual plugin constructor
    function Plugin ( element, options ) {
        this.element = element;
        // jQuery has an extend method which merges the contents of two or
        // more objects, storing the result in the first object. The first object
        // is generally empty as we don't want to alter the default options for
        // future instances of the plugin
        this.settings = $.extend( {}, defaults, options );
        this._defaults = defaults;
        this._name = pluginName;
        this.timeId = null;
        this.resizeThrottle = null;
        this.$container = $(this.element).find(".text-slideshow:first");
        this.$slides = this.$container.children();
  
        this.$nextButton = $(this.element).find(".next:first");        
        this.$prevButton = $(this.element).find(".prev:first");

        this.init();
    }

    Plugin.prototype = {
        
        
        init: function () {

            // Place initialization logic here
            // You already have access to the DOM element and
            // the options via the instance, e.g. this.element
            // and this.settings
            // you can add more functions like the one below and
            // call them like so: this.yourOtherFunction(this.element, this.settings).
            this.$slides.not(':first').not('.dummy-slide').hide();

            if(this.$slides.length > 1) {
                this.start();

                this.$nextButton.on('click', {plugin:this}, this.pressForward);
                this.$prevButton.on('click', {plugin:this}, this.pressBackwards);
            }

            // if autoHeight is a number then we don't need to recalculate the sentinel
            // index on resize
           
            // bind unique resize handler per slideshow (so it can be 'off-ed' in onDestroy)
            this.settings._autoHeightOnResize = function () {
                clearTimeout( this.resizeThrottle );
                this.resizeThrottle = setTimeout( this.initAutoHeight, 50 );
            };

            $(window).on( 'resize orientationchange', this.settings._autoHeightOnResize );
           
            var that = this;

            function onResize() {
                that.initAutoHeight();
            }

            setTimeout( onResize, 30 );
        },        

        initAutoHeight: function() {
            var clone, sentinelIndex;
      
            //var autoHeight = this.settings.autoHeight;

            

            sentinelIndex = this.calcDummyIndex();
        
            // only recreate sentinel if index is different
            if ( sentinelIndex == this.settings._sentinelIndex )
                return;

            this.settings._sentinelIndex = sentinelIndex;
            if ( this.settings._sentinel )
                this.settings._sentinel.remove();

            // clone existing slide as sentinel
            clone = $(this.$slides[ sentinelIndex ]).clone();

            // #50; remove special attributes from cloned content
            clone.removeAttr( 'id name rel' ).find( '[id],[name],[rel]' ).removeAttr( 'id name rel' );

            clone.css({
                position: 'static',
                visibility: 'hidden',
                display: 'block'
            }).prependTo( this.$container ).addClass('.dummy-slide');
            clone.find( '*' ).css( 'visibility', 'hidden' );

            if(this.settings.definedHeight !== false) {
                this.settings.definedHeight = parseInt(this.settings.definedHeight);
                if($.type( this.settings.definedHeight ) == 'number') {
                    clone.height(this.settings.definedHeight);
                    
                }
            } 

            this.settings._sentinel = clone;     
        },

        calcDummyIndex: function () {
            var index = 0, max = -1;

            // calculate tallest slide index
            this.$slides.each(function(i) {
                var h = $(this).height();
                if ( h > max ) {
                    max = h;
                    index = i;
                }
            });
            return index;
        },

        start: function () {

            clearTimeout(this.timeId);
            var that = this;
            this.timeId = setInterval(function() {
                that.moveForward()},
              this.settings.intervalTime);
           
        },
        
        moveForward: function() {
        

            this.$container.children()
            .filter(':first').next()
            .fadeOut(this.settings.duration)
            .next()
            .fadeIn(this.settings.duration)
            .end().
            appendTo(this.$container);
         
        },

        moveBackwards: function() {

            this.$container.children()
            .filter(':first').next()
            .fadeOut(this.settings.duration);

            this.$container.children()
            .filter(':last')
            .fadeIn(this.settings.duration)
            .insertAfter(this.$container.children().filter(':first')); 
            
        },

        pressForward : function(event) {
         
            clearTimeout(event.data.plugin.timeId);

            event.data.plugin.moveForward();

            event.data.plugin.timeId = setInterval(function() {
                event.data.plugin.moveForward();

            }, event.data.plugin.settings.intervalTime);

            event.preventDefault();


        },

        pressBackwards : function(event) {

            clearTimeout(event.data.plugin.timeId);

            event.data.plugin.moveBackwards();
            
            event.data.plugin.timeId = setInterval(function() {
                event.data.plugin.moveForward();

            }, event.data.plugin.settings.intervalTime);  

            event.preventDefault();
        },

        stop : function(){
            clearTimeout(this.timeId);
        }
    };

    // A really lightweight plugin wrapper around the constructor,
    // preventing against multiple instantiations


    $.fn[ pluginName ] = function ( options ) {

        this.each(function() {
            if ( !$.data( this, "plugin_" + pluginName ) ) {

                $.data( this, "plugin_" + pluginName, new Plugin( this, options ) );
            }
        });

        // chain jQuery functions
        return this;
    };

})( jQuery, window, document );