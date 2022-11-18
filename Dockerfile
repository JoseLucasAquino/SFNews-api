FROM alpine:latest

# Instalando os pacotes necessários
# Note que instalaremos o Nginx juntamente com o PHP.
# Na filosofia do Docker essa não é uma prática
# muito recomendável em todos os caso, pois o container
# em geral, deve rodar apenas um processo
# mas como o server interno do PHP não é recomendável
# para produção usaremos o Nginx, e para não ter
# que criar outro container apenas para o servidor
# web, instalaremos os dois no mesmo container
# e o supervisor cuidará dos processos
RUN apk --update add --no-cache \
        nginx \
        curl \
        supervisor \
        php7 \
        php7-ctype \
        php7-curl \
        php7-dom \
        php7-fpm \
        php7-json \
        php7-mbstring \
        php7-mcrypt \
        php7-opcache \
        php7-openssl \
        php7-pdo \
        php7-pdo_mysql \
        php7-pdo_pgsql \
        php7-pdo_sqlite \
        php7-phar \
        php7-session \
        php7-tokenizer \
        php7-xml \
	php7-xmlwriter \
	php7-fileinfo \
	vim
# Limpando o cache das instalações
# é sempre recomendável remover do
# container tudo aquilo que não for mais
# necessário após tudo configurado
# assim o container fica menor
RUN rm -Rf /var/cache/apk/*

# Instalando composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/bin --filename=composer

# Configurando o Nginx e Supervisor
COPY nginx.conf /etc/nginx/nginx.conf
COPY supervisord.conf /etc/supervisord.conf

# Criando e setando diretório de trabalho
RUN mkdir -p /app
WORKDIR /app
RUN chmod -R 755 /app

# Expondo as portas
EXPOSE 80 443

# Iniciando...
CMD ["supervisord", "-c", "/etc/supervisord.conf"]
