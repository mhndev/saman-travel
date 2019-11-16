<?php
namespace mhndev\samanTravel;

use mhndev\samanTravel\Exception\ApiResponseException;
use mhndev\samanTravel\Exception\ApiSamanTravelCallingException;
use SoapClient;
use SoapFault;
use stdClass;

/**
 * Class SamanTravelSoapClient
 * @package mhndev\travel\saman
 */
class SamanTravelSoapClient implements iSamanTravelClient
{

    /**
     * @var string
     */
    private $user_name;

    /**
     * @var string
     */
    private $password;

    /**
     * @var string
     */
    private $base_url;

    /**
     * @var SoapClient
     */
    private $soap_client;

    /**
     * SamanTravelSoapClient constructor.
     * @param string $username
     * @param string $password
     * @param string $url
     */
    public function __construct(string $url, string $username, string $password)
    {
        $this->base_url = $url;
        $this->user_name    = $username;
        $this->password     = $password;
    }

    /**
     * @return SoapClient
     * @throws APIResponseException
     */
    private function getSoapClient()
    {
        if(! is_null($this->soap_client)) {
            return $this->soap_client;
        }

        ini_set('default_socket_timeout', 600);

        try{
            $this->soap_client = new SoapClient(
                $this->base_url,
                ['exception' => true, 'trace' => 1]
            );

            return $this->soap_client;
        }

        catch (\Exception $e) {

            if (
                get_class($e) == SoapFault::class &&
                strpos($e->getMessage(), "SOAP-ERROR: Parsing WSDL: Couldn't load from") !== false
            ) {
                throw new ApiResponseException;
            }

            else {
                throw new APIResponseException($e->getMessage());
            }
        }

    }

//    /**
//     * @param string $wsdl_url
//     * @return SoapClient
//     * @throws Exception
//     */
//    private function setSoapClient(string $wsdl_url)
//    {
//        // options for ssl in php 5.6.5
//        $opts = array (
//            'ssl' => array(
//                'ciphers'           => 'RC4-SHA',
//                'verify_peer'       => false,
//                'verify_peer_name'  => false
//            )
//        );
//
//        // SOAP 1.2 client
//        $params = array (
//            'encoding'              => 'UTF-8',
//            'verifypeer'            => false,
//            'verifyhost'            => false,
//            'soap_version'          => SOAP_1_2,
//            'trace'                 => 1,
//            'exceptions'            => 1,
//            'connection_timeout'    => 180,
//            'stream_context'        => stream_context_create($opts)
//        );
//
//        try {
//            return new SoapClient($wsdl_url, $params);
//        }
//        catch (Exception $e) {
//            throw new Exception('Unable to create SOAP client!');
//        }
//
//    }

    /**
     * @return stdClass
     * @throws ApiResponseException
     * @throws ApiSamanTravelCallingException
     * @sample
     * stdClass Object
     * (
     * [getCountriesResult] => stdClass Object
     * (
     * [TISCountryInfo] => Array
     * (
     * [0] => stdClass Object
     * (
     * [errorCode] => -1
     * [errorText] =>
     * [code] => 2
     * [title] => ‏آلمان‏
     * [zoneCode] => -1
     * [standardCode] => DE
     * )
     * [1] => stdClass Object
     * (
     * [errorCode] => -1
     * [errorText] =>
     * [code] => 3
     * [title] => ‏انگلستان‏
     * [zoneCode] => -1
     * [standardCode] => UK
     * )
     * [2] => stdClass Object
     * (
     * [errorCode] => -1
     * [errorText] =>
     * [code] => 4
     * [title] => ‏ايتاليا‏
     * [zoneCode] => -1
     * [standardCode] => IT
     * )
     * )
     * )
     * )
     */
    function getCountries()
    {
        try{
            $countries = $this->getSoapClient()->getCountries([
                'username'      => $this->user_name,
                'password'      => $this->password
            ]);
        }
        catch (SoapFault $e) {
            throw new ApiSamanTravelCallingException($e->getMessage());
        }

        return $countries;
    }


//    /**
//     * @param $name
//     * @param $arguments
//     */
//    function __call($name, $arguments)
//    {
//        try{
//            return call_user_func_array([$this, $methodName], $args);
//        }
//        catch (SoapFault $e) {
//            throw new ApiAsmariCallingException($e->getMessage());
//        }
//
//    }


