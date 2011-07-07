<?php
    require_once('../tests/BaseTest.php');

    class RegisterTest extends BaseTest {

        private $user;

        function __construct() {
            $username = 'test' . time();
            $this->user = array('username' => $username, 'password' => 'qwerty123', 'email' => $username . '@mydomain.com');
        }

        public function testRegister() {
            $this->register();
            $this->logout();
            $this->login($this->user['username'], $this->user['password']);
            $this->logout();
            $this->checkRegister();
        }

        public function register() {
            $this->open('forms/home.php');
            $this->click('login_sub_menu');
            $this->click('register');
            $this->waitForElementVisible('username');
            $this->type('username', $this->user['username']);
            $this->type('password', $this->user['password']);
            $this->type('confirm_password', $this->user['password']);
            $this->type('email', $this->user['email']);
            $this->clickAndWait('submit');
        }

        public function logout() {
            $this->click('login_sub_menu');
            $this->clickAndWait('login');
        }

        public function checkRegister() {
            $this->user['email'] = 'test';
            $this->register();
            require_once('../utils/help.php');
            $messages = getMessages();
            $this->waitForElementWithText('error', $messages['error_dublicating_user_info']);
            $username = $this->user['username'];
            $this->user['email'] = $username . '@mydomain.com';
            $this->user['username'] = $username . '_new';
            $this->waitForElementWithText('error', $messages['error_dublicating_user_info']);
        }
    }
?>
