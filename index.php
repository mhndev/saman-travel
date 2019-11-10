<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


use mhndev\samanTravel\SamanTravelSoapClient;

include 'vendor/autoload.php';


$azki_travisa = new SamanTravelSoapClient('ws@AZKI_webTravis', 'Ws35@9gRtpok22n');

die('here');

/*
//Getting All of the countries
$countries = $azki_travisa->getCountries();

//Getting first country
$first_country_title = $countries->getCountriesResult->TISCountryInfo[0]->title;

$durations_of_stay = $azki_travisa->getDurationsOfStay();

$country_detail = $azki_travisa->getCountry(2);

$plan_detail = $azki_travisa->getPlansWithDetail(2,'1990-09-19T00:00:00' ,31);

$plan_detail_by_code = $azki_travisa->getPlan(149);

$price_detail = $azki_travisa->getPriceInquiry(2, '1990-09-19T00:00:00', 31,149);

// BEGIN Register insurance
$insurance_data = [
    'nationalCode'      => '3830066181',
    'firstName'         => 'حمید',
    'lastName'          => 'غلامی',
    'latinFirstName'    => 'Hamid',
    'latinLastName'     => 'Gholami',
    'birthDate'         => '1990-09-19T00:00:00',
    'mobile'            => '09187866813',
    'email'             => 'hamidgholamy@yahoo.com',
    'gender'            => 1,
    'birthPlace'        => 'سنندج',
    'passportNo'        => '123456789',
    'postCode'          => '1234567899',
    'countryCode'       => 2,
    'durationOfStay'    => 31,
    'travelKind'        => 1,   // 1 is single, 2 is multi
    'planCode'          => 149,
];

$insurance_data = $azki_travisa->generateInsuranceInsertData($insurance_data);
$registered_insurance = $azki_travisa->registerInsurance($insurance_data);
// END Register insurance

$confirmed_insurance = $azki_travisa->confirmInsurance('6501687');

$getted_insurance = $azki_travisa->getInsurance('6501687');

$insurance_print_info = $azki_travisa->getInsurancePrintInfo('6501687');

$cancelation_result = $azki_travisa->cancelInsurance('6501687');

$customer_info_array = [
    'nationalCode'      => '2640083279',
    'fisrtName'         => 'حمید', //fisrtName is a spelling error from travis guys
    'lastName'          => 'غلامی',
    'firstNameLatin'    => 'Hamid',
    'lastNameLatin'     => 'Gholami',
    'gender'            => 1, //1 == male and 2 == female
    'birthDate'         => '1990-09-19T00:00:00',
    'birthPlace'        => '',
    'mobile'            => '',
    'email'             => '',
    'postCode'          => ''
];

$register_customer_result = $azki_travisa->registerCustomer($customer_info_array);

$customer = $azki_travisa->getCustomer('2640083279');

$germany_duration_of_stays = $azki_travisa->getCountryDurationsOfStay(2);

$country = $azki_travisa->getCountryByStandardCode('IR');

$plans = $azki_travisa->getPlans(2, '1990-09-19T00:00:00', 31);

$customer_info_array = [
    'nationalCode'      => '2640083279',
    'firstName'         => 'محمود',
    'lastName'          => 'کهنسال',
    'firstNameLatin'    => 'Mahmood',
    'lastNameLatin'     => 'Kohansal',
    'isIranian'         => 1,
    'gender'            => 1, //1 == male and 2 == female
    'birthDate'         => '1990-09-19T00:00:00',
    'birthPlace'        => 'aa',
    'mobile'            => '',
    'email'             => '',
    'postCode'          => ''
];

$edit_customer_result = $azki_travisa->editCustomer($customer_info_array);
*/
