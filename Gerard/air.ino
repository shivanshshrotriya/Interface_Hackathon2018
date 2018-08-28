

#include <MQ135.h>

#include <ESP8266WiFi.h>

#define VIRTUAL_PIN 5
#define ANALOGPIN A0


const char* ssid  = "TP-LINK_D6C8";
const char* password = "12345678";
const char* host = "kannadajanapada.xyz";
const char* passcode = "12345678";


// Switch pin numbers
#define SW1 5
#define SW2 4
int switch1, switch2;
MQ135 gasSensor = MQ135(ANALOGPIN);
int val;
int sensorPin = 0;
int sensorValue=0;
String url = "";
WiFiClient client;

// Wake from sleep, in seconds.
#define wakeuptime 30

void setup() {
  sensorValue = analogRead(0); 
  Serial.begin(115200);
  delay(10);
  Serial.println();
  Serial.println();
  Serial.print("Connecting to ");
  Serial.println(ssid);
  WiFi.begin(ssid, password);
  while (WiFi.status() != WL_CONNECTED) {
    delay(500);
    Serial.print(".");
  }
  Serial.println("");
  Serial.println("WiFi connected");
  Serial.println("IP address: ");
  Serial.println(WiFi.localIP());

  pinMode(SW1, INPUT_PULLUP);
  pinMode(SW2, INPUT_PULLUP);
  
  delay(5000);

 
}

void loop() {
 val = analogRead(A0);       // read analog input pin 0
  Serial.print ("raw = ");
  Serial.println (val);
  float zero = gasSensor.getRZero();
  Serial.print ("rzero: ");
  Serial.println (zero);
  float ppm = gasSensor.getPPM();
  Serial.print ("ppm: ");
  Serial.println (ppm);
  delay(5000); 

   // Connect to host
  Serial.print("Connecting to ");
  Serial.println(host);
  // Use WiFiClient class to create TCP connections
  const int httpPort = 80;
  if (!client.connect(host, httpPort)) {
    Serial.println("Connection failed!");
    return;
  }

  // Read switch values
  switch1 = digitalRead(SW1);
  switch2 = digitalRead(SW2);
  
  // Create a URL for the request. Modify YOUR_HOST_DIRECTORY so that you're pointing to the PHP file.
  url = "/air/uplive.php?ppm=";
   url += sensorValue;

  // This will send the request to the server
  Serial.print("Requesting URL: ");
  Serial.println(url);
  client.print(String("GET ") + url + " HTTP/1.1\r\n" +
               "Host: " + host + "\r\n" +
               "Connection: close\r\n\r\n");
  unsigned long timeout = millis();
  while (client.available() == 0) {
    if (millis() - timeout > 5000) {
      Serial.println(">>> Client Timeout !");
      client.stop();
      return;
    }
  }
/*
  // Read all the lines of the reply from server and print them to Serial
  while (client.available()) {
    String line = client.readStringUntil('\r');
    Serial.print(line);
  }
  */

  Serial.println();
  Serial.println("Closing connection");

  // Sleep
  Serial.println("Going to sleep");
  delay(5000);
  delay(5000);
  sensorValue = analogRead(0); 
}
