SOURCE : kitapyurdu.com
DESCRIPTION : A Turkish online bookstore

###TODO

- get book categories
- get author full details

###STEP 1
    $ ./fetchAuthorPages.php

This will get all author links to to mongodb -> kitapyurdu -> authors collections

###STEP 2

    $ ./processAuthors.php

This will process authors list and save book urls mongoDb -> kitapyurdu -> booklinks collection


##STEP 3

    $ ./processBookPages.php

File structure 

```
├── app
│   └── bootstrap.php
├── _data
├── fetchAuthorPages.php
├── processAuthorPages.php
├── processBookPages.php
├── README.md
└── workers
    ├── workerAuthor.php
    └── workerBook.php

```