    /**
     * @return mixed
     * @throws ApiResponseException
     * @throws ApiSamanTravelCallingException
     */
    function getDurationsOfStay()
    {
        try {
            $durations_of_stay = $this->getSoapClient()->getDurationsOfStay([
                'username'      => $this->user_name,
                'password'      => $this->password
            ]);
        } catch (SoapFault $e) {
            throw new ApiSamanTravelCallingException($e->getMessage());
        }

        return $durations_of_stay;
    }


    /**
     * @param int $country_code
     * @param string $birth_date
     * @param int $duration_of_stay_code
     * @return mixed
     * @throws ApiResponseException
     * @throws ApiSamanTravelCallingException
     */
    function getPlansWithDetail(int $country_code, string $birth_date, int $duration_of_stay_code)
    {
        try {
            $plan_detail = $this->getSoapClient()->getPlansWithDetail([
                'username'          =>$this->user_name,
                'password'          =>$this->password,
                'countryCode'       => $country_code,
                'birthDate'         => $birth_date,
                'durationOfStay'    => $duration_of_stay_code
            ]);
        } catch (SoapFault $e) {
            throw new ApiSamanTravelCallingException($e->getMessage());
        }

        return $plan_detail;
    }

    /**
     *
     */
    function getCredit()
    {
        // TODO: Implement getCredit() method.
    }


    /**
     * @param int $country_code
     * @return mixed
     * @throws ApiResponseException
     * @throws ApiSamanTravelCallingException
     */
    function getCountry(int $country_code)
    {
        try {
            $country_detail = $this->getSoapClient()->getCountry([
                'username'      =>$this->user_name,
                'password'      =>$this->password,
                'countryCode'   => $country_code
            ]);

        } catch (SoapFault $e) {
            throw new ApiSamanTravelCallingException($e->getMessage());
        }

        return $country_detail;
    }


    /**
     * @param int $plan_code
     * @return stdClass
     * @throws ApiResponseException
     * @throws ApiSamanTravelCallingException
     */
    function getPlan(int $plan_code)
    {
        try {
            $plan_detail = $this->getSoapClient()->getPlan([
                'username'      =>$this->user_name,
                'password'      =>$this->password,
                'planCode'      => $plan_code
            ]);

        } catch (SoapFault $e) {
            throw new ApiSamanTravelCallingException($e->getMessage());
        }

        return $plan_detail;
    }


    /**
     * @param int $country_code
     * @param string $birth_date
     * @param int $duration_of_stay
     * @param int $plan_code
     * @return stdClass
     * @throws ApiResponseException
     * @throws ApiSamanTravelCallingException
     */
    function getPriceInquiry(int $country_code, string $birth_date, int $duration_of_stay, int $plan_code)
    {
        try {
            $price_info = $this->getSoapClient()->getPriceInquiry([
                'username'          =>$this->user_name,
                'password'          =>$this->password,
                'countryCode'       => $country_code,
                'birthDate'         => $birth_date,
                'durationOfStay'    => $duration_of_stay,
                'planCode'          => $plan_code
            ]);

        } catch (SoapFault $e) {
            throw new ApiSamanTravelCallingException($e->getMessage());
        }

        return $price_info;
    }

    /**
     * @param stdClass $TIS_insurance_info
     * $insurance_data = (object) [
     * 'nationalCode'      => '3830066181',
     * 'firstName'         => 'حمید',
     * 'lastName'          => 'غلامی',
     * 'latinFirstName'    => 'Hamid',
     * 'latinLastName'     => 'Gholami',
     * 'birthDate'         => '1990-09-19T00:00:00',
     * 'mobile'            => '09187866813',
     * 'email'             => 'hamidgholamy@yahoo.com',
     * 'gender'            => 1,
     * 'birthPlace'        => 'سنندج',
     * 'passportNo'        => '123456789',
     * 'postCode'          => '1234567899',
     * 'countryCode'       => 2,
     * 'durationOfStay'    => 31,
     * 'travelKind'        => 1,   // 1 is single, 2 is multi
     * 'planCode'          => 149,
     * ];
     * @return stdClass registerInsuranceResult
     * @throws ApiResponseException
     * @throws ApiSamanTravelCallingException
     */
    function registerInsurance(stdClass $TIS_insurance_info)
    {
        try {
            $insurance_info = $this->getSoapClient()->registerInsurance([
                'username'          =>$this->user_name,
                'password'          =>$this->password,
                'insuranceData'     => $TIS_insurance_info
            ]);

        } catch (SoapFault $e) {
            throw new ApiSamanTravelCallingException($e->getMessage());
        }

        return $insurance_info;
    }

