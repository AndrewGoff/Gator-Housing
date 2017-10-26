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
