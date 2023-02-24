<?php

namespace MercadoPago\Woocommerce\Gateways;

use MercadoPago\Woocommerce\Transactions\TicketTransaction;

if (!defined('ABSPATH')) {
    exit;
}

class TicketGateway extends AbstractGateway
{
    /**
     * ID
     *
     * @const
     */
    const ID = 'woo-mercado-pago-ticket';

    /**
     * @const
     */
    public const CHECKOUT_NAME = 'checkout-ticket';

    /**
     * TicketGateway constructor
     */
    public function __construct()
    {
        parent::__construct();
        $this->adminTranslations = $this->mercadopago->adminTranslations->ticketGatewaySettings;
        $this->storeTranslations = $this->mercadopago->storeTranslations->ticketCheckout;

        $this->id                 = self::ID;
        $this->icon               = $this->getCheckoutIcon();
        $this->title              = $this->adminTranslations['gateway_title'];
        $this->description        = $this->adminTranslations['gateway_description'];
        $this->method_title       = $this->adminTranslations['method_title'];
        $this->method_description = $this->description;

        $this->init_form_fields();
        $this->init_settings();
        $this->payment_scripts($this->id);

        $this->mercadopago->gateway->registerUpdateOptions($this);
        $this->mercadopago->endpoints->registerApiEndpoint($this->id, [$this, 'webhook']);

        $this->mercadopago->gateway->registerThankYouPage($this->id, [$this, 'loadThankYouPage']);
    }

    /**
     * Get Mercado Pago Icon
     *
     * @return mixed
     */
    private function getCheckoutIcon()
    {
        $siteId = strtoupper($this->mercadopago->seller->getSiteId());
        $iconName = 'MLB' === $siteId ? 'icon-ticket-mlb' : 'icon-ticket';
        return $this->mercadopago->plugin->getGatewayIcon($iconName);
    }

    /**
     * Init form fields for checkout configuration
     *
     * @return void
     */
    public function init_form_fields(): void
    {
        $this->form_fields = [
            'config_header' => [
                'type'         => 'mp_config_title',
                'title'        => $this->adminTranslations['header_title'],
                'description'  => $this->adminTranslations['header_description'],
            ],
            'enabled' => [
                'type'         => 'mp_toggle_switch',
                'title'        => $this->adminTranslations['enabled_title'],
                'subtitle'     => $this->adminTranslations['enabled_subtitle'],
                'default'      => 'no',
                'descriptions' => [
                    'enabled'  => $this->adminTranslations['enabled_enabled'],
                    'disabled' => $this->adminTranslations['enabled_disabled'],
                ],
            ],
            'title' => [
                'type'         => 'text',
                'title'        => $this->adminTranslations['title_title'],
                'description'  => $this->adminTranslations['title_description'],
                'default'      => $this->adminTranslations['title_default'],
                'desc_tip'     => $this->adminTranslations['title_desc_tip'],
                'class'        => 'limit-title-max-length',
            ],
            'currency_conversion' => [
                'type'         => 'mp_toggle_switch',
                'title'        => $this->adminTranslations['currency_conversion_title'],
                'subtitle'     => $this->adminTranslations['currency_conversion_subtitle'],
                'default'      => 'no',
                'descriptions' => [
                    'enabled'  => $this->adminTranslations['currency_conversion_enabled'],
                    'disabled' => $this->adminTranslations['currency_conversion_disabled'],
                ],
            ],
            'type_payments'   => $this->field_ticket_payments(),
            'date_expiration' => [
                'title'        => $this->adminTranslations['date_expiration_title'],
                'type'         => 'number',
                'description'  => $this->adminTranslations['date_expiration_description'],
                'default'      => MP_TICKET_DATE_EXPIRATION,
            ],
            'advanced_configuration_title' => [
                'type'         => 'title',
                'title'        => $this->adminTranslations['advanced_title_title'],
                'class'        => 'mp-subtitle-body',
            ],
            'advanced_configuration_description' => [
                'type'         => 'title',
                'title'        => $this->adminTranslations['advanced_description_title'],
                'class'        => 'mp-small-text',
            ],
            'stock_reduce_mode' => [
                'title'         => $this->adminTranslations['stock_reduce_title'],
                'type'          => 'mp_toggle_switch',
                'default'       => 'no',
                'subtitle'      => $this->adminTranslations['stock_reduce_subtitle'],
                'descriptions'  => array(
                    'enabled'   => $this->adminTranslations['stock_reduce_enabled'],
                    'disabled'  => $this->adminTranslations['stock_reduce_disabled'],
                ),
            ]
        ];
    }

    /**
     * Added gateway scripts
     *
     * @param string $gatewaySection
     *
     * @return void
     */
    public function payment_scripts(string $gatewaySection): void
    {
        parent::payment_scripts($gatewaySection);
    }

