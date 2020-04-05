<?php

    // Fonction qui supprime les espaces inutiles dans une chaine

    function delete_spc_into($texte) {
        $texte = preg_replace('/[ ]{2,}/',' ',$texte);
        $texte = preg_replace("/\s'\s/","'",$texte);
        $texte = preg_replace("/\s\,\s/",', ',$texte);
        $texte = preg_replace("/\s\/\s/",'/',$texte);
        $texte = preg_replace("/\s\./",'.',$texte);
        $texte = preg_replace("/\s\!/",'!',$texte);
        $texte = preg_replace("/\s\?/",'?',$texte);
        $texte = preg_replace("/\s\;\s/",'; ',$texte);
        $texte = preg_replace("/\s\:\s/",': ',$texte);
        return $texte;
    }

    // Fonction qui supprime les espaces inutiles dans une phrase correcte

    function delete_spc_into_sentence($texte) {
        if (is_sentence($texte)) {
            $texte = delete_spc_into($texte);
            return $texte;
        }
        return false;
    }

    // Fonction qui permet de decouper des phrases

    function cut($texte) {
        $texte = preg_split('/([^.!?]+[.!?]+)/',$texte, -1, PREG_SPLIT_DELIM_CAPTURE | PREG_SPLIT_NO_EMPTY);
        return $texte;
    }

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

    // Fonction qui vérifie si une phrase est correcte

    function is_sentence($sentence) {
        if(preg_match("#[.?!]{2,}#",$sentence)){
            return false;
        }
        if (preg_match('#^[A-Z].+[.!?]$#',$sentence)) {
                return true;
        }
        return false;
    }

    function is_empty($chaine) {
        if (long_chaine($chaine)==0) {
            return true;
        }
        return false;
    }