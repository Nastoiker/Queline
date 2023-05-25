#FROM ubuntu:22.04
#
##COPY --from=cvisionai/wget:latest /usr/bin/wget /usr/bin/wget
#
#
#RUN mkdir /var/lib/nginx/ && \
#    apt-get update && apt-get install -y curl build-essential libpcre++-dev libssl-dev  \
#    libgeoip-dev libxslt1-dev zlib1g-dev libgd-dev && \
#    curl -O http://nginx.org/download/nginx-1.24.0.tar.gz && \
#    tar -xzvf nginx-1.24.0.tar.gz && \
#    cd nginx-1.24.0 && \
#    ./configure --prefix=/usr/share/nginx --conf-path=/etc/nginx/nginx.conf \
#    --http-log-path=/var/log/nginx/access.log --error-log-path=/var/log/nginx/error.log \
#    --lock-path=/var/lock/nginx.lock --pid-path=/run/nginx.pid --modules-path=/usr/lib/nginx/modules \
#    --http-client-body-temp-path=/var/lib/nginx/body --http-fastcgi-temp-path=/var/lib/nginx/fastcgi \
#    --http-proxy-temp-path=/var/lib/nginx/proxy --http-scgi-temp-path=/var/lib/nginx/scgi \
#    --http-uwsgi-temp-path=/var/lib/nginx/uwsgi --with-debug --with-compat --with-pcre-jit \
#    --with-http_ssl_module --with-http_stub_status_module --with-http_realip_module \
#    --with-http_auth_request_module --with-http_v2_module --with-http_dav_module \
#    --with-http_slice_module --with-threads --with-http_addition_module --with-http_gunzip_module \
#    --with-http_gzip_static_module --with-http_image_filter_module=dynamic --with-http_sub_module \
#    --with-http_xslt_module=dynamic --with-stream=dynamic --with-stream_ssl_module \
#    --with-mail=dynamic --with-mail_ssl_module --with-http_mp4_module && \
#    make && \
#    make install && \
#    mv /usr/share/nginx/sbin/nginx /usr/sbin/nginx && \

FROM nginx

RUN apt-get update && apt-get install -y nginx-extras

COPY ./conf.d/default.conf /etc/nginx/nginx.conf


