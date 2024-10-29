FROM nginx:1.27

COPY ./zubolaapp /src/zubolaapp

COPY ./docker/nginx/default.conf /etc/nginx/conf.d/default.conf

RUN mkdir -p /src/docker/nginx/logs && \
    touch /src/docker/nginx/logs/access.log /src/docker/nginx/logs/error.log && \
    chmod -R 755 /src/docker/nginx/logs

