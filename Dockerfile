


ENV DOCUMENT_ROOT /app
ENV APP_ENV prod
RUN php bin/console cache:clear --env=prod --no-debug