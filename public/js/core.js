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

	Ajax.prototype.post = function(url, data) {
		var settings = {
			url: this.context + url,
			type: 'POST',
			data: data
		};

		return $.ajax($.extend({}, settings, this.settings));
	};

	return Ajax;
})(APP);
var Component = (function() {

	var defaultSettings = {
		templateSelector: '',
		targetSelector: ''
	};

	var Component = function(settings) {
		this.settings = $.extend({}, defaultSettings, settings);
		this.data = {};
	};

	Component.prototype.render = function() {
		var that = this;
		var src = $(this.settings.templateSelector).text();

		dust.renderSource(src, this.data, function(err, out) {
			$(that.settings.targetSelector).html(out);
			that.onRender();
		});
	};

	Component.prototype.onRender = function() {};

	Component.prototype.clear = function() {
		$(this.settings.targetSelector).html('');
	};

	return Component;
})();