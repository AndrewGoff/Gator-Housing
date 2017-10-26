var MainContainerController = (function() {

	var MainContainerController = function() {};

	MainContainerController.show = function(panelName) {
		var panels = getPanelsFromContainer();
		$(panels).each(function() {
			var isPanelToShow = $(this).get(0).id === panelName;
			$(this).toggleClass('hidden', !isPanelToShow);
		});
	};

	var getPanelsFromContainer = function() {
		return $('.main-container').find('.app-panel');
	};

	return MainContainerController;

})();