<?php
class ContactView {
  
  private $controller;
  
  public function __construct($controller) {
    $this->controller = $controller;
  }
  
  public function output() {
    return "
      <address>
        <strong>Roleplay, LTDA</strong><br>
        Rua 246 Qd-85 Lt-06 Ap-305<br>
        Setor Leste Universit<?php echo htmlentities('á'); ?>rio, Goi<?php echo htmlentities('â'); ?>nia, GO 74603-230<br>
        <abbr title='Phone'>P:</abbr> +55 (62) 9 8575-6063
      </address>
      <address>
        <strong>Fl" . htmlentities('á') . "vio Pereira da Silva</strong><br>
        <a href='mailto:flavio.p.silva.ti@icloud.com'>flavio.p.silva.ti@icloud.com</a>
      </address>
    ";
  }
}
?>