    /**
     * @param int $bimeh_no
     * @return stdClass registerInsuranceResult
     * @throws ApiResponseException
     * @throws ApiSamanTravelCallingException
     */
    function confirmInsurance(int $bimeh_no)
    {
        try {
            $confirmed_insurance = $this->getSoapClient()->confirmInsurance([
                'username'          =>$this->user_name,
                'password'          =>$this->password,
                'bimehNo'           => $bimeh_no
            ]);

        } catch (SoapFault $e) {
            throw new ApiSamanTravelCallingException($e->getMessage());
        }

        return $confirmed_insurance;
    }

    /**
     * @param string $serial_no
     * @return stdClass getInsuranceResult
     * @throws ApiResponseException
     * @throws ApiSamanTravelCallingException
     */
    function getInsurance(string $serial_no)
    {
        try {
            $confirmed_insurance = $this->getSoapClient()->getInsurance([
                'username'          =>$this->user_name,
                'password'          =>$this->password,
                'serialNo'           => $serial_no
            ]);

        } catch (SoapFault $e) {
            throw new ApiSamanTravelCallingException($e->getMessage());
        }

        return $confirmed_insurance;
    }

    /**
     * @param string $serial_no
     * @return stdClass getInsurancePrintInfoResult
     * @throws ApiResponseException
     * @throws ApiSamanTravelCallingException
     */
    function getInsurancePrintInfo(string $serial_no)
    {
        try {
            $insurance_print_info = $this->getSoapClient()->getInsurancePrintInfo([
                'username'          =>$this->user_name,
                'password'          =>$this->password,
                'serialNo'           => $serial_no
            ]);

        } catch (SoapFault $e) {
            throw new ApiSamanTravelCallingException($e->getMessage());
        }

        return $insurance_print_info;
    }

    /**
     * @param string $serial_no
     * @return stdClass cancelInsuranceResult
     * @throws ApiResponseException
     * @throws ApiSamanTravelCallingException
     */
    function cancelInsurance(string $serial_no)
    {
        try {
            $cancelation_result = $this->getSoapClient()->cancelInsurance([
                'username'          =>$this->user_name,
                'password'          =>$this->password,
                'serialNo'           => $serial_no
            ]);

        } catch (SoapFault $e) {
            throw new ApiSamanTravelCallingException($e->getMessage());
        }

        return $cancelation_result;
    }

    /**
     * @param array $array_customer_info
     * @return stdClass registerCustomerResult
     * @throws ApiResponseException
     * @throws ApiSamanTravelCallingException
     * @sample
     * stdClass Object
     * (
     * [registerCustomerResult] => stdClass Object
     * (
     * [errorCode] => -1
     * [errorText] => بیمه گزار با کد ملی 3830066181، نام : حمید غلامی و تاریخ تولد 1369/06/28 و اتباع 1 در تراویس وجود دارد.
     * [code] => 3307996
     * [nationalCode] => 3830066181
     * [firstName] => حمید
     * [lastName] => غلامی
     * [firstNameLatin] => Hamid
     * [lastNameLatin] => Gholami
     * [isMale] => 1
     * [birthDate] => 1990-09-19T00:00:00
     * [birthPlace] => سنندج
     * [mobile] => 09187866813
     * [email] => hamidgholamy@yahoo.com
     * )
     * )
     */
    function registerCustomer (array $array_customer_info)
    {
        $array_customer_info['username'] = $this->user_name;
        $array_customer_info['password'] = $this->password;

        try {
            $customer_info = $this->getSoapClient()->registerCustomer($array_customer_info);
        } catch (SoapFault $e) {
            throw new ApiSamanTravelCallingException($e->getMessage());
        }

        return $customer_info;
    }

