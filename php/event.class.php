<?php
require 'config.inc.php';

class Event { 
  private $eventID;
  private $title;
  private $country;
  private $city;
  private $street;
  private $houseNumber;
  private $cabinet;
  private $startDate;
  private $endDate;
  private $site;
  private $shortInfo;
  private $fullInfo;
  private $isPublished;
  
  public static $defaultLogo = 'uploads/events/logos/default_logo.png';
  private $logo;

  public function __construct($eventID, $title, $logo, $country, $city, $street, $houseNumber, $cabinet, $startDate, $endDate, $site, $shortInfo, $fullInfo, $isPublished) {
    $this->eventID = $eventID;
    $this->title = $title;
    $this->country = $country;
    $this->city = $city;
    $this->street = $street;
    $this->houseNumber = $houseNumber;
    $this->cabinet = $cabinet;
    $this->startDate = date("d.m.Y G:i", strtotime($startDate));
    $this->endDate = date("d.m.Y G:i", strtotime($endDate));
    //date("Y-m-d h:i", strtotime($startDate)); //Обратная конвертация
    $this->site = $site;
    $this->shortInfo = $shortInfo;
    $this->fullInfo = $fullInfo;
    $this->isPublished = $isPublished;

    if ($logo == null) {
      $this->logo = self::$defaultLogo; 
    } else {
      $this->logo = "uploads/events/logos/$logo";
    }
  }
  
  public function getEventID() {
    return $this->eventID;
  }
  public function setEventID($eventID) {
    $this->eventID = $eventID;
  }
  
  public function getTitle() {
    return $this->title;
  }
  public function setTitle($title) {
    $this->title = $title;
  }
  
  public function getLogo() {
    return $this->logo;
  }
  public function setLogo($logo) {
    $this->logo = $logo;
  }
  
  public function getCountry() {
    return $this->country;
  }
  public function setCountry($country) {
    $this->country = $country;
  }
  
  public function getCity() {
    return $this->city;
  }
  public function setCity($city) {
    $this->city = $city;
  }
  
  public function getStreet() {
    return $this->street;
  }
  public function setStreet($street) {
    $this->street = $street;
  }
  
  public function getHouseNumber() {
    return $this->houseNumber;
  }
  public function setHouseNumber($houseNumber) {
    $this->houseNumber = $houseNumber;
  }
  
  public function getCabinet() {
    return $this->cabinet;
  }
  public function setCabinet($cabinet) {
    $this->cabinet = $cabinet;
  }
  
  public function getStartDate() {
    return $this->startDate;
  }
  public function setStartDate($startDate) {
    $this->startDate = $startDate;
  }
  
  public function getEndDate() {
    return $this->endDate;
  }
  public function setEndDate($endDate) {
    $this->endDate = $endDate;
  }
  
  public function getSite() {
    return $this->site;
  }
  public function setSite($site) {
    $this->site = $site;
  }

  public function getShortInfo() {
    return $this->shortInfo;
  }
  public function setShortInfo($shortInfo) {
    $this->shortInfo = $shortInfo;
  }
  
  public function getFullInfo() {
    return $this->fullInfo;
  }
  public function setFullInfo($fullInfo) {
    $this->fullInfo = $fullInfo;
  }

  public function getIsPublished() {
    return $this->isPublished;
  }

  public function getAutoFill() {
    $autoFill = "&title=$this->title&country=$this->country&city=$this->city&street=$this->street&houseNumber=$this->houseNumber&cabinet=$this->cabinet&startDate=$this->startDate&endDate=$this->endDate&site=$this->site";
    return $autoFill;
  }
}
?>