#!/usr/bin/env python3
# -*- coding:utf-8 -*-

import os

def getFiles(dir, suffix):
    res = []
    for root, directory, files in os.walk(dir):
        for filename in files:
            name, suf = os.path.splitext(filename)
            if suf == suffix:
                res.append(os.path.join(root, filename))
    return res

def isEnc(file):
    try:
        f = open(file, 'r', encoding='utf-8')
        data = f.read()
        return data.find('$O00OO0') != -1
    except:
        return False

for file in getFiles("./", '.php'):
    if not isEnc(file):
        continue
    print(file)
    p = os.popen('php -d extension=evalhook.so "' + file + '"')
    x = p.read()
    f = open(file, 'w')
    f.write(x)