    /**
     * @param string $national_code
     * @return stdClass getCustomerResult
     * stdClass Object
     * @throws ApiResponseException
     * @throws ApiSamanTravelCallingException
     * @sample
     * (
     * [getCustomerResult] => stdClass Object
     * (
     * [errorCode] => -1
     * [errorText] =>
     * [code] => 3307996
     * [nationalCode] => 3830066181
     * [firstName] => حمید
     * [lastName] => غلامی
     * [firstNameLatin] => Hamid
     * [lastNameLatin] => Gholami
     * [isMale] => 1
     * [birthDate] => 1990-09-19T00:00:00
     * [birthPlace] => سنندج
     * [mobile] => 09187866813
     * [email] => hamidgholamy@yahoo.com
     * )
     * )
     */
    function getCustomer(string $national_code)
    {
        $array = [
            'username'          => $this->user_name,
            'password'          => $this->password,
            'nationalCode'      => $national_code
        ];

        try {
            $customer_info = $this->getSoapClient()->getCustomer($array);
        } catch (SoapFault $e) {
            throw new ApiSamanTravelCallingException($e->getMessage());
        }

        return $customer_info;
    }

    /**
     * @param array $array_customer_info
     * @return  mixed
     * @throws ApiResponseException
     * @throws ApiSamanTravelCallingException
     * @sample
     * stdClass Object
     * (
     * [editCustomerResult] => stdClass Object
     * (
     * [errorCode] => -1
     * [errorText] =>
     * [code] => 3307996
     * [nationalCode] => 3830066181
     * [firstName] => علی
     * [lastName] => غلامی
     * [firstNameLatin] => Ali
     * [lastNameLatin] => Gholami
     * [isMale] =>
     * [birthDate] => 1990-09-19T00:00:00
     * [birthPlace] => aa
     * [mobile] => 09187866813
     * [email] => hamidgholamy@yahoo.com
     * )
     *
     * )
     */
    function editCustomer(array $array_customer_info)
    {
        $array_customer_info['username'] = $this->user_name;
        $array_customer_info['password'] = $this->password;

        try {
            $customer_info = $this->getSoapClient()->editCustomer($array_customer_info);
        } catch (SoapFault $e) {
            throw new ApiSamanTravelCallingException($e->getMessage());
        }

        return $customer_info;
    }

    /**
     * @param string $national_code
     * @param string $passport_number
     * @param int $country_code
     * @return mixed
     * @throws ApiResponseException
     * @throws ApiSamanTravelCallingException
     */
    function getCustomerInsurances(string $national_code, string $passport_number, int $country_code)
    {
        try {
            $customer_insurances = $this->getSoapClient()->getCustomerInsurances([
                'username'          => $this->user_name,
                'password'          => $this->password,
                'nationalCode'      => $national_code,
                'passportNo'        => $passport_number,
                'countryCode'       => $country_code
            ]);
        } catch (SoapFault $e) {
            throw new ApiSamanTravelCallingException($e->getMessage());
        }

        return $customer_insurances;
    }

    /**
     * @param int $country_code
     * @return stdClass
     * @throws ApiResponseException
     * @throws ApiSamanTravelCallingException
     * @sample
     * stdClass Object
     * (
     * [getCountryDurationsOfStayResult] => stdClass Object
     * (
     * [TISDurationOfStay] => Array
     * (
     * [0] => stdClass Object
     * (
     * [errorCode] => -1
     * [errorText] =>
     * [title] => 7 روزه
     * [value] => 7
     * )
     *
     * [1] => stdClass Object
     * (
     * [errorCode] => -1
     * [errorText] =>
     * [title] => 15 روزه
     * [value] => 15
     * )
     * )
     * )
     * )
     */
    function getCountryDurationsOfStay(int $country_code)
    {
        try {
            $duration_of_stays = $this->getSoapClient()->getCountryDurationsOfStay([
                'username'          => $this->user_name,
                'password'          => $this->password,
                'countryCode'      => $country_code
            ]);
        } catch (SoapFault $e) {
            throw new ApiSamanTravelCallingException($e->getMessage());
        }

        return $duration_of_stays;
    }

    function setInsuranceContractInfo()
    {
        // TODO: Implement setInsuranceContractInfo() method.
    }

    function registerInsuranceIO()
    {
        // TODO: Implement registerInsuranceIO() method.
    }

