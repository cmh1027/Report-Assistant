#-*-coding: utf-8-*-
# html 뉴스만 크롤링 가능
from bs4 import BeautifulSoup
import urllib.request
import urllib.parse
from urllib.request import Request, urlopen
import sys

keyword = sys.argv[1]
params={'pz':'1', 'tbm':'nws', 'cf':'all', 'ned':'kr', 'hl':'ko', 'q':keyword}
encoded=urllib.parse.urlencode(params)
req = Request("https://www.google.com/m/search?"+encoded, headers={'User-Agent': 'Mozilla/5.0'})
webpage = urlopen(req).read()
soup = BeautifulSoup(webpage, 'html.parser', from_encoding='utf-8')
header = soup.find_all("h3", class_="r")
content = soup.find_all("div", "st")
info = soup.find_all("div", "slp")
news_number=0
index=0
data=""
if(len(header)==0):
	data="No data"
else:
	while(news_number<4):
		href = header[index].contents[0]['href'].replace('/url?q=', '')
		if href.find('.html')!=-1:
			data+="".join(str(v) for v in header[index].contents[0].contents).replace('<b>', '').replace('</b>', '')+'\n'
			data+=urllib.request.unquote(header[index].contents[0]['href'].replace('/url?q=', ''))[0:href.find('.html')+5]+'\n'
			data+=info[index].contents[0].contents[0]+'\n'
			for k in range(len(content[index].contents)):
				if not isinstance(content[index].contents[k], str):
					content[index].contents[k] = content[index].contents[k].contents[0]
			data+="".join(str(v) for v in content[index])+"\n"
			index+=1
			news_number+=1
		else:
			index+=1
		if(index==len(header)):
			break

f = open("search.txt", 'w', encoding='UTF8')
f.write(data)
f.close()