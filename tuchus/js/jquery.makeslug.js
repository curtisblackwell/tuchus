!(function ($) {
  jQuery.fn.makeSlug = function (options, i) {
    if (this.length > 1) {
      var a = new Array();
      this.each(
        function (i) {
          a.push($(this).makeSlug(options, i));
        });
      return a;
    }
    var opts = $.extend({}, $().makeSlug.defaults, options);
    
    /* PUBLIC FUNCTIONS */
    
    this.destroy = function (reInit) {
      var container = this;
      var reInit = (reInit != undefined) ? reInit : false;
      $(container).removeData('makeSlug'); // this removes the flag so we can re-initialize
    };
    
    this.update = function (options) {
      opts = null;
      opts = $.extend({}, $().makeSlug.defaults, options);
      this.destroy(true);
      return this.init();
    };
    
    this.init = function (iteration) {
      if ($(container).data('makeSlug') == true)
        return this; // this stops double initialization
      
      // call a function before you do anything
      if (opts.beforeCreateFunction != null && $.isFunction(opts.beforeCreateFunction))
        opts.beforeCreateFunction(targetSection, opts);
        
      var container = this; // reference to the object you're manipulating. To jquery it, use $(container). 
      
      $(container).keyup(function(){
        if(opts.slug !== null) opts.slug.val(makeSlug($(this).val()));
      });
      
      $(container).data('makeSlug', true);
      
      // call a function after you've initialized your plugin
      if (opts.afterCreateFunction != null && $.isFunction(opts.afterCreateFunction))
        opts.afterCreateFunction(targetSection, opts);
      return this;
    };
    
    /* PRIVATE FUNCTIONS */
    
    function makeSlug(str) { 
      str = str.replace(/^\s+|\s+$/g, ''); // trim
      str = str.toLowerCase();
      
      // remove accents, swap ñ for n, etc
      var from = "àáäâèéëêìíïîòóöôùúüûñç·/_,:;";
      var to   = "aaaaeeeeiiiioooouuuunc------";
      for (var i=0, l=from.length ; i<l ; i++) {
        str = str.replace(new RegExp(from.charAt(i), 'g'), to.charAt(i));
      }
      
      str = str.replace(/[^a-z0-9 -]/g, '') // remove invalid chars
      .replace(/\s+/g, '-') // collapse whitespace and replace by -
      .replace(/-+/g, '-'); // collapse dashes
      
      return str;
    };
    
    // Finally
    return this.init(i);
  };

  // DONT FORGET TO NAME YOUR DEFAULTS WITH THE SAME NAME
  jQuery.fn.makeSlug.defaults = {
    slug: null
  };
})(jQuery);