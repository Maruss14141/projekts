<?php


require_once('model.php');
$model = new Model;

if (isset($_POST['add'])) {

    $name = htmlspecialchars($_POST['name']);
    $comment = htmlspecialchars($_POST['comment']);

    if(!mb_strlen($name) && !mb_strlen($comment)) {
        header('location:/?error=blank');
        exit();
    }

    $errors = $model->validate($name, $comment);

    if (!count($errors)) {

       $model->storeComment($name, $comment);


       header:
       header('location:/');
       exit();
    }
}

$page = 1;
const COMMENTS_COUNT = 10;

if(isset($_GET['page'])) {
    $page = intval($_GET['page']) ? $_GET['page'] : header('location:/?page=1');
}
$comments = $model->getComments($page, COMMENTS_COUNT);

$commentsCount = $model->getCommentsCount();

require_once('view.php');
?>