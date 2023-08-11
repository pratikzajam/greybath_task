
<nav class="navbar navbar-expand-lg bg-body-tertiary">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">Navbar</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse " id="navbarNavDropdown">
                <ul class="navbar-nav ul-auto">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="profile.php">Home</a>
                    </li>
                    
                    <?php if (isset($_SESSION['logged_in'])) { ?>
                        
                    <li class="nav-item">
                        <a class="nav-link active" href="action/logout.php">Logout</a>
                    </li>
                 <?php }?>                   
                </ul>
            </div>
        </div>
    </nav>