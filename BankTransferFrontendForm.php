<?php

class BankTransferFrontendForm  extends Daq_Form_Abstract
{
    public function init()
    {
        $this->addGroup("default");

        $e = $this->create("info", "label");
        $e->setDescription(__("Bank transfer info notice", "wpjobboard"));
        $e->addClass('wpjb-flash-info banktransfer-info-notice mt-0 ml-0 d-block');
        $this->addElement($e, "default");

        $e = $this->create("fullname");
        $e->setLabel(__("Full Name", "wpjobboard"));
        $e->setRequired(true);
        $this->addElement($e, "default");

        $e = $this->create("email");
        $e->setLabel(__("Email", "wpjobboard"));
        $e->setRequired(true);
        $this->addElement($e, "default");

        apply_filters("wpjb_form_init_payment_default", $this);
    }
}
