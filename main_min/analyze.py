from konlpy.utils import pprint
from konlpy.tag import Komoran
komoran = Komoran()

f = open("result.txt", 'r', encoding='UTF8')
strings = f.readlines()
f.close()
result = "".join(strings)
analysis = komoran.pos(u''+result)
NNPS = []
for i in analysis:
	if i[1]=="NNP":
		NNPS.append(i[0])
NNPS=list(set(NNPS))
dup = []
for i in NNPS:
	for j in NNPS:
		if i!=j:
			if i.find(j)!=-1 and j.find(i)==-1:
				dup.append(i)
			if j.find(i)!=-1 and j.find(i)==-1:
				dup.append(j)
NNPS = [y for y in NNPS if y not in dup]
for i in NNPS:
	result=result.replace(i, "<u>"+i+"</u>")
f = open("output.txt", 'w', encoding='UTF8')
f.write(result)
f.close()