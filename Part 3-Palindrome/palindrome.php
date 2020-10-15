<?php
    function isPalindrome($str){
        $strreverse = strrev($str);
        if (strcasecmp($str, $strreverse) == 0){
            echo $str . " is a Palindrome";
        }
        else{
            echo $str . " is not a Palindrome";
        }
    }
?>