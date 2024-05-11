<?php

/**
 * Receive updates from hub; order status, order notes
 */

// Endpoint to receive updated order data from the hub site
add_action('rest_api_init', function() {
    register_rest_route('store-order-plugin/v1', '/update-order', array(
        'methods' => 'POST',
        'callback' => 'update_order_status_and_note',
    ));
});

function update_order_status_and_note($request) {
    $secret_key = get_option('rest_secret_key');
    $data = $request->get_json_params();
    $sent_secret_key = $_SERVER['HTTP_AUTHORIZATION'];
    if ($sent_secret_key !== 'Basic ' . base64_encode('wppool:' . $secret_key)) {
        return rest_ensure_response(array('success' => false, 'message' => 'Unauthorized access.'), 403);
    }
    $order_id = $data['order_id'];
    $order = wc_get_order($order_id);

    if ($order) {
        if (isset($data['status'])) {
            $order->set_status($data['status']);
            $order->save();
        }
        if (isset($data['order_notes'])) {
            $order->set_customer_note($data['order_notes']);
             $order->save();
        }
    }

    return rest_ensure_response('Order status and note updated successfully.');
}