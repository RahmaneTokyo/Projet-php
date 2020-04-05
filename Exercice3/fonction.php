<?php

    // Fonction qui compte le nombre d'éléments d'une chaine ou d'un tableau
    
    function long_chaine($car) {
        if (isset($car)) {
            $i=0;
            for ($j=0; isset($car[$i]); $j++) {
                $i++;
            }
            return $i;
        }
    }

    // Autre methode
    
    function taille_chaine($chaine){
        $i=0;
        while(isset($chaine[$i])){
            $i++;
        }
        return $i;
    }

    // Fonction qui vérifie si un caractère est une lettre minuscule

    function is_minuscule($car) {
        if ( long_chaine($car) == 1 && ($car >= 'a' && $car <= 'z') ) {
            return true;
        }
        return false;
    }

    // Fonction qui vérifie si un caractère est une lettre majuscule

    function is_majuscule($car) {
        if ( long_chaine($car) == 1 && ($car >= 'A' && $car <= 'Z') ) {
            return true;
        }
        return false;
    }


    // Fonction qui teste si le caratère est un chiffre

    function is_car_numeric($car) {
        if ($car >='0' && $car <='9') {
            return true;
        }
        return false;
    }

    // Fonction qui teste si un caractère est alphabétique

    function is_car_alpha ($car) {
        if( long_chaine($car) == 1 && ( ($car >= "a" && $car <= "z" ) || ($car >= "A" && $car <= "Z" ) ) ){
            return true;
        }
        return false;
    }

    // Fonction qui teste si tous les caractères d'une chaine sont alphabetiques

    function is_chaine_alpha($chaine){
        For($i=0; $i<long_chaine($chaine); $i++){
            If (!is_car_alpha($chaine[$i])){
                return false;
            }
        }
        return true;
    }

    // Fonction qui teste si tous les caractères d'une chaine sont numériques

    function is_chaine_numeric($chaine){
        for($i=0; $i<long_chaine($chaine); $i++){
            If (!is_car_numeric($chaine[$i])){
                return false;
            }
        }
        return true;
    }

    // Fonction qui vérifie si un caractère est présent dans une chaine

    function is_car_present_in_chaine($car,$chaine) {
        for ($i=0; $i<long_chaine($chaine); $i++) {
            if ($car == $chaine[$i]) {
                return true;
            }
        }
        return false;
    }

    // Fonction qui permet d'inverser la casse d'une lettre et qui retourne un caractère non alphabétique

    function invers_car_case($car) {
        $min='abcdefghijklmnopqrstuvwxyz';
        $maj='ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        if ( long_chaine($car) == 1 && is_car_alpha($car) ) {
            for ($i=0; $i<26; $i++){
                if ($car == $min[$i]) {
                    return $maj[$i];
                }
                if ($car == $maj[$i]) {
                    return $min[$i];
                }
            }
        }else {
            return $car;
        }
    }

    // Autre méthode

    function invert_car_case($car){
        $min = 'a';
        $max = 'A';
        if(long_chaine($car)==1){
           for ($i=0; $i < 26; $i++) { 
               if ($car==$min) {
                   return $max;
               }elseif ($car==$max) {
                   return $min;
               }
               $min++;
               $max++;
           }
        }
        return $car;
    }

    // Fonction qui vérifie si une chaine est vide ou pas

    function is_empty($chaine) {
        if (long_chaine($chaine)==0) {
            return true;
        }
        return false;
    }

    // Fonction qui supprime les espaces avant et apres une chaine

    function delete_spc_before_after($chaine){
        $debut=0;
        $fin=long_chaine($chaine)-1;
        $newChaine = '';
    
        if($chaine == ''){
            return $chaine;
        }
        while ($chaine[$debut] == ' '){
            $debut++; 
            if(!isset($chaine[$debut])){
                return '';
            } 
        }
        while ($chaine[$fin]==' '){
            $fin--;
        }
        for ($i = $debut; $i <= $fin ; $i++) { 
            $newChaine.= $chaine[$i];
        }
        return $newChaine;
    }

    // Fonction qui vérifie si une phrase commence par une lettre majuscule et se termine par un point

    function is_sentence($sentence) {
        if(preg_match("#[\.\?\!]{2,}#",$sentence)){
            return false;
        }
        if (preg_match('#^[A-Z].+[.!?]$#',$sentence)) {
                return true;
        }
        return false;
    }

    // Fonction qui supprime les espaces avant et apres la chaine ainsi que les espaces inutiles dans la chaine

    function delete_spc_beetween_before_after($texte) {
        $texte = trim($texte);
        $texte = preg_replace('/[ ]{2,}/',' ',$texte);
        return $texte;
    }