<?php

namespace deefyprojet\auth;

use deefyprojet\repository\DeefyRepository;

abstract class AuthzProvider{

    public static function autorisation(int $idUser, int $idPl):bool
    {
        $res = false;
        $r = DeefyRepository::getInstance();

        $stmt = $r->getInstance()->getPDO()->prepare("SELECT id_pl FROM user2playlist WHERE id_user = ?");
        $stmt->execute([$idUser]);
        $tabId = $stmt->fetch();
        $keyId = array_search($idPl,$tabId);
        if(sizeof($tabId) > 0 && $keyId){
            $res = true;
        }
        return $res;
    }

}