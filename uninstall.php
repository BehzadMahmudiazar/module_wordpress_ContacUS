<?php



global $wpdb;
$sql = "
DROP TABLE   {$wpdb->prefix}shno_message_return";
$wpdb->get_results($sql);
















































