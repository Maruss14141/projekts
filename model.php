<?php
class Model {

	private $linkDb = null;

	public function __construct()
	{
	   require 'config.php';
	   
	   $this->linkDb = new \PDO('mysql:host=' . $dbHost . ';dbname=' . $dbName, $dbUser, $dbPassword);
	}

	public function getComments($page, $countPerPage) {

		$count = $this->getCommentsCount();

		$offset = $countPerPage - 1;
		$limit = ($page - 1) * $offset;


		$query = "select * from comments ORDER BY id DESC LIMIT $limit, $offset";
		$pstmt = $this->linkDb->prepare($query);
		$pstmt->execute();
		return $pstmt->fetchAll();   
    }

	public function getCommentsCount() {

		$query = "select count(id) as count from comments";
		$pstmt = $this->linkDb->prepare($query);
		$pstmt->execute();
		return $pstmt->fetchAll()[0]['count'];
	}

	public function storeComment($name, $comment) {
		$query = "insert into comments(name, comment) values(:name, :comment)";
		$pstmt = $this->linkDb->prepare($query);
		$pstmt->bindParam(':name', $name, \PDO::PARAM_STR);
		$pstmt->bindParam(':comment', $comment, \PDO::PARAM_STR);
		$pstmt->execute();   
	 }

	 public function validate($name, $comment) {
		$errors = [];
 
		if ($name == '') {
		   $errors['name'] = 'Field Name must be filled!';
		}
 
		if ($comment == '') {
		   $errors['comment'] = 'Field Сomment must be filled!';
		}	
		
		return $errors;
	 }

}

?>
