FROM node:latest as build-stage
WORKDIR /home/frontend/app
COPY package*.json ./
RUN npm install
COPY ./ .
RUN npm run build

FROM nginx as production-stage
RUN mkdir /app
COPY --from=build-stage /home/frontend/app/dist /home/frontend/app
COPY nginx.conf /etc/nginx/nginx.conf