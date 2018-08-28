

#include <ESP8266WiFi.h>
#include <ESP8266HTTPClient.h>
 
const char* ssid = "NSF 2018";
const char* password = "3dUQnk9z";
 
void setup () {

  pinMode(LED_BUILTIN,OUTPUT);
  digitalWrite(LED_BUILTIN,HIGH);
  Serial.begin(115200);
  WiFi.begin(ssid, password);
 
  while (WiFi.status() != WL_CONNECTED) {
 
    delay(1000);
    Serial.print("Connecting..");
 
  }
  Serial.print("Connected");
  if(WL_CONNECTED)
  digitalWrite(LED_BUILTIN,LOW);
}
 
void loop() {
 String ext;
  if (WiFi.status() == WL_CONNECTED) { //Check WiFi connection status
 
    HTTPClient http;  //Declare an object of class HTTPClient
 
    http.begin("http://api.openweathermap.org/data/2.5/forecast?q=Bangalore,IN&APPID=e602d93ba236a61bfcd50b3f42a8e04e&mode=json&units=metric&cnt=2");  //Specify request destination
    int httpCode = http.GET();                                                                  //Send the request
 
    if (httpCode > 0) { //Check the returning code
 
      String payload = http.getString();   //Get the request response payload
      ext=payload;
      Serial.println(ext);                     //Print the response ext
 
    }
 
    http.end();   //Close connection
 
  }
    
   
  int first=ext.indexOf('803');
  int last=ext.indexOf('04d');
  String subext=ext.substring(first,last);
  Serial.println(first);
  
  
 
  delay(30000);    //Send a request every 30 seconds
 
}
