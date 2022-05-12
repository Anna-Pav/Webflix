<?php

    class FormSanitizer{

        #creating functions that sanitize user's input
        #and that can be called directly by the program

        #creating a function to sanitise user's input
        public static function sanitizeFormString($inputText){
            $inputText = trim($inputText); #removing spaces before and after username
            $inputText = ucfirst($inputText); #Capitalise first letter
            return $inputText;
        }

        public static function sanitizeFormUsername($inputText){
            $inputText = strip_tags($inputText); #removing tags
            $inputText = str_replace(" ","", $inputText); #replacing spaces
            return $inputText;
        }

        public static function sanitizeFormPassword($inputText){
            $inputText = strip_tags($inputText); #removing tags for security reasons
            return $inputText;
        }

        public static function sanitizeFormEmail($inputText){
            $inputText = strip_tags($inputText); #removing tags
            $inputText = trim($inputText); #removing spaces before and after username
            return $inputText;
        }


    }

?>