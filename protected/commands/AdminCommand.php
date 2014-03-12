<?php

/**
 * Description
 *
 * @since   1.0.0
 * @package StructureWiki
 * @author  Levi Putna <levi.putna@gmail.com>
 */
class AdminCommand extends ConsoleCommand {

//    public function run($args) {
//        echo $this->output("  Error", "white", "red") . " Missing requires action\n\n";
//        echo "   create           Create a new admin account\n";
//    }

    public function actionCreate($email = null, $password = null, $given = null, $family = null, $role = 1) {

        if (is_null($email) || is_null($password) || is_null($given) || is_null($family)) {
            echo "\n " . $this->output("Error", "white", "red") . " Missing requires arguments\n\n";

            echo " Argument     | Description                                                   | Required \n";
            echo " ------------------------------------------------------------------------------------------\n";
            echo " --email      | The email address used by this account                        | True\n";
            echo " --password   | The password used ot log into the account                     | True\n";
            echo " --given      | The account holders given name                                | True\n";
            echo " --family     | The account holders family name                               | True\n";
            echo " --role       | Account security role id)                                     | False      Default = 1\n\n";
            echo " Example 'admin create --email=levi.putna@gmail.com --password=4Me2Change --given=Levi --family=Putna' \n\n";
        } else {
            $new_admin              = new AdminAccounts();
            $new_admin->email       = $email;
            $new_admin->given_name  = $given;
            $new_admin->family_name = $family;
            $new_admin->password    = $password;
            $new_admin->role_id     = $role;

            if ($new_admin->save()) {
                echo "\n " . $this->output("Success:", "white", "green") . " New Admin account created.\n\n";
            } else {
                echo "\n " . $this->output("Error: ", "white", "red") . " Unable to create admin account\n\n";
                echo " Please fix the following input errors:\n\n";

                foreach ($new_admin->errors as $error) {
                    echo "    " . $error[0] . "\n";
                }

                echo "\n";

            }
        }


    }
}
 