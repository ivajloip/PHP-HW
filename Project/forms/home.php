<?php
    require_once('../utils/help.php');
    require_once('../utils/db.php');

    $vars = getMessagesForArray(array('avatar'));
    if(isLoggedId()) {
        $file = getFile(getAvatarFileName());
        if($file != NULL) { 
            $vars += array('mime_type' => $file->file['type'], 'content' => base64_encode($file->getBytes()));
        }
    }

    genericSmartyDisplay($vars, '../forms/home.tpl');
?>