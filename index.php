<?php include 'elements/session_start.php';?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
</head>
<body>
<?php include 'elements/navbar.php'; ?>

<?php if (isset($_SESSION['auth']['id'])) {?>
    
    <a href="/create_post.php" class="button" style="position: relative; top: 30px">Create a post</a>
    
    <?php }?>

<?php 
try {
    $conn = new PDO("mysql:host=mysql;dbname=db", 'root', 'root');
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (Throwable $th) {
    header("Location: /index.php");
}
$sql = "SELECT 
    posts.id AS Posts__id, 
    posts.created AS Posts__created, 
    posts.content AS Posts__content, 
    users.first_name AS Users__first_name, 
    users.last_name AS Users__last_name,
    IF (likes.post_id IS NOT NULL, COUNT(posts.id), 0) AS Likes__count
FROM posts 
INNER JOIN 
users ON posts.user_id = users.id
LEFT JOIN
likes ON posts.id = likes.post_id
GROUP BY posts.id
ORDER BY posts.created DESC LIMIT 10";
$stmt = $conn->prepare($sql);
$stmt->execute();
$posts = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<?php if (!empty($posts)): ?>
    <div class="post-container">
        <?php 
        $cutContent = true;
        foreach ($posts as $post) {
            $totalLikes = $post['Likes__count'];
            include 'elements/load_posts.php';        
        } ?>
    </div>
    <?php else: ?>
        <p>No posts avalabile.</p>
    <?php endif; ?>
    <a href="#" id="bottomOfPage" data-next_offset="10" style=""></a>

</body>
<script src="/js/like.js"></script>
<script>
    let loadMorePostsElem = document.querySelector("#bottomOfPage")

    const loadMorePosts = async function() {
        const url = `http://localhost:8000/more_posts.php?offset=${loadMorePostsElem.dataset.next_offset}`; 
        try {
            const response = await fetch(url);
            if (!response.ok) throw new Error(`Response status: ${response.status}`);
            
            const data = await response.text();

            // if (data.status === 'success') {
            const postContainer = document.querySelector('.post-container');
            postContainer.innerHTML = postContainer.innerHTML + data;
            loadMorePostsElem.dataset.next_offset = parseInt(loadMorePostsElem.dataset.next_offset) + 10;
            // } else if (data.status === 'no_more_posts') {
            //     observer.disconnect(); 
            // }
        } catch (error) {
            console.error('AJAX error:', error.message);
        }
    };

    const options = {
        root: null,
        treshold: 0,
        rootMargin: "200px"
    };

    const callback = (entries, observer) => {
        entries.forEach((entry) => {
            if (entry.isIntersecting) {
                loadMorePosts()
            }
        });
    };


    const observer = new IntersectionObserver(callback, options);
    observer.observe(loadMorePostsElem)
</script>

</html>