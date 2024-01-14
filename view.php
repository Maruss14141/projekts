<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="description" content="test_uzd">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="styles/style.css">
</head>
<body>
<div class="container">
    <form action="" id="response" method="post" class="comment-form">
        <div class="input-group">
            <label for="input-name">Name</label>
            <input type="text" name="name" placeholder="Your name..." id="input-name" value="<?php if (isset($errors)) echo htmlspecialchars($_POST['name']) ?>">
        </div>
        <div class="input-group"><strong><?php if (isset($errors) && isset($errors['name'])) echo $errors['name']; ?></strong></div>
        <div class="input-group">
            <label for="textarea-comment">Comment</label>
            <textarea name="comment" id="textarea-comment" placeholder="Add your comment..." cols="30" rows="5"><?php if (isset($errors)) echo htmlspecialchars($_POST['comment']); ?></textarea>
        </div>
        <div class="input-group"><strong><?php if (isset($errors) && isset($errors['comment'])) { echo $errors['comment']; } if(!isset($errors) && isset($_GET['error'])) { if($_GET['error'] == 'blank') echo 'Form cannot be blank';} ?></strong></div>
        <div class="input-group">
            <button submit value="Add" id="input-submit" name="add">Add comment</button>
        </div>
    </form>

    <table class="content">
        <tr>
            <th>Name</th>
            <th>Comment</th>
        </tr>


        <?php
        if(count($comments)) {
            foreach ($comments as $comment) {
        ?>
        <tr>
            <th><?php echo $comment['name'];?></th>
            <th><?php echo nl2br($comment['comment'])?></th>
        </tr>
        <?php
            }
        }
                   ?>
    </table>
    <form method="get" action="/" class="pagination-panel">
        <div class="panel-content">
            <?php
            if($commentsCount) {
                $pageCount = intval($commentsCount / 10);
                if($commentsCount % 10) $pageCount++;

                for($i = 1; $i <= $pageCount; $i++) {
                    ?>
                    <button id="page_btn_<?php echo $i?>" value="<?php echo $i ?>" name="page"><?php echo $i ?></button>
                    <?php
                }
            }
            ?>
        </div>
    </form>
    <?php if($commentsCount > 10) {
        if(isset($_GET['page'])) {
            $page = $_GET['page'];
        } else {
            $page = 1;
        }
        ?>
        <script>
           let pageBtn = document.querySelector("#page_btn_" + <?php echo $page ?>)
           pageBtn.classList.add("active")
        </script>
    <?php
    }
    ?>
</body>
</html>
