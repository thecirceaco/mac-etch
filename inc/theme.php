<?php
declare(strict_types=1);

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}

add_action(
    'admin_enqueue_scripts',
    static function (): void {
        $admin_file = get_stylesheet_directory() . '/assets/css/admin.css';
        if ( is_readable( $admin_file ) ) {
            wp_enqueue_style(
                'mac-etch-admin-styles',
                get_stylesheet_directory_uri() . '/assets/css/admin.css',
                [],
                (string) filemtime( $admin_file )
            );
        }

        // The role check is intentional: client roles can carry admin-like
        // capabilities. client.css and admin.css are cosmetic only and publicly
        // downloadable, not access control.
        // phpcs:ignore WordPress.WP.Capabilities.RoleFound -- Intentional: client roles can carry admin-like capabilities.
        if ( current_user_can( 'administrator' ) ) {
            return;
        }

        $client_file = get_stylesheet_directory() . '/assets/css/client.css';
        if ( is_readable( $client_file ) ) {
            wp_enqueue_style(
                'mac-etch-client-styles',
                get_stylesheet_directory_uri() . '/assets/css/client.css',
                [],
                (string) filemtime( $client_file )
            );
        }
    }
);
