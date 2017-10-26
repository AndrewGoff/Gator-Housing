var Students = (function() {

	var images = [];

	var Students = function(settings) {
		this.settings = settings;
		this.bindEvents();
		this.ajax = new Ajax();
	};

	Students.prototype = new Component();

	Students.prototype.fetch = function() {
		var that = this;

		return this.ajax.get('students/all').done(function(payload) {
			that.data = JSON.parse(payload);
		});
	};

	Students.prototype.bindEvents = function() {
		this.bindReplyListener();
		this.bindMenuButtonListener();
	};

	Students.prototype.onRender = function() {
		var postings = $('.student-homepage').find('.student-posting');
		var that = this;

		$(postings).each(function(index, element) {
			var id = element.id;
			that.ajax.get('/students/thumbnail/'+id).done(function(img) {
				$(element).find('.thumbnail').html(img);
			});
		});
	};

	Students.prototype.bindMenuButtonListener = function() {
		$('.menu-btn-student-homepage').on('click', function() {
			$('.menu-btn-home').removeClass('active');
			$(this).addClass('active');
			MainContainerController.show('student-homepage');
		});
	};


	Students.prototype.bindReplyListener = function() {
		var that = this;
		$(this.settings.targetSelector).on('click', '.reply-button', function() {
			var idInfo= $(this).get(0).id;

			var modal = $('#modal-contact');
			modal.modal('show');
			modal.on('submit', function(data){
				data.preventDefault();
				var subject = document.getElementById('subject').value;
				subject = subject.replace(/\s+/g, '_');
	 			var body = document.getElementById('body').value;
	 			body = body.replace(/\s+/g, '_');
	 			modal.modal('hide');
	 			var info = idInfo + ",-," + subject + ",-," + body;
	 			document.getElementById("form-contact").reset();

 				if (subject !== "" && body !== ""){
			  		that.ajax.get('messages/send_message/' + info);
				}
			})
		});
	};

	return Students;
})();