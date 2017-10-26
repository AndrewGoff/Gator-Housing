<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Gator Real Estate</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap -->
    <link href="C:\Users\Andrew\Desktop\New folder (2)\public\css\bootstrap.min.css" rel="stylesheet">
    <link href="C:\Users\Andrew\Desktop\New folder (2)\public\css\bootstrap-theme.min.css" rel="stylesheet">
    <!-- CSS -->
    <link href="C:\Users\Andrew\Desktop\New folder (2)\public\cssmain.css" rel="stylesheet">
    <?php include_once(APP . "libs/analyticstracking.php"); ?>
  </head>
  <body>
    <nav class="navbar navbar-inverse navbar-fixed-top">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
          <span class="sr-only">Toggle navigation</span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand active menu-btn-home" href="#">Gator Real Estate</a>
        </div>
        <!-- Navbar collapse toggles content on the page -->
        <div id="navbar" class="collapse navbar-collapse login-nav">
          <ul class="nav navbar-nav navbar-left">
            <li class="menu-btn-about navbar-menu-btn" data-toggle="collapse" data-target="#navbar"><a>About</a></li>
          </ul>

          <!--List of links in the navbar -->
          <ul class="nav navbar-nav navbar-right">
            <li><a class="cd-signin">Log in</a></li>
            <li><a class="cd-signup">Sign up</a></li>
            <li><a class="cd-greetings dropdown-toggle" data-toggle="dropdown" data-target=".dropdowntester" style="display:none"></a></li>
            <li><a class="cd-logout" style="display:none">Log out</a></li>
            <div class="dropdowntester">
              <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                <li class="menu-btn-home-homepage navbar-menu-btn" data-toggle="collapse" data-target="#navbar"><a>Home</a></li>
                <li class="menu-btn-landlord-homepage navbar-menu-btn" data-toggle="collapse" data-target="#navbar"><a>Landlord</a></li>
                <li class="menu-btn-student-homepage navbar-menu-btn" data-toggle="collapse" data-target="#navbar" style="display:none"><a>Student</a></li>
              </div>
            </div>
          </ul>
          
          <form id="search-form" class="navbar-form navbar-nav" role="search">
            <div class="form-group">
              <div class="dropdown">
                <div align="left" id="myDropdown" class="dropdown-content">
                  <div id="dropdownbuttonback" class="btn btn-danger">Back</div>
                  <div class="input-group">
                    <span class="input-group-addon">Minimum Price</span>
                    <input type="text" name="price_min" class="form-control" placeholder="0">
                  </div>
                  <div class="input-group">
                    <span class="input-group-addon">Maximum Price</span>
                    <input type="text" name="price_max" class="form-control" placeholder="1000">
                  </div>
                  <div class="input-group">
                    <span class="input-group-addon">Number of Beds</span>
                    <input type="text" name="num_beds" class="form-control" placeholder="2">
                  </div>
                  <div class="input-group">
                    <span class="input-group-addon">Number of Baths</span>
                    <input type="text" name="num_baths" class="form-control" placeholder="1">
                  </div>
                  <div class="input-group">
                    <span class="input-group-addon">Number of Tenants</span>
                    <input type="text" name="num_tenants" class="form-control" placeholder="2">
                  </div>
                  <br>
                  <div class="form-group">
                    <label for="order_filter">Order By:</label><br>
                      <select class="form-control" id="order_filter" name="order_filter">
                        <option value="">------------------------------------</option>
                        <option value="price">Lowest Price</option>
                        <option value="price_DESC">Highest Price</option>
                        <option value="date_DESC">Most Recent</option>
                        <option value="numViews_DESC">Most Viewed</option>
                      </select>
                  </div>
                </div>
              </div>
              <div id="dropdownbutton" class="btn btn-success">Filters</div>
              <input id="search-query" type="text" class="form-control" placeholder="City or ZIP Code">
            </div>
            <button type="submit" class="btn btn-default">Search</button>
          </form>
        </div><!--/.nav-collapse -->
      </div>
    </nav>