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