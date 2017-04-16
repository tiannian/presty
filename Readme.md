# presty
A lightweight RESTful API framework based PHP.
## Installation
If you use composer to manage your project:
```
composer require tiannian/presty
```
If you are using it directly, you can download it into your project or use git:
```
git clone http://github.com/tiannian/presty
```

## Requirements
* php > 5.3 or php > 7.0

## HTTP Server Configuration
You need to configure your http server to use presty.Redirect all requests to the entry file you specified by your http server configuration.
### Nginx
If you want to redirect all requests to  `/api` to index.php, add the following configuration to the location section.
```
location /api{
	include fastcgi_params;
	fastcgi_pass 127.0.0.1:9000;
	fastcgi_param index.php;
}
```
## Usage

### Entry File
Use composer:
```
require 'vendor/autoload.php';
```
Use directly:
```
require 'path-to-presty/src/app.php';
```
### Path Match
Presty will find the file according to the requested path. When the folder does not exist, it looks for a folder that begins with an underscore.When you find the file that requested the path to point, presty will follow <filename>.<method>.php to match file.When this file does not exist, it will go to find out if there is a file with an underscore in the path.

Files in the same directory are allowed to have the same name as the folder, but only one file and folder with an underscore allowed in the directory is allowed.

When a file or folder that matches an underscore appears, presty records the name and path in the url_match of the request array.
### Request Array
Request array `$ resty_request` is a global variable, in any php file can be accessed. The request array contains information for each request.
* `url` Request URL
* `url_match` A record of the path and file name
* `query` The query string parameters parsed into an array
* `query_str` Query string
* `charset` The value of Accept-Charset 
* `body` The body string parsed into an array by `json_decode`
* `method` Request method
* `headers` Request headers
* `hostname` Remote Hostname
* `ip` Remote IP
* `port` Remote Port

### Response Array
The response array `$ resty_response` is a global variable that can be accessed in any php file. The response array can be modified in the php file, and the data is returned to the client based on the data recorded in the array.
* `status` HTTP Status Code
* `headers` Response headers
* `redirect` Redirect URL
* `body` The response body array is parsed as a json string sent to the client

# presty
一个基于PHP的轻量RESTful API 框架
## 安装
如果你使用composer环境的项目:
```
composer require tiannian/presty
```
如果你希望直接使用，你可以通过git下载框架
```
git clone http://github.com/tiannian/presty
```

## 依赖
* php > 5.3 or php > 7.0

## HTTP 服务器配置
您需要配置您的http服务器以使用presty，通过配置将所有请求重定向至你指定的入口文件。
### Nginx
If you want to redirect all requests to  `/` to index.php, add the following configuration to the location section.
```
location /{
	include fastcgi_params;
	fastcgi_pass 127.0.0.1:9000;
	fastcgi_param index.php;
}
```
## 使用

### 入口文件
使用composer :
```
require 'vendor/autoload.php'
```
直接使用:
```
require 'path-to-presty/src/app.php
```
### 路径匹配
presty会根据请求路径依次查找文件树，当文件夹不存在，它会寻找以下划线开头的文件夹。查找到请求路径指向的文件时，presty会按照文件名.请求方法.php匹配文件。当此文件不存在，它会去查找路径中是否存在以下划线开头的文件。

同目录下的文件允许与文件夹同名，但同目录下仅允许出现一个以下划线开头的文件和文件夹。

当出现匹配以下划线开头的文件或文件夹时，presty会将对应的名称与路径记录在请求数组的url_match中。
### 请求数组
请求数组`$resty_request`是一个全局变量，在一个php文件中均可以访问到。请求数组中包含了每一次请求的信息。
* url 请求路径
* url_match 路径与文件名的对应记录
* query 将查询参数字符串进行解析并以数组的形式返回
* query_str 查询参数字符串
* charset Accept-Charset值
* body 被json_decode解析为数组的请求体
* method 请求方法
* headers 请求头数组
* hostname 请求远程主机名
* ip 请求远程地址
* port 请求远程端口

### 响应数组
响应数组`$resty_response`是一个全局变量，在任何一个php文件中均可以访问到。响应数组在php文件中可以修改，修改后会根据数组中记录的数据向客户端返回数据。
* status 返回HTTP状态码
* headers 返回的响应头
* redirect 此次请求会被重定向至指定URL
* body 相应体数组，会被解析为json字符串发送给客户端
