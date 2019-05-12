<?php
require 'config.inc.php';

class User { 
  private $accountID;
  private $email;
  private $password;
  private $userType;
  private $registrationDate;
  private $status;
  private $surname;
  private $name;
  private $middlename;
  private $city;
  private $institutionType;
  private $institutionNumber;
  private $grade;
  private $gender;
  private $birthDate;
  private $telephoneNumber;
  private $photo;

  public function __construct($accountID, $email, $password, $userType, $registrationDate, $status, $surname, $name, $middlename, $city, $institutionType, $institutionNumber, $grade, $gender, $birthDate, $telephoneNumber, $photo) {
    $this->accountID = $accountID;
    $this->email = $email;
    $this->password = $password;
    $this->userType = $userType;
    $this->registrationDate = $registrationDate;
    $this->status = $status;
    $this->surname = $surname;
    $this->name = $name;
    $this->middlename = $middlename;
    $this->city = $city;
    $this->institutionType = $institutionType;
    $this->institutionNumber = $institutionNumber;
    $this->grade = $grade;
    $this->gender = $gender;
    $this->birthDate = $birthDate;
    $this->telephoneNumber = $telephoneNumber;

    if ($photo == null) {
      $this->photo = 'uploads/users/avatars/default_avatar.jpg'; 
    } else {
      $this->photo = "uploads/users/avatars/$photo";
    }
  }
  
  public function getAccountID() {
    echo $this->accountID;
  }
  public function setAccountID($accountID) {
    $this->accountID = $accountID;
  }
  
  public function getEmail() {
    echo $this->email;
  }
  public function setEmail($email) {
    $this->email = $email;
  }
  
  public function getPassword() {
    echo $this->password;
  }
  public function setPassword($password) {
    $this->password = $password;
  }
  
  public function getUserType() {
    echo $this->userType;
  }
  public function setUserType($userType) {
    $this->userType = $userType;
  }
  
  public function getRegistrationDate() {
    echo $this->registrationDate;
  }
  public function setRegistrationDate($registrationDate) {
    $this->registrationDate = $registrationDate;
  }
  
  public function getStatus() {
    echo $this->status;
  }
  public function setStatus($status) {
    $this->status = $status;
  }
  
  public function getSurname() {
    echo $this->surname;
  }
  public function setSurname($surname) {
    $this->surname = $surname;
  }
  
  public function getName() {
    echo $this->name;
  }
  public function setName($name) {
    $this->name = $name;
  }
  
  public function getMiddlename() {
    echo $this->middlename;
  }
  public function setMiddlename($middlename) {
    $this->middlename = $middlename;
  }
  
  public function getCity() {
    echo $this->city;
  }
  public function setCity($city) {
    $this->city = $city;
  }

  public function getInstitutionType() {
    echo $this->institutionType;
  }
  public function setInstitutionType($institutionType) {
    $this->institutionType = $institutionType;
  }
  
  public function getInstitutionNumber() {
    echo $this->institutionNumber;
  }
  public function setInstitutionNumber($institutionNumber) {
    $this->institutionNumber = $institutionNumber;
  }

  public function getGrade() {
    echo $this->grade;
  }
  public function setGrade($grade) {
    $this->grade = $grade;
  }

  public function getGender() {
    echo $this->gender;
  }
  public function setGender($gender) {
    $this->gender = $gender;
  }

  public function getBirthDate() {
    echo $this->birthDate;
  }
  public function setBirthDate($birthDate) {
    $this->birthDate = $birthDate;
  }

  public function getTelephoneNumber() {
    echo $this->telephoneNumber;
  }
  public function setTelephoneNumber($telephoneNumber) {
    $this->telephoneNumber = $telephoneNumber;
  }

  public function getPhoto() {
    echo $this->photo;
  }
  public function setPhoto($photo) {
    $this->photo = $photo;
  }
}
?>