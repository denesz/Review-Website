<?php
include '../elements/session_start.php';

$response = [
    'status' => 'success',
    'message' => 'Like added to post',
];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        $conn = new PDO("mysql:host=mysql;dbname=db", 'root', 'root');
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $input = json_decode(file_get_contents('php://input'), true);

        $postId = intval($input['postId']);
        $userId = $_SESSION['auth']['id'];

        if (empty($postId) || empty($userId)) {
            throw new Exception("Invalid post ID or user ID");
        }

        try {
            $stmt = $conn->prepare("INSERT INTO likes (user_id, post_id, liked_at) VALUES (:userId, :postId, NOW())");
            $stmt->bindParam(':userId', $userId, PDO::PARAM_INT);
            $stmt->bindParam(':postId', $postId, PDO::PARAM_INT);
            $stmt->execute();
        } catch (\Throwable $th) {
            //delete like
            //DELETE FROM likes WHERE user_id = :user_id AND post_id = :post_id;
        }


        $countStmt = $conn->prepare("SELECT COUNT(*) AS total_likes FROM likes WHERE post_id = :postId");
        $countStmt->bindParam(':postId', $postId, PDO::PARAM_INT);
        $countStmt->execute();
        $totalLikes = $countStmt->fetch(PDO::FETCH_ASSOC)['total_likes'];

        $response = [
            'status' => 'success',
            'message' => 'Like added successfully',
            'nr_likes' => $totalLikes
        ];

    } catch (Exception $e) {
        $response = [
            'status' => 'error',
            'message' => $e->getMessage()
        ];
    }
}

echo json_encode($response);
?>
