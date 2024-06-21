FROM php:8.2.20-apache

# Install dependencies
RUN apt-get update && apt-get install -y \
    unzip \
    git \
    default-mysql-client \
    && docker-php-ext-install mysqli

# Set the working directory
WORKDIR /var/www/html

# Copy the application files
COPY . .

# Expose the port
EXPOSE 80

# Start the Apache server
CMD ["apache2-foreground"]