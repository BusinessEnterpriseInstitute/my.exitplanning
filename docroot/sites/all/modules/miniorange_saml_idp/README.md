CONTENTS OF THIS FILE
---------------------

 * Introduction
 * Requirements
 * Installation
 * Configuration

INTRODUCTION
------------
Drupal SAML 2.0 IDP provides the ability to turn your Drupal site to an Identity Provider. SSO into any SP using your Srupal site as an IDP. We support all known Service Providers. If you need detailed instructions on setting up these SPs, we can give you step by step instructions.



CONFIGURATION
-------------
 * Configure user permissions in Administration » People » miniOrange SAML IDP Configuration:


   - Setup Customer account with miniOrange


     Create/Login with miniOrange by entering email address, phone number and
     password.


   - Identity Provider Setup.


     Make note of the Service Provider information. This will be required to configure your IdP.
	 Configure the Drupal site to act as a Identity Provider(IDP). Information such as SP Entity ID, ACS Url are taken from SP and stored here.


   - Service Provider Setup


     Make note of the Identity Provider information. This will be required to configure your SP.

