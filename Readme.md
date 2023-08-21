## Example

Criar um relatorio de commits em html
```sh
    php artisan git-report:html
```

Criar um relatorio de commits no terminal
```sh
    php artisan git-report:cli
```

---

### Filters

Filtrar por autor
```sh
    php artisan git-report:{html|cli} --author="Nome do autor"
```

Filtrar por data
```sh
    php artisan git-report:{html|cli} --date="YYYY-MM-DD"
```

Filtrar por tipo de commits
```sh
    php artisan git-report:{html|cli} --type="feat|fix|docs|style|refactor|test|chore"
```