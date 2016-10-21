<?php
class TODOModel {
  
  public function __construct() {
    
  }
  
  public function insert_todo($todo) {
    $conn = get_conn();
    
    $stmt = $conn->prepare("INSERT INTO TODO (title, description, deadline, created, user_id) VALUES (?,?,?,?,?)");

    $deadlineStr = date_format($todo->get_deadline(), 'Y-m-d h:i:s');
    $createdStr = date_format(date_create(), 'Y-m-d h:i:s');
    
    $stmt->bind_param('ssssi', $a = $todo->get_title(), $b = $todo->get_description(), $deadlineStr, $createdStr, $id = 1);
    
    $stmt->execute();
    
    $stmt->close();
    $conn->close();
  }
  
  public function list_with_limit_and_offset($limit = -1, $offset = -1) {
    $todos = new SplQueue();
    
    $conn = get_conn();
    
    // TODO: Use logged user id
    $sql = "SELECT * FROM TODO WHERE user_id = 1 and is_done = (0) ORDER BY deadline, title";
    $results = $conn->query($sql);
    if ($results->num_rows > 0) {
      while ($row = $results->fetch_assoc()) {
        $todo = new TODO();
        $todo->set_id($row['id']);
        $todo->set_title($row['title']);
        $todo->set_description($row['description']);
        $todo->set_deadline($row['deadline']);
        $todo->set_is_done($row['is_done']);
        $todo->set_created($row['created']);
        $todo->set_user_id($row['user_id']);
        $todos->push($todo);
      }
    }
    $conn->close();
    
    return $todos;
  }
}

class TODO {
  
  private $id;
  private $title;
  private $description;
  private $deadline;
  private $isDone;
  private $created;
  private $userId;
  
  public function __construct() {
    
  }
  
  public function get_id() {
    return $this->id;
  }
  
  public function set_id($id) {
    $this->id = $id;
  }
  
  public function get_title() {
    return $this->title;
  }
  
  public function set_title($title) {
    $this->title = $title;
  }
  
  public function get_description() {
    return $this->description;
  }
  
  public function set_description($description) {
    $this->description = $description;
  }
  
  public function get_deadline() {
    return $this->deadline;
  }
  
  public function set_deadline($deadline) {
    $this->deadline = $deadline;
  }
  
  public function get_is_done() {
    return $this->isDone;
  }
  
  public function set_is_done($isDone) {
    $this->isDone = $isDone;
  }
  
  public function get_created() {
    return $this->created;
  }
  
  public function set_created($created) {
    $this->created = $created;
  }
  
  public function get_user_id() {
    return $this->userId;
  }
  
  public function set_user_id($userId) {
    $this->userId = $userId;
  }
}
?>
