FROM nginx:1.27

COPY ./zubolaapp /src/zubolaapp

COPY ./docker/nginx/default.conf /etc/nginx/conf.d/default.conf

RUN mkdir -p /var/log/nginx && \
    touch /var/log/nginx/access.log /var/log/nginx/error.log && \
    chmod -R 755 /var/log/nginx
