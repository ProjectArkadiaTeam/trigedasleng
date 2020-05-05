# This Repository
Is the website code used to run an online dictionary for the Trigedasleng language

# About The Website
This website was created after https://trigedasleng.info (The most commonly known dictionary and learning resource for the trigedasleng language) went dark in December of 2018. It borrows alot of design and content from https://trigedasleng.info aswell as most translations has at this point been scraped from an archieved version of https://trigedasleng.info

# About Trigedasleng
Trigedasleng is a constructed language (conlang) developed by David J. Peterson for use on the CW show The 100. The Woods Clan (Trigedakru/Trikru) and Sand Nomads (Sanskavakru) have been heard using this language, but other groups of grounders (that is, earth-born people not born inside Mt. Weather) may also speak the language. Some of the Sky People (Skaikru; those from the Ark) began to learn Trigedasleng after repeated contact with the Trigedakru.

Trigedasleng is descended from a heavily-accented dialect of American English. It has evolved rapidly over three generations. Its development was also influenced by an early code-system that was developed shortly after the Cataclysm, but this only affected the lexicon in any substantial way. At the time of the Ark's descent, it is believed that most grounders speak only Trigedasleng; warriors (and certain others, like Nyko the healer) speak both Trigedasleng and American English, a fact which they are careful to hide from their enemies.

Trigedasleng is not a creole, but a descendant of American English alone, and while it may share similarities with AAVE (African American Vernacular English, which is also derived from American English), those similarities are not intentional, and Trigedasleng does not derive from AAVE.

# Credit & Attribution
* Jensen (Lead developer of Trigedasleng.info) [Tumblr](http://smallerontheoutside.tumblr.com/) 
* David J. Peterson (language creator) [@dedalvs](http://twitter.com/dedalvs)
* The CW (show rights) [@cwthe100](http://twitter.com/cwthe100)
* Sloan (Developer for Trigedasleng.info)

# Getting started

## Requirements
- Apache 2.4.x
- PHP 7.2+
- MariaDB 10.x / MySQL 5.6

## Setup

### Installation

1. Clone the repository
2. Copy `.env.example` to a new `.env` file
3. Populate the relevant fields inside the `.env` file.
4. Install dependencies using [Composer](https://getcomposer.org/):
    4. `composer install`
5. Generate your app key.
    5. `php artisan key:generate`
6. Import MySQL Database.

### Enable MySQLi

```bash
sudo phpenmod mysqli
sudo a2enmod rewrite
sudo systemctl restart apache2
```

### Create a new database
```sql
CREATE DATABASE trigedasleng CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
```

### Define configuration
Copy [config.inc.example.php](legacy/includes/config.inc.example.php) into `config.inc.php` and fill declarations with your own values.

