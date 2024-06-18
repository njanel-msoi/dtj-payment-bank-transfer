<?php

class BankTransferAdminForm extends Wpjb_Form_Abstract_Payment
{
    public function init()
    {
        parent::init();

        // TODO: add +XX% to amount to transfer

        $this->addGroup("bankTransferMessage", __("Bank transfer", "wpjobboard"));

        $e = $this->create("message", "textarea");
        $e->setValue($this->conf("message"));
        $e->setLabel(__("Message", "wpjobboard"));
        $this->addElement($e, "bankTransferMessage");
    }
}
