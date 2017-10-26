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
$(document).ready(function() {
    var postings = new Postings({
        templateSelector: '#main-postings-template',
        targetSelector: '#main-postings'
    });
    var mostrecent = new SideBarPostings({
         templateSelector: '#sidebar-template',
         targetSelector: '#most-recent'
     });
    var mostviewed = new SideBarPostings({
         templateSelector: '#sidebar-template',
         targetSelector: '#most-viewed'
     });
    // var favorites = new SideBarPostings({
    //      templateSelector: '#sidebar-template',
    //      targetSelector: '#favorites'
    //  });

    // var landlord = new Landlords({
    //     templateSelector: '#landlord-homepage-template',
    //     targetSelector:  '#landlord-homepage'
    // });

    // var student = new Students({
    //     templateSelector: '#student-homepage-template',
    //     targetSelector:  '#student-homepage'
    // });

    postings.fetch_all().done(function(payload) {
        postings.render();
    });

    mostrecent.fetchRecents().done(function(payLoad){
        mostrecent.render();
        mostrecent.bindEvents();

    });
    mostviewed.fetchMostViewed().done(function(payLoad){
        mostviewed.render();
        mostviewed.bindEvents();
    });
    // mostviewed.fetchMostViewed().done(function(payLoad){
    //     mostviewed.render();
    // });

    // favorites.fetchFavorites().done(function(payLoad){
    //     favorites.render();
    //     favorites.bindEvents();
    // });

    // landlord.fetch().done(function(payload){
    //     landlord.render();
    // });

    // student.fetch().done(function(payload){
    //     student.render();
    // });

    var modal = new Modal();

    MainContainerController.show('main-postings');


    $('.menu-btn-home').on('click', function() {
        $('.menu-btn-landlord-homepage').removeClass('active');
        $(this).addClass('active');
        MainContainerController.show('main-postings');
    });

    $('.menu-btn-about').on('click', function() {
        $('.menu-btn-landlord-homepage').removeClass('active');
        $(this).addClass('active');
        MainContainerController.show('about-page');
    });

});

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

/*
Copyright (c) 2016 by CodyHouse (http://codepen.io/codyhouse/pen/pIrbg)

Permission is hereby granted, free of charge, to any person obtaining a copy of this software and associated documentation files (the "Software"), to deal in the Software without restriction, including without limitation the rights to use, copy, modify, merge, publish, distribute, sublicense, and/or sell copies of the Software, and to permit persons to whom the Software is furnished to do so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM, OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE SOFTWARE.
*/



