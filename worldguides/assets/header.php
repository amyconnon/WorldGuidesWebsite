<?php
session_start();

if(isset($_SESSION["login"])) {
  $logedin = 1;
} else {
  $logedin = 0;
}

  if ($logedin === 0) {

  
    echo ' <nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" >World Guides</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
  
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav mr-auto">

        <li class="nav-item active">
          <a class="nav-link" href="index.php">Home <span class="sr-only">(current)</span></a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="sites.php">Sites</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="createlist.php">Create list</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="signup.php">Sign up</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="login.php">Log in</a>
        </li>

      </ul>';
    } else if ($logedin === 1){
      echo ' <nav class="navbar navbar-expand-lg navbar-light bg-light">
      <a class="navbar-brand" >World Guides</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
    
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
  
          <li class="nav-item active">
            <a class="nav-link" href="index.php">Home <span class="sr-only">(current)</span></a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="sites.php">Sites</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="createlist.php">Create list</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="list.php">List</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="logout.php">Log out</a>
          </li>
  
        </ul>';
    }

    ?>

   

          <form class="form-inline my-2 my-lg-0" method='POST' action='searchresult.php'>
            <input class="form-control mr-sm-2" type="search" placeholder="Search" name ="postedsearch" aria-label="Search">
            <button class="btn btn-outline-info my-2 my-sm-0" type="submit" id="searchbutton">Search</button>
          </form>
        </div>
      </nav>
<!--End of navbar using bootstrap-->


