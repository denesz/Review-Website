<?php
session_start();

try {
    $conn = new PDO("mysql:host=mysql;dbname=db", 'root', 'root');
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (Throwable $th) {
    echo json_encode(['status' => 'error', 'message' => 'Database connection failed.']);
    exit;
}

$offset = isset($_GET['offset']) ? (int)$_GET['offset'] : 0;
$limit = 10;

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
GROUP BY posts.id
ORDER BY posts.created DESC
LIMIT :offset, :limit";

$stmt = $conn->prepare($sql);
$stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
$stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
$stmt->execute();

$posts = $stmt->fetchAll(PDO::FETCH_ASSOC);

foreach ($posts as $post) {
    $cutContent = true;
    $totalLikes = $post['Likes__count'];
    include 'elements/load_posts.php';
}
