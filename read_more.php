<?php
include 'elements/session_start.php';
include 'elements/navbar.php'?>
<link rel="stylesheet" href="styles/main.css">
<?php
try {
    $conn = new PDO("mysql:host=mysql;dbname=db", 'root', 'root');
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    if (isset($_GET['id'])) {
        $postId = intval($_GET['id']);

        $sql = "SELECT
            posts.id AS Posts__id,
            posts.created AS Posts__created,
            posts.content AS Posts__content,
            users.first_name AS Users__first_name,
            users.last_name AS Users__last_name,
            IF (likes.post_id IS NOT NULL, COUNT(posts.id), 0) AS Likes__count
        FROM posts
        INNER JOIN users ON posts.user_id = users.id
        LEFT JOIN
        likes ON posts.id = likes.post_id
        WHERE posts.id = :id
        GROUP BY posts.id";

        $stmt = $conn->prepare($sql);
        $stmt->execute(['id' => $postId]);
        $post = $stmt->fetch(PDO::FETCH_ASSOC);
        $cutContent = false;
        if ($post) {?>
            <div class="post-container">
                <?php
                    $totalLikes = $post['Likes__count'];
                    include 'elements/load_posts.php';
                ?>
            </div>
        <?php } else {
            echo "Post not found.";
        }
    } else {
        echo "Invalid post ID.";
    }
} catch (Throwable $th) {
    echo "Error: " . $th->getMessage();
}
?>

<script src="/js/like.js"></script>