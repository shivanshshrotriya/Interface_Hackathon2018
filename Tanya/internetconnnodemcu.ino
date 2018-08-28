#include <ESP8266WiFi.h>

const char *ssid =  "NSF 2018";     // replace with your wifi ssid and wpa2 key
const char *pass =  "3dUQnk9z";     //password

WiFiClient client;
 
void setup() 
{
       pinMode(LED_BUILTIN,OUTPUT);
       digitalWrite(LED_BUILTIN,HIGH); //LED Off to indicate wifi not connected
       Serial.begin(9600);
       delay(10);
               
       Serial.println("Connecting to ");
       Serial.println(ssid); 
 
       WiFi.begin(ssid, pass); 
       while (WiFi.status() != WL_CONNECTED) 
          {
            delay(500);
            Serial.print(".");
          }
      Serial.println("");
      
      Serial.println("WiFi connected");
      if (WL_CONNECTED)  
       digitalWrite(LED_BUILTIN,LOW); //LED on indicating wifi connected
      
      
}
 
void loop() 
{      
  
}

