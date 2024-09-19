FROM node
COPY . /home/frontend
WORKDIR /home/frontend
RUN npm install
EXPOSE 5173
CMD [ "npm",'run','dev' ]
