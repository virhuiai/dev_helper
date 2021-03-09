FROM php:7.4.8-apache
COPY ./sources.list /etc/apt/
COPY ./CodeIgniter4-4.0.4/ /ci4/

RUN apt-get update && apt-get upgrade -y

RUN apt-get install -y vim && \
apt-get install -y mlocate && \
updatedb

# 安装intl,mysqli
RUN apt-get update && \
    apt-get upgrade -y && \
    apt-get install -y --no-install-recommends  apt-transport-https libicu-dev && \
docker-php-ext-install -j$(nproc) intl && \
docker-php-ext-install mysqli

RUN rm -rf /var/lib/apt/lists/* && apt-get clean

# php.ini
RUN cp /usr/local/etc/php/php.ini-development /usr/local/etc/php/php.ini && \
sed -ri -e 's!;extension=mysqli!extension=mysqli!g' /usr/local/etc/php/php.ini
# 设置Apache目录
ENV APACHE_DOCUMENT_ROOT /ci4/public
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf && \
sed -ri -e 's!/var/www/!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/apache2.conf /etc/apache2/conf-available/*.conf
WORKDIR /ci4/public

# 可以直接下载 https://github.com/codeigniter4/CodeIgniter4/archive/v4.0.4.zip, 下面这句会生成  /ci4/v4.0.4.zip
# ADD https://github.com/codeigniter4/CodeIgniter4/archive/v4.0.4.zip /ci4/

#docker build -t ci404 .
# docker run -d -p 80:80 --rm --name tmpimg_c ci404
# cd /Users/virhuiaivirhuiai/Documents/virhuiai-github/dev_helper/spring_helper/CodeIgniter4-4.0.4
# docker run -d -p 80:80 --rm  -v $(pwd):/ci4/  --name tmpimg_c ci404