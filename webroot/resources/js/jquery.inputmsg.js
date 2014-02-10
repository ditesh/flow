(function($){

	var callbackfn;

	$.fn.inputmsg = function(callbackfn) {

		return this.each(function(index, val) {

			$(this).blur(function() {

				elem = $(this);
				sibling =  elem.next();
				var retval = callbackfn(elem);

				if (retval === null)
					return;

				if (sibling.hasClass("input-status-ok") || sibling.hasClass("input-status-bad"))
					sibling.remove();

				if (retval)
					elem.after($("<span id='last-status' class='input-status-ok'>OK</span>"))
				else
					elem.after($("<span id='last-status' class='input-status-bad'>X</span>"))

				setTimeout(function() {

					$("#last-status").fadeOut("slow");
					$("#last-status").remove();

				}, 5000);

			});
		});

  	};

	$.fn.inputok = function() {

		return this.each(function (index, val) {

			var elem = $(this);

			if (!sibling.hasClass("input-status-bad"))
				sibling.remove();

			else if (sibling.hasClass("input-status-ok")) {

				var id = Math.random()*1000000;
				elem.after($("<span id='last-status-"+id+"' class='input-status-ok'>OK</span>"))

				setTimeout(function() {

						$("#last-status-"+id).fadeOut("slow");
						$("#last-status-"+id).remove();

					}, 5000);

			}

		});

	};

	$.fn.inputerr = function() {

		return this.each(function (index, val) {

			var elem = $(this);
			var sibling =  elem.next();

			if (sibling.hasClass("input-status-ok"))
				sibling.remove();

			else if (!sibling.hasClass("input-status-bad"))
				elem.after($("<span class='input-status-bad'>X</span>"))

			elem.onkeydown(afterinputcheck);
		});

	};

	$.fn.afterinputcheck = function() {

		return this.each(function (index, val) {

			var elem = $(this);
			var sibling =  elem.next();

			if (sibling.hasClass("input-status-bad"))
				sibling.remove();

		});
	};

})(jQuery);
