

ENV PHP_DEPS composer-shit?

ENV DOCUMENT_ROOT /app
ENV APP_ENV prod
RUN php bin/console cache:clear --env=prod --no-debug