<?php
/*
Plugin Name: WPJobBoard - DTJ Bank transfer payment
Description: Plugin adds bank transfer payement to WPJB
Author: Nicolas Janel (n.janel@msoi.re)
*/

function wpjb_payment_bank_transfer($list)
{

	global $wpjobboard;

	// it's crucial that you include the class using include_once or
	// require_once since the method might be called more then once
	// which would cause class redeclaration error.
	include_once dirname(__FILE__) . "/BankTransferPayment.php";
	include_once dirname(__FILE__) . "/BankTransferFrontendForm.php";
	include_once dirname(__FILE__) . "/BankTransferAdminForm.php";

	$bankTransfer = new BankTransferPayment;
	// registers new payment method
	$list[$bankTransfer->getEngine()] = get_class($bankTransfer);

	return $list;
}

add_filter('wpjb_payments_list', 'wpjb_payment_bank_transfer');
