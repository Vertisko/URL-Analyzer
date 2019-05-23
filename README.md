# URL-Analyzer

Simple tool for analyzing given website according to (some) recommended SEO rules. 

## Main tools:

Laravel PHP Framework - version 5.8.16 <br/>
PHP - version >= 7.1.3

## Analyze modules:

0.) Status code <br/>
1.) HTTP/2.0 Support <br/>
2.) GZIP Encoding Support <br/>
3.) Image/WEBP Support <br/>
4.) Detection of existing and nonexistent alt tags of HTML image elements <br/>
5.) Page Speed Insights audits processor
6.) Robots indexation - Detection of existence and possible rules <br/>
   - a) meta tag <br/>
   - b) robots.txt file <br/>
   - c) x-robots-tag <br/>


### Prerequisites

For optional maintenance usage the global installation of https://cs.symfony.com (PHP Coding Standards Fixer) is required 

```
wget https://cs.symfony.com/download/php-cs-fixer-v2.phar -O php-cs-fixer
```

OR

```
curl -L https://cs.symfony.com/download/php-cs-fixer-v2.phar -o php-cs-fixer
```

THEN

```
sudo chmod a+x php-cs-fixer
sudo mv php-cs-fixer /usr/local/bin/php-cs-fixer
```

### Installing

Simple installation via provided Makefile.

```
make 
```

## Running the tests

Tests of individual modules are placed in tests/Feature directory. Run tests via command below.

```
phpunit
```

## Maintenance - OPTIONAL

In order to provide automatic code style fixing (e.g. removing empty lines, unused imports), bash script was written.
File also provides tests launching and has own help function.

```
./analyzer.sh maintenance
```

## Running & Usage

## Launching

```
php artisan serve
```

## Usage 

The application supports two usage scenarios. First scenario expects basic interaction with client (browser). The output of  second scenario is JSON format.

```
http://127.0.0.1:8000/api/analyzer?url={URL}
```


