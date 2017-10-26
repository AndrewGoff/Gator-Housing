var Landlords = (function() {

	var images = [];

	var Landlords = function(settings) {
		this.settings = settings;
		this.bindEvents();
		this.ajax = new Ajax();
	};

	Landlords.prototype = new Component();

	Landlords.prototype.fetch = function() {
		var that = this;

		return this.ajax.get('landlords/all').done(function(payload) {
			that.data = JSON.parse(payload);
		});
	};

	Landlords.prototype.onRender = function() {
		var postings = $('.landlord-homepage').find('.landlord-posting');
		var that = this;

		$(postings).each(function(index, element) {
			var id = element.id;
			that.ajax.get('/landlords/thumbnail/'+id).done(function(img) {
				$(element).find('.thumbnail').html(img);
			});
		});
	};

	Landlords.prototype.bindEvents = function() {
		this.bindEditListener();
		this.bindRemoveListener();
		this.bindMenuButtonListener();
		this.bindNewPageListener();
		this.bindAddPostingListener();
		this.bindSelectFileListener();
		this.bindUploadFileListener();
		this.bindAddFileListener();
		this.bindAddPostingFinishListener();
		this.bindReplyListener();
		this.bindUpdatePostingListener();
		this.bindHomeButtonListener();
	};

	Landlords.prototype.bindNewPageListener = function() {
		$(this.settings.targetSelector).on('click', '.add-new-posting', function(){
			console.log("You clicked the create a new post button.");
		});
	};

	Landlords.prototype.bindEditListener = function() {
		$(this.settings.targetSelector).on('click', '.edit-posting-button', function(e) {
			//e.stopPropagation();
			var postingID = $(this).get(0).id;
			var posting = new Posting({
				templateSelector: '#edit-posting-modal-template',
    			targetSelector: '.edit-posting-modal-form-data',
    			id: postingID
			});
			$("#edit-page-posting-modal").modal();
			posting.onRender = function() {};

			posting.fetch().done(function() {
				posting.render();
			});
		});

	};

	Landlords.prototype.bindUpdatePostingListener = function() {
		var that = this;
		var data = {};
		this.formModal = $('#edit-page-posting-modal');
		//this.updateButton = this.formModal.find('#update-posting');
		//console.log("UPDATE");
		//console.log(this.updateButton);
		// document.getElementById('#update-posting').onclick = function(){
		// 	console.log("CLICKED");
		// };
		$(this.formModal).on('click', '#update-posting', function(e) {
			e.stopPropagation(); 
			console.log("UPDATE");
			var form = $('#edit-page-posting-modal').find('#form-data');
			$(form).find('input').each(function(i, el) {
				var key = $(this).attr('name');
				var value = $(this).val();
				data[key] = value;
			});
			//console.log(data);
			that.ajax.get('/postings/edit/' + data.id, data).done(function(payload) {
				var postingId = JSON.parse(payload).postingID;
				$('#postingId').val(postingId);
				$('#posting-input-field-container').toggleClass('hidden', true);
				$('#posting-upload-file-container').toggleClass('hidden', false);
				
			});;
		});
	};

	Landlords.prototype.bindRemoveListener = function() {
		$(this.settings.targetSelector).on('click', '.remove-posting-button', function() {
			posting.bindEvents();
		});
	};

	Landlords.prototype.bindMenuButtonListener = function() {
		$('.menu-btn-landlord-homepage').on('click', function() {
			$('.menu-btn-home').removeClass('active');
			$(this).addClass('active');
			MainContainerController.show('landlord-homepage');
		});
	};

	Landlords.prototype.bindHomeButtonListener = function() {
		$('.menu-btn-home-homepage').on('click', function() {
			$('.menu-btn-home').removeClass('active');
			$(this).addClass('active');
			MainContainerController.show('main-postings');
		});
	};

	Landlords.prototype.bindAddPostingListener = function() {
		var that = this;
		var data = {};
		$('#add-posting').on('click', function(e) {
			e.stopPropagation(); 
			var form = $('#add-posting-modal').find('#form-data');
			$(form).find('input').each(function(i, el) {
				var key = $(this).attr('name');
				var value = $(this).val();
				data[key] = value;
			});
			that.ajax.post('/postings/add', data).done(function(payload) {
				console.log(payload);
				var postingId = JSON.parse(payload).postingID;
				$('#postingId').val(postingId);
				$('#posting-input-field-container').toggleClass('hidden', true);
				$('#posting-upload-file-container').toggleClass('hidden', false);
				
			});;
		});
	};

	Landlords.prototype.bindSelectFileListener = function() {
		$('#posting-upload-file').change(function() {
			var file = $(this).get(0).files[0];
			$('#posting-upload-file-name').html(file.name);
		});
	};

	Landlords.prototype.bindAddFileListener = function() {
		$('#posting-choose-file').click(function() {
			var file = $('#posting-upload-file').get(0).files[0];
			var ext = /^.+\.([^.]+)$/.exec(file.name);
			var fileExtension = ext == null ? "" : ext[1];
			if (fileExtension === 'png' || fileExtension === 'jpg' || fileExtension === 'jpeg') {
				images.push(file)
				console.log(file);
				$('#posting-upload-file-list').append('<li class="list-group-item">'+ file.name +'</li>');
			}
		});
	};

	Landlords.prototype.bindUploadFileListener = function() {
		$('#posting-upload-file-form').submit(function() {
			var data = new FormData();
			images.forEach(function(image, index) {
				data.append('images[]',image, image.name)
			});
			data.append('postingID', $(this).find('#postingId').val());
			//console.log(data);
			var settings = {
				cache: false,
		    	contentType: false,
		    	processData: false
		  	};

			new Ajax(settings).post('postingimages/add', data);
		});
	};

	Landlords.prototype.bindAddPostingFinishListener = function() {
		$('.add-posting-finish').click(function() {
			images = [];
			$('#postingId').val('');
			$('#posting-input-field-container').toggleClass('hidden', false);
			$('#posting-upload-file-container').toggleClass('hidden', true);
		});
	};

	Landlords.prototype.bindReplyListener = function() {
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

	return Landlords;
})();