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
  
  private $logo;

  public function __construct($eventID, $title, $logo, $country, $city, $street, $houseNumber, $cabinet, $startDate, $endDate, $site, $shortInfo, $fullInfo) {
    $this->eventID = $eventID;
    $this->title = $title;
    $this->country = $country;
    $this->city = $city;
    $this->street = $street;
    $this->houseNumber = $houseNumber;
    $this->cabinet = $cabinet;
    $this->startDate = $startDate;
    $this->endDate = $endDate;
    $this->site = $site;
    $this->shortInfo = $shortInfo;
    $this->fullInfo = $fullInfo;

    if ($logo == null) {
      $this->logo = 'uploads/events/logos/default_logo.png'; 
    } else {
      $this->logo = "uploads/events/logos/$logo";
    }
  }
  
  public function getEventID() {
    echo $this->eventID;
  }
  public function setEventID($eventID) {
    $this->eventID = $eventID;
  }
  
  public function getTitle() {
    echo $this->title;
  }
  public function setTitle($title) {
    $this->title = $title;
  }
  
  public function getLogo() {
    echo $this->logo;
  }
  public function setLogo($logo) {
    $this->logo = $logo;
  }
  
  public function getCountry() {
    echo $this->country;
  }
  public function setCountry($country) {
    $this->country = $country;
  }
  
  public function getCity() {
    echo $this->city;
  }
  public function setCity($city) {
    $this->city = $city;
  }
  
  public function getStreet() {
    echo $this->street;
  }
  public function setStreet($street) {
    $this->street = $street;
  }
  
  public function getHouseNumber() {
    echo $this->houseNumber;
  }
  public function setHouseNumber($houseNumber) {
    $this->houseNumber = $houseNumber;
  }
  
  public function getCabinet() {
    echo $this->cabinet;
  }
  public function setCabinet($cabinet) {
    $this->cabinet = $cabinet;
  }
  
  public function getStartDate() {
    echo $this->startDate;
  }
  public function setStartDate($startDate) {
    $this->startDate = $startDate;
  }
  
  public function getEndDate() {
    echo $this->endDate;
  }
  public function setEndDate($endDate) {
    $this->endDate = $endDate;
  }
  
  public function getSite() {
    echo $this->site;
  }
  public function setSite($site) {
    $this->site = $site;
  }

  public function getShortInfo() {
    echo $this->shortInfo;
  }
  public function setShortInfo($shortInfo) {
    $this->shortInfo = $shortInfo;
  }
  
  public function getFullInfo() {
    echo $this->statDate;
  }
  public function setFullInfo($fullInfo) {
    $this->fullInfo = $fullInfo;
  }
}
?>