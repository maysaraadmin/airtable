<?php
defined('MOODLE_INTERNAL') || die();

// Check if the $ADMIN variable is defined to ensure the settings are being added in the admin context.
if ($ADMIN->fulltree) {
    // Create the settings page for the Airtable plugin.
    $settings = new admin_settingpage(
        'local_airtable',
        get_string('pluginname', 'local_airtable')
    );

    // Add the API key setting.
    $settings->add(new admin_setting_configtext(
        'local_airtable/apikey',
        get_string('apikey', 'local_airtable'),
        get_string('apikey', 'local_airtable'),
        '',
        PARAM_RAW
    ));

    // Add the Base ID setting.
    $settings->add(new admin_setting_configtext(
        'local_airtable/baseid',
        get_string('baseid', 'local_airtable'),
        get_string('baseid', 'local_airtable'),
        '',
        PARAM_RAW
    ));

    // Add the settings page to the admin tree.
    $ADMIN->add('localplugins', $settings);
}
