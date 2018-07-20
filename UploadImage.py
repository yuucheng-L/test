import sys
import requests
import time
import json

img = sys.argv[1]

url = 'http://59.124.69.148:10000/'
user_key='160916'
application="humanpose;face_recognition;classfu"#"humanpose;face_recognition"#'humanpose;classfu'##;classfu;face_recognition'
url_upload =url+'upload?user_key='+user_key+'&application='+application ##'http://59.124.69.148:10000/upload?user_key=2231&application=humanpose;classfu;face_recognition'
files = {'media': open('InputImg/'+img, 'rb')}
#print(url_upload)
Data=requests.post(url_upload, files=files)
#print(type(Data))


Json_Data=Data.json()
Data_ID=Json_Data["Data_ID"]
Data_ID=str(Data_ID[1:-1])

#print(Data_ID)
Json_Data=1
continued=1

while(continued):
    url_getdata = "http://59.124.69.148:10000/getdata?img_id="+Data_ID
    ##print(url_getdata)
    Data=requests.get(url_getdata)
    ##print(Data.text)
    Buffer=Data.text
    
    
    #print(Buffer)
    #print(type(Data))
    #print(Data.json())
    Json_Data=Data.json()
    #print(len(Json_Data["Statu"]))

    
    Data_Statu=Json_Data["Data"]
    
    Data_Statu=str(Data_Statu)
    #print(Data_Statu)
    Data_Statu = json.loads(Data_Statu)
    
    #print(Data_Statu["status"])
    #Data_Statu_JSON=json.load(Data_Statu)
    #print(Data_Statu_JSON["status"])

    if(Data_Statu["status"]=="finish"):
        continued=0
        #face_recognition_data_JSON=Json_Data["Data"]
        ##print(face_recognition_data_JSON)
    #print(Json_Data)
    '''
    for index in range(len(Json_Data["Statkkkggu"])):
        Data_Statu=Json_Data["Statu"][index][1]
        if(Data_Statu=="unprocess"):
            continued=1
            print(Data_Statu)
    '''
    #time.sleep(1)
# file_name=Data_ID+".json"
# with open(file_name, 'w') as outfile:
#     json.dump(Data_Statu,outfile)

# print(Data_Statu["classfu_img"])
# print(Data_Statu["humanpose_img"])
# print(Data_Statu["face_recognition_img"])
#print(Data_ID)


data = { 'classfu_img' : Data_Statu["classfu_img"], 'humanpose_img' : Data_Statu["humanpose_img"], 'face_recognition_img' : Data_Statu["face_recognition_img"]}
json = json.dumps(data)
print(json)





