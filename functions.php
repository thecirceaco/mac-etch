<?php
/**
 * MAC Etch
 *
 * @package      mac-etch
 * @author       Circea
 * @copyright    2026 Circea
 * @license      GPL-3.0-or-later
 * @version      1.0.1
 * @since        0.1.0 Added 2026-04-05
 * @link         https://circea.co
 */

declare(strict_types=1);

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}

// Bootstrap
require_once __DIR__ . '/inc/constants.php';
require_once __DIR__ . '/inc/theme.php';

/**
 * For per-project custom code and options, you can edit:
 *
 * - assets/css/client.css     (for non-admin styles)
 * - assets/css/admin.css      (for backend styles)
 * - functions.php             (for custom functions)
 */

// PROJECT
