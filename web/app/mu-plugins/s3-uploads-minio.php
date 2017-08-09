<?php
/*
 * Plugin Name:  Minio for S3-Uploads
 * Description:  Allows for Minio Blob server to work with S3-Uploads
 * Version:      0.0.1
 * Author:       Evan
 * Author URI:   mailto:seclayer@gmail.com
 * License:      MIT License
 * */

if (S3_UPLOADS_USE_MINIO) {
  s3_uploads_activate();
  add_filter('s3_uploads_s3_client_params', function($params){
    $params['endpoint'] = S3_UPLOADS_BUCKET_URL;
    return $params;
  });
}

function s3_uploads_activate() {
  require_once( ABSPATH . 'wp-admin/includes/plugin.php' );
  $s3_plugin_path = array_keys(
    array_filter(get_plugins(), function($item) {
      return ($item['Name'] === 'S3 Uploads');
    })
  )[0];
  activate_plugin($s3_plugin_path);
}
