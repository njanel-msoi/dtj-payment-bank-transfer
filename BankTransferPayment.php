<?php

/**
 * Payment class
 * 
 * This is the only class you will need to add new payment method to the
 * job board.
 * 
 * It's important for the class to implement Wpjb_Payment_Interface,
 * otherwise it won't be registered.
 * 
 * If you are creating more advanced integration than payment by cash
 * please look into file wpjobboard/application/libraries/Payment/PayPal.php
 * which contains full PayPal IPN integration.
 * 
 */
class BankTransferPayment extends Wpjb_Payment_Abstract
{
	static $TRANSFER_EXTRA_PERCENTAGE_PRICE = "15";

	/**
	 *
	 * @var $_data Wpjb_Model_Payment
	 */
	protected $_data = null;

	public function __construct(Wpjb_Model_Payment $data = null)
	{

		$html = "The total payment amount is <strong>{payment_amount}</strong><br/> \r\n";
		$html .= "Please make transfer to 00000000000.<br/> \r\n";
		$html .= "In bank transfer title enter <strong>{payment_id}</strong>";

		$this->_default = array("message" => $html);
		$this->_data = $data;
	}

	public function getObject()
	{
		return $this->_data;
	}

	/**
	 * Returns engine identifier
	 * 
	 * @return string
	 */
	public function getEngine()
	{
		return "BankTransfer";
	}

	/**
	 * Returns title describing payment method
	 * 
	 * @return string
	 */
	public function getTitle()
	{
		return "Paiement par virement (+" . BankTransferPayment::$TRANSFER_EXTRA_PERCENTAGE_PRICE . "%)";
	}

	/**
	 * Returns class name of a form that holds configuration
	 * @since 4.0.5
	 * @return string
	 */
	public function getForm()
	{
		return "BankTransferAdminForm";
	}

	public function getIconFrontend()
	{
		return "wpjb-icon-money";
	}

	/**
	 * Procesess transaction (for online payments only)
	 *
	 * @param array $data Post data returned from payment processor
	 * @throws Exception If transaction is invalid
	 * @return void
	 */
	public function processTransaction()
	{
	}

	/**
	 * Returns payment button or how to pay instructions
	 * 
	 * @return string
	 */
	public function render()
	{

		$data = $this->_data;
		/* @var $data Wpjb_Model_Payment */

		$find = array("{payment_amount}", "{payment_id}");
		$repl = array(wpjb_price($data->payment_sum, $data->payment_currency), $data->id);

		// add message set in config in the final message
		$html = str_replace($find, $repl, $this->conf("message"));

		// TODO: set popup + button to redirect to job list ?

		return $html;
	}

	/**
	 * Returns default frontend form class for payment
	 * 
	 * Default frontend form is being used in a cart when user selects
	 * a payment gateway.
	 * 
	 * @since 4.3.5
	 * @return string Default paymeny form class
	 */
	public function getFormFrontend()
	{
		return "BankTransferFrontendForm";
	}
}
