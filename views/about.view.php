<?php
class AboutView {
  
  private $controller;
  
  public function __construct($controller) {
    $this->controller = $controller;
  }
  
  public function output() {
    return "
      <h2>Lorem ipsum</h2>
      <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec bibendum mauris tincidunt, commodo ligula vel, tincidunt lorem. Sed facilisis, orci eget lacinia finibus, nulla felis aliquet felis, et dapibus leo eros sed turpis. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Pellentesque scelerisque interdum auctor. Sed neque elit, fermentum eget quam et, dictum elementum orci. Etiam gravida est risus, dictum vestibulum massa laoreet in. Mauris viverra, lorem eu blandit bibendum, tellus dolor scelerisque sapien, eget sodales lacus urna in massa. In vehicula sed odio eu tempor. Suspendisse potenti.</p>

      <p>Morbi sed hendrerit est. Quisque in ipsum nunc. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Proin ultricies orci finibus lorem imperdiet, in tincidunt urna eleifend. Phasellus pretium elementum magna eu semper. Ut finibus eget dui eget dapibus. Sed et dapibus dui, id ullamcorper nunc.</p>

      <p>Curabitur id ipsum sed magna lacinia porta nec ut est. Quisque at ipsum est. Sed vel purus vitae tortor volutpat dictum eget non nibh. Mauris pulvinar, ligula id congue hendrerit, augue urna dignissim lacus, nec posuere justo magna scelerisque leo. Proin varius, nibh in lacinia porttitor, justo nisl ultrices mi, sed gravida libero urna at quam. Duis vel sapien sed nisl ullamcorper scelerisque. Sed tempor in ligula eget cursus.</p>

      <p>Duis convallis, purus id mattis hendrerit, nulla metus luctus lectus, in lobortis sem erat ac justo. Donec pharetra eget purus vel interdum. Sed nec convallis enim, eget laoreet eros. Donec blandit dapibus leo, vel gravida nulla sollicitudin id. Aliquam vitae risus vitae sem lobortis scelerisque. Suspendisse nec placerat mauris, sed pellentesque augue. Nulla facilisi. Proin mollis porta justo, nec tincidunt magna semper sed. Suspendisse mollis luctus nisi sit amet interdum.</p>

      <p>Suspendisse eu tristique metus. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Sed sagittis nisl vitae luctus mollis. Nam quis luctus nibh. Nam sed dolor neque. Curabitur gravida luctus augue, eget fermentum arcu pulvinar eget. Etiam ac nisl eget arcu placerat eleifend. Vestibulum eu mauris a leo vehicula gravida et ac felis. In hac habitasse platea dictumst. In tortor dui, commodo sit amet odio a, tempus sollicitudin arcu. Mauris in nibh semper, tincidunt nulla non, vulputate sem. Donec tincidunt sem vitae mi placerat mattis. Aliquam erat volutpat.</p>
    ";
  }
}
?>