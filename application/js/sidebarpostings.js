var SideBarPostings = (function() {

	var SideBarPostings = function(settings) {
		this.settings = settings;
		this.ajax = new Ajax();
	};

	SideBarPostings.prototype = new Component();

	SideBarPostings.prototype.fetch = function() {
		var that = this;

		return this.ajax.get('sidebars/all').then(function(payload) {
			that.data = JSON.parse(payload);

		});
	};

	SideBarPostings.prototype.fetchFavorites = function() {
		var that = this;

		return this.ajax.get('sidebars/favorites').then(function(payload) {
			that.data = JSON.parse(payload);
		});
	};
	SideBarPostings.prototype.fetchMostViewed = function() {
		var that = this;

		return this.ajax.get('sidebars/most_viewed').then(function(payload) {
			that.data = JSON.parse(payload);
		});
	};
	SideBarPostings.prototype.fetchRecents = function() {
		var that = this;

		return this.ajax.get('sidebars/most_recent').then(function(payload) {
			//console.log(payload);
			that.data = JSON.parse(payload);
		});
	};

	SideBarPostings.prototype.search = function(query) {
		var that = this;

		return this.ajax.get('sidebars/search/' + query).then(function(payload) {
			that.data = JSON.parse(payload);
		});
	};

	SideBarPostings.prototype.onRender = function() {
		var postings = $(".sidebar-postings").find(".sidebar-post");
		var that = this;

		// $(postings).each(function(index, element) {
		// 	var id = element.id;
		// 	that.ajax.get('/postings/thumbnail/'+id).done(function(img) {
		// 		$(element).find('.sidebar-thumbnail').html(img);
		// 	});
		// });
	};

	SideBarPostings.prototype.bindEvents = function() {
		this.bindShowDetailsListener();
	};

	SideBarPostings.prototype.bindShowDetailsListener = function() {
		$(this.settings.targetSelector).on('click', '.sidebar-post', function() {
			var postingId = $(this).get(0).id;
			var posting = new Posting({
				templateSelector: '#posting-detail-template',
                targetSelector: '#posting-detail',
                id: postingId
			});

			posting.fetch().done(function() {
				posting.render();
				MainContainerController.show('posting-detail');
			});

			posting.bindEvents();

		});
	};

	return SideBarPostings;

})();