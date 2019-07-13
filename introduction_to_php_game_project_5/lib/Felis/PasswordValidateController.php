<?php
/**
 * Created by PhpStorm.
 * User: tesfami1
 * Date: 2018/06/17
 * Time: 6:43 AM
 */

namespace Felis;


class PasswordValidateController
{
    /**
     * PasswordValidateController constructor.
     * @param Site $site The Site object
     * @param array $post $_POST
     */
    public function __construct(Site $site, array $post) {
        $root = $site->getRoot();
        if(isset($post["change"])){
            //
            // 1. Ensure the validator is correct! Use it to get the user ID.
            //
            $validators = new Validators($site);
            $validator = strip_tags($post['validator']);
            $userid = $validators->get($validator);
            if($userid === null) {
                $this->redirect = "$root/password-validate.php?v=$validator&e=". self::INVALID_VALIDATOR;
                return;
            }
            //
            // 2. Ensure the email matches the user.
            //
            $users = new Users($site);
            $editUser = $users->get($userid);
            if($editUser === null) {
                // User does not exist!
                $this->redirect = "$root/password-validate.php?v=$validator&e=".self::USER_NOT_EXIST;
                return;
            }
            $email = trim(strip_tags($post['email']));
            if($email !== $editUser->getEmail()) {
                // Email entered is invalid
                $this->redirect = "$root/password-validate.php?v=$validator&e=". self::EMAIL_INVALID;
                return;
            }

            //
            // 3. Ensure the passwords match each other
            //
            $password1 = trim(strip_tags($post['password']));
            $password2 = trim(strip_tags($post['password2']));
            if($password1 !== $password2) {
                // Passwords do not match
                $this->redirect = "$root/password-validate.php?v=$validator&e=".self::PASSWORD_NOT_MATCH;
                return;
            }

            if(strlen($password1) < 8) {
                // Password too short
                $this->redirect = "$root/password-validate.php?v=$validator&e=".self::PASSWORD_SHORT;
                return;
            }
            //
            // 4. Create a salted password and save it for the user.
            //
            $users->setPassword($userid, $password1);
            //
            // 5. Destroy the validator record so it can't be used again!
            //
            $validators->remove($userid);
            $this->redirect = "$root/login.php";
        } else {
            $this->redirect = "$root/";
        }
    }
    /**
     * @return mixed
     */
    public function getRedirect()
    {
        return $this->redirect;
    }
    private $redirect;  ///< Page we will redirect the user to.
    const INVALID_VALIDATOR = 1;
    const EMAIL_INVALID = 2;
    const USER_NOT_EXIST = 3;
    const PASSWORD_NOT_MATCH = 4;
    const PASSWORD_SHORT = 5;

}