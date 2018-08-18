
import os
import re
import sys
import datetime
from datetime import timedelta
import json
import subprocess
import MySQLdb
import smtplib



# function for reading DHT22 sensors
def sensorReadings(gpio, sensor):
    configurations = getConfigurations()
    adafruit = configurations["adafruitpath"]

    sensorReadings = subprocess.check_output(['sudo', adafruit, sensor, gpio])

    try:
        # try to read neagtive numbers
        temperature = re.findall(r"Temp=(-\d+.\d+)", sensorReadings)[0]
    except:
        # if negative numbers caused exception, they are supposed to be positive
        try:
            temperature = re.findall(r"Temp=(\d+.\d+)", sensorReadings)[0]
        except:
            pass
    humidity = re.findall(r"Humidity=(\d+.\d+)", sensorReadings)[0]
    intTemp = float(temperature)
    intHumidity = float(humidity)

    return intTemp, intHumidity



# helper function for database actions. Handles select, insert and sqldumpings. Update te be added later
def databaseHelper(sqlCommand, sqloperation):
    configurations = getConfigurations()

    host = configurations["mysql"][0]["host"]
    user = configurations["mysql"][0]["user"]
    password = configurations["mysql"][0]["password"]
    database = configurations["mysql"][0]["database"]
    backuppath = configurations["sqlbackuppath"]

    data = ""

    db = MySQLdb.connect(host, user, password, database)
    cursor = db.cursor()

    if sqloperation == "Insert":
        try:
            cursor.execute(sqlCommand)
            db.commit()
        except:
            db.rollback()
            sys.exit(0)


    return data


# helper function for getting configurations from config json file
def getConfigurations():
    path = os.path.dirname(os.path.realpath(sys.argv[0]))

    # get configs
    configurationFile = path + '/config.json'
    configurations = json.loads(open(configurationFile).read())

    return configurations


def main():
    currentTime = datetime.datetime.now().strftime("%Y-%m-%d %H:%M:%S")

    configurations = getConfigurations()

    # how many sensors there is 1 or 2
    sensorsToRead = configurations["sensoramount"]

    # Sensor names to add to database, e.g. carage, outside
    sensor1 = configurations["sensors"][0]["sensor1"]
#
    # Sensor gpios
    gpioForSensor1 = configurations["sensorgpios"][0]["gpiosensor1"]



    sensorType = configurations["sensortype"]


    d = datetime.date.weekday(datetime.datetime.now())
    h = datetime.datetime.now()


    try:
        sensor1temperature, sensor1humidity = sensorReadings(gpioForSensor1, sensorType)

    except:

        pass



    # insert values to db
    try:

            sqlCommand = "INSERT INTO temperaturedata SET dateandtime='%s', sensor='%s', temperature='%s', humidity='%s'" % (
            currentTime, sensor1, sensor1temperature, sensor1humidity)
            databaseHelper(sqlCommand, "Insert")

    except:
        sys.exit(0)


if __name__ == "__main__":
    main()
