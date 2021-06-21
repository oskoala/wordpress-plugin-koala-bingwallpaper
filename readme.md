# 考拉开源 WordPress 必应壁纸插件

> 考拉开源必应壁纸插件主页：https://www.oskoala.com/wordpress-plugin-koala-bingwallpaper

> 插件预览地址：https://www.wuzhixiang.cn/index.php/bing/

> github地址：https://github.com/oskoala/wordpress-plugin-koala-bingwallpaper

## 安装

### 第一步：
github项目主页下载到插件压缩包。

### 第二步：
登录 WordPress 后台 >> 插件 >> 安装插件 >> 上传插件 >> 选择第一步下载的压缩包 >> 现在安装。

## 配置

### 第一步：
因项目需要定时采集图片信息所以需要配置定时任务

Linux系统

一、进入crontab 编辑页面
```shell
crontab -e
```
二、 在最下方添加一行 注意域名要换成自己的
```
* * * * * wget --output-document=/dev/null https://www.wuzhixiang.cn/wp-cron.php
```

Windows系统

一、创建cron.bat文件填入如下信息  注意域名要换成自己的
```shell
powershell Invoke-WebRequest https://www.wuzhixiang.cn/wp-cron.php
```
二、配置计划任务 
具体请参考：https://blog.csdn.net/xinpo66/article/details/81238982

### 第二步：
添加必应壁纸页面

首先确保插件已正常启动。

WordPress 后台首页>>页面>>新建页面>>填写页面标题，选择页面模板【必应壁纸】>>点击发布按钮。

注意：页面创建以后能看到页面的访问链接，链接可以自定义，该链接即为必应壁纸访问链接。

## 插件信息

一、图片存储在\wp-content\uploads\bing 按照年份月份划分文件夹。

二、插件启动后自动创建数据表koala_bing_images用于保存插件产生的数据信息，插件卸载删除后数据库和图片文件不会自动删除，如需删除请手动处理[此处为了避免删除被不小心删除]。

