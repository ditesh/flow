(function($){

	$.fn.isset = function(truefn, falsefn) {

		return this.each(function (index, val) {

			var elem = $(this);
			var val = elem.val();

			if (val.length === 0)
				falsefn(elem);
			else
				truefn(elem);

		});

	};



})(jQuery);
