<?php if (!defined('APPLICATION')) exit();

// Conversations
$Configuration['Conversations']['Version'] = '3.0';

// Database
$Configuration['Database']['Name'] = 'dbname';
$Configuration['Database']['Host'] = 'vanilla_mysql_1';
$Configuration['Database']['User'] = 'dbuser';
$Configuration['Database']['Password'] = 'dbpassword';

// EnabledApplications
$Configuration['EnabledApplications']['Conversations'] = 'conversations';
$Configuration['EnabledApplications']['Vanilla'] = 'vanilla';

// EnabledPlugins
$Configuration['EnabledPlugins']['recaptcha'] = true;
$Configuration['EnabledPlugins']['GettingStarted'] = 'GettingStarted';
$Configuration['EnabledPlugins']['stubcontent'] = true;
$Configuration['EnabledPlugins']['swagger-ui'] = true;
$Configuration['EnabledPlugins']['Quotes'] = false;
$Configuration['EnabledPlugins']['rich-editor'] = true;

// Garden
$Configuration['Garden']['Title'] = 'Vanilla';
$Configuration['Garden']['Cookie']['Salt'] = 'kTeodMAXG886hbRL';
$Configuration['Garden']['Cookie']['Domain'] = '';
$Configuration['Garden']['Registration']['ConfirmEmail'] = true;
$Configuration['Garden']['Email']['SupportName'] = 'Vanilla';
$Configuration['Garden']['Email']['Format'] = 'text';
$Configuration['Garden']['SystemUserID'] = '1';
$Configuration['Garden']['UpdateToken'] = 'fa33aaa0e5040f7dae620d8a168c886f133c3ca4';
$Configuration['Garden']['InputFormatter'] = 'Rich';
$Configuration['Garden']['Version'] = 'Undefined';
$Configuration['Garden']['CanProcessImages'] = true;
$Configuration['Garden']['MobileInputFormatter'] = 'Rich';
$Configuration['Garden']['Installed'] = true;

// RichEditor
$Configuration['RichEditor']['Quote']['Enable'] = true;

// Routes
$Configuration['Routes']['YXBwbGUtdG91Y2gtaWNvbi5wbmc='] = array (
  0 => 'utility/showtouchicon',
  1 => 'Internal',
);
$Configuration['Routes']['cm9ib3RzLnR4dA=='] = array (
  0 => '/robots',
  1 => 'Internal',
);
$Configuration['Routes']['dXRpbGl0eS9yb2JvdHM='] = array (
  0 => '/robots',
  1 => 'Internal',
);
$Configuration['Routes']['Y29udGFpbmVyLmh0bWw='] = array (
  0 => 'staticcontent/container',
  1 => 'Internal',
);
$Configuration['Routes']['DefaultController'] = 'discussions';

// Vanilla
$Configuration['Vanilla']['Version'] = '3.0';

// Last edited by foo (172.23.0.1) 2021-03-05 16:09:05