    /**
     * @param string $country_standard_code
     * @return stdClass
     * @throws ApiResponseException
     * @throws ApiSamanTravelCallingException
     * @sample
     * stdClass Object
     * (
     * [getCountryByStandardCodeResult] => stdClass Object
     * (
     * [errorCode] => -1
     * [errorText] =>
     * [code] => 1
     * [title] => ایران
     * [zoneCode] => 1361
     * [zoneTitle] => تمامي مرزهاي ايران
     * [zoneTitleEnglish] => TouristZone_AllIranBorders
     * [standardCode] => IR
     * )
     * )
     */
    function getCountryByStandardCode(string $country_standard_code)
    {
        try {
            $country = $this->getSoapClient()->getCountryByStandardCode([
                'username'          => $this->user_name,
                'password'          => $this->password,
                'countryStandardCode'      => $country_standard_code
            ]);
        } catch (SoapFault $e) {
            throw new ApiSamanTravelCallingException($e->getMessage());
        }

        return $country;
    }

    /**
     * @param string|NULL $country_code
     * @param string|NULL $birth_date
     * @param int|NULL $duration_of_stay
     * @return stdClass getPlansResult
     * @throws ApiResponseException
     * @throws ApiSamanTravelCallingException
     * @sample
     * stdClass Object
     * (
     * [getPlansResult] => stdClass Object
     * (
     * [TISPlanInfoSimple] => Array
     * (
     * [0] => stdClass Object
     * (
     * [errorCode] => -1
     * [errorText] =>
     * [code] => 161
     * [title] => طرح  تفریحی طلایی (بدون پوشش بیماری های از قبل موجود)-وب سایت
     * [titleEnglish] => GOLDEN PLAN-70000EUR
     * [coverLimit] => 70.000EUR
     * )
     * [1] => stdClass Object
     * (
     * [errorCode] => -1
     * [errorText] =>
     * [code] => 162
     * [title] => طرح  تفریحی طلایی(همراه با پوشش بیماری های از قبل موجود)-وب سایت
     * [titleEnglish] => GOLDEN PLAN-60000EUR
     * [coverLimit] => 60.000EUR
     * )
     * [2] => stdClass Object
     * (
     * [errorCode] => -1
     * [errorText] =>
     * [code] => 159
     * [title] => طرح  تفریحی نقره ای (بدون پوشش بیماری های از قبل موجود)-وب سایت
     * [titleEnglish] => SILVER PLAN-35000EUR
     * [coverLimit] => 35.000EUR
     * )
     * )
     * )
     * )
     */
    function getPlans(
        string $country_code = NULL,
        string $birth_date = NULL,
        int $duration_of_stay = NULL
    )
    {
        try {
            $country = $this->getSoapClient()->getPlans([
                'username'          => $this->user_name,
                'password'          => $this->password,
                'countryCode'      => $country_code,
                'birthDate'         => $birth_date,
                'durationOfStay'    => $duration_of_stay
            ]);
        } catch (SoapFault $e) {
            throw new ApiSamanTravelCallingException($e->getMessage());
        }

        return $country;
    }

    function groupInsuranceRegister()
    {
        // TODO: Implement groupInsuranceRegister() method.
    }

    function groupInsuranceDelete()
    {
        // TODO: Implement groupInsuranceDelete() method.
    }

    function groupInsuranceConfirm()
    {
        // TODO: Implement groupInsuranceConfirm() method.
    }

    function groupInsuranceDetailList()
    {
        // TODO: Implement groupInsuranceDetailList() method.
    }

    function groupInsuranceDetailAdd()
    {
        // TODO: Implement groupInsuranceDetailAdd() method.
    }

    function groupInsuranceDetailDelete()
    {
        // TODO: Implement groupInsuranceDetailDelete() method.
    }

    function generateInsuranceInsertData(array $insurance_data) : stdClass
    {
        $object_insurance_data = (object) [
            'nationalCode'      => $insurance_data['nationalCode'],
            'firstName'         => $insurance_data['firstName'],
            'lastName'          => $insurance_data['lastName'],
            'latinFirstName'    => $insurance_data['latinFirstName'],
            'latinLastName'     => $insurance_data['latinLastName'],
            'birthDate'         => $insurance_data['birthDate'],
            'mobile'            => $insurance_data['mobile'],
            'email'             => $insurance_data['email'],
            'gender'            => $insurance_data['gender'],
            'birthPlace'        => $insurance_data['birthPlace'],
            'passportNo'        => $insurance_data['passportNo'],
            'postCode'          => $insurance_data['postCode'],
            'countryCode'       => $insurance_data['countryCode'],
            'durationOfStay'    => $insurance_data['durationOfStay'],
            'travelKind'        => $insurance_data['travelKind'],
            'planCode'          => $insurance_data['planCode'],
        ];

        return $object_insurance_data;

    }

}
