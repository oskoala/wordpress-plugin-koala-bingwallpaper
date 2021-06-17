# 考拉开源必应壁纸

> 考拉开源必应壁纸项目主页：https://www.oskoala.com/biyingbizhi

项目预览地址：https://www.wuzhixiang.cn/index.php/bing/

github地址：

## 安装
第一步：github项目主页下载到插件压缩包。

第二步：登录wordpress后台 >> 插件 >> 安装插件 >> 上传插件 >> 选择第一步下载的压缩包 >> 现在安装。

## 配置

因项目需要定时采集图片信息所以需要配置定时任务
Linux系统

```shell
第一步
crontab -e # 进入crontab 编辑页面
第二步 在最下方添加一行
* * * * * wget https://www.wuzhixiang.cn/wp-cron.php   #域名换成自己的
```

Windows系统

```shell
一、创建cron.bat文件填入如下信息：
powershell Invoke-WebRequest https://www.wuzhixiang.cn/wp-cron.php # 域名换成自己的
二、配置计划任务 
具体请参考：https://blog.csdn.net/xinpo66/article/details/81238982
```

## 插件信息

一、图片存储在\wp-content\uploads\bing 按照年份月份划分文件夹。

二、插件启动后自动创建数据表koala_bing_images用于保存插件产生的数据信息，插件卸载删除后数据库和图片文件不会自动删除，如需删除请手动处理[此处为了避免删除被不小心删除]。

