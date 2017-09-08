# Lucinda Framework API

This is the api that's going to be used by lucinda framework.

TODOS:
F @Framework: allow seting custom libraries path via constant
F @ServletsAPI: response content type should be configurable in route (<route ... extension="..."/>
F @ServletsAPI: <routes ref="XML_PATH"/>
F @Framework: remember original page and redirect to it in case of unauthorized/ok cycle
F @Framework: toggle IP checks on/off
F @Framework: add error author & mail error reporting (so RELEVANT users will be informed)
F @ErrorsAPI: if self::$objErrorHandler is not set, var dump exception
F @NoSQLAPI: add support for redis clusters
F @Oauth2Client: add refresh token support @ Driver
+ Caching API: client of NoSQLAPI
	+ HTTP caching
? @all APIs: add namespaces
? @all APIs: create different branches for each API so client sites won't be forced to update their code if a pull is done
F @SecurityAPI: make ip checks non-mandatory (to fix DHCP IP renewal)

Documentation:
- write docs for remaining api
- integrate framework documentation with apis
- show a dependency graph