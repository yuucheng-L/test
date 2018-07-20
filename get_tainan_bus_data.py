import requests
import json

payload= {
    'stopnamecht': '工研院南分院',
    'Lang': 'cht',
    'Pathid': '1502',
    'Type': '2'
}

response = requests.post("http://2384.tainan.gov.tw/NewTNBusAPI_V2/API/CrossRoutes.ashx", data = payload)

lists = json.loads(response.text)

target_location = {
    '0': 'Wangye Temple',
    '1': 'Sinying Bus Station or Lioujia'
}
for e in lists:
    for element in e['info']:
        hours = 0
        minutes = int(element['TimeId'])
        if minutes < 0:
            if minutes == -3:
                print('The final bus go for', target_location[element['GoBack']], 'has departed.')
            elif minutes == -1:
                print('The bus go for', target_location[element['GoBack']], 'has not started.')
            elif minutes == -2:
                print('The bus go for', target_location[element['GoBack']], 'was just left.')
            else:
                print('No data.')
            continue
        if minutes >= 60:
            hours += minutes // 60
            minutes %= 60
        time = ''
        if hours == 0:
            time += str(minutes) + ' minutes'
        elif hours == 1:
            time += str(hours) + ' hour ' + str(minutes) + ' minutes'
        else:
            time += str(hours) + ' hours ' + str(minutes) + ' minutes'
        print('The bus go for ' + target_location[element['GoBack']] + ' arrives in ' + time + '.')