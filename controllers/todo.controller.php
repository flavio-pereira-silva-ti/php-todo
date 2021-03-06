<?php
class TODOController {
  
  private $attrs;
  private $model;
  
  public function __construct($model) {
    $this->attrs = array();
    $this->model = $model;
  }
  
  public function get_attr($name) {
    if (array_key_exists($name, $this->attrs)) {
      return $this->attrs[$name];
    }
  }
  
  public function get_view_mode() {
    return $this->attrs['viewMode'];
  }
  
  public function list_all() {
    $todos = $this->model->list_with_limit_and_offset();
    $this->attrs['todos'] = $todos;
    $this->set_view_mode('output_list');
  }
  
  public function new_todo() {
    $this->set_view_mode('output_new');
  }
  
  public function insert_todo() {
    $title = $description = $deadline = '';
    $titleErr = $descriptionErr = $deadlineErr = '';
    
    $todo = new TODO();
    
    if (isset($_POST['title']) && $_POST['title'] == true) {
      $title = $this->sanitize_string_input($_POST['title']);
      if (empty($title)) {
        $titleErr = 'Title is invalid.';
      } else {
        $todo->set_title($title);
      }
    } else {
      $titleErr = 'Title is required.';
    }
    
    if (isset($_POST['description']) && $_POST['description'] == true) {
      $description = $this->sanitize_string_input($_POST['description']);
      if (empty($description)) {
        $descriptionErr = 'Description is invalid.';
      } else {
        $todo->set_description($description);
      }
    } else {
      $descriptionErr = 'Description is required.';
    }
    
    if (isset($_POST['deadline']) && $_POST['deadline'] == true) {
      $deadline = $_POST['deadline'];
      if (strtotime($deadline) <= strtotime('yesterday')) {
        $deadlineErr = 'Deadline cannot be before today.';
      } else {
        $todo->set_deadline(new DateTime($deadline));
      }
    } else {
      $deadlineErr = 'Deadline is required.';
    }
    
    if ($titleErr === '' && $descriptionErr === '' && $deadlineErr === '') {
      $this->model->insert_todo($todo);
      $this->attrs['messages'] = array('success' => 'TODO successfully created!');
      $this->list_all(); // Go to the list view
    } else {
      $this->attrs['title'] = $title;
      $this->attrs['titleErr'] = $titleErr;
      $this->attrs['description'] = $description;
      $this->attrs['descriptionErr'] = $descriptionErr;
      $this->attrs['deadline'] = $deadline;
      $this->attrs['deadlineErr'] = $deadlineErr;
      $this->attrs['messages'] = array('warning' => 'Some fields are invalid!');
      $this->new_todo(); // Go back to the new view
    }
  }
  
  public function edit_todo() {
    
  }
  
  public function update_todo() {
    
  }
  
  public function delete_todo($id) {
    try {
      $this->model->delete_todo($id);
    } catch (Exception $e) {
      $this->attrs['messages'] = array('warning' => 'There was an error: ' . $e->getMessage);
      $this->list_all(); // Go to the list view
      return;
    }
    $this->attrs['messages'] = array('success' => 'TODO successfully deleted!');
    $this->list_all(); // Go to the list view
  }
  
  private function set_view_mode($viewMode) {
    $this->attrs['viewMode'] = $viewMode;
  }
  
  private function sanitize_string_input($str) {
    $str = trim($str);
    $str = stripslashes($str);
    $str = htmlspecialchars($str);
    return $str;
  }
}
?>
