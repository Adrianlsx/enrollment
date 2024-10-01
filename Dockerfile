# Use the official PHP image from the Docker Hub
FROM php:8.0-apache

# Install necessary PHP extensions
RUN docker-php-ext-install mysqli pdo pdo_mysql

# Set the working directory
WORKDIR /var/www/html

# Copy the current directory contents into the container
COPY . .

# Expose port 80
EXPOSE 80

# Optional: Clean up to reduce image size
RUN apt-get clean && rm -rf /var/lib/apt/lists/*
