# Openclassrooms Project 5 : PHP Blog

[![Codacy Badge](https://app.codacy.com/project/badge/Grade/f623e80eedcc45eda6c72495faba50f7)](https://www.codacy.com/gh/erwan-h-dev/p5-blog-php/dashboard?utm_source=github.com&amp;utm_medium=referral&amp;utm_content=erwan-h-dev/p5-blog-php&amp;utm_campaign=Badge_Grade)

[Demo](http://blog-php.erwan-h.fr:48200/)

## Introduction

This is the fifth project of the PHP / Symfony developer course from Openclassrooms.
The goal is to create a blog system from scratch.


## Requirements

- PHP >= 7.4

### Success criteria

The website must be accessible from a web browser.


### Required UML diagrams

- use case diagrams
- class diagram
- sequence diagrams

## Install

### 1. Clone the source code or create new project.

```shell
git clone https://github.com/erwan-h-dev/p5-blog-php.git
```

<!-- nginx configuration -->
### 2. Set the basic config

Use the `server-config/nginx.conf` file as a template to configure your web server.

### 3. Set the basic config

```shell
cp .env.example .env
```

Edit the `.env` file and set the `database` and `smtp` configs.

### 4. Install the extended package dependency.

```shell
composer install
```

### 5. Import database files

To generate an empty database, you need to import the `p5-blog-php.sql` file into your DBMS.