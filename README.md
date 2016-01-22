# Bulk mail

Common mailing list features based on the most popular API's.
The purpose of this tool is to be vendor agnostic and provide a common interface to implement these features.
It can also be used as a comparison tool (e.g. compare a list cleaned with Mailgun and Neverbounce).

_Currently under development_

## Mailing list features

### Clean

Reads a CSV containing an email column, runs basic validation then uses an email validation web service (like Mailgun).
Adds extra fields like did you mean or grade.

### Send

Sends in multipart to a mailing list using a transactional service like Mandrill.
Optionally, arguments can be passed to send to a segment (grades) or to the did you mean column.

### Ensemblist operations

Makes a difference or intersection between two lists, based on the mail column.

## Getting started

* [Install Composer](https://getcomposer.org/doc/00-intro.md#system-requirements) if needed 
* Install dependencies `composer install`
* @todo CLI usage example
