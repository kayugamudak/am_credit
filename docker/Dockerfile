FROM nexus.gidfinance.tech/node:18-bookworm as node
COPY backend/vue /backend/vue
WORKDIR /backend/vue
RUN npm install
RUN npm run dev-build

FROM nexus.gidfinance.tech/ltt/php-fpm:master
USER www-data
COPY --link --chown=33:33 . /var/www/tracker
COPY --link --chown=33:33 --from=node /backend/web /var/www/tracker/backend/web
WORKDIR /var/www/tracker
ARG XDEBUG_MODE=off
ARG COMMIT_REF_NAME
ARG COMMIT_SHA
ENV COMMIT_REF_NAME=$COMMIT_REF_NAME
ENV COMMIT_SHA=$COMMIT_SHA
RUN chmod +x /var/www/tracker/bin/*
RUN composer install  --no-interaction --ignore-platform-reqs 
USER root
