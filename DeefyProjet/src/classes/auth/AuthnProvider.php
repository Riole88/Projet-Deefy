<?php

namespace deefyprojet\auth;

use deefyprojet\repository\DeefyRepository;

abstract class AuthnProvider{
    
    public static function signin(string $email, string $mdp)
    {
        $r = DeefyRepository::getInstance();
        $hash = $r->getPasswd( $email );

        if (password_verify($mdp,$hash)){
            $_SESSION['userMail'] = $email;// auth OK
            $stmt = $r->getInstance()->getPDO()->prepare("SELECT id FROM user WHERE email = ?");
            $stmt->execute([$email]);
            $id = $stmt->fetchColumn();
            $_SESSION['userId'] = $id;
        }else {
            //auth KO
        }
    }

    public static function register(string $email, string $mdp)
    {
        $r = DeefyRepository::getInstance();

        $hashedPassword = password_hash($mdp, PASSWORD_DEFAULT);


        $stmt = $r->getInstance()->getPDO()->prepare("INSERT INTO user (email, passwd) VALUES (?, ?)");
        $stmt->execute([$email, $hashedPassword]);
    }
}