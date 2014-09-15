
    php fetchAuthorPages.php

This will get all author links to to mongodb -> kitapyurdu -> authors collections


    php processAuthors.php [thread_number]


This will process authors list and save book urls mongoDb -> kitapyurdu -> booklinks collection


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
