<?php
/**
 * SMTP Configuration
 */

use Roots\WPConfig\Config;
use function Env\env;
/**
 * SMTP settings
 */
if (env('SMTP_HOST')) {
  Config::define('SMTP_HOST', env('SMTP_HOST'));
  Config::define('SMTP_AUTH', env('SMTP_AUTH'));
  Config::define('SMTP_PORT', env('SMTP_PORT'));
  Config::define('SMTP_SECURE', env('SMTP_SECURE'));
  Config::define('SMTP_USER', env('SMTP_USER'));
  Config::define('SMTP_PASS', env('SMTP_PASS'));
  Config::define('SMTP_FROM', env('SMTP_FROM'));
  Config::define('SMTP_NAME', env('SMTP_NAME'));
  Config::define('SMTP_DEBUG', env('SMTP_DEBUG'));
}

Config::define('MAIL_RECEIVER', env('MAIL_RECEIVER'));
