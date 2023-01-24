<?php

namespace MercadoPago\Woocommerce\Gateways;

use MercadoPago\Woocommerce\Interfaces\MercadoPagoGatewayInterface;

if (!defined('ABSPATH')) {
    exit;
}

class PixGateway extends AbstractGateway implements MercadoPagoGatewayInterface
{
    /**
     * @const
     */
    public const ID = 'woo-mercado-pago-pix';

    /**
     * @const
     */
    public const CHECKOUT_NAME = 'checkout-pix';

    /**
     * PixGateway constructor
     */
    public function __construct()
    {
        parent::__construct();

        $this->id                 = self::ID;
        $this->icon               = $this->mercadopago->plugin->getGatewayIcon('icon-pix');
        $this->title              = $this->mercadopago->options->get('title', $this->mercadopago->adminTranslations->pixSettings['gateway_title']);
        $this->description        = $this->mercadopago->adminTranslations->pixSettings['gateway_description'];
        $this->method_title       = $this->mercadopago->adminTranslations->pixSettings['gateway_method_title'];
        $this->method_description = $this->mercadopago->adminTranslations->pixSettings['gateway_method_description'];
        $this->activatedGateway   = $this->mercadopago->seller->getCheckoutPaymentMethodPix();
        $this->expirationDate     = (int) $this->mercadopago->seller->getCheckoutDateExpirationPix('1');

        $this->init_form_fields();
        $this->init_settings();
        $this->payment_scripts($this->id);

        $this->mercadopago->gateway->registerUpdateOptions($this);
        $this->mercadopago->gateway->registerGatewayTitle($this);
        // @todo: register the endpoint to woocommerce_api_wc_mp_pix_image
        $this->mercadopago->endpoints->registerApiEndpoint($this->id, [$this, 'webhook']);
        $this->mercadopago->order->registerEmailBeforeOrderTable([$this, 'getTemplate']);
        $this->mercadopago->order->registerOrderDetailsAfterOrderTable([$this, 'getTemplate']);
        $this->mercadopago->gateway->registerThankYouPage($this->id, [$this, 'loadThankYouPage']);
    }

    /**
     * Get checkout name
     *
     * @return string
     */
    public function getCheckoutName(): string
    {
        return self::CHECKOUT_NAME;
    }

