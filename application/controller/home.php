<?php

/**
 * Class Home
 *
 * Please note:
 * Don't use the same name for class and method, as this might trigger an (unintended) __construct of the class.
 * This is really weird behaviour, but documented here: http://php.net/manual/en/language.oop5.decon.php
 *
 */
class Home extends Controller
{
    /**
     * PAGE: index
     * This method handles what happens when you move to http://yourproject/home/index (which is the default page btw)
     */
    public function index()
    {
        // load views
        require APP . 'view/_templates/header.php';
        require APP . 'view/home/index.php';
        require APP . 'view/modal/login.php';
        require APP . 'view/landlord/add-posting-modal.php';
        require APP . 'view/landlord/edit-page-posting-modal.php';
        require APP . 'view/_templates/dust/sidebar.php';
        require APP . 'view/_templates/dust/main-postings.php';
        require APP . 'view/_templates/dust/posting-detail.php';
        require APP . 'view/_templates/dust/landlord-homepage.php';
        require APP . 'view/_templates/dust/edit-posting-modal.php';
        //require APP . 'view/about-page/about-page.php';
        require APP . 'view/_templates/footer.php';
        require APP . 'view/modal/favorite_contact_warning.php';
        require APP . 'view/_templates/dust/student-homepage.php';
    }

}
