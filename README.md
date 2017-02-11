This file use TransitLand Platform API (https://transit.land/documentation/datastore/api-endpoints.html for docs).

1) Search your bus stop by lat and long . [Example](https://transit.land/api/v1/stops?lat=40.36183&lon=18.16866)
2) Search "onestop_id" . on 1) [Example](s-srhvt7tyqw-le~br~cityterminal)
3) Save timesqr.php on your server and than open with "id" parameter. [Example](www.piersoft.it/gtfstutorial/timesqr.php?id=s-srhvt7tyqw-le~br~cityterminal)

that's all.

Simple idea: print one QRCode on every bus stop. On each qrcode insert link with "onestop_id" parameter on link to timesqr.php. 
