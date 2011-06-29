<?php
    require_once('../utils/help.php');
    require_once('../utils/db.php');

    function getId() {
        if($_SESSION['admin'] == TRUE && isset($_GET['id'])) {
            return new MongoId($_GET['id']);
        }
        return $_SESSION['id'];
    }

    function generateEditProfileForm() {
        $id = getId();
        $user = findUserById($id);

        $vars = getMessagesForArray(array('login', 'password', 'display_name',
                    'confirm_password', 'email', 'submit', 'avatar', 'male',
                    'female', 'is_admin', 'is_moderator', 'is_active'));
        $vars += array('action' => '../forms/edit_profile.php?id=' . $id, 
                       'username_show' => 'false',
                       'max_file_size' => '200000',
                       'username_value' => $user['username'],
                       'email_value' => $user['email'],
                       'display_name_value' => $user['display_name'],
                       'male_checked' => $user['sex'] == 'male' ? 'checked' : '',
                       'female_checked' => 
                            $user['sex'] == 'female' ? 'checked' : '',
                       'admin_view' => isAdmin(),
                       'is_admin_checked' => $user['is_admin'] ? 'checked' : '', 
                       'is_moderator_checked' => 
                            $user['is_moderator'] ? 'checked' : '',
                       'is_active_checked' => $user['active'] ? 'checked' : '');
        genericSmartyDisplay($vars, "../forms/edit_profile.tpl");
    }

    function validate() {
        if(((!isEmpty($_POST['password']) && !isEmpty($_POST['confirm_password']) && 
                        $_POST['password'] == $_POST['confirm_password']) 
                    || (isEmpty($_POST['password']) && isEmpty($_POST['confirm_password'])))
                && !isEmpty($_POST['email']) && !isEmpty($_POST['display_name'])) {
            return TRUE;
        }
        return FALSE;
    }


    function parseEditInfoFromPost() {
        if(!validate($_POST)) {
            return NULL;
        }
        $result = array('email' => $_POST['email'], 'display_name' => $_POST['display_name']);
        if(!isEmpty($_POST['password'])) {
            $result['password'] = generateHash($_POST['password'], $_POST['username']);
        }
        if(!isEmpty($_POST['sex'])) {
            $result['sex'] = $_POST['sex'];
        }
        if(isAdmin() && !isEmpty($_POST['is_admin']) 
                && $_POST['is_admin'] == 'true') {
            $result['is_admin'] = true;
        }
        else {
            $result['is_admin'] = false;
        }
        if(isAdmin() && 
                !isEmpty($_POST['is_moderator']) && $_POST['is_moderator'] == 'true') {
            $result['is_moderator'] = true;
        }
        else {
            $result['is_moderator'] = false;
        }
        if(!isEmpty($_POST['is_active']) && $_POST['is_active'] == 'true') {
            $result['active'] = true;
        }
        else {
            $result['active'] = false;
        }

        return $result;
    }

    function editProfile() {
        $db = getConnection();
        $users = $db->users;
        $update = parseEditInfoFromPost();
        if(update == NULL) {
            return false;
        }
        if(uploadFile() != 'OK') {
            return false;
        }
        else {
            $update['avatar'] = true;
        }
        $id = getId();
        $users->update(array('_id' => $id), array('$set' => $update));
        if($_SESSION['display_name'] != $update['display_name']) {
            updateDisplayName($update['display_name'], $id);
        }
        redirect2Home();
        return true;
    }

    genericRequestHandler(editProfile, generateEditProfileForm);
?>