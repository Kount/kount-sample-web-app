# kount-sample-web-app

Simple e-commerce site that integrates Kount Services

This basic web application is a simplified representation of a standard customer purchase process including:
* shopping cart review
* customer data verification
* transaction result

The web application integrates a few of the Kount Fraud Detection services -- the Kount Data Collector, Kount Risk Inquiry Service (RIS) and Kount Access PHP API.

#### Kount Data Collector

The Kount Data Collector is a service used to gather information for the customer provided by the device they use. The collected data includes: standard device fingerprints, IP address, Internet Service Provider, geo-location based on the customer's IP address and many more. The information obtained by the Data Collector service is stored for subsequent usage by Kount's fraud detection algorithms.

#### Kount Ris Inquiry service

This tool can make automated decisions for the level of fraud-likeliness of customer purchases. It uses various parameters:
* purchase details -- items and item descriptions, prices, item quantities, etc.
* customer details -- customer provided data for name, e-mail address, billing and shipping address, customer age and gender, etc.
* information collected by the Kount Data Collector

#### Kount Access PHP  

This library allows you to connect to the Kount Access API services and get information back from your login transactions.

#### Using Kount's PHP SDK

There are two ways to integrate this web application with Kount's sdk: 

* Composer installation   
    To use installation with composer, it is required to run a single command in the root of the web application.
  ```php
  $ composer install
  ```
    This will install a version of Kount's PHP SDK, currently it's working with the latest(6.5.2, https://github.com/Kount/kount-ris-php-sdk/releases)
    
* Direct Download  
  To use installation with direct download, you need to download the latest version(6.5.2, from Downloads: https://github.com/Kount/kount-ris-php-sdk/releases) into a folder and place it in the root of the web application.
  You will also need to change a line in the response.php file.
  ```php
  //Composer Installation
  include('./vendor/autoload.php');
  
     to
     
  //Direct Download   
  include('./Folder-containing-PHP-SDK/src/autoload.php');   
  ```

You will also need to add a bit of configuration, so that everything runs smoothly.

Once you have a merchantId and url, you must provide them for the kount access and ris sdks, which the demo uses.

* The quickest way to configure the demo application is to set the merchant id and url in the **config.ini** file 
  in the root directory of the project. The config.ini is a custom settings file which makes adding configurations  
  easier and avoids the hassle of manually re-adding the merchant id and url, everytime there are updates with the   
  other kount products.
  
  

* You can still use the src/settings.ini file but you'll have to re-configure it every time there is an update with kount's 
  ris php sdk and kount access sdk versions.  
  If you've used composer installation the src folder is located in: 
  ```php
  $ cd path-to-web-app/vendor/kount/kount-ris-php-sdk/src/settings.ini
  ```
  If you've used the direct download option the src folder is located in:
  ```php
  $ cd path-to-web-app/Folder-containing-PHP-SDK/src/settings.ini
  ```


