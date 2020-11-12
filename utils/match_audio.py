from difflib import SequenceMatcher
from mp3_tagger import MP3File, VERSION_2
from os import walk,path
import json
import string
import mysql.connector

#Update this before running!
mydb = mysql.connector.connect(
  host="localhost",
  user="root",
  password="",
  database="trigedasleng"
)

mycursor = mydb.cursor()

def similar(a, b):
    return SequenceMatcher(None, a, b).ratio()

def clean_string(a):
    return a.translate(str.maketrans('', '', string.punctuation)).replace("’","").replace("'","").lower()

fname = []
for root,d_names,f_names in walk("./../public/audio"):
    for f in f_names:
        fname.append(path.join(root, f))

with open("translations.json") as f:
    data = json.load(f)

x = 1
for file in fname:
    if path.splitext(file)[1] == ".mp3":

        mp3 = MP3File(file)
        mp3.set_version(VERSION_2)

        # no title in meta data
        if not mp3.song:
            continue

        name = clean_string(mp3.song)
        for line in data:
            similarity = similar(clean_string(line['trigedasleng']), name)
            if similarity < 0.9:
                continue

            # check if audio is already set
            if not line['audio']:
                line['audio'] = file.replace("\\", "/")
                print(str(line['id']) + " = " + file.replace("\\", "/") + " - Similarity: " + str(similarity))
                sql = "UPDATE dict_translations SET audio = '"+ file.replace("\\", "/").replace('./../public/', '') + "' WHERE id = '"+ str(line['id']) +"'"
                mycursor.execute(sql)
                x+=1

print("Total: " + str(x))
mydb.commit()
print(mycursor.rowcount, "record(s) affected")

# Dump new data
with open('translations2.json', 'w') as outfile:
    json.dump(data, outfile, indent=4)

with open("translations2.json") as f2:
    data2 = json.load(f2)

y = 0
for line in data2:
    if line == "":
        continue
    if not line['audio'] and line['episode'] != "other" and not "070" in line['episode']:
        print(line['episode'] + " - " + line['trigedasleng'])
        y += 1

print("Total missing: " + str(y))
