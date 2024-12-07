<?php
require_once(__DIR__ . '/../../config.php');
require_once($CFG->libdir . '/adminlib.php');

require_login();
admin_externalpage_setup('local_airtable');

echo $OUTPUT->header();
echo $OUTPUT->heading('Airtable Integration');

$api = new \local_airtable\api();
$records = $api->get_records('YourTableName');

if (!empty($records['records'])) {
    echo html_writer::start_tag('ul');
    foreach ($records['records'] as $record) {
        echo html_writer::tag('li', $record['fields']['Name'] ?? 'Unnamed Record');
    }
    echo html_writer::end_tag('ul');
} else {
    echo $OUTPUT->notification('No records found or API error.');
}

echo $OUTPUT->footer();
