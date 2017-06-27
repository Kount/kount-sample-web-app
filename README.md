# kount-sample-web-app

Simple e-commerce site that integrates Kount Services

This basic web application is a simplified representation of a standard customer purchase process including:
* shopping cart review
* customer data verification
* transaction result

The web application integrates two of the Kount Fraud Detection services -- the Kount Data Collector and the Kount Risk Inquiry Service (RIS). It is written in PHP and uses the Kount RIS PHP SDK.

#### Kount Data Collector

The Kount Data Collector is a service used to gather information for the customer provided by the device they use. The collected data includes: standard device fingerprints, IP address, Internet Service Provider, geo-location based on the customer's IP address and many more. The information obtained by the Data Collector service is stored for subsequent usage by Kount's fraud detection algorithms.

#### Kount Ris Inquiry service

This tool can make automated decisions for the level of fraud-likeliness of customer purchases. It uses various parameters:
* purchase details -- items and item descriptions, prices, item quantities, etc.
* customer details -- customer provided data for name, e-mail address, billing and shipping address, customer age and gender, etc.
* information collected by the Kount Data Collector
