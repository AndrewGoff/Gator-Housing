var Ajax = (function(APP){
	var Ajax = function(settings) {
		this.context = APP.url
		this.settings = settings;
	};

	Ajax.prototype.get = function(url, data) {
		var settings = {
			url: this.context + url,
			type: 'GET',
			data: data
		};

		return $.ajax($.extend({}, settings, this.settings));
	};

	return Ajax;
})(APP);