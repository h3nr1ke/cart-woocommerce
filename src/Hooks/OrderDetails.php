<?php

namespace MercadoPago\Woocommerce\Hooks;

use MercadoPago\Woocommerce\Admin\Translations;

if (!defined('ABSPATH')) {
    exit;
}

class OrderDetails
{
    /**
     * @var OrderDetails
     */
    private static $instance = null;

    /**
     * Get OrderDetailsHook instance
     *
     * @return OrderDetails
     */
    public static function getInstance(): OrderDetails
    {
        if (null === self::$instance) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    /**
     * Add actions to meta box
     *
     * @param array $actions
     *
     * @return array
     */
    public function addOrderMetaBoxActions(array $actions): array
    {
        $actions['cancel_order'] = Translations::$orderSettings['cancel_order'];
        return $actions;
    }
}
