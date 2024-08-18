# 冰心网络验证 V3.1 全解密去授权版
需要的PHP插件  php-mbstring  php-gd
安装nginx 和  php及插件
sudo apt install nginx php-mysql php-fpm php-curl php-xml php-gd php-mbstring php-memcached php-zip

开放80端口
sudo iptables -I INPUT -p tcp --dport 80 -j ACCEPT
sudo netfilter-persistent save
sudo netfilter-persistent reload

sudo nano /etc/nginx/sites-available/default
在server模块中，修改或添加以下内容
location ~ \.php$ {
        include snippets/fastcgi-php.conf;
        fastcgi_pass unix:/run/php/php8.1-fpm.sock;
    }

设置网站根目录的权限
sudo chown -R www-data:www-data /var/www

重启nginx服务
sudo systemctl restart nginx

重启PHP-FPM服务
sudo systemctl restart php8.1-fpm

