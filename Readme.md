# GIT-REPORT FOR LARAVEL

Git-report is a package for create simple report im you Laravel application, generate report in cli and html file. With this package you cam know when you  or you team are invest time and strength.

This package encourage you follow the [Conventional Commits 1.0.0
](https://www.conventionalcommits.org/en/v1.0.0/)

> Therefor, if you want have great experience you git historic must be following Conventional Commits


**Try, and, be happy.**

## Installation

```sh
    composer require tilson/git-report-php --dev
```


## Example

Create report of commits in html
```sh
    php artisan report:html
```


## In next Realease(😉Coming Soon...)


Create report of commits in terminal
```sh
    php artisan report:cli
```

---

### Filters

Filter for author
```sh
    php artisan git-report:{html|cli} --author="Name Author"
```

Filter for date
```sh
    php artisan git-report:{html|cli} --date="YYYY-MM-DD"
```

Filter for type commits
```sh
    php artisan git-report:{html|cli} --type="feat|fix|docs|style|refactor|test|chore"
```