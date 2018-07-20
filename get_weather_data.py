import requests
from bs4 import BeautifulSoup

res = requests.get("https://works.ioa.tw/weather/towns/台南-六甲區.html")
# res.encoding = "utf-8"
soup = BeautifulSoup(res.text,"html5lib")

names = soup.select("section div span b")
datas = soup.select("section div span")

ret = ''
for i in range(0, len(names) - 1):
    name = str(names[i]).replace('<b>', '').replace('：</b>', '')
    data = str(datas[i]).replace(str(names[i]), '').replace('<span>', '').replace('</span>', '').replace('Â°c', '')
    pre = ''
    if i == 0:
    	pre += 'Current Temperature'
    elif i == 1:
    	pre += 'Current Humidity'
    elif i == 2:
    	pre += 'Rainfall'
    elif i == 3:
    	pre += 'Sunraise'
    elif i == 4:
    	pre += 'Sunset'
    ret += pre + ': ' + data + '\n'

print(ret)