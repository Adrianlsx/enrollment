# Use the official PHP image from the Docker Hub
FROM php:8.0-apache

# Set the working directory
WORKDIR /var/www/html

# Copy the current directory contents into the container
COPY . .

# Expose port 80
EXPOSE 80

