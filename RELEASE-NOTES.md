
kount-sample-web-app 1.3.1
==========================
**06/30/2017**

### Bugfixes
* fixed a bug on Firefox and IE - vertical scroll on the pop-up window for the full RIS response was missing.   

kount-sample-web-app 1.3.0
==========================
**06/29/2017**

### Improvements
* replaced the iframe data collector device with Kount's js data collector device(It's using a js script and an image tags).
* refactored the path including Kount's php sdk, to be compatible with other operational systems(Linux, OS X).

kount-sample-web-app 1.2.0
==========================
**06/27/2017**

### New Features
* changed the font-family for the entire web app

### Improvements
* added the correct url provided by Kount
* included the latest version(6.5.2) of Kount's php sdk in composer.json
* made the table used to visualize the RIS response fields, expandable in a separate window with the full list of fields

kount-sample-web-app 1.1.0
==========================
**06/22/2017**

### New Features
* integrated a Kount Data Collector call to obtain user device information

### Improvements
* some of the request parameters have actual values depending on the user

### Bugfixes
* removed a small visual bug only present on firefox

kount-sample-web-app 1.0.0
==========================
**06/19/2017**

### New Features
* basic e-commerce site design
* standard RIS call with predefined parameters
* ability to receive different responses from RIS (approved, review, declined)
