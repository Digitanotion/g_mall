<?php
    define('DB_OPTIONS', 
    [
    "root",
        "",
        "watchapp",
        "localhost",
    ], true);

    define ('PDO_OPTIONS', [
        PDO::ATTR_EMULATE_PREPARES   => false, // turn off emulation mode for "real" prepared statements
        PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION, //turn on errors in the form of exceptions
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC, //make the default fetch be an associative array
    ],
    true) ;
    define ('SMTP_OPTIONS', [
        "smtpnoreply@credebit.com.ng",
        "j3W(ix)1=D~v",
        "localhost"
    ],
    true) ;

    define ('SMS_OPTIONS', [
        "https://sfsfdsfdsfnfdsfdsf/comfsfs",
    ],
    true) ;

?>