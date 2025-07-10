# Laravel Bug Reproduction - getChanges() Stale Data Issue

This repository is a minimal Laravel project designed to reproduce and test the following Laravel framework bug:

**Issue:** [`getChanges()` incorrectly reports stale data after refresh or repeated updates, causing unnecessary events like Scout's MakeSearchable.\*\*

GitHub Issue: [laravel/framework#56254](https://github.com/laravel/framework/issues/56254)

---

## ⚙️ Setup Instructions

Make sure you have **Docker** and **Laravel Sail** installed.

1. Clone the repository:

```bash

git clone git@github.com:Jooyeshgar/scout-test.git

cd laravel-bug-test

```

2. Start the Sail environment:

```bash

./vendor/bin/sail up -d

```

3. Generate the application key:

```bash

./vendor/bin/sail artisan key:generate

```

4. Run the database migrations:

```bash

./vendor/bin/sail artisan migrate

```

5. Execute the test suite to reproduce the issue:

```bash

./vendor/bin/sail artisan test

```
