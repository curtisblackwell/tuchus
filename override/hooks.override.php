<?php
class Hooks_override extends Hooks {

  function control_panel__add_to_head() {
    return $this->css->link('tuchus.css');
  }

}
