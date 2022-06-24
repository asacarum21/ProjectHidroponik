#include <ESP8266WiFi.h>
#include <WiFiClient.h> 
#include <ESP8266WebServer.h>
#include <ESP8266HTTPClient.h>

char ssid[] = "Shark2";
char pass[] = "qwertyui";
char host[] = "192.168.43.90"; 


int sensor1 = D4;
int sensor2 = D3;
int relay = D6;
int relay2 = D7;
int sensorValue = 0;
int sensorValue1 = 0;

float tinggiTandon = 0;
float tinggiAir = 0;
float panjangSensor = 4.0;
int nilaiMax = 1023;

void setup() {
  pinMode(relay,OUTPUT);
  pinMode(relay2,OUTPUT);
  digitalWrite(relay,LOW);
  digitalWrite(relay2, LOW);

  delay(1000);
  Serial.begin(115200); // mengatur boudrate komunikasi serial antara arduino dengan PC
  WiFi.mode(WIFI_OFF);        //Prevents reconnection issue (taking too long to connect)
  delay(1000);
  WiFi.mode(WIFI_STA);

  WiFi.begin(ssid, pass);     //Connect to your WiFi router
  Serial.println("");
 
  Serial.print("Connecting");
  // Wait for connection
  while (WiFi.status() != WL_CONNECTED) {
    delay(500);
    Serial.print(".");
  }
  
  //If connection successful show IP address in serial monitor
  Serial.println("");
  Serial.print("Connected to ");
  Serial.println(ssid);
  Serial.print("IP address: ");
  Serial.println(WiFi.localIP()); 

  
}

void loop() {
  // put your main code here, to run repeatedly:
  //digitalWrite(relay,LOW);
  //digitalWrite(relay2,LOW);
  
  sensorValue = analogRead(sensor1);
  sensorValue1 = analogRead(sensor2);// membaca tengan dari sensor dalam bentuk integer
  tinggiTandon = sensorValue1*panjangSensor/nilaiMax;
  tinggiAir = sensorValue*panjangSensor/nilaiMax;
 
  //Post Data
  
  Serial.println(sensorValue);
  Serial.println(sensorValue1);
  String postData,status1,status2;
  status1 = String(tinggiTandon);
  status2 = String(tinggiAir);
  Serial.println(status1);
  Serial.println(status2);
  
  postData = "status1=" + status1 + "&status2=" + status2 ;
  
  HTTPClient http; 
  http.begin("http://192.168.43.90/iot/post.php");              //Specify request destination
  http.addHeader("Content-Type", "application/x-www-form-urlencoded");
  
  int httpCode = http.POST(postData);   //Send the request
  String payload = http.getString();    //Get the response payload
 
  Serial.println(httpCode);   //Print HTTP return code
  Serial.println(payload);    //Print request response payload
 
  http.end();  //Close connection
  
  delay(15000);  //Post Data at every 15 seconds
  
}
