<?php

class CopiaseguridadController extends ControllerPanel {

    public function initialize() {
        $this->tag->setTitle('ADMIN');
        parent::initialize();
    }

    public function indexAction() {
      
    }

    public function backupAction(){
        $pass = $this->config->database->password;
        $user = $this->config->database->username;
        $name_file = "backup".date("Y-m-d").".sql";
        $nameDB = $this->config->database->dbname;

        putenv("PGPASSWORD=" . $pass);
        $dumpcmd = array("pg_dump", "-i", "-U", escapeshellarg($user), "-F", "c", "-b", "-v", "-f", escapeshellarg($name_file), escapeshellarg($nameDB));
        exec( join(' ', $dumpcmd), $cmdout, $cmdresult );
        putenv("PGPASSWORD");
        if ($cmdresult != 0)
        {
            # Handle error here...
            print $cmdresult;
        }

    }
    
}