var Modal = function() {
	var that = this;
	this.formModal = $('.cd-user-modal');
	this.formLogin = this.formModal.find('#cd-login');
	this.formSignup = this.formModal.find('#cd-signup');
	this.formModalTab = $('.cd-switcher');
	this.tabLogin = $('.cd-switcher').children('li').eq(0).children('a');
	this.tabSignup = $('.cd-switcher').children('li').eq(1).children('a');
	this.mainNav = $('.login-nav');
	this.ajax = new Ajax();

	//open modal
	this.mainNav.on('click', function(event){
		$(event.target).is(that.mainNav) && that.mainNav.children('ul').toggleClass('is-visible');
	});

	//open sign-up form
	this.mainNav.on('click', '.cd-signup', this.signupSelected.bind(this));
	//open login-form form
	this.mainNav.on('click', '.cd-signin', this.loginSelected.bind(this));

	//Sign In form data collection
	this.formLogin.find('.cd-form').on('submit', function(data){
		data.preventDefault();
		var email = document.getElementById('signin-email').value;
 		var password = document.getElementById('signin-password').value;
		
		that.confirmCredentials(email, password);

	});

	//Sign Up form data collection
	this.formSignup.find('.cd-form').on('submit', function(data){
		data.preventDefault();
		var lastName = document.getElementById('signup-lastname').value,
			firstName = document.getElementById('signup-firstname').value,
			emailSignup = document.getElementById('signup-email').value,
			emailSignupConfirm = document.getElementById('signup-email-confirm').value,
			passwordSignup = document.getElementById('signup-password').value,
			passwordSignupConfirm = document.getElementById('signup-password-confirm').value;

		if (emailSignup !== emailSignupConfirm){
			$('.cd-signup-warning-email-mismatch').show();
		}
		else{
			$('.cd-signup-warning-email-mismatch').hide();
		}
		if (passwordSignup !== passwordSignupConfirm){
			$('.cd-signup-warning-password-mismatch').show();
		}
		else{
			$('.cd-signup-warning-password-mismatch').hide();
		}
		if ((emailSignup === emailSignupConfirm) && (passwordSignup === passwordSignupConfirm)){
			
			that.ajax.get("/sessions/check_taken/"+ emailSignup).done(function(payload){
		 		that.data = JSON.parse(payload);

		 		// Check to see if user email is taken:
		 		if (that.data.response === "Approved") {
		 			var user = {
 						email: emailSignup,
 						password: passwordSignup,
 						firstName: firstName,
 						lastName: lastName 
		 			};
		 			that.signUpUser(user);
		 		} else {
		 			$('.cd-signup-warning-email-taken').show();
		 		}
		 	});
		}
	});

	//Logout button
	this.mainNav.on('click', '.cd-logout', function(data){
		var temp = that.ajax.get('/sessions/logout');
		$('.cd-greetings').hide();
	 	$('.cd-logout').hide();
	 	$('.menu-btn-student-homepage').hide();
	 	$('.cd-greetings').text("");
	 	$('.cd-signin').show();
	 	$('.cd-signup').show();
	 	MainContainerController.show('main-postings');

	});

	//close modal
	this.formModal.on('click', function(event){
		if( $(event.target).is(that.formModal) || $(event.target).is('.cd-close-form') ) {
			that.formModal.removeClass('is-visible');
		}
	});

	//close modal when clicking the esc keyboard button
	$(document).keyup(function(event){
    	if(event.which=='27'){
    		that.formModal.removeClass('is-visible');
	    }
    });

	//switch from a tab to another
	this.formModalTab.on('click', function(event) {
		event.preventDefault();
		( $(event.target).is( that.tabLogin ) ) ? that.login_selected() : that.signup_selected();
	});
}
	
Modal.prototype.signUpUser = function(user){
	$('.cd-signup-warning-email-taken').hide();
	
	// TODO: CHANGE FOR $_POST
	var userData = user.password + "," + user.email + 
					"," + user.firstName + "," + user.lastName;
	
	var tempUser = this.ajax.get('/sessions/add_user/'+ userData);
	// console.log(userData);
	var emailDomain = user.email.split('@')[1];

	this.confirmCredentials(user.email, user.password);
	
	this.formModal.removeClass('is-visible');
	document.getElementById("cd-form-signup").reset();
}

Modal.prototype.confirmCredentials = function(email, password){
	var that = this;
	this.ajax.get("/sessions/check_credentials/" + email + "," + password )
		.done(function(payload){
			// console.log(payload);
			that.data = JSON.parse(payload);
			//console.log(that.data);
			
			if (that.data.response === "Approved"){
	 			that.logIn(email);
	 		} else {
	 			document.getElementById("cd-form-login").reset();
	 			$('.cd-login-warning').show();
	 		}

		});
};

Modal.prototype.logIn = function(email){
	var that = this;

	var landlord = new Landlords({
        templateSelector: '#landlord-homepage-template',
        targetSelector:  '#landlord-homepage'
    });

    landlord.fetch().done(function(payload){
        landlord.render();
    });

	that.ajax.get("/sessions/get_first_name/" + email).done(function(payload){
		user_name = JSON.parse(payload)["name"];

		that.formModal.removeClass('is-visible');
		document.getElementById("cd-form-login").reset();
		$('.cd-login-warning').hide();
		$('.cd-signin').hide();
		$('.cd-signup').hide();
		$('.cd-greetings').text("Hello, " + user_name);
		$('.cd-greetings').show();
		$('.cd-logout').show();

		that.ajax.get("/sessions/is_student").done(function(payload) {
			data = JSON.parse(payload);
			if (data.response === "Approved"){
				$('.menu-btn-student-homepage').show();

			    var student = new Students({
			        templateSelector: '#student-homepage-template',
			        targetSelector:  '#student-homepage'
			    });

			    student.fetch().done(function(payload){
			        student.render();
			    });

			}
		});

	});
};