    /**
     * Render gateway checkout template
     *
     * @return void
     */
    public function payment_fields(): void
    {
        $currentUser = $this->mercadopago->currentUser->getCurrentUser();

		$logged_user_email = ( 0 !== $currentUser->ID ) ? $currentUser->user_email : null;
		$address           = $this->mercadopago->currentUser->getCurrentUserMeta('billing_address_1', true);
		$address_2         = $this->mercadopago->currentUser->getCurrentUserMeta('billing_address_2', true);
		$address          .= ( ! empty( $address_2 ) ? ' - ' . $address_2 : '' );
		$country           = $this->mercadopago->currentUser->getCurrentUserMeta('billing_country', true);
		$address          .= ( ! empty( $country ) ? ' - ' . $country : '' );

        $parameters = array(
            'test_mode'                        => $this->mercadopago->seller->isTestMode(),
            'test_mode_title'                  => $this->storeTranslations['test_mode_title'],
            'test_mode_description'            => $this->storeTranslations['test_mode_description'],
            'test_mode_link_text'              => $this->storeTranslations['test_mode_link_text'],
            'test_mode_link_src'               => $this->mercadopago->links->getLinks()['docs_integration_test'],
            'input_document_label'             => $this->storeTranslations['input_document_label'],
            'input_document_helper'            => $this->storeTranslations['input_document_helper'],
            'ticket_text_label'                => $this->storeTranslations['ticket_text_label'],
            'input_table_button'               => $this->storeTranslations['input_table_button'],
            'input_helper_label'               => $this->storeTranslations['input_helper_label'],
            'terms_and_conditions_description' => $this->storeTranslations['terms_and_conditions_description'],
            'terms_and_conditions_link_text'   => $this->storeTranslations['terms_and_conditions_link_text'],
            'terms_and_conditions_link_src'    => $this->mercadopago->links->getLinks()['mercadopago_terms_and_conditions'],
            'amount'                           => $this->getAmount(),
            'payment_methods'                  => $this->getPaymentMethods(),
            'site_id'                          => $this->mercadopago->seller->getSiteId(),
            'payer_email'                      => esc_js($logged_user_email),
            'currency_ratio'                   => $this->mercadopago->currency->getRatio($this),
            'woocommerce_currency'             => get_woocommerce_currency(),
            'account_currency'                 => $this->mercadopago->country->getCountryConfigs(),
            'febraban'                         => (0 !== $currentUser->ID) ?
                array(
                    'firstname' => esc_js($currentUser->user_firstname),
                    'lastname'  => esc_js($currentUser->user_lastname),
                    'docNumber' => '',
                    'address'   => esc_js($address),
                    'number'    => '',
                    'city'      => esc_js($this->mercadopago->currentUser->getCurrentUserMeta('billing_city', true)),
                    'state'     => esc_js($this->mercadopago->currentUser->getCurrentUserMeta('billing_state', true)),
                    'zipcode'   => esc_js($this->mercadopago->currentUser->getCurrentUserMeta('billing_postcode', true)),
                ) :
                array(
                    'firstname' => '',
                    'lastname'  => '',
                    'docNumber' => '',
                    'address'   => '',
                    'number'    => '',
                    'city'      => '',
                    'state'     => '',
                    'zipcode'   => '',
                ),
        );

        $this->mercadopago->template->getWoocommerceTemplate(
            'public/checkouts/ticket-checkout.php',
            $parameters
        );
    }

    /**
     * Field ticket payments
     *
     * @return array
     */
    private function field_ticket_payments()
    {
        $paymentMethods = $this->mercadopago->seller->getCheckoutTicketPaymentMethods();

        if (!is_array($paymentMethods)) {
            $paymentMethods = json_decode($paymentMethods, true);
        }

        $payment_list = array(
            'type'                 => 'mp_checkbox_list',
            'title'                => $this->adminTranslations['type_payments_title'],
            'description'          => $this->adminTranslations['type_payments_description'],
            'desc_tip'             => $this->adminTranslations['type_payments_desctip'],
            'payment_method_types' => array(
                'ticket'           => array(
                    'label'        => $this->adminTranslations['type_payments_label'],
                    'list'         => array(),
                ),
            ),
        );

        foreach ($paymentMethods as $paymentMethod) {
            $payment_list['payment_method_types']['ticket']['list'][] = array(
                'id'        => $paymentMethod['id'],
                'field_key' => $this->get_field_key($paymentMethod['id']),
                'label'     => array_key_exists('payment_places', $paymentMethod) ? $paymentMethod['name'] . ' (' . $this->buildPaycashPaymentsString() . ')' : $paymentMethod['name'],
                'value'     => $this->getOption($paymentMethod['id'], 'yes'),
                'type'      => 'checkbox',
            );
        }

        return $payment_list;
    }

