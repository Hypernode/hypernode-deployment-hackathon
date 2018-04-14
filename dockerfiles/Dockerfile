FROM ubuntu:16.04
MAINTAINER hackathon@hypernode.com
ARG DEBIAN_FRONTEND=noninteractive

RUN apt-get update && apt-get install -y --allow-downgrades --allow-remove-essential --allow-change-held-packages --allow-unauthenticated --no-install-recommends \
      software-properties-common \
      python-software-properties

RUN printf 'deb http://ubuntu.byte.nl xenial main hypernode percona php\ndeb http://security.ubuntu.com/ubuntu xenial-security main restricted universe multiverse\n' > /etc/apt/sources.list

RUN apt-get update && apt-get install -y --allow-downgrades --allow-remove-essential --allow-change-held-packages --allow-unauthenticated --no-install-recommends \
      blackfire-php \
      php-common \
      php-ext-snappy \
      php-hypernode \
      php-igbinary \
      php-imagick \
      php-ioncube \
      php-memcache \
      php-redis \
      php7.0 \
      php7.0-bcmath \
      php7.0-cli \
      php7.0-common \
      php7.0-curl \
      #php7.0-fpm \
      php7.0-gd \
      php7.0-imap \
      php7.0-intl \
      php7.0-json \
      php7.0-ldap \
      php7.0-mbstring \
      php7.0-mcrypt \
      php7.0-mysql \
      php7.0-odbc \
      php7.0-opcache \
      php7.0-pgsql \
      php7.0-pspell \
      php7.0-readline \
      php7.0-soap \
      php7.0-sybase \
      php7.0-tidy \
      php7.0-xml \
      php7.0-xmlrpc \
      php7.0-zip \
      php7.1 \
      php7.1-bcmath \
      php7.1-cli \
      php7.1-common \
      php7.1-curl \
      #php7.1-fpm \
      php7.1-gd \
      php7.1-imap \
      php7.1-intl \
      php7.1-json \
      php7.1-ldap \
      php7.1-mbstring \
      php7.1-mcrypt \
      php7.1-mysql \
      php7.1-odbc \
      php7.1-opcache \
      php7.1-pgsql \
      php7.1-pspell \
      php7.1-readline \
      php7.1-soap \
      php7.1-sybase \
      php7.1-tidy \
      php7.1-xml \
      php7.1-xmlrpc \
      php7.1-zip \
      mysql-common \
      percona-server-client-5.6 \
      percona-server-server-5.6 \
      python \
      python-mysqldb \
      python-pip \
      curl \
      rsync \
      zip \
      tar \
      nodejs \
      git \
      openssh-client \
      openssh-server \
      && curl --silent --show-error https://getcomposer.org/installer | php \
      && mv /composer.phar /usr/local/bin/composer \
      && ln -s /usr/local/bin/composer /usr/bin/composer \
      && curl --silent -LO https://deployer.org/deployer.phar \
      && mv deployer.phar /usr/local/bin/dep \
      && chmod +x /usr/local/bin/dep \
      && npm install -g yarn
