<?php
declare(strict_types=1);

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}

/**
 * Register shared child-theme hooks.
 */
function mac_etch_register_shared_hooks(): void {
    add_action( 'admin_enqueue_scripts', 'mac_etch_enqueue_backend_styles' );
    add_action( 'wp_enqueue_scripts', 'mac_etch_enqueue_frontend_assets', 20 );
}

/**
 * Enqueue backend-only styles.
 */
function mac_etch_enqueue_backend_styles(): void {
    mac_etch_enqueue_style( 'mac-etch-admin-styles', '/assets/css/admin.css' );

    if ( ! current_user_can( 'administrator' ) ) {
        mac_etch_enqueue_style( 'mac-etch-client-styles', '/assets/css/client.css' );
    }
}

/**
 * Enqueue frontend assets.
 */
function mac_etch_enqueue_frontend_assets(): void {
    mac_etch_enqueue_script(
        'mac-etch-main-scripts',
        '/assets/js/main.js',
        wp_script_is( 'etch-frontend', 'registered' ) ? [ 'etch-frontend' ] : [],
        true
    );

    mac_etch_enqueue_style( 'mac-etch-main-styles', '/assets/css/main.css' );
}

/**
 * Enqueue a stylesheet if the file exists.
 *
 * @param string             $handle   WordPress handle.
 * @param string             $rel_path Theme-relative file path.
 * @param array<int, string> $deps     Optional dependencies.
 */
function mac_etch_enqueue_style( string $handle, string $rel_path, array $deps = [] ): void {
    $file = mac_etch_asset_path( $rel_path );

    if ( ! is_readable( $file ) ) {
        return;
    }

    wp_enqueue_style(
        $handle,
        mac_etch_asset_url( $rel_path ),
        $deps,
        (string) filemtime( $file )
    );
}

/**
 * Enqueue a script if the file exists.
 *
 * @param string             $handle    WordPress handle.
 * @param string             $rel_path  Theme-relative file path.
 * @param array<int, string> $deps      Optional dependencies.
 * @param bool               $in_footer Whether to load in the footer.
 */
function mac_etch_enqueue_script(
    string $handle,
    string $rel_path,
    array $deps = [],
    bool $in_footer = false
): void {
    $file = mac_etch_asset_path( $rel_path );

    if ( ! is_readable( $file ) ) {
        return;
    }

    wp_enqueue_script(
        $handle,
        mac_etch_asset_url( $rel_path ),
        $deps,
        (string) filemtime( $file ),
        $in_footer
    );
}

/**
 * Build a theme-relative asset URL.
 */
function mac_etch_asset_url( string $rel_path ): string {
    return rtrim( get_stylesheet_directory_uri(), '/' ) . $rel_path;
}

/**
 * Build a theme-relative asset path.
 */
function mac_etch_asset_path( string $rel_path ): string {
    return rtrim( get_stylesheet_directory(), '/' ) . $rel_path;
}

mac_etch_register_shared_hooks();
