<!-- card comment -->
    <div class="card-comment" data-aos="fade-up" data-aos-duration="500">
        <div class="sizingbox">
        </div>
        <a href="user_view.php?id=<?php echo $select_user_id; ?>" class="card-comment-picture-link">
            <div class="card-comment-picture">
                <img src="\assets\images\profil-pictures\<?php echo $picture;?>" alt="Profile Picture">
            </div>
        </a>
        <div class="card-content-text-container">
            <div class="card-comment-title">
                <h3><?php echo $comment['username'];?></h3>
                <p>
                <?php
                    $date = new DateTime($comment['message_date']);
                    $date = $date->format('l d F Y \a\t H:i'); 
                    echo $date;
                ?>
                </p>
            </div>
            <span class="line_sep comment"></span>
            <div class="card-comment-text">
                <p><?php echo $comment['comment'];?></p>
            </div>
            
            <?php if($select_user_id === $_SESSION['LOGGED_USER']['id']) : ?>
                <div class="edit_button">
                    <a href="comment_to_edit.php?id=<?php echo $comment['id']; ?>""><button class="edit">Edit <i class='bx bxs-edit'></i></button></a>
                    <a href="post/post_comment_delete.php?id=<?php echo $comment['id']; ?>"><button class="delete">Delete <i class='bx bx-trash-alt' ></i></button></a>
                </div>
            <?php endif; ?>  
        </div>
    </div>
<!-- card comment -->
