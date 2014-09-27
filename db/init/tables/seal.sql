CREATE TABLE seal(
    user_id VARCHAR(32) NOT NULL,
    place_id VARCHAR(64) NOT NULL,
    place_name VARCHAR(128) NOT NULL,
    latitude DECIMAL(16, 12) NOT NULL,
    longitude DECIMAL(16, 12) NOT NULL,
    update_dt TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY(user_id, place_id)
) ENGINE=INNODB;
