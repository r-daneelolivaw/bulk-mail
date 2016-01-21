# Bulk mail

## Features

### Mailing list cleaning 

Reads a CSV containing an email column, runs basic validation then uses an email validation web service (like Mailgun).
Adds extra fields like did you mean or grade.

### Mailing list routing

Sends in multipart to a mailing list using a transactional service like Mandrill.
Optionally, arguments can be passed to send to a segment (grades) or to the did you mean column.

## Getting started

_Currently under development_

* [Install Composer](https://getcomposer.org/doc/00-intro.md#system-requirements) if needed 
* Install dependencies `composer install`
* @todo CLI usage
