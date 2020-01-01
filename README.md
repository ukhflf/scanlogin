# scanlogin  
laravel-admin 企业微信扫码登陆扩展

## 框架及扩展要求  
PHP >= 7.0.0  
Laravel >= 5.5.0  
Laravel-admin >= 1.6.3  
easywechat >=4.2  
laravel-wechat >=5.0

## 安装
composer require ukhflf/scanlogin  
easywechat 安装 https://github.com/overtrue/wechat  
laravel-wechat 安装 https://github.com/overtrue/laravel-wechat  

## 配置
在根目录config/app.php providers 中添加 Ukhflf\Scanlogin\ScanloginServiceProvider::class  
发布配置信息 php artisan vendor:publish --provider="Ukhflf\Scanlogin\ScanloginServiceProvider"  
完成后会在config/ 文件夹中找到 scanlogin.php 分别填写您企业微信的appid、agentid、redirect_uri

## 扫码登陆页面
http://yourhost/admin/scanlogin








