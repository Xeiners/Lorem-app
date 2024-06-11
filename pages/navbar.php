<header>
     <div class="navMobile">
        <?php $current_page = basename($_SERVER['PHP_SELF'])?>
        <a href="home.php">
            <div class="btn-container <?php if($current_page == 'home.php') {echo 'active'; } ?>">
                <i class='bx bx-home-alt-2'></i><p>Home</p>
            </div>
        </a>
        <a href="search.php">
            <div class="btn-container <?php if($current_page == 'search.php') {echo 'active'; } ?>">
                <i class='bx bx-search'></i><p>Search</p>
            </div>
        </a>

        <a href="comment_add.php" >
            <div class="btn-container round-add <?php if($current_page == 'adding.php') {echo 'active'; } ?>">
                <i class='bx bxs-plus-circle'></i>
            </div>
        </a>    
        
        <a href="edit_comment.php">
            <div class="btn-container <?php if($current_page == 'edit_comment.php') {echo 'active'; } ?>">
                <i class='bx bx-bell' ></i><p>Edits</p>
            </div>
        </a>
        <a href="user_profile.php">
            <div class="btn-container <?php if($current_page == 'user_profile.php') {echo 'active'; } ?>">
                <i class='bx bx-user' ></i><p>User</p>
            </div>
        </a>
     </div>
 </header>