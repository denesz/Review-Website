<div class="post">
    <p class="post-user"><?= $post['Users__first_name'] . ' ' . $post['Users__last_name']?></p>
    <p class="post-content">
        <?php
            if (mb_strlen($post['Posts__content'], "UTF-8") > 1050 && $cutContent) {
                $trunchiat = mb_substr($post['Posts__content'], 0, 1050, "UTF-8");
                echo $trunchiat . '...';
                ?>
                <?php
            } else {
                echo $post['Posts__content'];
            }
            ?>
    </p>
    <?php
    if (mb_strlen($post['Posts__content'], "UTF-8") > 1050 && $cutContent) {?>
    <a href="/read_more.php?id=<?=$post['Posts__id']?>" class="read-more">Read more</a>

    <?php
    }
    ?>
    <div class="post-footer">

        <?php if (isset($_SESSION['auth']['id'])) {?>
            <button data-post_id="<?=$post['Posts__id']?>" class="like-button" >LIKE</button>
        <?php }?>

        <span class="likes-count"><?=$totalLikes?> likes</span>
    </div>
</div>