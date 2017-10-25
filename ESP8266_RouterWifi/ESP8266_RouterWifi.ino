#include "ESP8266WiFi.h"

const char server[] = "www.000webhost.com"; 

const char* MY_SSID = "DTU";
const char* MY_PWD =  "";

WiFiClient client;


void setup()
{
  Serial.begin(115200);
//  dht.begin();
  Serial.print("Connecting to "+*MY_SSID);
  WiFi.begin(MY_SSID, MY_PWD);
  Serial.println("going into wl connect");

  while (WiFi.status() != WL_CONNECTED) //not connected,  ...waiting to connect
    {
      delay(1000);
      Serial.print(".");
    }
  Serial.println("wl connected");
  Serial.println("");
  Serial.println("Credentials accepted! Connected to wifi\n ");
  Serial.println("");
}

void loop() {
  int humi = 10;
  int temp = 20;
  
  Serial.print("Humidity: ");
  Serial.print(humi);
  Serial.print(" %\t");
  Serial.print("Temperature: ");
  Serial.print(temp);

  Serial.println("\nStarting connection to server..."); 
  // if you get a connection, report back via serial:
  if (client.connect(server, 80)) {
    Serial.println("connected to server");
    WiFi.printDiag(Serial);

    String data = "humi="+(String) humi+"&temp="+(String) temp;

    client.println("POST /session/connection_arduino.php HTTP/1.1"); //change this if using your Sub-domain
    client.print("Host: files.000webhost.com\n");                 //change this if using your Domain
    client.println("User-Agent: ESP8266/1.0");
    client.println("Connection: close"); 
    client.println("Content-Type: application/x-www-form-urlencoded");
    client.print("Content-Length: ");
    client.print(data.length());
    client.print("\n\n");
    client.print(data);
    client.stop(); 
    Serial.println("\n");
    Serial.println("My data string im POSTing looks like this: ");
    Serial.println(data);
    Serial.println("And it is this many bytes: ");
    Serial.println(data.length());       
    delay(2000);
  }
}

void printWifiStatus() {
  // print the SSID of the network you're attached to:
  Serial.print("SSID: ");
  Serial.println(WiFi.SSID());

  // print your WiFi shield's IP address:
  IPAddress ip = WiFi.localIP();
  Serial.print("IP Address: ");
  Serial.println(ip);

  // print the received signal strength:
  long rssi = WiFi.RSSI();
  Serial.print("signal strength (RSSI):");
  Serial.print(rssi);
  Serial.println(" dBm");
}