    /**
     * Init form fields for checkout configuration
     *
     * @return void
     */
    public function init_form_fields(): void
    {
        parent::init_form_fields();

        if (
            !empty($this->mercadopago->store->getCheckoutCountry()) &&
            !empty($this->mercadopago->seller->getCredentialsPublicKey()) &&
            !empty($this->mercadopago->seller->getCredentialsAccessToken())
        ) {
            $paymentMethodPix = $this->mercadopago->seller->getCheckoutPaymentMethodPix();

            if (empty($paymentMethodPix) || !in_array('pix', $paymentMethodPix['pix'], true)) {
                if (isset($_GET['section']) && $_GET['section'] == $this->id) {
                    $this->mercadopago->notices->adminNoticeMissPix();
                }

                $stepsContent = $this->mercadopago->template->getWoocommerceTemplateHtml(
                    'admin/settings/steps.php',
                    [
                        'title'                       => $this->mercadopago->adminTranslations->pixSettings['steps_title'],
                        'step_one_text'               => $this->mercadopago->adminTranslations->pixSettings['steps_step_one_text' ],
                        'step_two_text'               => $this->mercadopago->adminTranslations->pixSettings['steps_step_two_text'],
                        'step_three_text'             => $this->mercadopago->adminTranslations->pixSettings['steps_step_three_text'],
                        'observation_one'             => $this->mercadopago->adminTranslations->pixSettings['steps_observation_one'],
                        'observation_two'             => $this->mercadopago->adminTranslations->pixSettings['steps_observation_two'],
                        'button_about_pix'            => $this->mercadopago->adminTranslations->pixSettings['steps_button_about_pix'],
                        'observation_three'           => $this->mercadopago->adminTranslations->pixSettings['steps_observation_three'],
                        'link_title_one'              => $this->mercadopago->adminTranslations->pixSettings['steps_link_title_one'],
                        'link_url_one'                => $this->mercadopago->links->getLinks()['mercadopago_pix'],
                        'link_url_two'                => $this->mercadopago->links->getLinks()['mercadopago_support'],
                    ]
                );

                $this->form_fields = [
                    'header'        => [
                        'type'        => 'mp_config_title',
                        'title'       => $this->mercadopago->adminTranslations->pixSettings['header_title'],
                        'description' => $this->mercadopago->adminTranslations->pixSettings['header_description'],
                    ],
                    'steps_content' => [
                        'title' => $stepsContent,
                        'type'  => 'title',
                        'class' => 'mp_title_checkout',
                    ],
                ];
            } else {
                $this->form_fields = [
                    'header'                             => [
                        'type'        => 'mp_config_title',
                        'title'       => $this->mercadopago->adminTranslations->pixSettings['header_title'],
                        'description' => $this->mercadopago->adminTranslations->pixSettings['header_description'],
                    ],
                    'card_settings'                      => [
                        'type'        => 'mp_card_info',
                        'value'       => [
                            'title'       => $this->mercadopago->adminTranslations->pixSettings['card_settings_title'],
                            'subtitle'    => $this->mercadopago->adminTranslations->pixSettings['card_settings_subtitle'],
                            'button_text' => $this->mercadopago->adminTranslations->pixSettings['card_settings_button_text'],
                            'button_url'  => $this->mercadopago->links->getLinks()['admin_settings_page'],
                            'icon'        => 'mp-icon-badge-info',
                            'color_card'  => 'mp-alert-color-success',
                            'size_card'   => 'mp-card-body-size',
                            'target'      => '_self',
                        ],
                    ],
                    'enabled'                            => [
                        'type'         => 'mp_toggle_switch',
                        'title'        => $this->mercadopago->adminTranslations->pixSettings['enabled_title'],
                        'subtitle'     => $this->mercadopago->adminTranslations->pixSettings['enabled_subtitle'],
                        'default'      => 'no',
                        'descriptions' => [
                            'enabled'  => $this->mercadopago->adminTranslations->pixSettings['enabled_descriptions_enabled'],
                            'disabled' => $this->mercadopago->adminTranslations->pixSettings['enabled_descriptions_disabled'],
                        ],
                    ],
                    'title'                              => [
                        'type'            => 'text',
                        'title'           => $this->mercadopago->adminTranslations->pixSettings['title_title'],
                        'description'     => $this->mercadopago->adminTranslations->pixSettings['title_description'],
                        'default'         => $this->mercadopago->adminTranslations->pixSettings['title_default'],
                        'desc_tip'        => $this->mercadopago->adminTranslations->pixSettings['title_desc_tip'],
                        'class'           => 'limit-title-max-length',
                    ],
                    'expiration_date'                    => [
                        'type'        => 'select',
                        'title'       => $this->mercadopago->adminTranslations->pixSettings['expiration_date_title'],
                        'description' => $this->mercadopago->adminTranslations->pixSettings['expiration_date_description'],
                        'default'     => '30 minutes',
                        'options'     => [
                            '15 minutes' => $this->mercadopago->adminTranslations->pixSettings['expiration_date_options_fifteen_minutes'],
                            '30 minutes' => $this->mercadopago->adminTranslations->pixSettings['expiration_date_options_thirty_minutes'],
                            '60 minutes' => $this->mercadopago->adminTranslations->pixSettings['expiration_date_options_sixty_minutes'],
                            '12 hours'   => $this->mercadopago->adminTranslations->pixSettings['expiration_date_options_twelve_hours'],
                            '24 hours'   => $this->mercadopago->adminTranslations->pixSettings['expiration_date_options_twenty_four_hours'],
                            '2 days'     => $this->mercadopago->adminTranslations->pixSettings['expiration_date_options_two_days'],
                            '3 days'     => $this->mercadopago->adminTranslations->pixSettings['expiration_date_options_three_days'],
                            '4 days'     => $this->mercadopago->adminTranslations->pixSettings['expiration_date_options_four_days'],
                            '5 days'     => $this->mercadopago->adminTranslations->pixSettings['expiration_date_options_five_days'],
                            '6 days'     => $this->mercadopago->adminTranslations->pixSettings['expiration_date_options_six_days'],
                            '7 days'     => $this->mercadopago->adminTranslations->pixSettings['expiration_date_options_seven_days'],
                        ]
                    ],
                    'currency_conversion'                => [
                        'type'         => 'mp_toggle_switch',
                        'title'        => $this->mercadopago->adminTranslations->pixSettings['currency_conversion_title'],
                        'subtitle'     => $this->mercadopago->adminTranslations->pixSettings['currency_conversion_subtitle'],
                        'default'      => 'no',
                        'descriptions' => [
                            'enabled'  => $this->mercadopago->adminTranslations->pixSettings['currency_conversion_descriptions_enabled'],
                            'disabled' => $this->mercadopago->adminTranslations->pixSettings['currency_conversion_descriptions_disabled'],
                        ],
                    ],
                    'card_info_helper'                   => [
                        'type'  => 'title',
                        'value' => '',
                    ],
                    'card_info'                          => [
                        'type'        => 'mp_card_info',
                        'value'       => [
                            'title'       => $this->mercadopago->adminTranslations->pixSettings['card_info_title'],
                            'subtitle'    => $this->mercadopago->adminTranslations->pixSettings['card_info_subtitle'],
                            'button_text' => $this->mercadopago->adminTranslations->pixSettings['card_info_button_text'],
                            'button_url'  => $this->mercadopago->links->getLinks()['mercadopago_pix'],
                            'icon'        => 'mp-icon-badge-info',
                            'color_card'  => 'mp-alert-color-success',
                            'size_card'   => 'mp-card-body-size',
                            'target'      => '_blank',
                        ]
                    ],
                    'advanced_configuration_title'       => [
                        'type'  => 'title',
                        'title' => $this->mercadopago->adminTranslations->pixSettings['advanced_configuration_title'],
                        'class' => 'mp-subtitle-body',
                    ],
                    'advanced_configuration_description' => [
                        'type'  => 'title',
                        'title' => $this->mercadopago->adminTranslations->pixSettings['advanced_configuration_subtitle'],
                        'class' => 'mp-small-text',
                    ],
                    'discount'               => [
                        'type'              => 'mp_actionable_input',
                        'title'             => $this->mercadopago->adminTranslations->pixSettings['discount_title'],
                        'input_type'        => 'number',
                        'description'       => $this->mercadopago->adminTranslations->pixSettings['discount_description'],
                        'checkbox_label'    => $this->mercadopago->adminTranslations->pixSettings['discount_checkbox_label'],
                        'default'           => '0',
                        'custom_attributes' => [
                            'step' => '0.01',
                            'min'  => '0',
                            'max'  => '99',
                        ],
                    ],
                    'commission'             => [
                        'type'              => 'mp_actionable_input',
                        'title'             => $this->mercadopago->adminTranslations->pixSettings['commission_title'],
                        'input_type'        => 'number',
                        'description'       => $this->mercadopago->adminTranslations->pixSettings['commission_description'],
                        'checkbox_label'    => $this->mercadopago->adminTranslations->pixSettings['commission_checkbox_label'],
                        'default'           => '0',
                        'custom_attributes' => [
                            'step' => '0.01',
                            'min'  => '0',
                            'max'  => '99',
                        ],
                    ]
                ];
            }
        }
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
        $this->mercadopago->template->getWoocommerceTemplate(
            'public/checkout/pix-checkout.php',
            [
                'test_mode'                        => $this->mercadopago->seller->isTestMode(),
                'test_mode_title'                  => $this->mercadopago->publicTranslations->pix['test_mode_title'],
                'test_mode_description'            => $this->mercadopago->publicTranslations->pix['test_mode_description'],
                'pix_template_title'               => $this->mercadopago->publicTranslations->pix['pix_template_title'],
                'pix_template_subtitle'            => $this->mercadopago->publicTranslations->pix['pix_template_subtitle'],
                'pix_template_alt'                 => $this->mercadopago->publicTranslations->pix['pix_template_alt'],
                'pix_template_src'                 => plugins_url('../assets/images/pix.png', plugin_dir_path(__FILE__)),
                'terms_and_conditions_description' => $this->mercadopago->publicTranslations->pix['terms_and_conditions_description'],
                'terms_and_conditions_link_text'   => $this->mercadopago->publicTranslations->pix['terms_and_conditions_link_text'],
                'terms_and_conditions_link_src'    => $this->mercadopago->links->getLinks()['mercadopago_terms_and_conditions'],
            ]
        );
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
        $order = wc_get_order($order_id);
        $order->payment_complete();
        $order->add_order_note('Hey, your order is paid! Thank you!', true);

        wc_reduce_stock_levels($order_id);

        $this->mercadopago->woocommerce->cart->empty_cart();

        return [
            'result' => 'success',
            'redirect' => $this->get_return_url($order)
        ];
    }

