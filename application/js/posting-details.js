var PostingDetails = (function(){
	var PostingDetails = function(settings) {
		this.settings = settings;
		this.bindEvents();
		this.ajax = new Ajax();
	};
	PostingDetails.prototype = new Component();

	PostingDetails.bindEvents = function() {
		this.bindFavoritePageListener();
		this.bindShowPostingsListener();
	}
	PostingDetails.prototype.bindFavoritePageListener = function() {
		$(this.settings.targetSelector).on('click', '.posting-detail-reset-button', function(){
			console.log('event fired');
			MainContainerController.show('main-postings');
		});
	}
	PostingDetails.prototype.bindShowPostingsListener = function() {
		$(this.settings.targetSelector).on('click', '.posting-detail-reset-button', function(){
			console.log('event fired');
			MainContainerController.show('main-postings');
		});
	}
})();
