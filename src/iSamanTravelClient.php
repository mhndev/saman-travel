<?php
namespace mhndev\samanTravel;

use stdClass;

/**
 * @package azkitravisa
 * Description About Methods:
 * In case of errors all of the methods would return the following output
 * stdClass Object
    * (
        * [getPlanResult] => stdClass Object
        * (
            * [errorCode] => 404
            * [errorText] => طرح مورد نظر یافت نشد.
            * [code] => 0
        * )
    * )
 */

interface iSamanTravelClient
{

    function getCountries();

    function getDurationsOfStay();

    function getPlansWithDetail(int $country_code, string $birth_date, int $duration_of_stay_code);

    function getCredit();

    function getCountry(int $country_code);

    /**
     * @param int $plan_code
     * @return stdClass
     * @sample
     * stdClass Object
    (
        [getPlanResult] => stdClass Object
        (
            [errorCode] => -1
            [errorText] =>
            [code] => 149
            [title] => طرح 30.000یورو وب سایت -همه کشورهای جهان
            [titleEnglish] => Web site plan-30000EUR
            [coverLimit] => 30000EUR
        )
    )
     */
    function getPlan(int $plan_code);

    /**
     * @param int $country_code
     * @param string $birth_date
     * @param int $duration_of_stay
     * @param int $plan_code
     * @return stdClass
     * @sample
     * stdClass Object
    (
        [getPriceInquiryResult] => stdClass Object
        (
            [errorCode] => -1
            [errorText] =>
            [countryCode] => 2
            [countryPriceCode] => 0
            [planCode] => 149
            [priceGross] => 686852
            [priceAvarez] => 20606
            [priceTax] => 41211
            [priceDiscount] => 0
            [priceTotal] => 748669
        )
    )
     */
    function getPriceInquiry(int $country_code, string $birth_date, int $duration_of_stay, int $plan_code);

    function registerInsurance(stdClass $TIS_insurance_info);

    function confirmInsurance(int $bimeh_no);

    function getInsurance(string $serial_no);

    function getInsurancePrintInfo(string $serial_no);

    function cancelInsurance(string $serial_no);

    function registerCustomer(array $array_customer_info);

    function getCustomer(string $national_code);

    function editCustomer(array $array_customer_info);

    function getCustomerInsurances(string $national_code, string $passport_number, int $country_code);

    function getCountryDurationsOfStay(int $country_code);

    function setInsuranceContractInfo();

    function registerInsuranceIO();

    function getCountryByStandardCode(string $countr_standard_code);

    function getPlans(string $country_code, string $birth_date, int $duration_of_stay);

    function groupInsuranceRegister();

    function groupInsuranceDelete();

    function groupInsuranceConfirm();

    function groupInsuranceDetailList();

    function groupInsuranceDetailAdd();

    function groupInsuranceDetailDelete();

}