    /**
     * Receive gateway webhook notifications
     *
     * @return void
     */
    public function webhook(): void
    {
        $status = 200;
        $response = [
            'status' => $status,
            'message' => 'Webhook handled successful'
        ];

        wp_send_json_success($response, $status);
    }

    /**
     * Get pix template
     *
     * @param $order
     *
     * @return string
     */
    public function getTemplate($order): string
    {
        $orderId = $order->get_id();
        $pixOn   = get_post_meta($orderId, 'pix_on');
        $pixOn   = (int) array_pop($pixOn);

        if (1 === $pixOn && 'pending' === $order->get_status()) {
            $qrCode         = get_post_meta($orderId, 'mp_pix_qr_code');
            $qrCode         = array_pop($qrCode);

            $qrCodeBase64   = get_post_meta($orderId, 'mp_pix_qr_base64');
            $qrCodeBase64   = array_pop($qrCodeBase64);

            $expirationDate = get_post_meta($orderId, 'checkout_pix_date_expiration');
            $expirationDate = array_pop($expirationDate);

            $siteUrl        = $this->mercadopago->options->get('siteurl');
            $hasGd          = !in_array('gd', get_loaded_extensions(), true);
            $qrCodeImage    = $hasGd ? "data:image/jpeg;base64,{$qrCode}" : "{$siteUrl}/?wc-api=wc_mp_pix_image&id={$orderId}";

            return $this->mercadopago->template->getWoocommerceTemplateHtml(
                'public/congrats/pix-image.php',
                [
                    'qr_code'              => $qrCode,
                    'expiration_date'      => $expirationDate,
                    'expiration_date_text' => $this->mercadopago->publicTranslations->pix['expiration_date_text'],
                    'qr_code_image'        => $qrCodeImage,
                ]
            );
        }

        return '';
    }

