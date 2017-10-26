var Postings = (function(Posting, MainContainerController) {


	var Postings = function(settings) {
		this.settings = settings;
		this.bindEvents();
		this.ajax = new Ajax();
		this.pages = {};
	};

	Postings.prototype = new Component();

	Postings.prototype.renderPage = function(pageNum){
		this.data = this.pages[pageNum];
		this.render();
	};

	Postings.prototype.fetchPage = function (pageurl) {
		var that = this;
		return this.ajax.get(pageurl).then(function(payload){
			that.data = JSON.parse(payload);
		});
	};

	//fetches all postings
	Postings.prototype.fetch_all = function() {
		var that = this;
		return this.ajax.get('postings/all').then(function(payload) {
			that.data = JSON.parse(payload);
		});
	};

	//only searches string queries and assumes that query already has column id's written ie: query = 'id = 1'
	Postings.prototype.search = function(query) {
		var that = this;
		return this.ajax.get('postings/search_limit/' + query).then(function(payload) {
			that.pages = JSON.parse(payload);
		});
	};
	
	Postings.prototype.getZip = function(query) {
		var that = this;
		return this.ajax.get('postings/search/zip = ' + query).then(function(payload) {
			that.data = JSON.parse(payload);
		});
	};

	Postings.prototype.onRender = function() {
		var postings = $('.main-postings').find('.posting');
		var that = this;
		$(postings).each(function(index, element) {
			var id = element.id;
			that.ajax.get('/postings/thumbnail/'+id).done(function(img) {
				$(element).find('.posting-thumbnail').html(img);
			});
		});
	};

	Postings.prototype.bindEvents = function() {
		this.bindPageListener();
		this.bindShowDetailsListener();
		// this.bindFavoriteListener();
		this.bindContactListener();
	};

	Postings.prototype.bindPageListener = function() {
		var that = this;
		$(this.settings.targetSelector).on('click', '.page-btn', function() {
			var url = $(this).attr('data-page-url');
			that.renderPage(url);

		});

	};

	Postings.prototype.bindShowDetailsListener = function() {
		//creates dust template

		// $(this.settings.targetSelector).on('click', '.posting', function() {
		// 	var postingId = $(this).get(0).id;
		// 	var posting = new Posting({
		// 		templateSelector: '#posting-detail-template',
  //       		targetSelector: '#posting-detail',
  //       		id: postingId
		// 	});
		// 	//JSON fetches correctly, but doesn't render properly
		// 	posting.fetch().done(function(payload) {
		// 		//console.log("POSTING: ", posting.id);
		// 		posting.render();	
		// 		MainContainerController.show('posting-detail');
		// 	});
		// 	posting.bindEvents();
		// });






		$(this.settings.targetSelector).on('click', '.details', function() {

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

	// Postings.prototype.bindFavoriteListener = function() {
	// 	var that = this;
	// 	$(this.settings.targetSelector).on('click', '.favorite', function() {
	// 		var postingId= $(this).get(0).id;
	// 		that.ajax.get('/favorites/add/' + postingId).done(function(payload) {
	// 	 		data = JSON.parse(payload);
	// 	 		// console.log(data);
	// 	 		if (data.response === "Approved"){
 //      				$('#modal-favorite-added').modal('show');
 //      			} else {
	// 	        	console.log("Please log into a student account.");
	// 	        	$('#modal-login-warning').modal('show');
	// 	        }
	// 	 	});
	// 	});
	// };

	Postings.prototype.bindContactListener = function() {
		var that = this;
		$(this.settings.targetSelector).on('click', '.contact', function() {

			var postingId= $(this).get(0).id;
			that.ajax.get('/sessions/is_student/').done(function(payload) {
		 		data = JSON.parse(payload);
		 		// console.log(data);
		 		if (data.response === "Approved"){
        			console.log("contacted landlord.");
        			var modal = $('#modal-contact');
        			modal.modal('show');
        			modal.on('submit', function(data){
						data.preventDefault();
						var subject = document.getElementById('subject').value;
						subject = subject.replace(/\s+/g, '_');
			 			var body = document.getElementById('body').value;
			 			body = body.replace(/\s+/g, '_');
			 			modal.modal('hide');
			 			var info = postingId + ",-," + subject + ",-," + body;
			 			document.getElementById("form-contact").reset();

			 			if (subject !== "" && body !== ""){
	        				that.ajax.get('messages/send_message_landlord/' + info);
	        			}
					});
      			}
      			else {
		        	$('#modal-login-warning').modal('show');
		        }
		 	});
		});
	};

	return Postings;
})(Posting, MainContainerController);
