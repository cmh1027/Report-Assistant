# Report Assistant
## What is Report Assistant?
Report assistant searches a keyword you want and gets a recent news related to that keyword.
The Assistant automatically analyze contents of the news and underlines important words.
And then, you can share your report  and exchange opinions with others.

## Why is Report Assistant needed?
* It makes you save time for searching and analyzing the news
* It can be a community for sharing reports and communicating others about the topic.

## Requirements
* It doesn't support Mac and Linux for constructing server. Only windows
Processe for Analyzing is done by exec() php function.
A command string in exec() function is written for Windows
* Your php must not forbid exec() function. Check php.ini and enable it if it is disabled.
* You must install two open-source programs below. And of course, python3&pip must be installed. 
* webapp.sql file must be executed before constructing server
* It doesn't support Firefox Browser

## Install
* JPype
https://pypi.python.org/pypi/JPype1

Download it and setup it with command below

$ python setup.py build 

$ python setup.py install

This package is needed for KONLPY

* KONLPY - Korean natural language processing package
http://konlpy.org/ko/latest/#

$ pip install konlpy

$ python analyze.py (Any textfile named "result.txt" is needed)


All Commands above must work to construct a server.
Refer to the link above if an error occurs.

## What are used?
* HTML
* CSS and BootStrap
* Javascript(with JQuery), AJAX+JSON
* PHP
* MySQL
* Google Search API - "Custom search API" : https://console.developers.google.com/projectselector/apis/api/customsearch.googleapis.com/overview
* KONLPY (with Jpype)
* SmartEditor2 : https://github.com/naver/smarteditor2
* Snoopy.php : https://github.com/endroy/Snoopy
* Simple_html_dom.php : http://simplehtmldom.sourceforge.net/
* stmp.js : https://www.smtpjs.com/

## License
This library is free software; you can redistribute it and/or
modify it under the terms of the GNU Lesser General Public
License as published by the Free Software Foundation; either
v3 of the License, or (at your option) any later version.

This library is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the GNU
Lesser General Public License for more details.

You should have received a copy of the GNU Lesser General Public
License along with this library; if not, write to the Free Software