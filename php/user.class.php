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
  public static $photoDir = 'uploads/users/avatars/';
  public static $defaultPhoto = 'default_avatar.jpg';

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
    $this->birthDate = date("d.m.Y", strtotime($birthDate));
    $this->telephoneNumber = $telephoneNumber;

    if ($photo == null) {
      $this->photo = self::$defaultPhoto;
    } else {
      $this->photo = "$photo";
    }
  }

  public static function create() {
    $instanse = new self(null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null);
    return $instanse;
  }

  public function getAccountID() {
    return $this->accountID;
  }

  public function setAccountID($accountID) {
    $this->accountID = $accountID;
  }

  public function getEmail() {
    return $this->email;
  }

  public function setEmail($email) {
    $this->email = $email;
  }

  public function getPassword() {
    return $this->password;
  }

  public function setPassword($password) {
    $this->password = $password;
  }

  public function getUserType() {
    return $this->userType;
  }

  public function setUserType($userType) {
    $this->userType = $userType;
  }

  public function getRegistrationDate() {
    return $this->registrationDate;
  }

  public function setRegistrationDate($registrationDate) {
    $this->registrationDate = $registrationDate;
  }

  public function getStatus() {
    return $this->status;
  }

  public function setStatus($status) {
    $this->status = $status;
  }

  public function getSurname() {
    return $this->surname;
  }

  public function setSurname($surname) {
    $this->surname = $surname;
  }

  public function getName() {
    return $this->name;
  }

  public function setName($name) {
    $this->name = $name;
  }

  public function getMiddlename() {
    return $this->middlename;
  }

  public function setMiddlename($middlename) {
    $this->middlename = $middlename;
  }

  public function getCity() {
    return $this->city;
  }

  public function setCity($city) {
    $this->city = $city;
  }

  public function getInstitutionType() {
    return $this->institutionType;
  }

  public function setInstitutionType($institutionType) {
    $this->institutionType = $institutionType;
  }

  public function getInstitutionNumber() {
    return $this->institutionNumber;
  }

  public function setInstitutionNumber($institutionNumber) {
    $this->institutionNumber = $institutionNumber;
  }

  public function getGrade() {
    return $this->grade;
  }

  public function setGrade($grade) {
    $this->grade = $grade;
  }

  public function getGender() {
    return $this->gender;
  }

  public function setGender($gender) {
    $this->gender = $gender;
  }

  public function getBirthDate() {
    return $this->birthDate;
  }

  public function setBirthDate($birthDate) {
    $this->birthDate = $birthDate;
  }

  public function getTelephoneNumber() {
    return $this->telephoneNumber;
  }

  public function setTelephoneNumber($telephoneNumber) {
    $this->telephoneNumber = $telephoneNumber;
  }

  public function getPhoto() {
    return $this->photo;
  }

  public function setPhoto($photo) {
    $this->photo = $photo;
  }

  public function getAutoFill() {
    $autoFill = "&email=$this->email&usertype=$this->userType&surname=$this->surname&name=$this->name&middlename=$this->middlename&city=$this->city&institution_type=$this->institutionType&institution_number=$this->institutionNumber&grade=$this->grade&gender=$this->gender&birthdate=$this->birthDate&telephone=$this->telephoneNumber&photo=$this->photo";
    return $autoFill;
  }
}
