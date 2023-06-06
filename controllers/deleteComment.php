<?php

require_once('models/base.php');

if (isset($_SESSION['admin_id'])) {
            
    if (isset($_POST['comment_id'])) {
        $commentId = $_POST['comment_id'];

        
        $model = new Base();

        
        $result = $model->deleteComment($commentId);

        if ($result) {
            header("Location: index.php?controller=movieDetails&id=$_POST[movie_id]");
            exit();
        } else {
            echo "Failed to delete comment.";
        }
    } else {
        echo "Comment ID not provided.";
    }
} else {
    echo "Access denied. You must be an admin to delete comments.";
}



   
    
        
        