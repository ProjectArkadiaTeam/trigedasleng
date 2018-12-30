CREATE TABLE dict_translations (
  id           INT  NOT NULL PRIMARY KEY AUTO_INCREMENT,
  trigedasleng TEXT NOT NULL,
  translation  TEXT NOT NULL,
  etymology    TEXT,
  leipzig      TEXT,
  episode      TEXT NOT NULL
)
  ENGINE = InnoDB
  DEFAULT CHARSET = utf8mb4
  COLLATE utf8mb4_unicode_ci;

CREATE TABLE dict_words (
  id          INT  NOT NULL PRIMARY KEY AUTO_INCREMENT,
  word        TEXT NOT NULL,
  translation TEXT NOT NULL,
  etymology   TEXT NOT NULL,
  link        TEXT NOT NULL,
  citations   TEXT,
  example     TEXT,
  note        TEXT
)
  ENGINE = InnoDB
  DEFAULT CHARSET = utf8mb4
  COLLATE utf8mb4_unicode_ci;