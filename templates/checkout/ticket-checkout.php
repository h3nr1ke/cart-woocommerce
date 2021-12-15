<?php

/**
 * Part of Woo Mercado Pago Module
 * Author - Mercado Pago
 * Developer
 * Copyright - Copyright(c) MercadoPago [https://www.mercadopago.com]
 * License - https://www.gnu.org/licenses/gpl.html GPL version 2 or higher
 *
 * @package MercadoPago
 */

if ( ! defined('ABSPATH') ) {
	exit;
}
?>

<div class="mp-checkout-ticket-container">
	<div class="mp-checkout-ticket-content">
		<?php if ( true === $test_mode ) : ?>
			<div class="mp-checkout-ticket-test-mode">
				<test-mode
					title="<?php echo esc_html_e('Offline Methods in Test Mode', 'woocommerce-mercadopago'); ?>"
					description="<?php echo esc_html_e('You can test the flow to generate an invoice, but you cannot finalize the payment. ', 'woocommerce-mercadopago'); ?>"
					link-text="<?php echo esc_html_e('See the rules for the test mode.', 'woocommerce-mercadopago'); ?>"
					link-src="<?php echo esc_html($test_mode_link); ?>">
				</test-mode>
			</div>
		<?php endif; ?>
		<?php if ( 'MLU' === $site_id ) : ?>
			<div class="mp-checkout-ticket-input-document">
			<input-document
				documents='[
					{"name":"CI"},
					{"name":"Outro"}]'
				validate=true>
			</input-document>
		</div>
		<?php endif; ?>
		<?php if ( 'MLB' === $site_id ) : ?>
			<div class="mp-checkout-ticket-input-document">
			<input-document
				documents='[
					{"name":"CPF"},
					{"name":"CNPJ"}]'
				validate=true>
			</input-document>
		</div>
		<?php endif; ?>
		<p class="mp-checkout-ticket-text">Select where you want to pay</p>

		<input-table name="payment-options" columns='<?php echo esc_attr(wp_json_encode($payment_methods)); ?>'>
		</input-table>

		<!-- NOT DELETE LOADING-->
		<div id="mp-box-loading"></div>

		<!-- utilities -->
		<div id="mercadopago-utilities">
			<input type="hidden" id="site_id" value="<?php echo esc_textarea( $site_id ); ?>" name="mercadopago_ticket[site_id]" />
			<input type="hidden" id="amountTicket" value="<?php echo esc_textarea( $amount ); ?>" name="mercadopago_ticket[amount]" />
			<input type="hidden" id="currency_ratioTicket" value="<?php echo esc_textarea( $currency_ratio ); ?>" name="mercadopago_ticket[currency_ratio]" />
			<input type="hidden" id="campaign_idTicket" name="mercadopago_ticket[campaign_id]" />
			<input type="hidden" id="campaignTicket" name="mercadopago_ticket[campaign]" />
			<input type="hidden" id="discountTicket" name="mercadopago_ticket[discount]" />
		</div>

	</div>
		<div class="mp-checkout-ticket-terms-and-conditions">
			<terms-and-conditions
				description="<?php echo esc_html_e( 'By continuing, you agree with our', 'woocommerce-mercadopago' ); ?>"
				link-text="<?php echo esc_html_e( 'Terms and Conditions', 'woocommerce-mercadopago' ); ?>"
				link-src="<?php echo esc_html( $link_terms_and_conditions ); ?>">
			</terms-and-conditions>
		</div>
</div>
