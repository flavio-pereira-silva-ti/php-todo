<?php
class TODOView {
  
  private $controller;
  
  public function __construct($controller) {
    $this->controller = $controller;
  }
  
  public function output() {
    return $this->{$this->controller->get_view_mode()}();
  }
  
  private function output_new() {
    $title = $this->controller->get_attr('title');
    $titleErr = $this->controller->get_attr('titleErr');
    
    $description = $this->controller->get_attr('description');
    $descriptionErr = $this->controller->get_attr('descriptionErr');
    
    $deadline = $this->controller->get_attr('deadline');
    $deadlineErr = $this->controller->get_attr('deadlineErr');
    
    $html = "
      <div class='row'>
        <div class='col-md-3'>
          <h2>New TODO</h2>
        </div>
        <div class='col-md-6'>
          <div class='h2'>&nbsp;</div>
        </div>
        <div class='col-md-3'>&nbsp;</div>
      </div>
      <hr>
      <div class='row'>
        " . $this->output_messages() . "
        <div class='col-md-12'>
          <form method='POST' action='/index.php'>
            <input type='hidden' id='section' name='section' value='todo'>
            <input type='hidden' id='action' name='action' value='insert_todo'>

            <div class='form-group" . (!empty($titleErr) ? ' has-error' : '') . "'>
              <label for='title'>* Title</label>
              <input type='text' class='form-control' id='title' name='title' maxlength='255' required autofocus value='" . (isset($title) ? $title : '') . "'>
              " . (!empty($titleErr) ? "<span class='help-block'>" . $titleErr . "</span>" : "") . "
            </div>

            <div class='form-group" . (!empty($descriptionErr) ? ' has-error' : '') . "'>
              <label for='description'>* Description</label>
              <textarea class='form-control' id='description' name='description' rows='10' cols='5' maxlength='3000' required>" . (isset($description) ? $description : '') . "</textarea>
              " . (!empty($descriptionErr) ? "<span class='help-block'>" . $descriptionErr . "</span>" : "") . "
            </div>

            <div class='form-group" . (!empty($deadlineErr) ? ' has-error' : '') . "'>
              <label for='deadline'>* Deadline</label>
              <input type='date' class='form-control' id='deadline' name='deadline' required value='" . (isset($deadline) ? $deadline : '') . "'>
              " . (!empty($deadlineErr) ? "<span class='help-block'>" . $deadlineErr . "</span>" : "") . "
            </div>

            <button type='submit' class='btn btn-primary'>Create</button>
            <a href='/index.php?section=todo&action=list_all' class='btn btn-default'>Cancel</a>
          </form>
        </div>
      </div>
    ";
    
    return $html;
  }
  
  private function output_list() {
    $html = "
      <div class='row'>
        <div class='col-md-3'>
          <h2>TODO List</h2>
        </div>
        <div class='col-md-6'>
          <div class='h2'>&nbsp;</div>
        </div>
        <div class='col-md-3'>
          <a href='/index.php?section=todo&action=new_todo' class='btn btn-primary pull-right h2'>New TODO</a>
        </div>
      </div>
      <hr>
    ";
    
    $todos = $this->controller->get_attr('todos');
    $html .= "
      <div class='row'>
      " . $this->output_messages() . "
    ";
    
    if ($todos->isEmpty()) {
      $html .= "
        <div class='col-md-12'>
          <h3><small><i class='glyphicon glyphicon-exclamation-sign'></i> There's no TODO </small></h3>
        </div>
      ";
   
    } else {
      $html .= "
        <div class='col-md-12'>
          <table class='table table-striped table-bordered'>
            <thead>
              <tr>
                <th style='width: 10%;'>#</th>
                <th style='width: 20%;'>Title</th>
                <th style='width: 40%;'>Description</th>
                <th style='width: 15%;'>Deadline</th>
                <th style='width: 15%;'>Actions</th>
              </tr>
            </thead>
            <tbody>
      ";
      
      foreach ($todos as $todo) {
        $deadline = new DateTime($todo->get_deadline());
        $html .= "
          <tr>
            <td>" . $todo->get_id() . "</td>
            <td>" . $todo->get_title() . "</td>
            <td>" . $todo->get_description() . "</td>
            <td>" . $deadline->format('m/d/Y') . "</td>
            <td>
              <a href='/index.php?section=todo&action=edit_todo&id=" . $todo->get_id() . "' class='btn btn-block btn-default'>Edit</a>
              <a href='/index.php?section=todo&action=delete_todo&id=" . $todo->get_id() . "' class='btn btn-block btn-danger'>Delete</a>
            </td>
          </tr>
        ";
      }
      
      $html .= "
            </tbody>
          </table>
        </div>
      ";
    }
    
    $html .= "
      </div>
    ";

    return $html;
  }

  private function output_messages() {
    $html = "";
    $messages = $this->controller->get_attr('messages');
    if (isset($messages)) {
      foreach ($messages as $type => $message) {
        $html .= "
          <div class='col-md-12'>
            <div class='alert alert-" . $type . " alert-dismissible' role='alert'>
              <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
              " . $message . "
            </div>
          </div>
        ";
      }
    } else {
      $html .= "";
    }
    return $html;
  }
}
?>
