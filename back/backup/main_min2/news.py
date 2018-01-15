#-*-coding: utf-8-*-
import sys
from newspaper import Article

url = sys.argv[1] 
article = Article(url)
article.download()
article.parse()
f = open("result.txt", 'w', encoding='UTF8')
f.write(article.text)
f.close()