// Modal.prototype.addUserToSession = function(id){
// 	console.log(id);
// 	this.ajax.get("/sessions/add_tenant/"+ "('" + id + "')");
// };

Modal.prototype.loginSelected = function(){
	this.mainNav.children('ul').removeClass('is-visible');
	this.formModal.addClass('is-visible');
	this.formLogin.addClass('is-selected');
	this.formSignup.removeClass('is-selected');
	this.tabLogin.addClass('selected');
	this.tabSignup.removeClass('selected');
};

Modal.prototype.signupSelected = function(){
	this.mainNav.children('ul').removeClass('is-visible');
	this.formModal.addClass('is-visible');
	this.formLogin.removeClass('is-selected');
	this.formSignup.addClass('is-selected');
	this.tabLogin.removeClass('selected');
	this.tabSignup.addClass('selected');
};


//credits http://css-tricks.com/snippets/jquery/move-cursor-to-end-of-textarea-or-input/
jQuery.fn.putCursorAtEnd = function() {
	return this.each(function() {
    	// If this function exists...
    	if (this.setSelectionRange) {
      		// ... then use it (Doesn't work in IE)
      		// Double the length because Opera is inconsistent about whether a carriage return is one character or two. Sigh.
      		var len = $(this).val().length * 2;
      		this.focus();
      		this.setSelectionRange(len, len);
    	} else {
    		// ... otherwise replace the contents with itself
    		// (Doesn't work in Google Chrome)
      		$(this).val($(this).val());
    	}
	});
};
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

