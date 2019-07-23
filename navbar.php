
  <header>
      <!-- Fixed navbar -->
      <nav class="navbar navbar-expand-md navbar-dark fixed-top bg-header">
        <a class="navbar-brand" href="#"><img src="img/logo.png" id="logo"> Helping Hands</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarCollapse">
          <ul class="navbar-nav mr-auto">
           <li class="nav-item active">
              <a class="nav-link" href="index.php">Home</a>
            </li>
           
          </ul>
          <form class="form-inline mt-2 mt-md-0">
		  <?php if(!isset($_SESSION["user_type"])) { ?>
				<a href="#loginModal" data-toggle="modal" data-target="#loginModal"><span class="fa fa-sign-in" aria-hidden="true"></span>&nbsp;&nbsp;SIGN IN</a>
		  <?php }else if($_SESSION["user_type"] == 'user') { ?>
            <span class="welcome-text">Welcome <?php echo $_SESSION["name"]; ?></span>
            <a href="login.php?value=logout"><span class="fa fa-sign-out" aria-hidden="true"></span>&nbsp;&nbsp;Sign Out</a>
		  <?php } ?>
          </form>
        </div>
      </nav>
    </header>