	/**
	 * Build Paycash Payments String
	 *
	 * @return string
	 */
	public function buildPaycashPaymentsString() {
		$get_payment_methods_ticket = $this->mercadopago->options->get( '_all_payment_methods_ticket', '[]' );

		foreach ($get_payment_methods_ticket as $payment) {
			if ('paycash' === $payment['id']) {
				$payments = array_column($payment['payment_places'] , 'name');
			}
		}

		$last_element     = array_pop( $payments );
		$paycash_payments = implode(', ', $payments);

		return implode( $this->storeTranslations['paycash_concatenator'] , array( $paycash_payments, $last_element ));
	}

    /**
     * Validate gateway checkout form fields
     *
     * @return bool
     */
    public function validate_fields(): bool
    {
        return true;
    }

    /**
     * Process payment and create woocommerce order
     *
     * @param int $order_id
     *
     * @return array
     */
    public function process_payment($order_id): array
    {
        parent::process_payment($order_id);

        // @todo: nonce validation

        // phpcs:ignore WordPress.Security.NonceVerification
        $checkout = map_deep($_POST['mercadopago_ticket'], 'sanitize_text_field');
        $order    = wc_get_order($order_id);

        if ($checkout['amount'] && $checkout['paymentMethodId']) {
            $this->transaction = new TicketTransaction($this, $order, $checkout);
            $response = $this->transaction->createPayment();

            if (is_array($response) && array_key_exists('status', $response)) {
                $this->mercadopago->metaData->updatePaymentsOrderMetadata($order->get_id(), [$response['id']]);

                if ('pending' === $response['status']) {
                    if ('pending_waiting_payment' === $response['status_detail'] || 'pending_waiting_transfer' === $response['status_detail']) {
                        WC()->cart->empty_cart();

                        if ('yes' === $this->$this->mercadopago->options->get('stock_reduce_mode', 'no')) {
                            wc_reduce_stock_levels($order_id);
                        }

                        $this->mercadopago->order->setTicketMetadata($this, $order, $response);

                        $description = $this->storeTranslations['customer_not_paid'];
                        $this->mercadopago->order->addOrderNote($order, $description);

                        if ('bank_transfer' !== $response['payment_type_id']) {
                            $description = "Mercado Pago: {$this->storeTranslations['congrats_title']}" .
                                "<a target=\"_blank\" href=\"{$response['transaction_details']['external_resource_url']}\"" .
                                "{$this->storeTranslations['congrats_subtitle']}</a>";
                            $this->mercadopago->order->addOrderNote($order, $description, 1);
                        }

                        return [
                            'result'   => 'success',
                            'redirect' => $order->get_checkout_order_received_url(),
                        ];
                    }
                }


                return $this->processReturnFail(
                    __FUNCTION__,
                    $this->mercadopago->storeTranslations->commonMessages['cho_form_error']
                );
            }
        }

        return $this->processReturnFail(
            __FUNCTION__,
            $this->mercadopago->storeTranslations->commonMessages['cho_default_error']
        );
    }

    /**
     * Receive gateway webhook notifications
     *
     * @return void
     */
    public function webhook(): void
    {
        $status   = 200;
        $response = [
            'status'  => $status,
            'message' => 'Webhook handled successful'
        ];

        wp_send_json_success($response, $status);
    }

	/**
	 * Render ticket thank you page
	 *
	 * @param string $order_id Order Id.
	 */
    public function loadThankYouPage($order_id): void
    {
		$order               = wc_get_order( $order_id );
		$transaction_details = (method_exists($order, 'get_meta')) ? $order->get_meta( '_transaction_details_ticket' ):get_post_meta( $order->get_id(), '_transaction_details_ticket', true );

		if ( empty( $transaction_details ) ) {
			return;
        }

        $this->mercadopago->template->getWoocommerceTemplate(
            'public/order/ticket-order-received.php',
            [
                'print_ticket_label'  => $this->storeTranslations['print_ticket_label'],
                'print_ticket_link'   => $this->storeTranslations['print_ticket_link'],
                'transaction_details' => $transaction_details,
            ]
        );
    }

	/**
	 * Get payment methods
	 *
	 * @return array
	 */
	public function getPaymentMethods(): array
    {
        $activePaymentMethods = [];
		$ticketPaymentMethods = $this->mercadopago->seller->getCheckoutTicketPaymentMethods();

		if ( ! empty( $ticketPaymentMethods ) ) {
			foreach ( $ticketPaymentMethods as $ticketPaymentMethod ) {
				if (!isset($this->settings[$ticketPaymentMethod['id']])
					|| 'yes' === $this->settings[$ticketPaymentMethod['id']]) {
					$activePaymentMethods[] = $ticketPaymentMethod;
				}
			}
		}
        sort($activePaymentMethods);

        return $this->mercadopago->paymentMethods->treatTicketPaymentMethods($activePaymentMethods);
	}
}
