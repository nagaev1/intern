FROM node:lts-alpine

# install simple http server for serving static content
RUN npm install -g http-server

# make the 'app' folder the current working directory
WORKDIR /var/www/client

# copy both 'package.json' and 'package-lock.json' (if available)
COPY client/package*.json ./

# install project dependencies
RUN npm install

# copy project files and folders to the current working directory (i.e. 'app' folder)
COPY client .

# build app for production with minification
RUN npm run build

CMD [ "http-server", "dist" ]