var Posting = (function() {

  var DEFAULT_ID = '0';

  var Posting = function(settings) {
    this.settings = settings;
    this.ajax = new Ajax();
  };

  Posting.prototype = new Component();

  //fetches individual posting detail
   Posting.prototype.fetch = function() {
    var that = this;
    var id = this.settings.id;
    var posting = '/postings/get_detail/' + id;

    return this.ajax.get(posting).then(function(payload) {
      that.data = JSON.parse(payload).posting;
    });
  };

  Posting.prototype.onRender = function() {
    this.loadImages();
    MainContainerController.show('posting-detail');
  };


  //carousel buttons
  Posting.prototype.bindGalleryListener = function() {
    var that = this;

    $(this.settings.targetSelector).on('click', '.page-btn', function() {
      var url = $(this).attr('data-page-url');
      that.fetch(url).done(function() {
        that.render();
      });
    });

  };

  Posting.prototype.bindEvents = function() {
    this.bindDetailsResetListener();
    // this.bindFavoriteButton();
    this.bindContactButton();
  };

  //exit to search listings button, will reset main controller view as well
  Posting.prototype.bindDetailsResetListener = function() {
    $(this.settings.targetSelector).on('click', '.posting-detail-reset-button', function(){
      console.log('reset listener binding work')
      MainContainerController.show('main-postings');
    });
  };

  // Posting.prototype.bindFavoriteButton = function() {
  //   var that = this;
  //   $(this.settings.targetSelector).on('click', '.favorite', function() {
  //     var postingId= $(this).get(0).id;
  //     that.ajax.get('/favorites/add/' + postingId).done(function(payload) {
  //       data = JSON.parse(payload);
  //       // console.log(data);
  //       if (data.response === "Approved"){
  //             $('#modal-favorite-added').modal('show');
  //           } else {
  //             console.log("Please log into a student account.");
  //             $('#modal-login-warning').modal('show');
  //           }
  //     });
  //   });
  // };

  Posting.prototype.bindContactButton = function() {
    var that = this;
    $(this.settings.targetSelector).on('click', '.contact', function() {

      var postingId= $(this).get(0).id;
      that.ajax.get('/sessions/is_student/').done(function(payload) {
        data = JSON.parse(payload);
        if (data.response === "Approved"){
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

  Posting.prototype.loadImages = function() {
    var that = this;

    $('.posting-detail-image').each(function(i, e) {
      var postingDetailImage = $(this);
      var postingId = postingDetailImage.data('postingId') || '';
      that.ajax.get('/postingimages/get', { id: postingId }).done(function(img) {
        $(postingDetailImage).html(img);
      });
    });
  };

  return Posting;
})();

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



$(document).ready(function(){
	var dropped = false;
    $("#dropdownbutton").click(function(){
        $("#myDropdown").slideToggle("fast");
        dropped = !dropped;
    });
    $("#dropdownbuttonback").click(function(){
    	$("#myDropdown").slideToggle("fast");
    	dropped = !dropped;
    });
    $(document).click(function(){
    	if (dropped === true){
    		$("#myDropdown").slideToggle("fast");
    		dropped = false;
    	}
    });
    $("#myDropdown").click(function(e){
  		e.stopPropagation(); 
	});
	$("#dropdownbutton").click(function(e){
  		e.stopPropagation(); 
	});
	
	$('#search-form').submit(function(event){
		event.preventDefault(); //prevents search from refreshing
		var searchstring = $('#search-query').val(); //grabs contents from search bar
		var priceMin = $("input[name='price_min']").val();
		var priceMax = $("input[name='price_max']").val();
		var numBeds = $("input[name='num_beds']").val();
		var numBaths = $("input[name='num_baths']").val();
		var numTenants = $("input[name='num_tenants']").val();
		var orderFilter = $("select[name='order_filter']").val();
		var searchQuery = [];
		var finalQuery = "";
		var metadataString = "";

		this.ajax = new Ajax();

		var postings = new Postings({
			templateSelector: '#main-postings-template',
        	targetSelector: '#main-postings'
		});	

		if (searchstring>0)
		{
			metadataString = searchstring;
		}
		else
		{
			if($.type(searchstring) === 'string')
			{
				if(searchstring !== ''){
					metadataString = searchstring.replace(/\s+/g, '_');
				}
			}
			else
				alert("NOT VALID INPUT");
		}


		if (priceMin === "" && priceMax !== "")
		{
			priceMin = 0;
		}
		if (priceMax === "" & priceMin !== "")
		{
			priceMax = 9999;
		}
		if (priceMax !== "" && priceMin !== ""){
			searchQuery.push("price BETWEEN '" + priceMin + "' AND '" + priceMax + "'");
		}

		if (numBeds !== "")
		{
			searchQuery.push("numBed = " + numBeds);
		}

		if (numBaths !== "")
		{
			searchQuery.push("numBath = " + numBaths);
		}

		if (numTenants !== "")
		{
			searchQuery.push("numTenants = " + numTenants);
		}


		if (searchQuery.length === 0 && orderFilter === "" && metadataString === ""){
			postings.fetch_all().done(function(payload) {
				if($.type(searchstring.val()) === 'string') {
					var newsearchstring = searchstring.val().replace(/\s+/g, '_');
					postings.search(newsearchstring).done(function(payload){
						postings.render();
					});
				}
				else
					alert("NOT VALID INPUT");
				postings.render();
			});
		}
		else {

			if (searchQuery.length === 0){
				searchQuery.push("price > 0");
			}

			finalQuery += searchQuery[0];
			for (var i = 1; i < searchQuery.length; i++){
				finalQuery += " AND " + searchQuery[i];
			}

			if (metadataString === ""){
				metadataString = "_";
			}
			var newSearchString = finalQuery.replace(/\s+/g, '_');
			var sqlPassArray = [newSearchString, metadataString, orderFilter];
			postings.search(sqlPassArray).done(function(payload){
				postings.renderPage("1");
			});
		}
		MainContainerController.show('main-postings');
	});
});


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