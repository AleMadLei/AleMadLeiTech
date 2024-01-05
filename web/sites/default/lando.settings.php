<?php

// Gets the database connection information.
$lando_info = json_decode(getenv('LANDO_INFO'), TRUE);
$databases['default']['default'] = [
  'driver' => 'mysql',
  'database' => $lando_info['database']['creds']['database'],
  'username' => $lando_info['database']['creds']['user'],
  'password' => $lando_info['database']['creds']['password'],
  'host' => $lando_info['database']['internal_connection']['host'],
  'port' => $lando_info['database']['internal_connection']['port'],
];

// Sets a salt.
$settings['hash_salt'] = md5(getenv('LANDO_HOST_IP'));

// Set to true for local debugging.
$debug = TRUE;
if ($debug) {
  // Disable aggregation.
  $config['system.performance']['css']['preprocess'] = FALSE;
  $config['system.performance']['js']['preprocess'] = FALSE;

  // Lando services.
  $settings['container_yamls'][] = $app_root . '/' . $site_path . '/lando.services.yml';

  // Cache backend.
  $settings['cache']['bins']['render'] = 'cache.backend.null';
  $settings['cache']['bins']['page'] = 'cache.backend.null';
  $settings['cache']['bins']['dynamic_page_cache'] = 'cache.backend.null';

  // Assertions for SDC.
  ini_set('zend.assertions', 1);
}
