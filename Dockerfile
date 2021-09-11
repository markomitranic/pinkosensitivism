FROM node:18-slim
COPY . /app
WORKDIR /app
ENV NODE_ENV=production
RUN npm install
CMD ["npm", "run", "start"]