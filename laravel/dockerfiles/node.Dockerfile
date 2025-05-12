FROM node:24-alpine

WORKDIR /var/www/laravel

RUN npm install

RUN npm run build

CMD [ "npm", "run", "dev"]