    /**
     * Load thank you page
     *
     * @param $orderId
     *
     * @return void
     */
    public function loadThankYouPage($orderId): void
    {
        $order              = wc_get_order($orderId);
        $methodExists       = method_exists($order, 'get_meta');
        $qrCodeBase64       = $methodExists ? $order->get_meta('mp_pix_qr_base64') : get_post_meta($order->get_id(), 'mp_pix_qr_base64', true);
        $qrCode             = $methodExists ? $order->get_meta('mp_pix_qr_code') : get_post_meta($order->get_id(), 'mp_pix_qr_code', true);
        $transactionAmount  = $methodExists ? $order->get_meta('mp_transaction_amount') : get_post_meta($order->get_id(), 'mp_transaction_amount', true);
        $transactionAmount  = number_format($transactionAmount, 2, ',', '.');
        $expirationOption   = $this->mercadopago->options->get('checkout_pix_date_expiration', '30 minutes');

        $country           = $this->mercadopago->country->getPluginDefaultCountry();
        $countryConfigs    = $this->mercadopago->country->getCountryConfigs($country);
        $currencySymbol    = $countryConfigs['currency_symbol'];

        if (empty($qr_base64) && empty($qr_code)) {
            return;
        }

        $this->mercadopago->template->getWoocommerceTemplate(
            'public/order/pix-order-received.php',
            [
                'img_pix'             => plugins_url('../assets/images/pix.png', plugin_dir_path(__FILE__)),
                'amount'              => $transactionAmount,
                'qr_base64'           => $qrCodeBase64,
                'title_purchase_pix'  => $this->mercadopago->publicTranslations->pix['title_purchase_pix'],
                'title_how_to_pay'    => $this->mercadopago->publicTranslations->pix['title_how_to_pay'],
                'step_one'            => $this->mercadopago->publicTranslations->pix['step_one'],
                'step_two'            => $this->mercadopago->publicTranslations->pix['step_two'],
                'step_three'          => $this->mercadopago->publicTranslations->pix['step_three'],
                'step_four'           => $this->mercadopago->publicTranslations->pix['step_four'],
                'text_amount'         => $this->mercadopago->publicTranslations->pix['text_amount'],
                'currency'            => $currencySymbol,
                'text_scan_qr'        => $this->mercadopago->publicTranslations->pix['text_scan_qr'],
                'text_time_qr_one'    => $this->mercadopago->publicTranslations->pix['qr_date_expiration'],
                'qr_date_expiration'  => $expirationOption,
                'text_description_qr' => $this->mercadopago->publicTranslations->pix['text_description_qr'],
                'qr_code'             => $qrCode,
                'text_button'         => $this->mercadopago->publicTranslations->pix['text_button'],
            ]
        );
    }
}
