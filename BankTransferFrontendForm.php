<?php

class BankTransferFrontendForm  extends Daq_Form_Abstract
{
    public function init()
    {
        // this code is taken from the Stripe plugin
        $amount = getPaymentAmountFromPaymentFormDefault();
        $notice = "Pour valider un achat par virement, veuillez effectuer un règlement de <b>$amount €</b> sur le compte bancaire qui vous sera transmis à la page de confirmation.<br>
        <br>N'oubliez pas de valider la commande avec le bouton ci-dessous";

        $this->addGroup("notice");

        $e = $this->create("info", "label");
        $e->setDescription($notice);
        $e->addClass('banktransfer-info-notice pt-25 mt-0 ml-0 d-block color-brand-2');
        $this->addElement($e, "notice");

        $this->addGroup("default");

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
