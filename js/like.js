document.addEventListener('click', function(event) {
    if(event.target.matches('.like-button')) {
        const postId = event.target.dataset.post_id
        addLike(postId, event.target);
    }
});

const addLike = async function(postId, likeButton) {
    const url = "http://localhost:8000/services/like_post.php"; 
    try {
        const response = await fetch(url, {
            method: 'POST', 
            body: JSON.stringify({ postId: postId })
        });

        if (!response.ok) {
            throw new Error(`Response status: ${response.status}`);
        }

        const data = await response.json();

        if (data.status == 'success') {
            const likesCountElement = likeButton.nextElementSibling;  
            likesCountElement.textContent = data.nr_likes + ' likes';
        } else {
            console.error('Error updating the like.');
        }

    } catch (error) {
        console.error('AJAX error:', error.message);
    }
}