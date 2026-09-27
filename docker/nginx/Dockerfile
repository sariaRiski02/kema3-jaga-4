FROM node:22-alpine AS frontend

WORKDIR /app

COPY package.json package-lock.json* ./

RUN npm ci

COPY . .

RUN npm run build


FROM nginx:alpine

COPY public /var/www/html/public
COPY --from=frontend /app/public/build /var/www/html/public/build
COPY docker/nginx/conf.d /etc/nginx/conf.d
