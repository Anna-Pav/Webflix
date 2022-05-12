<?php
#using a constant to keep the error message and re-use it
class Constants {
    public static $firstNameCharacters = "First name must be between 2 and 25 characters";
    public static $lastNameCharacters = "Last name must be between 2 and 25 characters";
    public static $usernameCharacters = "Username must be between 2 and 25 characters";
    public static $usernameTaken = "Username already exists!";
    public static $emailsDontMatch = "Emails don't match!";
    public static $emailInvalid = "Emails is invalid!";
    public static $emailTaken = "Emails is taken!";
    public static $passwordsDontMatch = "Passwords don't match!";
    public static $passwordLength = "Password must be between 6 and 20 characters";
    public static $loginFailed = "Username or password is incorrect";
    public static $passwordIncorrect = "Your old password is incorrect";

}
?>