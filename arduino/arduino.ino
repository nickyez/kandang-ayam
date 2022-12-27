#include <DHTesp.h>
#include <ESP8266WiFi.h>
#include <ESP8266HTTPClient.h>
#include <WiFiClient.h>
#include "ArduinoJson.h"

// init var
const int dhtPin = 14;
const int relayPin = 4;
DHTesp dht;

String deviceId = "A001";

const char *ssid = "hpAvero";
const char *password = "avero7899";
String baseUrl = "http://143.198.201.61/api/v1/" + deviceId;

unsigned long lastTime = 0;
unsigned long timerDelay = 5000;

void setup()
{
  // setup serial in baud 115200
  Serial.begin(115200);
  // setup pinOut data
  dht.setup(dhtPin, DHTesp::DHT11);
  pinMode(relayPin, OUTPUT);
  // setup connection to WIfi
  WiFi.begin(ssid, password);
  Serial.println("Connecting");
  while (WiFi.status() != WL_CONNECTED)
  {
    delay(500);
    Serial.print(".");
  }
  Serial.println("");
  Serial.print("Connected to WiFi network with IP Address: ");
  Serial.println(WiFi.localIP());
  Serial.println("Timer set to 5 seconds (timerDelay variable), it will take 5 seconds before publishing the first reading.");
  delay(10);
}

void loop()
{
  if ((millis() - lastTime) > timerDelay) {
    // Check WiFi connection status
    if (WiFi.status() == WL_CONNECTED)
    {
      WiFiClient wifiClient;
      HTTPClient http;
      // Code for Request Temperature and Humidity
      TempAndHumidity lastValues = dht.getTempAndHumidity();
      String temp = String(lastValues.temperature, 0);
      String humi = String(lastValues.humidity, 0);
      Serial.print("temp: ");
      Serial.print(temp + "    ");
      Serial.print("humi: ");
      Serial.println(humi);
      String serverPath = baseUrl + "/suhu?temp=" + temp + "&humi=" + humi;
      http.begin(wifiClient, serverPath.c_str());
      int httpResponseCode = http.GET();
      if (httpResponseCode > 0)
      {
        Serial.print("HTTP Response code: ");
        Serial.println(httpResponseCode);
        String payload = http.getString();
        Serial.println(payload);
      }
      else
      {
        Serial.print("Error code: ");
        Serial.println(httpResponseCode);
      }
      // Code for Lamp Control
      String serverPath2 = baseUrl + "/lampu";
      http.begin(wifiClient, serverPath2.c_str());
      int httpResponseCode2 = http.GET();
      if (httpResponseCode2 > 0)
      {
        char json[500];
        String payload = http.getString();
        payload.toCharArray(json, 500);
        StaticJsonDocument<384> doc;
        DeserializationError error = deserializeJson(doc, json);
        int lampStatus = doc["data"]["status"];
        Serial.println(lampStatus);
        if (lampStatus == 1)
        {
          digitalWrite(relayPin, LOW);
          Serial.print("nyala");
        } else {
          digitalWrite(relayPin, HIGH);
          Serial.print("mati");
        }
      }
      else
      {
        Serial.print("Error code: ");
        Serial.println(httpResponseCode2);
      }
      http.end();
    }
    else
    {
      Serial.println("WiFi Disconnected");
    }
    lastTime = millis();
  }
}
