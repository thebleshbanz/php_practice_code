			<?php
$timezone = 'UTC';
if (is_link('/etc/localtime')) {
    // Mac OS X (and older Linuxes)    
    // /etc/localtime is a symlink to the 
    // timezone in /usr/share/zoneinfo.
    $filename = readlink('/etc/localtime');
    if (strpos($filename, '/usr/share/zoneinfo/') === 0) {
        $timezone = substr($filename, 20);
    }
} elseif (file_exists('/etc/timezone')) {
    // Ubuntu / Debian.
    $data = file_get_contents('/etc/timezone');
    if ($data) {
        $timezone = $data;
    }
} elseif (file_exists('/etc/sysconfig/clock')) {
    // RHEL / CentOS
    $data = parse_ini_file('/etc/sysconfig/clock');
    if (!empty($data['ZONE'])) {
        $timezone = $data['ZONE'];
    }
}
 
date_default_timezone_set($timezone);

$timezone_offset_minutes = 330;  // $_GET['timezone_offset_minutes']

// Convert minutes to seconds
$timezone_name = timezone_name_from_abbr("", $timezone_offset_minutes*60, false);

// Asia/Kolkata
echo $timezone_name;
			?>