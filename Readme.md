- 工程目录结构
```powershell
PS D:\STUDENT47\phpLearning2> tree /F /A
|   .editorconfig [code的配置文件]
|   composer.json [包管理器的配置文件]
|   composer.lock [包管理器的配置文件]
|   LICENSE [协议]
|   Readme.md 
|
+---.vscode
|       settings.json [code的配置文件]
|
+---App [model&controller文件夹]
|   \---Http
|       \---Controllers
|               TestController.php
|
+---myFrame [框架相关的基础文件]
|       App.php [路由检测&请求分发]
|       Request.php [获取&处理phpinfo]
|
+---public [公共入口文件夹]
|       .htaccess [分布式配置文件]
|       htaccessBackup [分布式配置文件备份]
|       index.php [单一入口&路由配置]
|
\---vendor [composer的拓展包安装目录]
    |   autoload.php
    |
    +---composer 的 autoload 包
    |
    \--- [其他拓展包]
```

