 <h3>
 What is travisa php package
 </h3>
 <p>
 This package has been designed to use travisa travel insruance easy and fast;
 </p>
 
 <h4>How to use ... </h4>
 Creating a new instance of object
 ~~~
 $azki_travisa = new AzkiTravisa('****', '****');
 ~~~
 
 <h4>Getting List Of Countries</h4>
 ~~~
 $countries = $azki_travisa->getCountries();
 ~~~
 Here is a sample output of getCountries
 ~~~
 stdClass Object
     (
         [getCountriesResult] => stdClass Object
         (
             [TISCountryInfo] => Array
             (
                 [0] => stdClass Object
                 (
                     [errorCode] => -1
                     [errorText] =>
                     [code] => 2
                     [title] => ‏آلمان‏
                     [zoneCode] => -1
                     [standardCode] => DE
                 )
                 [1] => stdClass Object
                 (
                     [errorCode] => -1
                     [errorText] =>
                     [code] => 3
                     [title] => ‏انگلستان‏
                     [zoneCode] => -1
                     [standardCode] => UK
                 )
                 [2] => stdClass Object
                 (
                     [errorCode] => -1
                     [errorText] =>
                     [code] => 4
                     [title] => ‏ايتاليا‏
                     [zoneCode] => -1
                     [standardCode] => IT
                 )
             )
         )
     )
~~~
<h4>

</h4>