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
