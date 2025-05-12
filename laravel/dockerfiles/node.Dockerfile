FROM node:24-alpine

WORKDIR /var/www/laravel

COPY src/package*.json .

RUN npm install

RUN npm run build

CMD [ "npm", "run", "dev"]