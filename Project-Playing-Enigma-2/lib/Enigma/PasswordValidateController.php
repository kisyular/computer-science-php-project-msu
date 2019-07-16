<?php
/**
 * Created by PhpStorm.
 * User: tesfami1
 * Date: 2018/06/20
 * Time: 2:34 AM
 */

namespace Enigma;


class PasswordValidateController
{
    public function __construct(Site $site, array $post){
        $root = $site->getRoot();
        if(isset($post['addMe'])){
            //
            // 1. Ensure the validator is correct! Use it to get the user ID.
            //
            $validators = new Validators($site);
            $validator = strip_tags($post['validator']);
            $email = $validators->get($validator)[0];
            $name = $validators->get($validator)[1];
            if($email === null) {
                $this->redirect = "$root/password-validate.php?v=$validator&e=". self::INVALID_VALIDATOR;
                return;
            }
            //
            // 2. Ensure the email matches the user.
            //
            $users = new Users($site);
//            $editUser = $users->get($email);
//            if($editUser === null) {
//                // User does not exist!
//                $this->redirect = "$root/password-validate.php?v=$validator&e=".self::USER_NOT_EXIST;
//                return;
//            }
            $userEmail = trim(strip_tags($post['email']));
            if($userEmail !== $email) {
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
            // 4. Add user and create salted password and save it for the user.
            //
            $salt = $users->randomSalt();
            $hash = hash("sha256", $password1 . $salt);
            $row = array('id' => null,
                'email' => $email,
                'name' => $name,
                'password' => $hash,
                'salt'=>$salt
            );
            if($users->addUser($row)){
                //
                // 5. Destroy the validator record so it can't be used again!
                //
                $validators->remove($email);

            }

            $this->redirect = "$root";;
        } else {
            $this->redirect = "$root";
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
    const PASSWORD_NOT_MATCH = 2;
    const PASSWORD_SHORT = 3;
    const EMAIL_INVALID = 4;
}