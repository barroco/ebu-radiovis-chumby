Chumby Radio FM application including RadioVIS features developed by EBU for IBC 2010 to demonstrate RadioDNS and RadioVIS functionalities.

[RadioVIS specifications](http://www.radiodns.org/docs)

# Structure #

## chumbradiod ##
chumbradiod daemon was modified to add the PI code to the reply of a radio status request.

## xmlproxy ##
Xmlproxy uses [php-radiodns project](http://code.google.com/p/php-radiodns/) to retrieve the RadioDNS informations to locate radioVIS services without making on device the DNS request.

## chumbradiovis ##
This is the chumby application which implements the client side of RadioVIS.

# Versions #
RadioVIS specification : 1.0.0
Flash Lite :