
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