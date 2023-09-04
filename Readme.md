## Example

Create report of commits in html
```sh
    php artisan report:html
```

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